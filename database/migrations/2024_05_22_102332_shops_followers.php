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
        Schema::create('shops_followers', function(Blueprint $table){
            $table->foreignId('client_id')
                        ->references('id')
                        ->on('clients')->cascadeOnUpdate()->cascadeOnDelete();

            $table->string('shop_unique_name');

            $table->foreign('shop_unique_name')
                        ->references('unique_name')
                        ->on('shops')
                        ->cascadeOnDelete()
                        ->cascadeOnUpdate();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shops_followers');
    }
};
