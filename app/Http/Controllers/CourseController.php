<?php

namespace App\Http\Controllers;

use App\Http\Requests\CourseRequest;
use App\Models\Course;

class CourseController extends Controller
{
    public function course_add(){
        return view("course_create");
    }

    public function course_addform(CourseRequest $request){
        $course = new Course();
        $course->name = $request->name;
        $course->description = $request->description;
        $course->save();
        
        return redirect()->route("dashboard");
    }

    public function course_delete(Course $course){
        $course->delete();
        return redirect()->route("dashboard");
    }

    public function course_edit(Course $course){
        return view("course_edit", compact("course"));
    }

    public function course_editform(CourseRequest $request, Course $course){
        $course->name = $request->name;
        $course->description = $request->description;
        $course->save();

        return redirect()->route("dashboard");
    }

}
