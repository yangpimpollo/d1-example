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
        Schema::create('orders', function (Blueprint $table) {
            $table->string('order_id')->primary();
            $table->date('order_date')->default(now()->toDateString());
            $table->string('customer_id'); 
            $table->string('store_id'); 
            $table->unsignedBigInteger('staff_id'); 
            $table->timestamps();

            $table->foreign('customer_id')->references('dni')->on('customers')->onDelete('cascade');
            $table->foreign('store_id')->references('id')->on('stores')->onDelete('cascade');
            $table->foreign('staff_id')->references('dni')->on('staffs')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
