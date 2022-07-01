<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Profile;
use App\Models\Course;
use App\Models\course_Register;


class ProfileController extends Controller
{


    public function index($id)
    {
        $page = "profile";
        $my_courses=[];
        $crID = [];
        $profileUser = Profile::where('user_id',$id);
        if($profileUser->exists()){//the have a Profile
            $profileUser = Profile::where('user_id',$id)->first();//Profile Data
            $courseRegister = course_Register::where('user_id',$id)->get();

            foreach($courseRegister as $cr){
                $course_id = (integer)$cr->course_id;
                $crGetID =  (integer)$cr->id;
                $course = Course::find($course_id);
                if($course->count() < 0){
                    continue;
                }else{
                    $my_courses[] = $course;
                    $crID[] = $crGetID;
                }

            }

           return view("main.profile",compact("profileUser","page","my_courses","crID"));//go to Profile page

        }else{//the not have a Profile
            $newProfileUser = Profile::create(['user_id'=>$id]);//create Profile
            $profileUser = Profile::where('user_id',$id)->first();
            return view("main.profile",compact("profileUser","page","my_courses"));//go to Profile page
        }

    }


    public function update(Request $request, $id)
    {
        $profileUpdate = Profile::find($id);
        $profileUpdate->update($request->all());
        return redirect()->back()->with('msg_s','تم التحديث بنجاح');
    }



}
