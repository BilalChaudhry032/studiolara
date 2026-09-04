<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactSubmission extends Model
{
    protected $fillable = [
        'name',
        'email',
        'company',
        'project_type',
        'budget_range',
        'timeline',
        'description',
        'ip_address',
    ];
}
