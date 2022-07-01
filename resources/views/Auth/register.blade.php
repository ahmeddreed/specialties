@extends("layouts.auth")
@section("content")


<main>
    <div class="container">

        <div class="col-lg-4 col-md-6 mx-auto">
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

      <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-6 col-md-8 d-flex flex-column align-items-center justify-content-center">


              <div class="card mb-3">

                <div class="card-body">

                  <div class="pt-4 pb-2">
                    <h5 class="card-title text-center pb-0 fs-4">انشاء حساب </h5>
                  </div>

                  <form dir="rtl" class="row g-3 needs-validation" method="POST" action="{{ route("registerUser") }}" enctype="multipart/form-data">
                    @csrf
                    @method("post")
                    <div class="col-12">
                      <label for="yourName" class="form-label fs-5 ">الاسم الكامل</label>
                      <input type="text" name="name" value="{{ old('name') }}"  class="form-control @error('name') is-invalid  @enderror " id="yourName" >

                        @error('name')
                        <small class="text-danger">
                            {{ $message }}
                        </small>
                        @enderror

                    </div>

                    <div class="col-12">
                      <label for="yourEmail" class="form-label  fs-5"> الايميل</label>
                      <input type="email" name="email" value="{{ old('email') }}"  class="form-control @error('email') is-invalid  @enderror" id="yourEmail" required>

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
                    <div class="col-12">
                      <p class="small mb-0 fs-5"> لدي حساب <a href="{{ route("login") }}"> دخول</a></p>
                    </div>
                  </form>

                </div>
              </div>

              <div class="credits">
                <!-- All the links in the footer should remain intact. -->
                <!-- You can delete the links only if you purchased the pro version. -->
                <!-- Licensing information: https://bootstrapmade.com/license/ -->
                <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/ -->

              </div>

            </div>
          </div>
        </div>

      </section>

    </div>
  </main><!-- End #main -->


@endsection
