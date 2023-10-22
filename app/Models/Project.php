<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $casts = [
        'start_at' => 'date',
        'end_at' => 'date',
    ];

    protected $fillable = [
        'name',
        'description',
        'start_at',
        'end_at',
        'company_id'
    ];
}
