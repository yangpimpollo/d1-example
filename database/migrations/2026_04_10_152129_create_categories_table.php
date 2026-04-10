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
        Schema::create('categories', function (Blueprint $table) {
            $table->char('category_id', 1)->primary(); 
            $table->string('category_name', 100);
        });

        // Insert initial data
        DB::table('categories')->insert([
            ['category_id' => 'A', 'category_name' => 'Pizzas Clásicas'],
            ['category_id' => 'B', 'category_name' => 'Pizzas Especiales'],
            ['category_id' => 'C', 'category_name' => 'Empanadas'],
            ['category_id' => 'D', 'category_name' => 'Entradas u otros'],
            ['category_id' => 'E', 'category_name' => 'Bebidas'],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
