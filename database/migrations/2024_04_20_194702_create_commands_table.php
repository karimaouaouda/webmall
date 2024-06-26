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
        Schema::create('commands', function (Blueprint $table) {
            $table->id();
            $table->foreignId('client_id')
            ->references('id')
            ->on('clients');

            $table->string('shop_unique_name');

            $table->json('ship_to')->nullable();

            $table->enum('status', \App\Enums\CommandStatus::values());

            $table->string('tracking_code')->nullable();

            $table->string('shipping_with');

            $table->timestamps();


            $table->foreign('shop_unique_name')
                ->references('unique_name')
                ->on('shops');

            $table->foreign('shipping_with')
                ->references('company_name')
                ->on('shipping_methods');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('commands');
    }
};
