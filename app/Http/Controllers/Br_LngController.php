<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Branch;
use App\Models\Language;
use App\Models\Br_lng;

class Br_LngController extends Controller
{



    public function searchBr_lngTable(Request $request)
    {
        $request->validate([
            'search'=>"required",
        ]);

        $search = $request->search;
        $page = "br_lngTable";
        $data_br_lng = Br_lng::latest()->where("name","like", '%'.$search.'%')->paginate(15);

        if($data_br_lng->count() <= 0 ){//not found this search in the names
            $data_br_lng = Br_lng::latest()->where("title","like", '%'.$search.'%')->paginate(15);

            if($data_br_lng->count() <= 0 ){//not found this search in the title
                return redirect()->route("BrLngTable")->with("msg_e", " بحثك غير موجود او لديك خطأ");

            }else{//found this search in the title
               return view("Dashboard.br_lngTable",compact('data_br_lng','page'));
            }

        }else{//found this search in the names
           return view("Dashboard.br_lngTable",compact('data_br_lng','page'));
        }
    }



    public function addBrLng(Request $request)
    {
        $request->validate([// validate Data
            'languageID'=>'required',
            'branchID'=>'required',
        ]);

        $language = Language::find($request->languageID);
        $branch = Branch::find($request->branchID);
        $name = $language->name.'-'.$branch->name;

        $nameCheck = Br_lng::where('name', $name)->count();
        // dd($request->all(),$name,$nameCheck );

        if($nameCheck > 0 ){//the is exist
            return redirect()->back()->with('msg_e','عذرا الاسم محجوز');
        }
        else{
            Br_lng::create([
                'name'=>$name,
                'branch_id'=>$request->branchID,
                'language_id'=>$request->languageID,
            ]);

            return redirect()->back()->with('msg_s','تم الاضافة  بنجاح');
        }

    }





    public function destroy($id)
    {
        $brLngDel = Br_lng::find($id);

        if($brLngDel != Null){//if the Data is exist
            $brLngDel->delete();
            return redirect()->back()->with("msg_s","تم الحذف بنجاح");
        }else{//if the Data is not exist
            return redirect()->back()->with("msg_e","يوجد خطأ");
        }
    }





    public function update(Request $request, $id)
    {
        $request->validate([// validate Data
            'languageID'=>'required',
            'branchID'=>'required',
        ]);

        $brLngData = Br_lng::find($id);//Branch-Language Data
        $language = Language::find($request->languageID);//Language Data
        $branch = Branch::find($request->branchID);//Branch Data

        $name = $language->name.'-'.$branch->name;// name of Language-Branch

        $nameCheck = Br_lng::where('name', $name)->count();//count of name Language-Branch

        if($nameCheck > 0 ){
            if($name == $brLngData->name){//not change the name
                return redirect()->back()->with('msg_e','لا يوجد اي تحديث');
            }
            else{//the name is exist
                return redirect()->back()->with('msg_e','عذرا الاسم محجوز');
            }
        }
        else{// update the Data

            $brLngData->update([
                'name'=>$name,
                'branch_id'=>$request->branchID,
                'language_id'=>$request->languageID,
            ]);
            return redirect()->back()->with('msg_s','تم التحديث بنجاح');
        }

    }


}
