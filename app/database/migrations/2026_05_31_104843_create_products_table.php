<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->uuid('id')->primary();

            $table->uuid('product_set_id');

            $table->string('sku');

            $table->string('name', 50);
            $table->string('slug');

            $table->enum('type', ['device', 'service']);
            $table->enum('condition', ['new', 'used', 'refurbished']);

            $table->string('description_title');
            $table->text('description_text');

            $table->decimal('price', 10, 2);
            $table->decimal('price_wo_vat', 10, 2);

            $table->decimal('wholesale_price', 10, 2);

            $table->boolean('published')->default(false);

            $table->timestamps();

            $table->foreign('product_set_id')
                ->references('id')
                ->on('product_sets')
                ->cascadeOnDelete();

            $table->index('product_set_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
