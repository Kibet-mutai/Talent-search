<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Role;

class Freelancer extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'first_name',
        'last_name',
        'gender',
        'location',
        'resume',
        'image',
        'skills'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // public function role()
    // {
    //     return $this->belongsTo(Role::class);
    // }
    public function employer() {
        return $this->belongsToMany(Employer::class);
    }


    public function review() {
        return $this->hasMany(Review::class);
    }
}
