<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        // Table commandes
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('order_number')->unique(); // EX: ABL-2024-0001
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();

            // Infos client
            $table->string('customer_name');
            $table->string('customer_email');
            $table->string('customer_phone');

            // Adresse livraison
            $table->string('address');
            $table->string('city');
            $table->string('zip')->nullable();

            // Statut
            $table->enum('status', [
                'pending',    // En attente
                'confirmed',  // Confirmée
                'processing', // En préparation
                'shipped',    // Expédiée
                'delivered',  // Livrée
                'cancelled',  // Annulée
            ])->default('pending');

            // Paiement
            $table->enum('payment_method', ['cash', 'card', 'transfer'])->default('cash');
            $table->enum('payment_status', ['unpaid', 'paid', 'refunded'])->default('unpaid');

            $table->decimal('subtotal', 10, 2);
            $table->decimal('shipping', 10, 2)->default(0);
            $table->decimal('total', 10, 2);
            $table->text('notes')->nullable();
            $table->timestamps();
        });

        // Lignes de commande
        Schema::create('order_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained()->cascadeOnDelete();
            $table->foreignId('product_id')->nullable()->constrained()->nullOnDelete();
            $table->string('product_name'); // snapshot du nom
            $table->decimal('product_price', 10, 2);
            $table->integer('quantity');
            $table->decimal('subtotal', 10, 2);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('order_items');
        Schema::dropIfExists('orders');
    }
};