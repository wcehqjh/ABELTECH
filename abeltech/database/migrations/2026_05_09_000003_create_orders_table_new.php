<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        // Vérifier si la table existe déjà
        if (!Schema::hasTable('orders')) {
            Schema::create('orders', function (Blueprint $table) {
                $table->id();
                $table->string('order_number')->unique();
                $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
                $table->string('customer_name');
                $table->string('customer_email');
                $table->string('customer_phone');
                $table->text('address');
                $table->string('city');
                $table->string('zip')->nullable();
                $table->string('payment_method');
                $table->text('notes')->nullable();
                $table->decimal('subtotal', 10, 2)->default(0);
                $table->decimal('total', 10, 2)->default(0);
                $table->decimal('shipping', 10, 2)->default(0);
                $table->enum('status', ['pending', 'processing', 'completed', 'cancelled'])->default('pending');
                $table->timestamps();
                
                $table->index('order_number');
                $table->index('status');
                $table->index('created_at');
            });
        }
    }

    public function down()
    {
        Schema::dropIfExists('orders');
    }
};
