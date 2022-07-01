@extends("layouts.main")
@section("content")


<main id="main my-5">
    <!-- ======= Breadcrumbs ======= -->
    <section id="breadcrumbs" class="breadcrumbs">
    </section><!-- End Breadcrumbs -->
    <!-- ======= Portfolio Details Section ======= -->

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

    @if ($page == 'Speciaty Detail')
        {{-- Speciaty Detail --}}

        <section id="portfolio-details" class="portfolio-details">
            <div class="container">

            <div class="row gy-4 p-5">


                <div class="col-lg-4" dir="rtl">
                    <div class="portfolio-info">
                        <h3>المعلومات</h3>
                        <ul>
                        <li><strong>النوع</strong>: تخصص</li>
                        <li><strong>الاسم</strong>: {{ $speciatyDetail->name }}</li>
                        <li><strong>العنوان</strong>: {{ $speciatyDetail->title }}</li>
                        </ul>
                    </div>

                </div>

                <div class="col-lg-8">
                <div class="portfolio-info">
                    <h3> التفاصيل</h3>
                    {!! $speciatyDetail->details !!}
                    </div>
                </div>


            </div>
            </div>
        </section><!-- End Portfolio Details Section -->

            <!-- =======الفروع======= -->
            <section id="services" class="services section-bg pricing">
                <div class="container" data-aos="fade-up">
                <div class="section-title">
                    <h2>فروع التخصص</h2>
                </div>
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


                @else
                    <h3 class="text-center">لايوجد فروع مرتبطة حاليا</h3>
                @endif

                </div>
                </div>
            </section><!-- الفروع -->

        {{--end Speciaty Detail --}}


    @elseif($page == 'Branch Detail')
        {{-- Branch Detail --}}
        <section id="portfolio-details" class="portfolio-details">
            <div class="container">

            <div class="row gy-4 p-5">


                <div class="col-lg-4" dir="rtl">
                    <div class="portfolio-info">
                        <h3>المعلومات</h3>
                        <ul>
                        <li><strong>النوع</strong>: فرع</li>
                        <li><strong>الاسم</strong>: {{ $branchDetail->name }}</li>
                        <li><strong>العنوان</strong>: {{ $branchDetail->title }}</li>
                        </ul>
                    </div>

                </div>

                <div class="col-lg-8">
                <div class="portfolio-info">
                    <h3> التفاصيل</h3>
                    {!! $branchDetail->details !!}
                    </div>
                </div>


            </div>
            </div>
        </section><!-- End Portfolio Details Section -->
            <section id="services" class="services section-bg pricing">
                <div class="container" data-aos="fade-up">
                <div class="section-title">
                    <h2>لغات الفرع</h2>
                </div>
                <div class="row mt-5">

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


                @else
                    <h3 class="text-center">لايوجد لغات مرتبطة حاليا</h3>
                @endif

                </div>
                </div>
            </section>


        {{--end Branch Detail --}}




        @elseif($page == 'Language Detail')
        {{-- Language Detail --}}
        <section id="portfolio-details" class="portfolio-details">
            <div class="container">

            <div class="row gy-4 p-5">


                <div class="col-lg-4" dir="rtl">
                    <div class="portfolio-info">
                        <h3>المعلومات</h3>
                        <ul>
                        <li><strong>النوع</strong>: لغة</li>
                        <li><strong>الاسم</strong>: {{ $languageDetail->name }}</li>
                        <li><strong>العنوان</strong>: {{ $languageDetail->title }}</li>
                        </ul>
                    </div>

                </div>

                <div class="col-lg-8">
                <div class="portfolio-info">
                    <h3> التفاصيل</h3>
                    {!! $languageDetail->title !!}
                    </div>
                </div>


            </div>
            </div>
        </section><!-- End Portfolio Details Section -->

            <!-- =======الفروع======= -->
            <section id="services" class="services section-bg pricing">
                <div class="container" data-aos="fade-up">
                <div class="section-title">
                    <h2> كورسات اللغة</h2>
                </div>
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


                @else
                    <h3 class="text-center">لايوجد كورسات مرتبطة حاليا</h3>
                @endif

                </div>
                </div>
            </section><!-- الفروع -->


        {{--end Language Detail --}}



        @elseif($page == 'Course Detail')
        {{-- Course Detail --}}
        <section id="portfolio-details" class="portfolio-details">
            <div class="container">

            <div class="row gy-4 p-5">


                <div class="col-lg-4" dir="rtl">
                    <div class="portfolio-info">
                        <h3>المعلومات</h3>
                        <ul>
                        <li><strong>النوع</strong>: لغة</li>
                        <li><strong>الاسم</strong>: {{ $courseDetail->name }}</li>
                        <li><strong>العنوان</strong>: {{ $courseDetail->title }}</li>
                        </ul>
                    </div>

                </div>

                <div class="col-lg-8">
                <div class="portfolio-info">
                    <h3> التفاصيل</h3>
                    {!! $courseDetail->title !!}
                    </div>
                </div>

                <div class="col-10 text-center my-5">
                    @auth
                    @if ($regestered)
                        <h5 class="my-3 text-success">انت مسجل</h5>
                        <div class="row " >

                            <div class="col-lg-4 mx-auto " dir="ltr">
                                <div class="card bg-light shadow p-3 mb-5 bg-body rounded">
                                    <div class="card-body ">
                                        <h5 class="text-center">{{ $name[0] }} اساسيات اللغة</h5>
                                        <h6 class="text-center"></h6>
                                        <a href="https://www.youtube.com/results?search_query={{ $name[0] }}&sp=EgIQAw%253D%253D" target="_blank" class="btn btn-primary mt-3 ">عرض</a>
                                    </div>
                                </div>
                            </div>

                            @if ($courseDetail->FW_link != "")
                                <div class="col-lg-4 mx-auto " dir="ltr">
                                    <div class="card bg-light shadow p-3 mb-5 bg-body rounded">
                                        <div class="card-body ">
                                            <h5 class="text-center"> {{ $courseDetail->name }} اساسيات اطار العمل</h5>
                                            <h6 class="text-center"></h6>
                                            <a href="{{ $courseDetail->FW_link }}" target="_blank" class="btn btn-primary mt-3 ">عرض</a>
                                        </div>
                                    </div>
                                </div>
                            @endif

                            <div class="col-lg-4 mx-auto " dir="ltr">
                                <div class="card bg-light shadow p-3 mb-5 bg-body rounded">
                                    <div class="card-body ">
                                        <h5 class="text-center"> بناء مشروع باللغة العربية</h5>
                                        <h6 class="text-center"></h6>
                                        <a href="{{ $courseDetail->A_link }}" target="_blank" class="btn btn-primary mt-3 ">عرض</a>
                                    </div>
                                </div>
                            </div>


                            <div class="col-lg-4 mx-auto " dir="ltr">
                                <div class="card bg-light shadow p-3 mb-5 bg-body rounded">
                                    <div class="card-body ">
                                        <h5 class="text-center"> بناء مشروع باللغة الانكليزية</h5>
                                        <h6 class="text-center"></h6>
                                        <a href="{{ $courseDetail->E_link }}" target="_blank" class="btn btn-primary mt-3 ">عرض</a>
                                    </div>
                                </div>
                            </div>

                        </div>
                    @else
                        <form action="{{ route("courseRegister",['id'=>$courseDetail->id]) }}" method="POST">
                            @csrf
                            @method('post')
                            <button class="btn btn-primary fs-5">تسجيل</button>
                        </form>
                    @endif

                    @endauth
                    @guest
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                            تسجيل
                        </button>

                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <h4> لم تقم بتسجيل الدخول </h4>
                                        <h5>الرجاء التسجيل الدخول </h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endguest
                </div>



            </div>
            </div>
        </section><!-- End Portfolio Details Section -->
        {{--end Course Detail --}}
    @endif


  </main><!-- End #main -->



@endsection
