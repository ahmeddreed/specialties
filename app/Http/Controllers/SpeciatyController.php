<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Specialty;
use App\Models\Branch;
class SpeciatyController extends Controller
{
    public function showAllSpecialties()
    {
        $page = "show all";
        $show = "Specialties";
        $specialties = Specialty::latest()->paginate(12);
        return view("main.show_all" , compact("page","show","specialties"));
    }





    public function createSpeciaty(Request $request)
    {
        $uploader =auth()->id();
        $request->validate([
            'name'=> 'required|max:50|unique:specialties',
            'title'=>'required',
            'detail'=>'required',
        ]);

        Specialty::create([
            'name' =>$request->name,
            'title'=>$request->title,
            'details'=>$request->detail,
            'uploader'=>$uploader,
        ]);

        return redirect()->back()->with("msg_s","تم الانشاء  بنجاح ");
    }








    public function showSpeciatyDetail($id)
    {
        $page = 'Speciaty Detail';

        $speciatyDetail = Specialty::find($id);
        $branches = Branch::where('specialty','=',$id)->get();


        return view('main.show_detail', compact('page','speciatyDetail','branches'));
    }







    public function update(Request $request, $id)
    {
        $request->validate([
            'name'=> 'required|max:50',
            'title'=>'required',
            'detail'=>'required',
        ]);
        $speciatyData = Specialty::find($id);
        $countName = Specialty::where('name',$request->name)->count();

        if($countName > 0){

            if($speciatyData->name == $request->name){

                $speciatyData->title =  $request->title;
                $speciatyData->	details =  $request->detail;
                $speciatyData->updater =  auth()->id();
                $speciatyData->update();
                return redirect()->back()->with('msg_s','تم التحديث بنجاح');
            }
            else{
                return redirect()->back()->with('msg_e','عذرا الاسم محجوز');
            }
        }

        else{
            $speciatyData->name =  $request->name;
            $speciatyData->title =  $request->title;
            $speciatyData->	details =  $request->detail;
            $speciatyData->updater =  auth()->id();
            $speciatyData->update();
            return redirect()->back()->with('msg_s','تم التحديث بنجاح');
        }


    }






    public function destroySpecialty($id)
    {
        $specialtyDel = Specialty::find($id);

        if($specialtyDel != Null){//if the Specialty is exist
            $specialtyDel->delete();
            return redirect()->back()->with("msg_s","تم الحذف بنجاح");
        }else{//if the Specialty is not exist
            return redirect()->back()->with("msg_e","يوجد خطأ");
        }
    }






    public function search(Request $request)
    {
        $request->validate([
            'searchSP'=>"required",
        ]);

        $search = $request->searchSP;
        $page = "show all";
        $show = "Specialties";
        $specialties = Specialty::latest()->where("name","like", '%'.$search.'%')->paginate(12);

        if($specialties->count() <= 0 ){//not found this search in the names
            $specialties = Specialty::latest()->where("title","like", '%'.$search.'%')->paginate(12);

            if($specialties->count() <= 0 ){//not found this search in the title
                return redirect()->back()->with("msg_e", " بحثك غير موجود او لديك خطأ");

            }else{//found this search in the title
                return view("main.show_all" , compact("page","show","specialties"));
            }

        }else{//found this search in the names
            return view("main.show_all" , compact("page","show","specialties"));
        }
    }






    public function searchSpecialtyTable(Request $request)
    {
        $request->validate([
            'search'=>"required",
        ]);

        $search = $request->search;
        $page = "specialtyTable";
        $data_specialty = Specialty::latest()->where("name","like", '%'.$search.'%')->paginate(15);
        if($data_specialty->count() <= 0 ){//not found this search in the names
            $data_specialty = Specialty::latest()->where("title","like", '%'.$search.'%')->paginate(15);

            if($data_specialty->count() <= 0 ){//not found this search in the title
                return redirect()->route("specialtyTable")->with("msg_e", " بحثك غير موجود او لديك خطأ");

            }else{//found this search in the title
                 return view("Dashboard.SpecialtyTable",compact('data_specialty','page'));
            }

        }else{//found this search in the names
             return view("Dashboard.SpecialtyTable",compact('data_specialty','page'));
        }
    }

}
