<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Curriculum extends Model
{

    protected $table = 'curriculums';

    use HasFactory;

    public function homeworks() {
        return $this->hasMany(Homework::class);
    }

    public function attendances() {
        return $this->hasMany(Attendance::class);
    }

    public function notes() {
        return $this->belongsToMany(Note::class, 'curriculum_note');
    }

    public function course() {
        return $this->belongsTo(Course::class);
    }
}
