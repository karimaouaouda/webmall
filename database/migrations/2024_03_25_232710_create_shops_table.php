<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('shops', function (Blueprint $table) {
            $table->foreignId('seller_id')
                ->references('id')
                ->on('sellers')
                ->cascadeOnDelete()
                ->cascadeOnUpdate();

            $table->string('unique_name')
                ->uniqid();

            $table->string('name');
            $table->tinyText('description');
            $table->string('logo');
            $table->string('cover');
            $table->enum('status', [
                'processing',
                'accepted',
                'rejected'
            ]);
            $table->timestamps();

            $table->primary('unique_name');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shops');
    }
};
