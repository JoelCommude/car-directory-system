<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;


    protected $fillable = [
        'id',
        'name',
        'color',
    ];

    public function transactions()
    {
        return $this->hasMany(Transaction::class, 'company_id');
    }
}
