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
        Schema::dropIfExists('products');
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('sub_category_name');
            $table->string('shop_unique_name');
            $table->string('slug');
            $table->tinyText('description');
            $table->float('price');
            $table->tinyInteger('welcome_solde');
            $table->integer('available_qte', unsigned: true);
            $table->tinyInteger('solde', unsigned:true)->default(0);
            $table->integer('sensitive_qte', unsigned:true);
            $table->timestamps();

            $table->foreign('sub_category_name')->references('name')->on('sub_categories')
                ->cascadeOnUpdate()
                ->noActionOnDelete();

            $table->foreign('shop_unique_name')->references('unique_name')->on('shops')
                    ->cascadeOnDelete()
                    ->cascadeOnUpdate();
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
