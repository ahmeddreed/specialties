@extends("layouts.main")
@section("content")
    <!-- ======= Breadcrumbs ======= -->
    <section id="breadcrumbs" class="breadcrumbs">
    </section><!-- End Breadcrumbs -->
    <!-- ======= Portfolio Details Section ======= -->

    <section id="services" class="services section-bg pricing">
        <div class="container" data-aos="fade-up">

        @if ($show =="Specialties")
            {{-- show all Specialties  --}}
            <div class="section-title">
                <h2>التخصصات</h2>
            </div>


            <div class="row mt-5">

            @foreach ($specialties as $item)
                <div class="col-lg-3 mx-auto"  data-aos="fade-up" data-aos-delay="100">
                    <div class="box featured">
                    <h3 class="fs-4">{{ $item->name }}</h3>
                    <p class="fs-5">{{ $item->title }}</p>

                    <a href="{{ route('showSpeciatyDetail',['id'=>$item->id]) }}" class="buy-btn mb-5">عرض</a>
                    </div>
                </div>
            @endforeach
           {{ $specialties->links() }}

            </div>


        @elseif($show =="Branches")
            {{-- show all Branches  --}}
            <div class="section-title">
                <h2>الفروع</h2>
            </div>


            <div class="row mt-5">
            @foreach ($branches as $item)
                <div class="col-lg-3 mx-auto" data-aos="fade-up" data-aos-delay="100">
                    <div class="box featured">
                    <h3 class="fs-4">{{ $item->name }}</h3>
                    <p class="fs-5">{{ $item->title }}</p>

                    <a href="{{ route('showBranchDetail',['id'=>$item->id]) }}" class="buy-btn mb-5">عرض</a>
                    </div>
                </div>
            @endforeach
            {{ $branches->links() }}


        @elseif($show =="Languages")
        {{-- show all Languages  --}}
        <div class="section-title">
            <h2>اللغات</h2>
        </div>


        <div class="row mt-5">
            @foreach ($languages as $item)
            <div class="col-lg-3 mx-auto" data-aos="fade-up" data-aos-delay="100">
                <div class="box featured">
                <h3 class="fs-4">{{ $item->name }}</h3>
                <p class="fs-5">{{ $item->title }}</p>

                <a href="{{ route("showLanguageDetail",['id'=>$item->id]) }}" class="buy-btn mb-5">عرض</a>
                </div>
            </div>
        @endforeach
        {{ $languages->links() }}


        @elseif($show =="Courses")
        {{-- show all Courses  --}}
        <div class="section-title">
            <h2>الكورسات</h2>
        </div>

        <div class="row mt-5">
            @foreach ($courses as $item)
                <div class="col-lg-3 mx-auto" data-aos="fade-up" data-aos-delay="100">
                    <div class="box featured">
                    <h3 class="fs-4">{{ $item->name }}</h3>
                    <p class="fs-5">{{ $item->title }}</p>

                    <a href="{{ route("showCourseDetail",['id'=>$item->id]) }}" class="buy-btn mb-5">عرض</a>
                    </div>
                </div>
            @endforeach
        {{ $courses->links() }}

        @endif

        </div>
    </section>

@endsection
