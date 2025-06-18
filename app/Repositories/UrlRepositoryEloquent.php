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
        $this->model->create($data);
        return $data['short_code'];
    }

    public function redirect($short_code)
    {
        $url = $this->model->where('short_code', $short_code)->first();
        return $url;
    }

    public function stats($short_code)
    {
        $url = $this->model->where('short_code', $short_code)->first();
        return $url;
    }

    public function shortCodeExists(string $shortCode): bool 
    {
        return $this->model->on('mongodb')->where('short_code', $shortCode)->exists();
    }


}