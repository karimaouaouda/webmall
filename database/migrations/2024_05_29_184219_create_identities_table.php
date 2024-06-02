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
        Schema::create('identities', function (Blueprint $table) {
            $table->id();
            $table->string('identifiable_type');
            $table->integer('identifiable_id');
            $table->string('id_path');

            $table->foreignId('processed_by')->nullable()
                ->references('id')
                ->on('admins');

            $table->text('admin_note')->nullable();


            $table->enum('status', \App\Enums\IdentityStatus::values());
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('identities');
    }
};
