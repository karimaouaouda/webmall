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
        Schema::create('bans', function(Blueprint $table){
            $table->id();
            $table->foreignId('admin_id')
                        ->references('id')
                        ->on('admins')
                        ->cascadeOnDelete()
                        ->cascadeOnUpdate();

            $table->string('bannable_type');

            $table->integer('bannable_id');

            $table->text('reason');

            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
