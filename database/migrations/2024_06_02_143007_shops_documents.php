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
        Schema::dropIfExists('shops_documents');
        Schema::create('shops_documents', function(Blueprint $table){

            $table->id();

            $table->string('shop_unique_name');


            $table->string('document');

            $table->string('serial_number');

            $table->timestamp('starts_at');

            $table->enum('status', \App\Enums\ShopStatus::values());

            $table->foreignId('processed_by')
                ->nullable()
                ->references('id')
                ->on('admins');

            $table->text('admin_note')->nullable();

            $table->timestamps();



            $table->foreign('shop_unique_name')
                ->references('unique_name')
                ->on('shops');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shops_documents');
    }
};
