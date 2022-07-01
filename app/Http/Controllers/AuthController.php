<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
class AuthController extends Controller
{

    public function login()
    {
        $page ="login";
        return view("Auth.login",compact("page"));
    }



    public function register()
    {
        $page ="register";
        return view("Auth.register",compact("page"));
    }



    public function addUser(Request $request)
    {
        $request->validate([
            'name'=> 'required|max:50',
            'email'=>'required|email|unique:users',
            'password'=>'required|min:6|max:16',
            'gender'=>'required',
            'role'=>'required',
            'photo'=>'required|image',
        ]);

        $file = $request->file("photo");
        $ext = $file->extension();
        $image_name = time().".".$ext;
        $file->move("UserPhoto/", $image_name);
        // $file->storeAs("UserPhoto/", $image_name, 'public');

        User::create([
            'name'=> $request->name,
            'email'=> $request->email,
            'password'=>Hash::make($request->password),
            'gender'=> $request->gender,
            'role'=> $request->role,
            'photo'=> $image_name,
        ]);

        return redirect()->back()->with("msg_s","تم انشاء حسابك بنجاح ");
    }








    public function registerUser(Request $request)
    {
        $userCounter = User::all()->count();

        //not first register
        if($userCounter > 0){
            $role = "user";
            $request->validate([
                'name'=> 'required|max:50',
                'email'=>'required|email|unique:users',
                'password'=>'required|min:6|max:16',
                'gender'=>'required',
                'photo'=>'required|image',
            ]);

            $file = $request->photo;
            // dd( $request->photo);
            $ext = $file->extension();
            $image_name = time().".".$ext;
            $file->move("UserPhoto/", $image_name);
            // $file->storeAs("UserPhoto/", $image_name, 'public');


            User::create([
                'name'=> $request->name,
                'email'=> $request->email,
                'password'=>Hash::make($request->password),
                'gender'=> $request->gender,
                'role'=> $role,
                'photo'=> $image_name,
            ]);

             return redirect()->route('login')->with("msg_s","تم انشاء حسابك بنجاح ");

        }else{//this a first register
            $role = "manager";
            $request->validate([
                'name'=> 'required|max:50',
                'email'=>'required|email|unique:users',
                'password'=>'required|min:6|max:16',
                'gender'=>'required',
                'photo'=>'required|image',
            ]);

            $file = $request->photo;
            $ext = $file->extension();
            $image_name = time().".".$ext;
            $file->move("UserPhoto/", $image_name);
            // $file->storeAs("UserPhoto/", $image_name, 'public');

            User::create([
                'name'=> $request->name,
                'email'=> $request->email,
                'password'=> Hash::make($request->password),
                'gender'=> $request->gender,
                'role'=> $role,
                'photo'=> $image_name,
            ]);

            return redirect()->route('login')->with("msg_s","تم انشاء حسابك بنجاح ");
        }

    }






    public function checkLogin(Request $request)
    {

        $request->validate([
            'email'=>'required|email',
            'password'=>'required|min:6|max:16',
        ]);

        $user = User::all()->where("email" ,'=', $request->email)->first();
        $user_c = User::all()->where("email" ,'=', $request->email)->count();
        if ($user_c > 0 ){//check email
            if(Hash::check($request->password, $user->password)){//check password
               Auth::attempt([
                "email"=> $request->email,
                "password"=> $request->password,
               ]);//login is successfuly

               if($user->role == "user")//user login
               {
                   return redirect()->route("home")->with("msg_s","  تم الدخول بنجاح ");

               }else{//Manager or Admain login

                return redirect()->route("Dashboard")->with("msg_s","  تم الدخول بنجاح ");
               }

            }else{//the password in invalid
                return redirect()->back()->with("msg_e", "عذرا الرمز السري خطا");
            }
        }else{//the email in invalid
             return redirect()->back()->with("msg_e", "عذرا الايميل خطا");
        }
    }








    public function logout()
    {
        Auth::logout();
        return redirect()->route("login")->with("msg_s", "تم تسجيل الخروج");
    }




