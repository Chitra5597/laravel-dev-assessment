<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JobPosting extends Model
{
    protected $fillable = [
        'job_title',
        'description',
        'experience',
        'salary',
        'location',
        'extra_info',
        'company_name',
        'logo',
        'skills',
    ];

    protected $casts = [
        'skills' => 'array',
        'extra_info' => 'array',
    ];

}
