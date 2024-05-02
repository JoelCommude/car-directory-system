<?php

namespace App\Repositories;

use App\Models\Body;


class BodyRepository
{
    public function fetchAll()
    {
        return Body::all();
    }
}