<?php

use App\Enums\CommandStatus;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::dropIfExists('commands_products');

        Schema::create('commands_products', function (Blueprint $table) {
            $table->foreignId('command_id')
                ->references('id')
                ->on('commands');

            $table->foreignId('product_id')
                ->references('id')
                ->on('products');


            $table->integer('quantity', false);

            $table->integer('sold')->default(0);



            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('commands_products');
    }
};
