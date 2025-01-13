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
        Schema::create('settings', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('key');
            $table->string('data');
            $table->unsignedSmallInteger('permission')->default(0);
            $table->uuid('create_by')->nullable();
            $table->boolean('can_expaired')->default(false);
            $table->timestamp('expired_at')->nullable();
            $table->timestamps();
            
            $table->foreign('create_by')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
