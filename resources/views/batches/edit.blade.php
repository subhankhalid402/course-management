@extends('layout.master')
@section('page_title','Edit Dog')
@section('content')
    <!--begin::Content wrapper-->
    <div class="d-flex flex-column flex-column-fluid">
        <!--begin::Toolbar-->
        <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
            <!--begin::Toolbar container-->
            <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
                <!--begin::Page title-->
                <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                    <!--begin::Title-->
                    <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">
                        @yield('page_title')</h1>
                    <!--end::Title-->
                </div>
                <!--end::Page title-->
                <!--begin::Actions-->
                <div class="d-flex align-items-center gap-2 gap-lg-3">
                    <!--begin::Primary button-->
                    <a href="{{env('BASE_URL').'dogs'}}" class="btn btn-sm fw-bold btn-primary">
                        <i class="bi bi-list-check"></i>
                        Dogs List
                    </a>
                    <!--end::Primary button-->
                </div>
                <!--end::Actions-->
            </div>
            <!--end::Toolbar container-->
        </div>
        <!--end::Toolbar-->
        <!--begin::Content-->
        <div id="kt_app_content" class="app-content flex-column-fluid">
            <!--begin::Content container-->
            <div id="kt_app_content_container" class="app-container container-xxl">
                <!--begin::Card-->
                <div class="card">
                    <!--begin::Card body-->
                    <div class="card-body p-0" id="main-content-body">
                        <!--begin::Form-->
                        <div class="card-px py-5 my-5">
                            <!--begin::Row-->
                            <div class="row mb-3">
                                <!--begin::Col-->
                                <div class="col-md-12 pe-lg-10">
                                    <!--begin::Form-->
                                    <form action="#" class="form mb-15" method="post">

                                        <div class="row g-3 mb-8">
                                            <!--begin::Col-->
                                            <div class="col-md-4 fv-row">
                                                <label class="fs-5 fw-semibold mb-2">
                                                    <span class="required">User</span>
                                                </label>
                                                <select name="user_id" id="user_id"
                                                        class="form-control form-control-solid user_id">
                                                    @foreach($users as $user)
                                                        <option value="{{ $user->id }}"
                                                                @if($user->id == $dog->user_id) selected @endif>{{ $user->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <!--end::Col-->
                                            <!--begin::Col-->
                                            <div class="col-md-4 fv-row">
                                                <label class="fs-5 fw-semibold mb-2">
                                                    <span class="required">Dog Name</span>
                                                </label>
                                                <input type="text" class="form-control form-control-solid"
                                                       placeholder="Enter Dog name" name="name" id="name"
                                                       value="{{ $dog->name }}"/>
                                            </div>
                                            <!--end::Col-->

                                            <!--begin::Col-->
                                            <div class="col-md-4 fv-row">
                                                <label class="fs-5 fw-semibold mb-2">
                                                    <span class="required">Preference</span>
                                                </label>
                                                <select name="preference" id="preference"
                                                        class="form-control form-control-solid preference">

                                                    <option
                                                        value="play" {{ \App\Helpers\SiteHelper::isSelected($dog->preference, 'play') }}>
                                                        Pay
                                                    </option>
                                                    <option
                                                        value="missing" {{ \App\Helpers\SiteHelper::isSelected($dog->preference, 'missing') }}>
                                                        Missing
                                                    </option>
                                                    <option
                                                        value="adopt" {{ \App\Helpers\SiteHelper::isSelected($dog->preference, 'adopt') }}>
                                                        Adopt
                                                    </option>

                                                </select>
                                            </div>
                                            <!--end::Col-->

                                            <!--begin::Col-->
                                            <div class="col-md-4 fv-row">
                                                <label class="fs-5 fw-semibold mb-2">
                                                    <span class="">Breed</span>
                                                </label>
                                                <input type="text" class="form-control form-control-solid breed"
                                                       placeholder="Enter Breed" name="breed" id="breed"
                                                       value="{{ $dog->breed }}"/>
                                            </div>
                                            <!--end::Col-->

                                            <!--begin::Col-->
                                            <div class="col-md-4 fv-row">
                                                <label class="fs-5 fw-semibold mb-2">
                                                    <span class="">Gender</span>
                                                </label>
                                                <select name="gender" id=""
                                                        class="form-control form-control-solid gender">

                                                    <option
                                                        value="male" {{ \App\Helpers\SiteHelper::isSelected($dog->gender, 'male') }}>
                                                        Male
                                                    </option>
                                                    <option
                                                        value="female" {{ \App\Helpers\SiteHelper::isSelected($dog->gender, 'female') }}>
                                                        FeMale
                                                    </option>
                                                    <option
                                                        value="other" {{ \App\Helpers\SiteHelper::isSelected($dog->gender, 'other') }}>
                                                        Other
                                                    </option>

                                                </select>
                                            </div>
                                            <!--end::Col-->

                                            <!--begin::Col-->
                                            <div class="col-md-4 fv-row">
                                                <label class="fs-5 fw-semibold mb-2">
                                                    <span class="">Born Year</span>
                                                </label>
                                                <input type="number" class="form-control form-control-solid born_year"
                                                       placeholder="Enter Dog name" name="born_year" id="born_year"
                                                       value="{{ $dog->born_year }}"/>
                                            </div>
                                            <!--end::Col-->

                                            <!--begin::Col-->
                                            <div class="col-md-4 fv-row">
                                                <label class="fs-5 fw-semibold mb-2">
                                                    <span class="">Born Month</span>
                                                </label>
                                                <input type="number" class="form-control form-control-solid born_month"
                                                       placeholder="Enter month" name="born_month" id="born_month"
                                                       value="{{ $dog->born_month }}"/>
                                            </div>
                                            <!--end::Col-->

                                            <!--begin::Submit-->
                                            <div class="separator border-light my-10"></div>

                                            <div class="row">
                                                <div class="col-12">
                                                    <!--begin::Actions-->
                                                    <input type="hidden" id="id" value="{{$dog->id}}">
                                                    <div class="text-center">
                                                        <button type="reset" id="reset_form"
                                                                class="btn btn-light me-3">Reset
                                                        </button>
                                                        <button type="submit"
                                                                class="btn btn-primary submit-btn" id="user-save-btn">
                                                            <span class="indicator-label submit-btn-label">Submit</span>
                                                            <span
                                                                class="indicator-progress  submitted-processing-label">Please wait...
									                        <span
                                                                class="spinner-border spinner-border-sm align-middle ms-2"></span>
                                                        </span>
                                                        </button>
                                                    </div>
                                                    <!--end::Actions-->
                                                </div>
                                            </div>
                                            <!--end::Submit-->
                                    </form>
                                    <!--end::Form-->
                                </div>
                                <!--end::Col-->
                                <!--end::Col-->
                            </div>
                            <!--end::Row-->

                        </div>
                        <!--end::Form-->
                    </div>
                    <!--end::Card body-->
                </div>
                <!--end::Card-->
            </div>
            <!--end::Content container-->
        </div>
        <!--end::Content-->
    </div>
    <!--end::Content wrapper-->
@endsection

@section('page_level_scripts')
    <script type="text/javascript">
        $(document).on('click', '#user-save-btn', function (e) {
            e.preventDefault();
            do_post_ajax({
                'api_hook': 'dogs/update',
                'data': getFormData(),
            });
        });

        function getFormData() {
            return {
                'id': $('#id').val(),
                'name': $('#name').val(),
                'breed': $('.breed').val(),
                'preference': $('.preference').val(),
                'user_id': $('.user_id').val(),
                'gender': $('.gender').val(),
                'born_year': $('.born_year').val(),
                'born_month': $('.born_month').val(),
            }
        }
    </script>
@endsection
