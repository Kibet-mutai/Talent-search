<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HireFreelancer extends Model
{
    use HasFactory;
    protected $fillable = [
        'employer_id',
        'freelancer_id',
        'job_description',
        'job_type',
        'payment_rates',
        'status'
    ];
    
}
