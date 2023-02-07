<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $fillable = [
        'employer_id',
        'freelancer_id',
        'rating',
        'review'
    ];


    public function freelancer() {
        return $this->belongsTo(Freelancer::class);
    }
}
