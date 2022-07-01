<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Specialty;
use App\Models\Branch;
use App\Models\Language;
use App\Models\Br_lng;
class BranchController extends Controller
{

    public function showAllBranches()
    {
        $page = "show all";
        $show = "Branches";
        $branches = Branch::latest()->paginate(12);
        return view("main.show_all" , compact("page","show","branches"));
    }





    public function createBranch(Request $request)
    {
        $uploader = auth()->id();
        $request->validate([
            'name'=> 'required|max:50|unique:branches',
            'title'=>'required',
            'detail'=>'required',
            'specialty'=>'required',
        ]);

        Branch::create([
            'name' =>$request->name,
            'title'=>$request->title,
            'details'=>$request->detail,
            'specialty'=>$request->specialty,
            'uploader'=>$uploader,
        ]);

        return redirect()->back()->with("msg_s","تم الانشاء  بنجاح ");
    }






    public function showBranchDetail($id)
    {
        $page = 'Branch Detail';
        $branchDetail = Branch::find($id);//branch details
        $br_lng = Br_lng::where('branch_id',$id)->get();//how many language have this branch
        $languages =[];//language of this branch
        $i=0;//counter

        foreach($br_lng as $bl){ //set the languages in a variable
            $lng = Language::find($bl->language_id);//get a details of language
            if($lng->count() < 0){//if the branch not have any language
                continue;
            }else{
                $languages[$i] = $lng; //set the language in this a variable
                $i++;
                // dd($languages[0]->name);
            }
        }
        return view('main.show_detail', compact('page','branchDetail','languages'));
    }







    public function update(Request $request, $id)
    {
        $updater = auth()->id();
        $request->validate([
            'name'=> 'required|max:50',
            'title'=>'required',
            'detail'=>'required',
            'specialty'=>'required',
        ]);

        $branchData = Branch::find($id);
        $countName = Branch::where("name",$request->name)->count();
        if($countName > 0){

            if($branchData->name == $request->name){
                $branchData->update([
                    'title'=>$request->title,
                    'details'=>$request->detail,
                    'specialty'=>$request->specialty,
                    'updater'=>$updater,
                ]);
                return redirect()->back()->with('msg_s','تم التحديث بنجاح');
            }
            else{
                return redirect()->back()->with('msg_e','عذرا الاسم محجوز');
            }
        }
        else{
            $branchData->update([
                'name' =>$request->name,
                'title'=>$request->title,
                'details'=>$request->detail,
                'specialty'=>$request->specialty,
                'updater'=>$updater,
            ]);
            return redirect()->back()->with('msg_s','تم التحديث بنجاح');
        }

    }





    public function destroyBranch($id)
    {
        $branchDel = Branch::find($id);

        if($branchDel != Null){//if the Branch is exist
            $branchDel->delete();
            return redirect()->back()->with("msg_s","تم الحذف بنجاح");
        }else{//if the Branch is not exist
            return redirect()->back()->with("msg_e","يوجد خطأ");
        }
    }






    public function search(Request $request)
    {
        $request->validate([
            'searchBR'=>"required",
        ]);

        $search = $request->searchBR;
        $page = "show all";
        $show = "Branches";
        $branches = Branch::latest()->where("name","like", '%'.$search.'%')->paginate(12);

        if($branches->count() <= 0 ){//not found this search in the names
            $branches = Branch::latest()->where("title","like", '%'.$search.'%')->paginate(12);

            if($branches->count() <= 0 ){//not found this search in the title
                return redirect()->back()->with("msg_e", " بحثك غير موجود او لديك خطأ");

            }else{//found this search in the title
                return view("main.show_all" , compact("page","show","branches"));
            }

        }else{//found this search in the names
            return view("main.show_all" , compact("page","show","branches"));
        }
    }






    public function searchBranchTable(Request $request)
    {
        $request->validate([
            'search'=>"required",
        ]);

        $search = $request->search;
        $page = "branchesTable";
        $data_branch = Branch::latest()->where("name","like", '%'.$search.'%')->paginate(15);
        $specialties = Specialty::all();

        if($data_branch->count() <= 0 ){//not found this search in the names
            $data_branch = Branch::latest()->where("title","like", '%'.$search.'%')->paginate(15);

            if($data_branch->count() <= 0 ){//not found this search in the title
                return redirect()->route("branchesTable")->with("msg_e", " بحثك غير موجود او لديك خطأ");

            }else{//found this search in the title
                return view("Dashboard.BranchesTable",compact('data_branch','specialties','page'));
            }

        }else{//found this search in the names
            return view("Dashboard.BranchesTable",compact('data_branch','specialties','page'));
        }
    }



}
