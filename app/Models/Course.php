<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'price',
        'user_id'
    ];

    public function curriculums() {
        return $this->hasMany(Curriculum::class);
    }

    public function students() {
        return $this->belongsToMany(User::class, 'course_student', 'course_id', 'user_id');
    }
}
