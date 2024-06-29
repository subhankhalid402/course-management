<!--begin::Form-->
<form action="#" class="form mb-15" method="post">
    <!--begin::Row-->
    <div class="row g-3 mb-8">
        <!--begin::Col-->
        <!--end::Col-->
        <!--begin::Col-->
        <!-- Student Information -->
        <div class="row g-3 mb-8">
            <!-- Name -->
            <div class="col-md-4 fv-row">
                <label class="fs-5 fw-semibold mb-2">
                    <span class="required">Title</span>
                </label>
                <input type="text" class="form-control form-control-solid" placeholder="Enter Title" name="title"
                    id="title" required />
            </div>

        </div>
        <!--begin::Submit-->
        <div class="separator border-light my-10"></div>

        <div class="row">
            <div class="col-12">
                <!--begin::Actions-->
                <div class="text-center">
                    <button type="reset" id="reset_form" class="btn btn-light me-3">Reset
                    </button>
                    <button type="submit" class="btn btn-primary submit-btn" id="batch-save-btn">
                        <span class="indicator-label submit-btn-label">Submit</span>
                        <span class="indicator-progress  submitted-processing-label">Please wait...
                            <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                        </span>
                    </button>
                </div>
                <!--end::Actions-->
            </div>
        </div>
        <!--end::Submit-->
</form>
<!--end::Form-->

@section('create_form_js')
    <script type="text/javascript">
        $(document).on('click', '#batch-save-btn', function(e) {
            e.preventDefault();
            do_post_ajax({
                'api_hook': 'batches/store',
                'data': getFormData(),
            });
        });
        function getFormData() {
            return {
                'title': $('#title').val(),
            }
        }
    </script>
@endsection
