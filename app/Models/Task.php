<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    const BACKLOG = 'backlog';
    const INPROGRESS = 'in-progress';
    const COMPLETED = 'completed';
    const CANCELED = 'canceled';

    protected $fillable = [
        'name',
        'description',
        'assigned_to',
        'project_id',
        'company_id',
        'created_by',
        'status',
    ];

    public function author()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function asignee()
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }

    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id');
    }
}
