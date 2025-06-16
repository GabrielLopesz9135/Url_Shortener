<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::connection('mongodb')->create('plans', function (Blueprint $collection) {
            $collection->id();
            $collection->string('name');
            $collection->integer('daily_limit');
            $collection->decimal('price', 8, 2);
            $collection->timestamps();
        });
    }

    public function down(): void
    {
        Schema::connection('mongodb')->dropIfExists('plans');
    }
};
