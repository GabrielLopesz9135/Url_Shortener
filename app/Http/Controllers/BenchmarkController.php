<?php

namespace App\Http\Controllers;

use App\Events\UrlVisited;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class BenchmarkController extends Controller
{
    public function redisBenchmark($short_code)
    { 
        Redis::incr("clicks:{$short_code}");
    }

    public function directBenchmark($short_code)
    {
        event(new UrlVisited($short_code));
    }
}
