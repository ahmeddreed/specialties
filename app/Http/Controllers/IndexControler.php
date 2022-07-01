<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Specialty;
use App\Models\Branch;
use App\Models\Language;
use App\Models\Course;

class IndexControler extends Controller
{
   public function index(){

        $page = "home";
        $specialties = Specialty::latest()->paginate(4,['*'],'Specialty');
        $branches = Branch::latest()->paginate(4,['*'],'Branch');
        $languages = Language::latest()->paginate(4,['*'],'Language');
        $courses = Course::latest()->paginate(4,['*'],'Course');
        return view('main.index', compact('page','specialties','branches','languages','courses'));

   }
}
