@extends("layouts.dashboard")

@section('content')
<div class="pagetitle text-center my-3">
    <h1>Branches Table</h1>

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
                <div id="addBranch">
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        <i class="bi bi-plus"></i> اضافة
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel"><h5 class="text-center"> اضافة فروع</h5></h5>
                            <button type="button" class="btn btn-light" data-bs-dismiss="modal" aria-label="Close">X</button>
                            </div>
                            <div class="modal-body">

                                <form dir="rtl" class="row g-3 needs-validation mx-auto" method="POST" action="{{ route('createBranch') }}">
                                    @csrf
                                    @method("post")
                                    <div class="col-12">
                                      <label for="yourName" class="form-label fs-5 ">اسم الفرع</label>
                                      <input type="text" name="name" value="{{ old('name') }}" class="form-control @error('name') is-invalid  @enderror " id="yourName" >

                                        @error('name')
                                        <small class="text-danger">
                                            {{ $message }}
                                        </small>
                                        @enderror

                                    </div>

                                    <div class="col-12">
                                      <label for="yourEmail" class="form-label  fs-5"> العنوان</label>
                                      <input type="text" name="title" value="{{ old('title') }}" class="form-control @error('title') is-invalid  @enderror" id="yourEmail" required>

                                        @error('title')
                                        <small class="text-danger">
                                            {{ $message }}
                                        </small>
                                        @enderror

                                    </div>


                                    <div class="mb-3">
                                        <label for="exampleFormControlTextarea1" class="form-label">التفاصيل</label>
                                        <textarea class="form-control" id="editor" name="detail">{{ old('detail') }}</textarea>

                                        @error('detail')
                                        <small class="text-danger">
                                            {{ $message }}
                                        </small>
                                        @enderror
                                    </div>


                                    <div class="col-12">
                                    <label for="exampleFormControlTextarea1" class="form-label">التخصص</label>
                                    <select class="form-select fs-5 @error('specialty') is-invalid  @enderror" name="specialty" aria-label="Default select example">
                                        @foreach ($specialties as $specialty)
                                            <option class=" fs-5" value="{{ $specialty->id }}">{{ $specialty->name }}</option></option>
                                        @endforeach
                                    </select>

                                        @error('specialty')
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
                    <form class="d-flex col-lg-3  mx-5" dir="ltr"  data-aos="fade-up" action="{{ route("searchBranchTable") }}" method="POST">
                        @method("post")
                        @csrf
                        <input class="form-control me-2 @error('search') is-invalid  @enderror"   type="search" name="search" value="{{ old('search') }}" placeholder=" " aria-label="Search">

                        <button class="btn btn-outline-success"  type="submit">بحث</button>
                    </form>
                </div>

            </div>
            @if($data_branch->count() > 0)
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
                    <th scope="col">Title</th>
                    <th scope="col">Specialty</th>
                    <th scope="col">Uploader</th>
                    <th scope="col">Updater</th>
                    <th scope="col">Visit</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach($data_branch as $data)
                    <tr>
                        <th scope="row">{{ ++$i }}</th>
                        <td>{{ $data->name }}</td>
                        <td>{{ $data->title }}</td>
                        <td>
                            @php
                                $specialtyName = DB::table('specialties')->find($data->specialty);
                            @endphp
                                {{ $specialtyName->name }}
                            {{-- {{ $data->specialty }} --}}
                        </td>
                        <td>
                            @php
                                $user1 =DB::table('users')->find($data->uploader);
                            @endphp
                            @if($user1)
                                {{ $user1->name }}
                            @else
                                Deleted
                            @endif
                        </td>
                        <td>
                            @if($data->updater=="")
                                Null
                            @else
                                @php
                                    $user2 =DB::table('users')->find($data->updater);
                                @endphp
                                @if($user2)
                                    {{ $user2->name }}
                                @else
                                    Deleted
                                @endif
                            @endif
                        </td>
                        <td>
                            @if($data->visit=="")
                                Null
                            @else
                            {{ $data->visit }}
                            @endif
                        </td>
                        <td class="d-flex">

                            @if (auth()->user()->role == "manager")
                                <!-- Button trigger modal -->
                                <a  class="mx-1" data-bs-toggle="modal" data-bs-target="#exampleModalEdit{{ $data->id }}">
                                    <i class='btn bx bxs-edit-alt text-warning' ></i>
                                </a>


                                <!-- Modal -->
                                <div class="modal fade" id="exampleModalEdit{{ $data->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel"><h5 class="text-center"> اضافة فروع</h5></h5>
                                        <button type="button" class="btn btn-light" data-bs-dismiss="modal" aria-label="Close">X</button>
                                        </div>
                                        <div class="modal-body">

                                            <form dir="rtl" class="row g-3 needs-validation mx-auto" method="POST" action="{{ route("updateBranch",['id'=>$data->id]) }}">
                                                @csrf
                                                @method("put")
                                                <div class="col-12">
                                                <label for="yourName" class="form-label fs-5 ">اسم الفرع</label>
                                                <input type="text" name="name" value="{{ $data->name }}" class="form-control @error('name') is-invalid  @enderror " id="yourName" >

                                                    @error('name')
                                                    <small class="text-danger">
                                                        {{ $message }}
                                                    </small>
                                                    @enderror

                                                </div>

                                                <div class="col-12">
                                                <label for="yourEmail" class="form-label  fs-5"> العنوان</label>
                                                <input type="text" name="title" value="{{ $data->title }}" class="form-control @error('title') is-invalid  @enderror" id="yourEmail" required>

                                                    @error('title')
                                                    <small class="text-danger">
                                                        {{ $message }}
                                                    </small>
                                                    @enderror

                                                </div>


                                                <div class="mb-3">
                                                    <label for="exampleFormControlTextarea1" class="form-label">التفاصيل</label>
                                                    <textarea class="form-control" id="editor" name="detail">{{ $data->details }}</textarea>

                                                    @error('detail')
                                                    <small class="text-danger">
                                                        {{ $message }}
                                                    </small>
                                                    @enderror
                                                </div>


                                                <div class="col-12">
                                                <label for="exampleFormControlTextarea1" class="form-label">التخصص</label>
                                                <select class="form-select fs-5 @error('specialty') is-invalid  @enderror" name="specialty" aria-label="Default select example">

                                                    @php
                                                        $specialty1 =DB::table('specialties')->find($data->specialty);
                                                    @endphp

                                                    <option class=" fs-5" value="{{ $specialty1->id }}">{{ $specialty1->name }}</option>
                                                    @foreach ($specialties as $specialty)
                                                        @if ($specialty->name == $specialty1->name)

                                                        @else
                                                            <option class=" fs-5" value="{{ $specialty->id }}">{{ $specialty->name }}</option>
                                                        @endif

                                                    @endforeach
                                                </select>

                                                    @error('specialty')
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
                                        <form action="{{ route("destroyBranch",["id"=>$data->id]) }}" method="POST">
                                            @method('delete')
                                            @csrf
                                            <button type="submit " class="mx-1 btn btn-danger text-light ">حذف</button>
                                        </form>
                                        </div>
                                    </div>
                                    </div>
                                </div>

                            @else
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

                            @endif
                        </td>
                    </tr>
                    @endforeach



                </tbody>
              </table>
              <!-- End Table with hoverable rows -->



            </div>

            <div class="card-footer">
                <div>
                    {{ $data_branch->links() }}
                </div>
            </div>

            @else
              <div class="mx-auto ">
                  <div class="text-center fs-5 my-5">لا توجد بيانات</div>
              </div>
            @endif
          </div>

      </div>
    </div>
  </section>

@endsection
