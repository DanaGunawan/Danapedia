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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('title', 255);
            $table->string('slug',255)->nullable;
            $table->unsignedBigInteger('category_id')->nullable();
            $table->unsignedBigInteger('sub_category_id')->nullable();
            $table->unsignedBigInteger('brand_id')->nullable();
            $table->string('size', 25)->nullable();
            $table->string('colors', 25)->nullable();
            $table->double('old_price')->default(0);
            $table->double('price')->default(0);
            $table->text('short_description')->nullable();
            $table->longText('description')->nullable();
            $table->text('additional_informations')->nullable();
            $table->string('shipping_returns', 120)->nullable();
            $table->timestamp('created_at')->useCurrent()->nullable();
            $table->string('created_by')->useCurrent()->nullable();
            $table->string('related_product', 255)->nullable();
            $table->string('images', 150)->nullable();
            $table->string('status', 10)->default('Active');
            $table->boolean('is_deleted')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
