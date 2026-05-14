<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    protected $fillable = [
        'order_number',
        'user_id',
        'customer_name',
        'customer_email',
        'customer_phone',
        'address',
        'city',
        'zip',
        'payment_method',
        'notes',
        'subtotal',
        'total',
        'shipping',
        'status',
    ];

    protected $casts = [
        'subtotal' => 'decimal:2',
        'total' => 'decimal:2',
        'shipping' => 'decimal:2',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Générer un numéro de commande unique
     */
    public static function generateNumber(): string
    {
        $prefix = 'ABEL-';
        $year = date('Y');
        $month = date('m');
        
        $lastOrder = self::whereYear('created_at', $year)
            ->whereMonth('created_at', $month)
            ->orderBy('id', 'desc')
            ->first();
        
        if ($lastOrder) {
            $lastNumber = intval(substr($lastOrder->order_number, -4));
            $newNumber = str_pad($lastNumber + 1, 4, '0', STR_PAD_LEFT);
        } else {
            $newNumber = '0001';
        }
        
        return $prefix . $year . $month . '-' . $newNumber;
    }

    /**
     * Relation avec les articles de commande
     */
    public function items(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    /**
     * Relation avec l'utilisateur
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Mettre à jour le total automatiquement
     */
    protected static function booted()
    {
        static::saving(function ($order) {
            if ($order->subtotal && !$order->total) {
                $order->total = $order->subtotal + $order->shipping;
            }
        });
    }
}
