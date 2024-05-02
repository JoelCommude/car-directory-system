<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'user_id',
        'company_id',
        'car_id',
        'plate_number',
        'engine_number',
        'fuel_id',
        'body_id',
        'updated_by',
    ];

    public function company(){
        return $this->belongsTo(Company::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function car(){
        return $this->belongsTo((Car::class));
    }

    public function fuel(){
        return $this->belongsTo((Fuel::class));
    }

    public function body(){
        return $this->belongsTo((Body::class));
    }
}
