<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Body extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'name',
    ];

    public function transactions()
    {
        return $this->hasMany(Transaction::class, 'body_id');
    }
}