    public function updateFormProfile(Request $request, $id)
    {
        $request->validate([
            'name'=> 'required|max:50',
            'email'=>'required|email',
            'gender'=>'required',
            'photo'=>'nullable|image'
        ]);

        $userUpdate = User::find($id);
        $emailCount = User::where('email',$request->email)->count(); //conuter of email
        if($emailCount > 0){//the email is Exist

            if( $userUpdate->email == $request->email){//the user not change th email

                $userUpdate->name = $request->name;
                $userUpdate->gender = $request->gender;
                if($request->photo !=null){//change the photo

                    $file =$request->photo;
                    $ext = $file->extension();

                    $image_name = time().".".$ext;
                    $file->move("UserPhoto/",$image_name);
                    $userUpdate->photo =$image_name;

                }
                $userUpdate->update();
                return redirect()->back()->with('msg_s','تم التحديث بنجاح');
            }else{
                return redirect()->back()->with('msg_e','عذرا الايميل محجوز');
            }

        }else{//the email is not Exist

            $userUpdate->name = $request->name;
            $userUpdate->email = $request->email;
            $userUpdate->gender = $request->gender;
            if($request->photo !=null){//change the photo

                $file = $request->photo;
                $ext = $file->extension();

                if($ext == "jpg" or $ext == "jpeg" or $ext == "png" or $ext == "bmp" ){//the photo is valid
                    $image_name = time().".".$ext;
                    $file->move("UserPhoto/",$image_name);
                    $userUpdate->photo =$image_name;
                }else{//the photo is not valid

                    return redirect()->back()->with('msg_e','الرجاء ادخال صورة صحيح');
                }
            }
            $userUpdate->update();
            return redirect()->back()->with('msg_s','تم التحديث بنجاح');
        }


    }






    public function updateFormDashboard(Request $request, $id)
    {
        $request->validate([
            'name'=> 'required|max:50',
            'email'=>'required|email',
            'gender'=>'required',
            'role'=>'required',
            'photo'=>'nullable|image'
        ]);

        $userUpdate = User::find($id);
        $emailCount = User::where('email',$request->email)->count(); //conuter of email
        if($emailCount > 0){//the email is Exist

            if( $userUpdate->email == $request->email){//the user not change th email

                $userUpdate->name = $request->name;
                $userUpdate->gender = $request->gender;
                $userUpdate->role = $request->role;
                if($request->photo !=null){//change the photo

                    $file =$request->photo;
                    $ext = $file->extension();

                    $image_name = time().".".$ext;
                    $file->move("UserPhoto/",$image_name);
                    $userUpdate->photo =$image_name;

                }
                $userUpdate->update();
                return redirect()->back()->with('msg_s','تم التحديث بنجاح');
            }else{
                return redirect()->back()->with('msg_e','عذرا الايميل محجوز');
            }

        }else{//the email is not Exist

            $userUpdate->name = $request->name;
            $userUpdate->email = $request->email;
            $userUpdate->gender = $request->gender;
            $userUpdate->role = $request->role;
            if($request->photo !=null){//change the photo

                $file = $request->photo;
                $ext = $file->extension();

                if($ext == "jpg" or $ext == "jpeg" or $ext == "png" or $ext == "bmp" ){//the photo is valid
                    $image_name = time().".".$ext;
                    $file->move("UserPhoto/",$image_name);
                    $userUpdate->photo =$image_name;
                }else{//the photo is not valid

                    return redirect()->back()->with('msg_e','الرجاء ادخال صورة صحيح');
                }
            }
            $userUpdate->update();
            return redirect()->back()->with('msg_s','تم التحديث بنجاح');
        }


    }







    public function destroyUser($id)
    {
        $userDel = User::find($id);

        if($userDel != Null){//if the user is exist
            $userDel->delete();
            return redirect()->back()->with("msg_s","تم الحذف بنجاح");
        }else{//if the user is not exist
            // dd($userDel);
            return redirect()->back()->with("msg_e","يوجد خطأ");
        }
    }





    public function searchUserTable(Request $request)
    {
        $request->validate([
            'search'=>"required",
        ]);

        $search = $request->search;
        $page = "userTable";
        $data_user = User::latest()->where("name","like", '%'.$search.'%')->paginate(15);
        if($data_user->count() <= 0 ){//not found this search in the names
            $data_user = User::latest()->where("email","like", '%'.$search.'%')->paginate(15);

            if($data_user->count() <= 0 ){//not found this search in the title
                return redirect()->route("userTable")->with("msg_e", " بحثك غير موجود او لديك خطأ");

            }else{//found this search in the title
                return view("Dashboard.userTable", compact('data_user','page'));
            }

        }else{//found this search in the names
            return view("Dashboard.userTable", compact('data_user','page'));
        }
    }
}
