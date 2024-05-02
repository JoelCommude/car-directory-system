<?php

namespace App\Repositories;

use App\Models\Company;


class CompanyRepository
{
    public function fetchAll()
    {
        return Company::all();
    }
}