<?php

namespace App\Http\Controllers;

use App\Http\Requests\CourseRequest;
use App\Models\Course;
use Illuminate\Support\Facades\Auth;

class CourseController extends Controller
{
    public function course_add(){
        if(!Auth::check()){
            return redirect()->route("dashboard");
        }
        if(Auth::user()->role !== "admin"){
            return redirect()->route("dashboard");
        }
        return view("course_create");
    }
    public function course_addform(CourseRequest $request){
        if(Auth::user()->role !== "admin"){
            return redirect()->route("dashboard");
        }
        $course = new Course();
        $course->name = $request->name;
        $course->description = $request->description;
        $course->save();
        return redirect()->route("dashboard");
    }
    public function course_delete(Course $course){
        if(Auth::user()->role !== "admin"){
            return redirect()->route("dashboard");
        }
        $course->delete();
        return redirect()->route("dashboard");
    }
    public function course_edit(Course $course){
        if(Auth::user()->role !== "admin"){
            return redirect()->route("dashboard");
        }
        return view("course_edit", compact("course"));
    }
    public function course_editform(CourseRequest $request, Course $course){
        if(Auth::user()->role !== "admin"){
            return redirect()->route("dashboard");
        }
        $course->name = $request->name;
        $course->description = $request->description;
        $course->save();
        return redirect()->route("dashboard");
    }
}
