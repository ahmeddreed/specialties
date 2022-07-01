<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Language;
use App\Models\Branch;
use App\Models\Course;
use App\Models\Br_lng;
class LanguageController extends Controller
{


    public function showAllLanguages()
    {
        $page = "show all";
        $show = "Languages";
        $languages = Language::latest()->paginate(12);
        return view("main.show_all" , compact("page","show","languages"));
    }





    public function createLanguage(Request $request)
    {

        //Data validation
        $request->validate([
            'name'=> 'required|max:50|unique:languages',
            'title'=>'required',
            'branches'=> 'required',
        ]);

        $branches = $request->branches;
        $uploader = auth()->id();
        $basic_link = "https://www.youtube.com/results?search_query=".$request->name."&sp=EgIQAw%253D%253D";

        //Insert Data
        Language::create([
            'name' =>$request->name,
            'title'=>$request->title,
            'basic_link'=> $basic_link ,
            'uploader'=>$uploader,
        ]);


        $lng = Language::latest()->get();
        //chech if data inserted
        if ($lng[0]->name == $request->name){
            foreach($branches as $da){
                $br = Branch::find($da);

                $brID =(integer)$br->id;
                $lngID = (integer)$lng[0]->id;
                $brName = $br->name;

                $br_lng_name =$request->name."-".$brName;
                Br_lng::create([
                    'name'=>$br_lng_name,
                    'branch_id'=> $brID,
                    'language_id'=> $lngID,
                ]);
            }
        }else{
            return redirect()->back()->with("msg_e","عذرا يوجد خطا");
        }

        return redirect()->back()->with("msg_s","تم الانشاء  بنجاح ");
    }







    public function showLanguageDetail($id)
    {
        $page = 'Language Detail';
        $languageDetail = Language::find($id);
        if($languageDetail->count() <= 0)
        {
            return redirect()->back()->with("msg_e", "لا يوجد بيانات");
        }
        $br_lng = Br_lng::where('language_id',$id)->get();
        $courses=[];
        foreach($br_lng as $bl){
            $course = Course::where('br_lng',$bl->id)->get();
            if($course->count() < 0){
                continue;
            }else{
            $courses = $course;
            }
            // dd($courses);
        }
        return view('main.show_detail', compact('page','languageDetail','courses'));
    }









    public function update(Request $request, $id)
    {
        $request->validate([
            'name'=> 'required|max:50',
            'title'=>'required',
        ]);

        $updater = auth()->id();
        $languageData = Language::find($id);
        $countName = Language::where("name", $request->name)->count();
        if($countName > 0 ){

            if($languageData->name == $request->name){//not change the name
                $languageData->update([
                    'title'=>$request->title,
                    'updater'=>$updater,
                ]);
                return redirect()->back()->with('msg_s','تم التحديث بنجاح');
            }
            else{//the name is exist
                return redirect()->back()->with('msg_e','عذرا الاسم محجوز');
            }
        }
        else{//change the name

            $basic_link = "https://www.youtube.com/results?search_query=".$request->name."&sp=EgIQAw%253D%253D";
            $languageData->update([
                'name' =>$request->name,
                'title'=>$request->title,
                'basic_link'=> $basic_link ,
                'updater'=>$updater,
            ]);
            return redirect()->back()->with('msg_s','تم التحديث بنجاح');

        }


    }






    public function destroyLanguage($id)
    {
        $languageDel = Language::find($id);

        if($languageDel != Null){//if the Language is exist
            $languageDel->delete();
            return redirect()->back()->with("msg_s","تم الحذف بنجاح");
        }else{//if the Language is not exist
            return redirect()->back()->with("msg_e","يوجد خطأ");
        }
    }






    public function search(Request $request)
    {
        $request->validate([
            'searchLng'=>"required",
        ]);

        $search = $request->searchLng;
        $page = "show all";
        $show = "Languages";

        $languages = Language::latest()->where("name","like", '%'.$search.'%')->paginate(12);

        if($languages->count() <= 0 ){//not found this search in the names
            $languages = Language::latest()->where("title","like", '%'.$search.'%')->paginate(12);

            if($languages->count() <= 0 ){//not found this search in the title
                return redirect()->back()->with("msg_e", " بحثك غير موجود او لديك خطأ");

            }else{//found this search in the title
                return view("main.show_all" , compact("page","show","languages"));
            }

        }else{//found this search in the names
            return view("main.show_all" , compact("page","show","languages"));
        }
    }



    public function searchLanguageTable(Request $request)
    {
        $request->validate([
            'search'=>"required",
        ]);

        $search = $request->search;
        $page = "languageTable";
        $branches = Branch::all();
        $data_language = Language::latest()->where("name","like", '%'.$search.'%')->paginate(15);

        if($data_language->count() <= 0 ){//not found this search in the names
            $data_language = Language::latest()->where("title","like", '%'.$search.'%')->paginate(15);

            if($data_language->count() <= 0 ){//not found this search in the title
                return redirect()->route("languageTable")->with("msg_e", " بحثك غير موجود او لديك خطأ");

            }else{//found this search in the title
               return view("Dashboard.languageTable",compact('data_language','branches','page'));
            }

        }else{//found this search in the names
           return view("Dashboard.languageTable",compact('data_language','branches','page'));
        }
    }


}
