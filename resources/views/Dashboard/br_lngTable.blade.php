@extends("layouts.dashboard")

@section('content')
<div class="pagetitle text-center my-3">
    <h1>Branch-Language Table</h1>

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
                <div id="addLnaguage">
                    <!-- Button trigger modal -->
                    @if (auth()->user()->role == "manager")
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

                                    <form dir="rtl" class="row g-3 needs-validation mx-auto" method="POST" action="{{ route("addBrLng") }}">
                                        @csrf
                                        @method("post")
                                        <div class="col-12">
                                            <label for="exampleFormControlTextarea1" class="form-label">الفروع</label>
                                            <select class="form-select fs-5 @error('languageID') is-invalid  @enderror" name="languageID" aria-label="Default select example">
                                                @foreach ($languages as $language)
                                                    <option class=" fs-5" value="{{ $language->id }}">{{ $language->name }}</option>
                                                @endforeach

                                            </select>
                                        </div>


                                        <div class="col-12">
                                            <label for="exampleFormControlTextarea1" class="form-label">الفروع</label>
                                            <select class="form-select fs-5 @error('branchID') is-invalid  @enderror" name="branchID" aria-label="Default select example">
                                                @foreach ($branches as $branch)
                                                    <option class=" fs-5" value="{{ $branch->id }}">{{ $branch->name }}</option>
                                                @endforeach
                                            </select>
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
                    @else

                        <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#exampleModalAdmin">
                            <i class="bi bi-plus"></i> اضافة
                        </button>

                    @endif

                </div>
                <div class="d-flex justify-content-end">
                    <form class="d-flex col-lg-3  mx-5" dir="ltr"  data-aos="fade-up" action="{{ route("searchBr_lngTable") }}" method="POST">
                        @method("post")
                        @csrf
                        <input class="form-control me-2 @error('search') is-invalid  @enderror"   type="search" name="search" value="{{ old('search') }}" placeholder=" " aria-label="Search">

                        <button class="btn btn-outline-success"  type="submit">بحث</button>
                    </form>
                </div>


            </div>
            @if($data_br_lng->count() > 0)
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
                    <th scope="col">Branch ID</th>
                    <th scope="col">Language ID</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach($data_br_lng as $data)
                    <tr>
                        <th scope="row">{{ ++$i }}</th>
                        <td>{{ $data->name }}</td>
                        <td>{{ $data->branch_id }}</td>
                        <td>{{ $data->language_id }}</td>
                        <td class="d-flex">
                            @if (auth()->user()->role == "manager")
                                {{-- Edit --}}
                                <!-- Button trigger modal -->
                                <a href="#" class="mx-1 btn" data-bs-toggle="modal" data-bs-target="#exampleModalEdit{{ $data->id }}">
                                    <i class='bx bxs-edit-alt text-warning' ></i>
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

                                            <form dir="rtl" class="row g-3 needs-validation mx-auto" method="POST" action="{{ route("updateBrLng",['id'=>$data->id]) }}">
                                                @csrf
                                                @method("put")

                                                <div class="col-12">
                                                    <label for="exampleFormControlTextarea1" class="form-label">الفروع</label>
                                                    <select class="form-select fs-5 @error('languageID') is-invalid  @enderror" name="languageID" aria-label="Default select example">
                                                        @php
                                                            $lng = DB::table("languages")->find($data->language_id);
                                                        @endphp
                                                        <option class=" fs-5" value="{{ $lng->id }}">{{ $lng->name }}</option>

                                                        @foreach ($languages as $language)

                                                            @if($language->name == $lng->name)

                                                            @else
                                                                <option class=" fs-5" value="{{ $language->id }}">{{ $language->name }}</option>
                                                            @endif

                                                        @endforeach
                                                    </select>
                                                </div>


                                                <div class="col-12">
                                                    <label for="exampleFormControlTextarea1" class="form-label">الفروع</label>
                                                    <select class="form-select fs-5 @error('branchID') is-invalid  @enderror" name="branchID" aria-label="Default select example">

                                                        @php
                                                            $br = DB::table("branches")->find($data->branch_id);
                                                        @endphp
                                                            <option class=" fs-5" value="{{ $br->id }}">{{ $br->name }}</option>

                                                        @foreach ($branches as $branch)

                                                            @if ($branch->name == $br->name)

                                                            @else
                                                                <option class=" fs-5" value="{{ $branch->id }}">{{ $branch->name }}</option>
                                                            @endif

                                                        @endforeach
                                                    </select>

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

                                {{--end Edit --}}

                                {{-- Delete --}}

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
                                        <form action="{{ route("destroyBrLng",["id"=>$data->id]) }}" method="POST">
                                            @method('delete')
                                            @csrf
                                            <button type="submit " class="mx-1 btn btn-danger text-light ">حذف</button>
                                        </form>
                                        </div>
                                    </div>
                                    </div>
                                </div>


                                {{-- end Delete --}}
                            @else

                                <a class="mx-1 btn text-secondary" data-bs-toggle="modal" data-bs-target="#exampleModalAdmin"><i class='bx bxs-edit-alt' ></i></a>
                                <a class="mx-1 btn text-secondary" data-bs-toggle="modal" data-bs-target="#exampleModalAdmin"><i class='bx bxs-trash' ></i></a>

                                <!-- Modal -->
                                <div class="modal fade" id="exampleModalAdmin" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                        <div class="modal-header text-center">
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body text-center p-5">
                                            <h5> فقط المدير يمكنه الاضافة الحذف او التعديل</h5>
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
                    {{ $data_br_lng->links() }}
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
