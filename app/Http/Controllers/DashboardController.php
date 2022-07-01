<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Specialty;
use App\Models\Branch;
use App\Models\Language;
use App\Models\Course;
use App\Models\Br_lng;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $page = "dashboard";
        $userCount =      User::all()->count();
        $specialtyCount = Specialty::all()->count();
        $branchCount =    Branch::all()->count();
        $languageCount =  Language::all()->count();
        $courseCount =    Course::all()->count();
        return view("Dashboard.dashboard",compact("page","userCount","specialtyCount","branchCount","languageCount","courseCount"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function userTable()//show user table
    {
        $page = "userTable";
        $data_user = User::latest()->paginate(15);
        return view("Dashboard.userTable", compact('data_user','page'));
    }




    public function specialtyTable()//show Specialty table
    {
        $page = "specialtyTable";
        $data_specialty = Specialty::latest()->paginate(15);
        return view("Dashboard.SpecialtyTable",compact('data_specialty','page'));
    }




    public function branchesTable()//show  Branch table
    {
        $page = "branchesTable";
        $data_branch = Branch::latest()->paginate(15);
        $specialties = Specialty::all();
        return view("Dashboard.BranchesTable",compact('data_branch','specialties','page'));

    }




    public function languageTable()//show  Language table
    {
        $page = "languageTable";
        $branches = Branch::all();
        $data_language = Language::latest()->paginate(15);
        return view("Dashboard.languageTable",compact('data_language','branches','page'));
    }




    public function br_lngTable()//show  Branch-Language table
    {
        $page = "br_lngTable";
        $languages = Language::all();
        $branches = Branch::all();
        $data_br_lng = Br_lng::latest()->paginate(15);
        return view("Dashboard.br_lngTable",compact('data_br_lng','page','languages','branches'));
    }




    public function coursesTable()//show Course table
    {
        $page = "coursesTable";
        $br_lng = Br_lng::all();
        $data_course = Course::latest()->paginate(15);
        return view("Dashboard.coursesTable",compact('data_course','br_lng','page'));
    }


}
