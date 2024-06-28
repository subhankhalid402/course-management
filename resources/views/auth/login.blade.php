@extends('auth.layout.master')

@section('page_title', "Login - " . env('APP_NAME'))

@section('content')
<!--begin::Body-->
<div
    class="d-flex flex-column-fluid flex-lg-row-auto justify-content-center justify-content-lg-end p-12 p-lg-20">
    <!--begin::Card-->
    <div class="bg-body d-flex flex-column align-items-stretch flex-center rounded-4 w-md-600px p-20">
        <!--begin::Wrapper-->
        <div class="d-flex flex-center flex-column flex-column-fluid px-lg-10 pb-15 pb-lg-20" id="main-content-body">
            <!--begin::Form-->
            <form class="form w-100" novalidate="novalidate" id="kt_sign_in_form" action="#">
                <!--begin::Heading-->
                <div class="text-center mb-11">
                    <!--begin::Title-->
                    <h1 class="text-dark fw-bolder mb-3">Sign In</h1>
                    <!--end::Title-->
                    <!--begin::Subtitle-->
                    <div class="text-gray-500 fw-semibold fs-6">Enter your login details to get into the system!
                    </div>
                    <!--end::Subtitle=-->
                </div>
                <!--begin::Heading-->
                <!--begin::Input group=-->
                <div class="fv-row mb-8">
                    <!--begin::Email-->
                    <input type="text" placeholder="Email" id="email" name="email" autocomplete="off"
                           class="form-control bg-transparent"/>
                    <!--end::Email-->
                </div>
                <!--end::Input group=-->
                <div class="fv-row mb-3">
                    <!--begin::Password-->
                    <input type="password" placeholder="Password" id="password" name="password"
                           autocomplete="off"
                           class="form-control bg-transparent"/>
                    <!--end::Password-->
                </div>
                <!--end::Input group=-->
                <!--begin::Submit button-->
                <div class="d-grid mb-10">
                    <button type="submit" id="login-btn" class="btn btn-primary submit-btn">
                        <!--begin::Indicator label-->
                        <span class="indicator-label submit-btn-label">Sign In</span>
                        <!--end::Indicator label-->
                        <!--begin::Indicator progress-->
                        <span class="indicator-progress submitted-processing-label">Please wait...
										<span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                        <!--end::Indicator progress-->
                    </button>
                </div>
                <!--end::Submit button-->
            </form>
            <!--end::Form-->
            <div class="d-flex justify-content-end align-items-end flex-stack flex-wrap gap-3 fs-base fw-semibold mb-8">
                <div></div>
                <!--begin::Link-->
                <a href="{{ env('BASE_URL') . 'auth/forgot-password'}}" class="link-primary">Forgot Password ?</a>
                <!--end::Link-->
            </div>
        </div>
        <!--end::Wrapper-->
        <!--begin::Wrapper-->
        <!--end::Wrapper-->
    </div>
    <!--end::Card-->
</div>
<!--end::Body-->
@endsection

@section('page_scripts')
    <script type="text/javascript">

        $(document).on('click', '#login-btn', function (e) {
            e.preventDefault();
            disable_submit_btn();
            $.ajax({
                url: api_url + 'auth/authenticate',
                method: 'POST',
                data: JSON.stringify(getFormData()),
                dataType: "JSON",
                contentType: "application/json",
                success: function (response) {
                    enable_submit_btn();
                    if (response.status) {
                        Swal.fire({
                            text: "You have successfully logged in!",
                            icon: "success",
                            buttonsStyling: false,
                            confirmButtonText: "Redirecting you now...",
                            customClass: {
                                confirmButton: "btn btn-success"
                            }
                        });
                        window.location = base_url;
                    } else {
                        error_toaster(response.message);
                    }

                }
            });
        });

        function getFormData() {
            return {
                'email': $('#email').val(),
                'password': $('#password').val(),
            }
        }

    </script>
@endsection
