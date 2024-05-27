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
        Schema::create('interests', function (Blueprint $table) {
            $table->foreignId('client_id')
                    ->references('id')
                    ->on('clients')
                    ->cascadeOnDelete();

            $table->string('sub_category_name');

            $table->foreign('sub_category_name')
                    ->references('name')
                    ->on('sub_categories');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('interests');
    }
};
