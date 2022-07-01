<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IndexControler;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SpeciatyController;
use App\Http\Controllers\BranchController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\Br_LngController;
use App\Http\Controllers\CourseRegisterController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//home Routes
Route::get('/', [IndexControler::class, 'index'])->name("home");


//Profile Routes
Route::get('/profile/{id}', [ProfileController::class, 'index'])->name("profile")->middleware("auth");
Route::put('/updateProfile/{id}', [ProfileController::class, 'update'])->name("updateProfile")->middleware("auth");


//Auth Routes
Route::controller(AuthController::class)->group(function () {
    Route::get('/logout', 'logout')->name("logout")->middleware("auth");
    Route::get('/login', 'login')->name("login")->middleware("guest");
    Route::get('/register', 'register')->name("register")->middleware("guest");
    Route::post('/registerUser', 'registerUser')->name("registerUser");
    Route::post('/addUser', 'addUser')->name("addUser")->middleware("role");
    Route::post('/checkLogin', 'checkLogin')->name("checkLogin")->middleware("guest");
    Route::delete('/destroyUser/{id}', 'destroyUser')->name("destroyUser")->middleware("role");
    Route::post('/searchUserTable', 'searchUserTable')->name("searchUserTable")->middleware("role");
    Route::put('/updateFormProfile/{id}', 'updateFormProfile')->name("updateFormProfile")->middleware("auth");
    Route::put('/updateFormDashboard/{id}', 'updateFormDashboard')->name("updateFormDashboard")->middleware("auth");

});



//Dashboard Routes
Route::controller(DashboardController::class)->group(function () {
    Route::get('/Dashboard', 'index')->name("Dashboard")->middleware("role") ;
    Route::get('/userTable', 'userTable')->name("userTable")->middleware("role");
    Route::get('/specialtyTable', 'specialtyTable')->name("specialtyTable")->middleware("role");
    Route::get('/branchesTable', 'branchesTable')->name("branchesTable")->middleware("role");
    Route::get('/languageTable', 'languageTable')->name("languageTable")->middleware("role");
    Route::get('/BrLngTable', 'br_lngTable')->name("BrLngTable")->middleware("role");
    Route::get('/coursesTable', 'coursesTable')->name("coursesTable")->middleware("role");
});



//Specialty Route
Route::controller(SpeciatyController::class)->group(function(){
    Route::post('/createSpeciaty', 'createSpeciaty')->name("createSpeciaty")->middleware("role");
    Route::get('/showAllSpecialties', 'showAllSpecialties')->name("showAllSpecialties");
    Route::get('/showSpeciatyDetail/{id}', 'showSpeciatyDetail')->name("showSpeciatyDetail");
    Route::delete('/destroySpecialty/{id}', 'destroySpecialty')->name("destroySpecialty")->middleware("role");
    Route::post('/searchSpeciaty', 'search')->name("searchSpeciaty");
    Route::post('/searchSpecialtyTable', 'searchSpecialtyTable')->name("searchSpecialtyTable")->middleware("role");
    Route::put('/updateSpecialty/{id}', 'update')->name("updateSpecialty")->middleware("role");

});




//Branch Route
Route::controller(BranchController::class)->group(function(){
    Route::post('/createBranch', 'createBranch')->name("createBranch")->middleware("role");
    Route::get('/showAllBranches', 'showAllBranches')->name("showAllBranches");
    Route::get('/showBranchDetail/{id}', 'showBranchDetail')->name("showBranchDetail");
    Route::delete('/destroyBranch/{id}', 'destroyBranch')->name("destroyBranch")->middleware("role");
    Route::post('/searchBranch', 'search')->name("searchBranch");
    Route::post('/searchBranchTable', 'searchBranchTable')->name("searchBranchTable")->middleware("role");
    Route::put('/updateBranch/{id}', 'update')->name("updateBranch")->middleware("role");

});




//Language Route
Route::controller(LanguageController::class)->group(function(){
    Route::post('/createLanguage', 'createLanguage')->name("createLanguage")->middleware("role");
    Route::get('/showAllLanguages', 'showAllLanguages')->name("showAllLanguages");
    Route::get('/showLanguageDetail/{id}', 'showLanguageDetail')->name("showLanguageDetail");
    Route::delete('/destroyLanguage/{id}', 'destroyLanguage')->name("destroyLanguage")->middleware("role");
    Route::post('/searchLanguage', 'search')->name("searchLanguage");
    Route::post('/searchLanguageTable', 'searchLanguageTable')->name("searchLanguageTable")->middleware("role");
    Route::put('/updateLanguage/{id}', 'update')->name("updateLanguage")->middleware("role");
});




//Course Route
Route::controller(CourseController::class)->group(function(){
    Route::post('/createCourse', 'createCourse')->name("createCourse")->middleware("role");
    Route::get('/showAllCourses', 'showAllCourses')->name("showAllCourses");
    Route::get('/showCourseDetail/{id}', 'showCourseDetail')->name("showCourseDetail");
    Route::delete('/destroyCourse/{id}', 'destroyCourse')->name("destroyCourse")->middleware("role");
    Route::post('/searchCourse', 'search')->name("searchCourse");
    Route::post('/searchCourseTable', 'searchCourseTable')->name("searchCourseTable")->middleware("role");
    Route::put('/updateCourse/{id}', 'update')->name("updateCourse")->middleware("role");
});




//Branch-Language Route
Route::post('/searchBr_lngTable',[Br_LngController::class, 'searchBr_lngTable'] )->name("searchBr_lngTable")->middleware("role");
Route::post('/addBrLng',[Br_LngController::class, 'addBrLng'] )->name("addBrLng")->middleware("role");
Route::delete('/destroyBrLng/{id}',[Br_LngController::class, 'destroy'] )->name("destroyBrLng")->middleware("role");
Route::put('/updateBrLng/{id}',[Br_LngController::class, 'update'] )->name("updateBrLng")->middleware("role");





// Course Register Route destroyCourseRegister
Route::post('/courseRegister/{id}',[CourseRegisterController::class, 'courseRegister'] )->name("courseRegister");
Route::delete('/destroyCourseRegister/{id}',[CourseRegisterController::class, 'destroyCourseRegister'] )->name("destroyCourseRegister")->middleware("auth");
