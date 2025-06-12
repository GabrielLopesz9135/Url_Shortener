<?php

namespace App\Repositories;
use App\Models\Url;

class UrlRepositoryEloquent implements UrlRepositoryInterface
{

    private $model;

    public function __construct(Url $data)
    {
        $this->model = $data;
    }

    public function shortener($data)
    {
        Url::create($data);
        return $data['short_code'];
    }

    public function redirect($short_code)
    {
        $url = Url::where('short_code', $short_code)->first();
        return $url;
    }

    public function stats($short_code)
    {
        $url = Url::where('short_code', $short_code)->first();
        return $url;
    }

    public function shortCodeExists(string $shortCode): bool 
    {
        return Url::on('mongodb')->where('short_code', $shortCode)->exists();
    }


}