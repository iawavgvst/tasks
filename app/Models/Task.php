<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Task extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = false;
    protected $table = 'tasks';

    protected $fillable = [
        'title',
        'description',
        'due_date',
        'status',
        'priority',
        'category',
    ];

    protected $casts = [
        'created_at' => 'datetime:Y-m-d',
        'due_date' => 'datetime:Y-m-d',
    ];

    protected $hidden = [
        'updated_at',
        'deleted_at'
    ];
}
