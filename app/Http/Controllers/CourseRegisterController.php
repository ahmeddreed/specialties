<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\course_Register;
class CourseRegisterController extends Controller
{
    public function courseRegister(Request $request,$id)
    {
        $user_id = auth()->id();
        $course_id = $id;
        $courseRegister = course_Register::all()->where('user_id',$user_id)->where('course_id',$course_id);
        if($courseRegister->count() > 0){//regstred
            return redirect()->back()->with('msg_e','انت مسجيل بالفعل');
        }else{//not regstred

            $countRegister = course_Register::all()->where('user_id',$user_id)->where('state',0);
            if($countRegister->count() >= 3) //user  Registered more than three courses and not finished any course
            {
                return redirect()->back()->with('msg_e','لايمكن تسجيل في اكثر من ثلاث كورسات وانت لم تكمل احدهم');
            }
            else
            {
            $newCourseRegister = course_Register::create([
                'user_id'=>$user_id,
                'course_id'=>$course_id,
                'state'=>false,
            ]);
            return redirect()->route("profile",["id"=>auth()->id()])->with('msg_s','تم تسجيلك في الكورس بنجاح');
            }

        }

    }




    public function destroyCourseRegister($id)
    {
        $CourseRegisterDel = course_Register::find($id);
        //dd($CourseRegisterDel);
        if($CourseRegisterDel != null){//if the Specialty is exist
            $CourseRegisterDel->delete();
            return redirect()->back()->with("msg_s","تم الحذف بنجاح");
        }else{//if the Specialty is not exist
            return redirect()->back()->with("msg_e","يوجد خطأ");
        }
    }






}
