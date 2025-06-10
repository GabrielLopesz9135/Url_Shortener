<?php

namespace App\Repositories;

use App\Models\Url;

interface UrlRepositoryInterface
{

    public function __construct(Url $data);

        public function shortener($data);
        public function redirect($data);
        public function stats($short_code);
        public function shortCodeExists(string $shortCode): bool;

}