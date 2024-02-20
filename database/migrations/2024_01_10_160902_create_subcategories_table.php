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


            Schema::create('subcategories', function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->foreignId('category_id')->references('id')->on('categories');
                $table->string('picture')->nullable();
                $table->timestamps();
            });

    }


    public function down(): void
    {
        Schema::dropIfExists('subcategories');
    }
};
