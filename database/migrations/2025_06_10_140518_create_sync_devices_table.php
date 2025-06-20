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
        Schema::create('sync_devices', function (Blueprint $table) {
            $table->id();
            $table->string('device_id');
            $table->string('user_id');
            $table->foreignId('account_id')->constrained();
            $table->string('account_key');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sync_devices');
    }
};
