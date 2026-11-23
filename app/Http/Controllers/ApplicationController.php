<?php

namespace App\Http\Controllers;

use App\Http\Requests\ApplicationRequest;
use App\Http\Requests\ReviewRequest;
use App\Http\Requests\StatusRequest;
use App\Models\Application;
use App\Models\Course;
use Illuminate\Support\Facades\Auth;

class ApplicationController extends Controller
{
    public function application_add($course_id = null){
        $course = Course::find($course_id);
        $course_name = $course ? $course->name : null;
        return view("application_create", compact("course_name"));
    }
    public function application_addform(ApplicationRequest $request){
        $application = new Application();
        $application->user_id = Auth::user()->id;
        $application->course_name = $request->course_name;
        $application->date = $request->date;
        $application->payment = $request->payment;
        $application->status = "new";
        $application->save();
        return redirect()->route("dashboard");
    }
    public function application_admin(){
        $applications = Application::with("user")->orderBy('created_at', 'desc')->paginate(10);
        return view("application_admin", compact("applications"));
    }
    public function application_update_status(StatusRequest $request, Application $application){
        $application->status = $request->status;
        $application->save();
        return redirect()->route("application_admin");
    }
    public function application_list(){
        $applications = Application::where("user_id", Auth::user()->id)->with("user")->orderBy('created_at', 'desc')->get();
        return view("application_my", compact("applications"));
    }
    public function application_review(ReviewRequest $request, Application $application){
        if($application->user_id !== Auth::user()->id || $application->status !== "completed"){
            return redirect()->route("application_list");
        }
        $application->comment = $request->comment;
        $application->save();
        return redirect()->route("application_list");
    }
}
