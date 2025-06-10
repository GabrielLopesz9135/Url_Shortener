<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::connection('mongodb')->create('urls', function (Blueprint $collection) {
        });

        Schema::connection('mongodb')->table('urls', function (Blueprint $collection) {
            $collection->index('short_code');
            $collection->index('original_url');
            $collection->index('clicks');
            $collection->index('created_at');
        });

        DB::connection('mongodb')
        ->getCollection('urls')
        ->createIndex(
            ['expire_at' => 1],
            [
                'expireAfterSeconds' => 0,
                'name' => 'expire_at_ttl_index'
            ]
        );
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
         Schema::connection('mongodb')->drop('urls');
    }
};
