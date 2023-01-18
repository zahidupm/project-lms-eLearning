<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Course;
use Flasher\Prime\FlasherInterface;

class CourseIndex extends Component
{
    public function render()
    {
        $course = Course::paginate(10);

        return view('livewire.course-index', [
            'courses' => $course
        ]);
    }

    public function courseDelete($id, FlasherInterface $flasher) {
        $course = Course::findOrFail($id);
        $course->delete();

        flash()->addSuccess('Course deleted successful');
    }
}
