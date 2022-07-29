<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Br_lng;
use App\Models\course_Register;

class CourseController extends Controller
{

    public function showAllCourses()
    {
        $page = "show all";
        $show = "Courses";
        $courses = Course::latest()->paginate(12);
        return view("main.show_all" , compact("page","show","courses"));
    }






    public function createCourse(Request $request)
    {
        $request->validate([//validate data
            'name'=> 'required|unique:courses|max:50',
            'title'=>'required',
            'detail'=>'required',
            'br_lng'=>'required',
            'fw'=>'required',
        ]);

        $uploader= auth()->id();//get ID of user
        //get links of course
        $link_FW ="";
        $link_A = "https://www.youtube.com/results?search_query=انشاء+مشرروع+بواسطة+".$request->name."&sp=EgIQAw%253D%253D";
        $link_E = "https://www.youtube.com/results?search_query=create+a+project+by+".$request->name."&sp=EgIQAw%253D%253D";

        if($request->fw == "yes"){//chech if this course build on the framework
            $link_FW ="https://www.youtube.com/results?search_query=دورة+اساسيات+".$request->name."&sp=EgIQAw%253D%253D";
        }

        Course::create([//Insert Date in database
            'name'    =>$request->name,
            'title'   =>$request->title,
            'details' =>$request->detail,
            'br_lng'  =>$request->br_lng,
            'FW_link' =>$link_FW,
            'A_link'  =>$link_A,
            'E_link'  =>$link_E,
            'uploader'=>$uploader,
        ]);

        //successfuly message
        return redirect()->back()->with("msg_s","تم الانشاء  بنجاح ");
    }








    public function showCourseDetail($id)
    {
        $page = "Course Detail";
        $regestered =false;
        $courseDetail = Course::find($id);
        if($courseDetail->count() < 0 ){//the course not found
           return redirect()->back()->with('msg_e',"لا يوجد هذا الكورس");
        }else{//the course is exsits
            $br_lng = Br_lng::find($courseDetail->br_lng);
            $br_lng_name = $br_lng->name;//get Branch-language name
            $name = explode("-",$br_lng_name);//split name
            if(auth()->check())//if the user is logged in this course
            {
                $courseRegister = course_Register::all()->where('user_id',auth()->id())->where('course_id',$courseDetail->id);
                if($courseRegister->count() >= 1)//the user is already  regestered
                {
                    $regestered =true;
                }
                else//the user is not regestered
                {
                    $regestered =false;
                }
            }

            return view('main.show_detail', compact('page','courseDetail','regestered','name'));
        }

    }






    public function update(Request $request, $id)
    {
        $request->validate([//validate data
            'name'=> 'required|max:50',
            'title'=>'required',
            'detail'=>'required',
            'br_lng'=>'required',
            'fw'=>'required',
        ]);

        $updater= auth()->id();//get ID of user
        $courseData = Course::find($id);
        $nameCount = Course::where('name','=',$request->name)->count();
        if ($nameCount > 0){ // the name is  exsit

            if($courseData->name == $request->name){//the user not change a name
                $link_FW ="";
                if($request->fw == "yes"){//chech if this course build on the framework
                    $link_FW ="https://www.youtube.com/results?search_query=دورة+اساسيات+".$request->name."&sp=EgIQAw%253D%253D";
                }

                $courseData->title = $request->title;
                $courseData->details = $request->detail;
                $courseData->FW_link = $link_FW;
                $courseData->updater = $updater;
                $courseData->br_lng = $request->br_lng;
                $courseData->update();
                return redirect()->back()->with('msg_s','تم التحديث بنجاح');

            }
            else{// this name is  exist

                return redirect()->back()->with('msg_e','عذرا الاسم محجوز');

            }
        }
        else{//change the name and the name is not exist

            $link_FW ="";
            $link_A = "https://www.youtube.com/results?search_query=انشاء+مشرروع+بواسطة+".$request->name."&sp=EgIQAw%253D%253D";
            $link_E = "https://www.youtube.com/results?search_query=create+a+project+by+".$request->name."&sp=EgIQAw%253D%253D";
            //dd($request->fw);
            if($request->fw == "yes"){//chech if this course build on the framework
                $link_FW ="https://www.youtube.com/results?search_query=دورة+اساسيات+".$request->name."&sp=EgIQAw%253D%253D";
            }

            $courseData->name = $request->name;
            $courseData->title = $request->title;
            $courseData->details = $request->detail;
            $courseData->FW_link = $link_FW;
            $courseData->A_link  = $link_A;
            $courseData->E_link  = $link_E;
            $courseData->updater = $updater;
            $courseData->br_lng = $request->br_lng;
            $courseData->update();
            return redirect()->back()->with('msg_s','تم التحديث بنجاح');

        }


    }






    public function destroyCourse($id)
    {
        $courseDel = Course::find($id);

        if($courseDel != Null){//if the Course is exist
            $courseDel->delete();
            return redirect()->back()->with("msg_s","تم الحذف بنجاح");
        }else{//if the Course is not exist
            return redirect()->back()->with("msg_e","يوجد خطأ");
        }
    }








    public function search(Request $request)
    {
        $request->validate([
            'searchCS'=>"required",
        ]);

        $search = $request->searchCS;
        $page = "show all";
        $show = "Courses";
        $courses = Course::latest()->paginate(12);
        $courses = Course::latest()->where("name","like", '%'.$search.'%')->paginate(12);

        if($courses->count() <= 0 ){//not found this search in the names
            $courses = Course::latest()->where("title","like", '%'.$search.'%')->paginate(12);

            if($courses->count() <= 0 ){//not found this search in the title
                return redirect()->back()->with("msg_e", " بحثك غير موجود او لديك خطأ");

            }else{//found this search in the title
                return view("main.show_all" , compact("page","show","courses"));
            }

        }else{//found this search in the names
            return view("main.show_all" , compact("page","show","courses"));
        }
    }






    public function searchCourseTable(Request $request)
    {
        $request->validate([
            'search'=>"required",
        ]);

        $search = $request->search;
        $page = "coursesTable";
        $br_lng = Br_lng::all();
        $data_course = Course::latest()->where("name","like", '%'.$search.'%')->paginate(15);

        if($data_course->count() <= 0 ){//not found this search in the names
            $data_course = Course::latest()->where("title","like", '%'.$search.'%')->paginate(15);

            if($data_course->count() <= 0 ){//not found this search in the title
                return redirect()->route("coursesTable")->with("msg_e", " بحثك غير موجود او لديك خطأ");

            }else{//found this search in the title
              return view("Dashboard.coursesTable",compact('data_course','br_lng','page'));
            }

        }else{//found this search in the names
          return view("Dashboard.coursesTable",compact('data_course','br_lng','page'));
        }
    }
}

