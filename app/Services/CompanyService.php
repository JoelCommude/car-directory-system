<?php

namespace App\Services;

use App\Repositories\CompanyRepository;
use App\Http\Resources\CompanyResource;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class CompanyService
{
    public function __construct(
        private CompanyRepository $companyRepository,
    ){}

    public function getCompanyList(): AnonymousResourceCollection
    {
        $data = $this->companyRepository->fetchAll();
        return CompanyResource::collection($data);
    }
}