@extends("layouts.dashboard")

@section('content')

<main class="container p-5 mb-5">
    <div class="row p-3 m-3 text-light ">
        <div class="col-lg-3 bg-info mx-auto m-3 me-3 p-3 rounded"><i class="bi bi-person-fill fs-1 pe-2"></i> Users ({{ $userCount }}) </div>
        <div class="col-lg-3 bg-info mx-auto m-3 p-3 rounded"><i class="bi bi-code-square fs-1 pe-2" ></i> Specialties ({{ $specialtyCount }}) </div>
        <div class="col-lg-3 bg-info mx-auto m-3 p-3 rounded"><i class="bi bi-share-fill fs-1 pe-2"></i>Branches ({{ $branchCount }})</div>
        <div class="col-lg-3 bg-info mx-auto m-3 p-3 rounded"><i class="bi bi-code-slash fs-1 pe-2"></i>Languages ({{ $languageCount }})</div>
        <div class="col-lg-3 bg-info mx-auto m-3 p-3 rounded"><i class="bi bi-collection-play fs-1 pe-2"></i> Courses ({{ $courseCount }})</div>
    </div>
    <hr class="dropdown-divider">
    <div class="container">
        <div class="card">
            <div class="card-title d-flex">
                <h4 class="btn btn-info text-light float flaol-start">add</h4>
                <h4 class="  flaol-end">الاعلانات</h4>
            </div>
            <div class="card-body"></div>
        </div>
    </div>
</main>

@endsection
