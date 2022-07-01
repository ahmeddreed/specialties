@extends("layouts.main")
@section("content")
  <!-- ======= Hero Section ======= -->
  <section id="hero" class="d-flex align-items-center">

    <div class="container">
      <div class="row">
        <div class="col-lg-6 d-flex flex-column justify-content-center pt-4 pt-lg-0 order-2 order-lg-1" data-aos="fade-up" data-aos-delay="200">
          <h1 class="text-info">موقع تخصصات البرمجة</h1>
          <h2>موقع تعليمي يساعدك على تعلم البرمجة من خلال معرفة التخصصات والفروع ولغات البرمجة</h2>

        </div>
        <div class="col-lg-6 order-1 order-lg-2 hero-img" data-aos="zoom-in" data-aos-delay="200">
          <img src="assets/img/hero-img.png" class="img-fluid animated" alt="">
        </div>
      </div>
    </div>

  </section><!-- End Hero -->

  <main id="main">

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

     <!-- ======= التخصصات ======= -->
     <section id="pricing" class="pricing">
      <div class="container" data-aos="fade-up">

         <div class="section-title">
          <h2>التخصصات</h2>
        </div>

        @if (count($specialties) > 0)
          <form class="d-flex col-lg-3  mx-5" dir="ltr"  data-aos="fade-up" action="{{ route("searchSpeciaty") }}" method="POST">
            @method("post")
            @csrf
            <input class="form-control me-2 @error('searchSP') is-invalid  @enderror"   type="search" name="searchSP" value="{{ old('email') }}" placeholder=" " aria-label="Search">

            <button class="btn btn-outline-success"  type="submit">بحث</button>
          </form>
        @endif
        <div class="row ">

        @if (count($specialties) > 0)

            @foreach ($specialties as $item)
                <div class="col-lg-3 mx-auto"  data-aos="fade-up" data-aos-delay="100">
                    <div class="box featured">
                    <h3 class="fs-4">{{ $item->name }}</h3>
                    <p class="fs-5">{{ $item->title }}</p>

                    <a href="{{ route('showSpeciatyDetail',['id'=>$item->id]) }}" class="buy-btn mb-5  ">عرض</a>
                    </div>
                </div>
            @endforeach
           <div class="mx-auto text-center"><a href="{{ route("showAllSpecialties") }}" class="buy-btn mb-5">عرض الكل</a></div>

           <div class="d-flex justify-content-center">{{ $specialties->links() }}</div>

        @else
            <h3 class="text-center">لايوجد بيانات</h3>
        @endif



        </div>

      </div>
    </section><!-- التخصصات -->

    <!-- =======الفروع======= -->
    <section id="services" class="services section-bg pricing">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2>الفروع</h2>
        </div>
        @if (count($branches) > 0)
            <form class="d-flex col-lg-3  mx-5" dir="ltr"  data-aos="fade-up" action="{{ route("searchBranch") }}" method="POST">
                @method("post")
                @csrf
                <input class="form-control me-2 @error('searchBR') is-invalid  @enderror"   type="search" name="searchBR" value="{{ old('email') }}" placeholder=" " aria-label="Search">

                <button class="btn btn-outline-success"  type="submit">بحث</button>
            </form>
        @endif
        <div class="row mt-5">


        @if (count($branches) > 0)

            @foreach ($branches as $item)
                <div class="col-lg-3 mx-auto" data-aos="fade-up" data-aos-delay="100">
                    <div class="box featured">
                    <h3 class="fs-4">{{ $item->name }}</h3>
                    <p class="fs-5">{{ $item->title }}</p>

                    <a href="{{ route('showBranchDetail',['id'=>$item->id]) }}" class="buy-btn mb-5">عرض</a>
                    </div>
                </div>
            @endforeach

            <div class="mx-auto text-center"><a href="{{ route("showAllBranches") }}" class="buy-btn mb-5">عرض الكل</a></div>

            <div class="d-flex justify-content-center">{{ $branches->links() }}</div>

        @else
            <h3 class="text-center">لايوجد بيانات</h3>
        @endif

        </div>

      </div>
    </section><!-- الفروع -->



        <!-- =======اللغات ======= -->
     <section id="pricing" class="pricing">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2>اللغات</h2>
        </div>
        @if (count($languages) > 0)
            <form class="d-flex col-lg-3  mx-5" dir="ltr"  data-aos="fade-up" action="{{ route("searchLanguage") }}" method="POST">
                @method("post")
                @csrf
                <input class="form-control me-2 @error('searchLng') is-invalid  @enderror"   type="search" name="searchLng" value="{{ old('email') }}" placeholder=" " aria-label="Search">

                <button class="btn btn-outline-success"  type="submit">بحث</button>
            </form>
        @endif
        <div class="row ">

        @if (count($languages) > 0)

            @foreach ($languages as $item)
                <div class="col-lg-3 mx-auto" data-aos="fade-up" data-aos-delay="100">
                    <div class="box featured">
                    <h3 class="fs-4">{{ $item->name }}</h3>
                    <p class="fs-5">{{ $item->title }}</p>

                    <a href="{{ route("showLanguageDetail",["id"=>$item->id]) }}" class="buy-btn mb-5">عرض</a>
                    </div>
                </div>
            @endforeach

            <div class="mx-auto text-center"><a href="{{ route("showAllLanguages") }}" class="buy-btn mb-5">عرض الكل</a></div>
            <div  class="d-flex justify-content-center">{{ $languages->links() }}</div>

        @else
            <h3 class="text-center">لايوجد بيانات</h3>
        @endif

        </div>

      </div>
    </section><!--اللغات -->


<!-- =======الكورسات======= -->
<section id="services" class="services section-bg pricing">
    <div class="container" data-aos="fade-up">

      <div class="section-title">
        <h2>الكورسات</h2>
      </div>
      @if (count($courses) > 0)
        <form class="d-flex col-lg-3  mx-5" dir="ltr"  data-aos="fade-up" action="{{ route("searchCourse") }}" method="POST">
            @method("post")
            @csrf
            <input class="form-control me-2 @error('searchCS') is-invalid  @enderror"   type="search" name="searchCS" value="{{ old('email') }}" placeholder=" " aria-label="Search">

            <button class="btn btn-outline-success"  type="submit">بحث</button>
        </form>
      @endif
      <div class="row mt-5">


        @if (count($courses) > 0)

            @foreach ($courses as $item)
                <div class="col-lg-3 mx-auto" data-aos="fade-up" data-aos-delay="100">
                    <div class="box featured">
                    <h3 class="fs-4">{{ $item->name }}</h3>
                    <p class="fs-5">{{ $item->title }}</p>

                    <a href="{{ route("showCourseDetail",["id"=>$item->id]) }}" class="buy-btn mb-5">عرض</a>
                    </div>
                </div>
            @endforeach

            <div class="mx-auto text-center"><a href="{{ route("showAllCourses") }}" class="buy-btn mb-5">عرض الكل</a></div>

            <div class="d-flex justify-content-center">{{ $courses->links() }}</div>

        @else
            <h3 class="text-center">لايوجد بيانات</h3>
        @endif
      </div>

    </div>
  </section><!-- الكورسات -->



  </main><!-- End #main -->


 @endsection
