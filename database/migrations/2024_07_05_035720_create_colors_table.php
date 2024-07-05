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
        Schema::create('colors', function (Blueprint $table) {
            $table->id();
            $table->String('name');
            $table->String('code');
            $table->String('created_by');
            $table->tinyInteger('is_deleted')->default(0);
            $table->tinyInteger('status')->default('Active');
            $table->timestamps('created_at')->nullable();
            $table->timestamps('updated_at')->nullable();
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('colors');
    }
};
