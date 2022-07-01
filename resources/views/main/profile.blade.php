@extends("layouts.main")
@section("content")
    <!-- ======= Breadcrumbs ======= -->
    <section id="breadcrumbs" class="breadcrumbs">
        <div class="container">
            <h2>الصفحة الشخصية</h2>
          </div>
    </section><!-- End Breadcrumbs -->
    <!-- ======= Portfolio Details Section ======= -->
  <main class="main ">
    <section class="section profile p-5 m-5">
      <div class="row ">
        <div class="col-lg-10 col-md-6 mx-auto my-5">
            @if(Session::has("msg_s"))
                <div class="alert alert-success alert-dismissible fade show text-center" role="alert">
                    {{ Session::get("msg_s") }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>

            @elseif(Session::has("msg_e"))
            <div class="alert alert-warning alert-dismissible fade show text-center" role="alert">
                {{ Session::get("msg_e") }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif
        </div>
        <div class="col-xl-4 ">

          <div class="card p-3">
            <div class="card-body profile-card pt-4 d-flex flex-column align-items-center ">

            @if(auth()->user()->photo !="")

                <img src="{{ asset("UserPhoto/".auth()->user()->photo )}}" alt="Profile" class="rounded-circle img-size-response" >
            @else
                <img src="{{ asset("assets2/img/profile-img.jpg")}}" alt="Profile" class="rounded-circle card-img-top">
            @endif

              <h2 >{{ auth()->user()->name }}</h2>
              <h3>{{ auth()->user()->role }}</h3>
              <div class="social-links mt-2">
                @if ($profileUser->face_link != "")
                    <a href="{{ $profileUser->face_link }}" target="_blank" class="facebook"><i class="bi bi-facebook"></i></a>
                @endif

                @if ($profileUser->insta_link != "")
                    <a href="{{ $profileUser->insta_link }}"  target="_blank" class="instagram"><i class="bi bi-instagram"></i></a>
                @endif

                @if ($profileUser->youtube_link != "")
                    <a href="{{ $profileUser->youtube_link }}"  target="_blank" class="youtube"><i class="bi bi-youtube"></i></a>
                @endif



              </div>
            </div>
          </div>

        </div>

        <div class="col-xl-8">

          <div class="card">
            <div class="card-body pt-3">
              <!-- Bordered Tabs -->
              <ul class="nav nav-tabs nav-tabs-bordered">

                <li class="nav-item">
                  <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">بياناتي</button>
                </li>

                <li class="nav-item">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit"> تعديل البيانات</button>
                </li>

                <li class="nav-item">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-settings">كورساتي</button>
                </li>

              </ul>
              <div class="tab-content pt-2">

                <div class="tab-pane fade show active profile-overview" id="profile-overview">
                  <h5 class="card-title">نبذة تعريفية</h5>
                  @if ($profileUser->bio != "")
                    <p class="small fst-italic pb-5">{{ $profileUser->bio }}</p>
                  @else
                  <p class="small fst-italic pb-5">لايوجد</p>
                  @endif


                  <h5 class="card-title mb-3">التفاصيل:</h5>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 fs-5 ">الاسم الكامل</div>
                    <div class="col-lg-9 col-md-8">{{ auth()->user()->name }}</div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 fs-5">الايميل </div>
                    <div class="col-lg-9 col-md-8">{{ auth()->user()->email }}</div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 fs-5">الجنس</div>
                    <div class="col-lg-9 col-md-8">{{ auth()->user()->gender }}</div>
                  </div>

                </div>

                <div class="tab-pane fade profile-edit pt-3" id="profile-edit">
                    <h3 class="text-center  my-3">تعديل بيانات الشخصي</h3>
                  <!-- User Edit Form -->
                  <form class="p-3" action="{{ route("updateFormProfile",['id'=>auth()->id()] )}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <div class="row mb-3">
                      <label for="fullName" class="col-md-4 col-lg-3 col-form-label">الاسم الكامل</label>
                      <div class="col-md-8 col-lg-9">
                        <input type="text" name="name" value="{{ auth()->user()->name }}"  class="form-control @error('name') is-invalid  @enderror " id="yourName" >

                        @error('name')
                        <small class="text-danger">
                            {{ $message }}
                        </small>
                        @enderror
                      </div>
                    </div>



                    <div class="row mb-3">
                      <label for="company" class="col-md-4 col-lg-3 col-form-label">الايميل</label>
                      <div class="col-md-8 col-lg-9">
                        <input type="email" name="email" value="{{ auth()->user()->email }}"  class="form-control @error('email') is-invalid  @enderror" id="yourEmail" required>

                        @error('email')
                        <small class="text-danger">
                            {{ $message }}
                        </small>
                        @enderror
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="Job" class="col-md-4 col-lg-3 col-form-label">الصورة الشخصية</label>
                      <div class="col-md-8 col-lg-9">
                        <input type="file" name="photo" class="form-control @error('photo') is-invalid  @enderror"  >
                        @error('photo')
                        <small class="text-danger">
                            {{ $message }}
                        </small>
                        @enderror
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="Country" class="col-md-4 col-lg-3 col-form-label">الجنس</label>
                      <div class="col-md-8 col-lg-9">
                        <select class="form-select fs-5 @error('gender') is-invalid  @enderror" name="gender" aria-label="Default select example">
                            @if(auth()->user()->gender == 'ذكر')
                                <option class=" fs-5" value="ذكر">ذكر</option>
                                <option class=" fs-5" value="انثى">انثى</option>
                            @else
                                <option class=" fs-5" value="انثى">انثى</option>
                                <option class=" fs-5" value="ذكر">ذكر</option>

                            @endif
                        </select>

                            @error('gender')
                            <small class="text-danger">
                                {{ $message }}
                            </small>
                            @enderror
                      </div>
                    </div>

                    <div class="text-center">
                      <button type="submit" class="btn btn-primary my-3" >حفظ</button>
                    </div>
                  </form><!-- End User Edit Form -->

                  <hr/>
                  <h3 class="text-center my-3">تعديل بيانات ملف الشخصي</h3>

                <!-- Profile Edit Form -->
                <form class="p-3" action="{{ route('updateProfile',['id'=>$profileUser->id]) }}" method="POST">

                  @csrf
                  @method('put')
                  <div class="row mb-3">
                    <label for="about" class="col-md-4 col-lg-3 col-form-label">نبذة التعريفية</label>
                    <div class="col-md-8 col-lg-9">
                        <textarea name="bio" class="form-control" id="about" style="height: 100px">{{ $profileUser->bio }}</textarea>
                    </div>
                    </div>


                    <div class="row mb-3">
                        <label for="Facebook" class="col-md-4 col-lg-3 col-form-label">Facebook Profile</label>
                        <div class="col-md-8 col-lg-9">
                        <input name="face_link" type="text"  class="form-control" id="Facebook" value="{{ $profileUser->face_link }}">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="Instagram" class="col-md-4 col-lg-3 col-form-label">Instagram Profile</label>
                        <div class="col-md-8 col-lg-9">
                        <input name="insta_link" type="text" class="form-control" id="Instagram" value="{{ $profileUser->insta_link }}">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="Linkedin" class="col-md-4 col-lg-3 col-form-label">youtube link</label>
                        <div class="col-md-8 col-lg-9">
                        <input name="youtube_link" type="text" class="form-control" id="youtube" value="{{ $profileUser->youtube_link }}">
                        </div>
                    </div>

                    <div class="text-center">
                        <button type="submit" class="btn btn-primary my-3">حفظ</button>
                    </div>
                    </form><!-- End Profile Edit Form -->

                </div>



                <div class="tab-pane fade pt-3" id="profile-settings">

                    <div class="container">
                        <div class="row">

                            @if (count($my_courses) > 0)
                                {{-- @foreach ($my_courses as $course1) --}}
                                @for($i = 0; $i < count($my_courses); $i++)


                                    <div class="col-lg-5 mx-auto ">
                                        <div class="card bg-light shadow p-3 mb-5 bg-body rounded">
                                            <div class="card-body mx-auto">
                                                <h5 class="text-center">{{ $my_courses[$i]->name }}</h5>

                                                <div class="mx-auto my-3 ">
                                                    <a href="{{ route("showCourseDetail",['id'=>$my_courses[$i]->id]) }}" class=" btn btn-primary  ">عرض</a>


                                                    <!-- Button trigger modal -->
                                                    <a class="mx-1 btn btn-danger text-light" data-bs-toggle="modal" data-bs-target="#exampleModalDel{{ $my_courses[$i]->id }}">
                                                        حذف
                                                    </a>

                                                    <!-- Modal -->
                                                    <div class="modal fade" id="exampleModalDel{{ $my_courses[$i]->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <h5 class="text-danger text-center">  هل انت متاكد من الحذف</h5>
                                                            </div>
                                                            <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">الغاء</button>
                                                            <form action="{{ route("destroyCourseRegister",["id"=>$crID[$i]]) }}" method="POST">
                                                                @method('delete')
                                                                @csrf
                                                                <button type="submit " class="mx-1 btn btn-danger text-light ">حذف</button>
                                                            </form>
                                                            </div>
                                                        </div>
                                                        </div>
                                                    </div>

                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                @endfor
                            @else
                                <div class="mx-auto">
                                    <div class="text-center fs-5">لا توجد كورسات حتى الان</div>
                                </div>
                            @endif

                        </div>
                    </div>

                </div>


              </div><!-- End Bordered Tabs -->

            </div>
          </div>

        </div>
      </div>
    </section>

  </main><!-- End #main -->


@endsection
