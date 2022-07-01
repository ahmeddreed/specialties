@extends("layouts.dashboard")

@section('content')

    <div class="pagetitle text-center my-3">
      <h1>Users Table</h1>

    </div><!-- End Page Title -->
<section class="section">
    <div class="row p-5">
      <div class="col-lg-12">


        <div class="col-lg-12 col-md-8 mx-auto">
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
        <div class="card">
            <div class="card-title  px-3">
                <div id="addUser">
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        <i class="bi bi-plus"></i> اضافة
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel"><h5 class="text-center">اضافة مستخدمين </h5></h5>
                            <button type="button" class="btn btn-light" data-bs-dismiss="modal" aria-label="Close">X</button>
                            </div>
                            <div class="modal-body">

                                <form dir="rtl" class="row g-3 needs-validation mx-auto" method="POST" action="{{ route('addUser') }}" enctype="multipart/form-data">
                                    @csrf
                                    @method("post")
                                    <div class="col-12">
                                      <label for="yourName" class="form-label fs-5 ">الاسم الكامل</label>
                                      <input type="text" name="name" value="{{ old('name') }}" class="form-control @error('name') is-invalid  @enderror " id="yourName" >

                                        @error('name')
                                        <small class="text-danger">
                                            {{ $message }}
                                        </small>
                                        @enderror

                                    </div>

                                    <div class="col-12">
                                      <label for="yourEmail" class="form-label  fs-5"> الايميل</label>
                                      <input type="email" value="{{ old('email') }}" name="email" class="form-control @error('email') is-invalid  @enderror" id="yourEmail" required>

                                        @error('email')
                                        <small class="text-danger">
                                            {{ $message }}
                                        </small>
                                        @enderror

                                    </div>

                                    <div class="col-12">
                                      <label for="yourPassword" class="form-label fs-5">رمز السري</label>
                                      <input type="password" name="password" class="form-control @error('password') is-invalid  @enderror" id="yourPassword" required>
                                        @error('password')
                                        <small class="text-danger">
                                            {{ $message }}
                                        </small>
                                        @enderror

                                    </div>
                                    <div class="col-12">
                                        <select class="form-select fs-5 @error('gender') is-invalid  @enderror" name="role" aria-label="Default select example">
                                            @if(auth()->user()->role == "manager")

                                                <option class=" fs-5" value="manager">Manager</option></option>
                                                <option class=" fs-5" value="admin">Admin</option>
                                                <option class=" fs-5" value="user">User</option>

                                            @else

                                                <option class=" fs-5" value="admin">Admin</option>
                                                <option class=" fs-5" value="user">User</option>

                                            @endif

                                        </select>

                                            @error('gender')
                                            <small class="text-danger">
                                                {{ $message }}
                                            </small>
                                            @enderror

                                    </div>

                                    <div class="col-12">
                                        <label for="yourPassword" class="form-label fs-5">الصورة الشخصية</label>
                                        <input type="file" name="photo" class="form-control" id="yourPassword" required>
                                    </div>

                                    <div class="col-12">
                                        <select class="form-select fs-5 @error('gender') is-invalid  @enderror" name="gender" aria-label="Default select example">
                                            <option class=" fs-5" value="">اختر الجنس</option></option>
                                            <option class=" fs-5" value="ذكر">ذكر</option>
                                            <option class=" fs-5" value="انثى">انثى</option>
                                        </select>

                                            @error('gender')
                                            <small class="text-danger">
                                                {{ $message }}
                                            </small>
                                            @enderror

                                    </div>
                                    <div class="col-12">
                                      <button class="btn btn-primary w-100" type="submit">انشاء </button>
                                    </div>
                                  </form>


                            </div>
                            <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

                            </div>
                        </div>
                        </div>
                    </div>

                </div>

                <div class="d-flex justify-content-end">
                    <form class="d-flex col-lg-3  mx-5" dir="ltr"  data-aos="fade-up" action="{{ route("searchUserTable") }}" method="POST">
                        @method("post")
                        @csrf
                        <input class="form-control me-2 @error('search') is-invalid  @enderror"   type="search" name="search" value="{{ old('search') }}" placeholder=" " aria-label="Search">

                        <button class="btn btn-outline-success"  type="submit">بحث</button>
                    </form>
                </div>

            </div>

            @if($data_user->count() > 0)
            <div class="card-body">

            @php
                $i=0;
            @endphp



              <!-- Table with hoverable rows -->


              <table class="table table-hover">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Role</th>
                    <th scope="col">Gender</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach($data_user as $data)
                    <tr>
                        <th scope="row">{{ ++$i }}</th>
                        <td>{{ $data->name }}</td>
                        <td>{{ $data->email }}</td>
                        <td>{{ $data->role }}</td>
                        <td>{{ $data->gender }}</td>

                        @if (auth()->user()->role == "manager")

                            <td class="d-flex">

                                <!-- Button trigger modal -->
                                <a  class="mx-1 " data-bs-toggle="modal" data-bs-target="#exampleModalEdit{{ $data->id }}">
                                    <i class='btn bx bxs-edit-alt text-warning' ></i>
                                </a>


                                <!-- Modal -->
                                <div class="modal fade" id="exampleModalEdit{{ $data->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel"><h5 class="text-center">اضافة مستخدمين </h5></h5>
                                        <button type="button" class="btn btn-light" data-bs-dismiss="modal" aria-label="Close">X</button>
                                        </div>
                                        <div class="modal-body">

                                            <form dir="rtl" class="row g-3 needs-validation mx-auto" method="POST" action="{{ route('updateFormDashboard',['id'=>$data->id]) }}" enctype="multipart/form-data">
                                                @csrf
                                                @method("put")
                                                <div class="col-12">
                                                <label for="yourName" class="form-label fs-5 ">الاسم الكامل</label>
                                                <input type="text" name="name" value="{{ $data->name }}" class="form-control @error('name') is-invalid  @enderror " id="yourName" >

                                                    @error('name')
                                                    <small class="text-danger">
                                                        {{ $message }}
                                                    </small>
                                                    @enderror

                                                </div>

                                                <div class="col-12">
                                                <label for="yourEmail" class="form-label  fs-5"> الايميل</label>
                                                <input type="email" value="{{ $data->email }}" name="email" class="form-control @error('email') is-invalid  @enderror" id="yourEmail" required>

                                                    @error('email')
                                                    <small class="text-danger">
                                                        {{ $message }}
                                                    </small>
                                                    @enderror

                                                </div>


                                                <div class="col-12">
                                                    <select class="form-select fs-5 @error('role') is-invalid  @enderror" name="role" aria-label="Default select example">
                                                        @if ( $data->role == "manager")
                                                            <option class=" fs-5" value="manager">Manager</option></option>
                                                            <option class=" fs-5" value="admin">Admin</option>
                                                            <option class=" fs-5" value="user">User</option>
                                                        @elseif( $data->role == "admin")
                                                            <option class=" fs-5" value="admin">Admin</option>
                                                            <option class=" fs-5" value="manager">Manager</option></option>
                                                            <option class=" fs-5" value="user">User</option>
                                                        @elseif ( $data->role == "user")
                                                        <option class=" fs-5" value="user">User</option>
                                                        <option class=" fs-5" value="manager">Manager</option></option>
                                                        <option class=" fs-5" value="admin">Admin</option>

                                                        @else
                                                            <option class=" fs-5" value="manager">Manager</option></option>
                                                            <option class=" fs-5" value="admin">Admin</option>
                                                            <option class=" fs-5" value="user">User</option>
                                                        @endif
                                                    </select>

                                                        @error('role')
                                                        <small class="text-danger">
                                                            {{ $message }}
                                                        </small>
                                                        @enderror

                                                </div>

                                                <div class="col-12">
                                                    <label for="yourPassword" class="form-label fs-5">الصورة الشخصية</label>
                                                    <input type="file" name="photo" class="form-control" id="yourPassword" >
                                                </div>

                                                <div class="col-12">
                                                    <select class="form-select fs-5 @error('gender') is-invalid  @enderror" name="gender" aria-label="Default select example">
                                                        @if($data->gender == 'ذكر')
                                                            <option class=" fs-5" value="ذكر">ذكر</option>
                                                            <option class=" fs-5" value="انثى">انثى</option>
                                                        @elseif($data->gender == 'انثى')
                                                            <option class=" fs-5" value="انثى">انثى</option>
                                                            <option class=" fs-5" value="ذكر">ذكر</option>
                                                        @else
                                                            <option class=" fs-5" value="ذكر">ذكر</option>
                                                            <option class=" fs-5" value="انثى">انثى</option>
                                                        @endif
                                                    </select>

                                                        @error('gender')
                                                        <small class="text-danger">
                                                            {{ $message }}
                                                        </small>
                                                        @enderror

                                                </div>
                                                <div class="col-12">
                                                <button class="btn btn-primary w-100" type="submit">تعديل </button>
                                                </div>
                                            </form>


                                        </div>
                                        <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

                                        </div>
                                    </div>
                                    </div>
                                </div>


                                <!-- Button trigger modal -->
                                <button type="submit " class="mx-1 btn " data-bs-toggle="modal" data-bs-target="#exampleModalDelete{{ $data->id }}">
                                    <i class='bx bxs-trash text-danger' ></i>
                                </button>

                                <!-- Modal -->
                                <div class="modal fade" id="exampleModalDelete{{ $data->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                        <form action="{{ route("destroyUser",["id"=>$data->id]) }}" method="POST">
                                            @method('delete')
                                            @csrf
                                            <button type="submit " class="mx-1 btn btn-danger text-light ">حذف</button>
                                        </form>
                                        </div>
                                    </div>
                                    </div>
                                </div>


                            </td>
                        @else
                        <td >
                            <a class="mx-1 btn text-secondary" data-bs-toggle="modal" data-bs-target="#exampleModalAdmin"><i class='bx bxs-edit-alt' ></i></a>
                            <a class="mx-1 btn  text-secondary" data-bs-toggle="modal" data-bs-target="#exampleModalAdmin"><i class='bx bxs-trash' ></i></a>

                            <!-- Modal -->
                            <div class="modal fade" id="exampleModalAdmin" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                    <div class="modal-header text-center">
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body text-center p-5">
                                        <h5> فقط المدير يمكنه الحذف او التعديل</h5>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                        @endif

                    </tr>
                    @endforeach



                </tbody>
              </table>
              <!-- End Table with hoverable rows -->

            </div>
            <div class="card-footer">
                <div>
                    {{ $data_user->links() }}
                </div>
            </div>

            @else
            <div class="mx-auto">
                <div class="text-center fs-5">لا توجد بيانات</div>
            </div>
            @endif
          </div>

      </div>
    </div>
  </section>

@endsection
