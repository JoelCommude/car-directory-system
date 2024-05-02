<?php

namespace App\Services;

use App\Repositories\BodyRepository;
use App\Http\Resources\BodyResource;


class BodyService
{
    public function __construct(
        private BodyRepository $bodyRepository,
    ){}

    public function getBodyList()
    {
        $data = $this->bodyRepository->fetchAll();
        return BodyResource::collection($data);
    }
}