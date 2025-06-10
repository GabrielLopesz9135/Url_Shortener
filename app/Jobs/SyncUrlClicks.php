<?php

namespace App\Jobs;

use App\Models\Url;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redis;

class SyncUrlClicks implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        Log::info('Executando job de sincronização de cliques...');
        $keys = Redis::keys('clicks:*');

        foreach ($keys as $key) {
            $shortCode = str_replace('clicks:', '', $key);
            $clicks = (int) Redis::get($key);

            Url::on('mongodb')
                ->where('short_code', $shortCode)
                ->increment('clicks', $clicks);

            Redis::del($key);
        }
    }

}
