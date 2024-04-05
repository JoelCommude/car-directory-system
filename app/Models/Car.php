<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_id',
        'id',
        'name',
    ];

    public function transactions(){
        return $this->hasMany(Transaction::class, 'car_id');
    }
}
