@extends('layout.master')
@section('page_title','Terms and Conditions')
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
                {{--                    <a href="{{env('BASE_URL').'terms-and-conditions'}}" class="btn btn-sm fw-bold btn-primary">--}}
                {{--                        <i class="bi bi-list-check"></i>--}}
                {{--                        Dogs List--}}
                {{--                    </a>--}}
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

                                        <!--begin::Row-->
                                        <div class="row mb-8">
                                            <div class="col-12">
                                                <!--begin::Label-->
                                                <label class="form-label"></label>
                                                <!--end::Label-->
                                                <!--begin::Editor-->
                                                <div name="description" id="description"
                                                     class="min-h-200px max-h-300px mb-2 description">{!! $terms->description ?? "" !!}</div>
                                                <!--end::Editor-->
                                                <!--begin::Description-->
                                            {{--                                                <div class="text-muted fs-7">Set a description to the category for--}}
                                            {{--                                                    better visibility.--}}
                                            {{--                                                </div>--}}
                                            <!--end::Description-->
                                            </div>
                                        </div>
                                        <!--end::Row-->

                                        <!--begin::Submit-->
                                        <div class="separator border-light my-10"></div>

                                        <div class="row">
                                            <div class="col-12">
                                                <!--begin::Actions-->
                                                <input type="hidden" id="id" value="{{ $terms->id ?? "" }}">
                                                <div class="text-center">
                                                    {{--                                                        <button type="reset" id="reset_form"--}}
                                                    {{--                                                                class="btn btn-light me-3">Reset--}}
                                                    {{--                                                        </button>--}}
                                                    <button type="submit"
                                                            class="btn btn-primary submit-btn" id="terms-save-btn">
                                                        <span class="indicator-label submit-btn-label">Update</span>
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
        $(document).on('click', '#terms-save-btn', function (e) {
            e.preventDefault();
            do_post_ajax({
                'api_hook': 'support/terms-and-conditions/update',
                'data': getTermsFormData(),
            });
        });

        var quill;
        $(document).ready(function () {
            // Initialize Quill with additional functionalities
            quill = new Quill('#description', {
                modules: {
                    toolbar: [
                        [{header: [1, 2, false]}],
                        ['bold', 'italic', 'underline'],
                        ['image', 'code-block'],
                        [{'list': 'ordered'}, {'list': 'bullet'}],
                        [{'script': 'sub'}, {'script': 'super'}],
                        [{'indent': '-1'}, {'indent': '+1'}],
                        ['link', 'blockquote', 'code-block', 'video'],
                        [{'color': []}, {'background': []}],
                        [{'align': []}],
                        ['clean']
                    ]
                },
                placeholder: 'Type your text here...',
                theme: 'snow' // or 'bubble'
            });

        });

        function getTermsFormData() {
            // Retrieve the content
            var content = quill.root.innerHTML;

            return {
                'id': $('#id').val(),
                'description': $('#description').html(),
            }
        }
    </script>
@endsection
