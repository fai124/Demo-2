<?php

namespace App\Http\Controllers;

use App\Http\Requests\AppRequest;
use App\Http\Requests\ReviewRequest;
use App\Http\Requests\StatusRequest;
use App\Models\App;
use App\Models\Course;
use Illuminate\Support\Facades\Auth;

class AppController extends Controller
{
    public function application_add($course_id = null){
        $course = Course::find($course_id);
        $course_name = $course ? $course->name : null;

        return view("app_create", compact("course_name"));
    }

    public function application_addform(AppRequest $request){
        $application = new App();
        $application->user_id = Auth::user()->id;
        $application->course_name = $request->course_name;
        $application->date = $request->date;
        $application->payment = $request->payment;
        $application->status = "new";
        $application->save();
        return redirect()->route("dashboard");
    }

    public function application_admin(){
        $applications = App::with("user")->orderBy('created_at', 'desc')->paginate(10);
        return view("app_admin", compact("applications"));
    }

    public function application_update_status(StatusRequest $request, App $application){
        $application->status = $request->status;
        $application->save();

        return redirect()->route("application_admin");
    }

    public function application_list(){
        $applications = App::where("user_id", Auth::user()->id)->with("user")->orderBy('created_at', 'desc')->get();
        return view("app_my", compact("applications"));
    }

    public function application_review(ReviewRequest $request, App $application){
        if($application->user_id !== Auth::user()->id || $application->status !== "completed"){
            return redirect()->route("application_list");
        }

        $application->comment = $request->comment;
        $application->save();
        
        return redirect()->route("application_list");
    }

}
