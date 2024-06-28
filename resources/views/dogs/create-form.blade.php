<!--begin::Form-->
<form action="#" class="form mb-15" method="post">
    <!--begin::Row-->
    <div class="row g-3 mb-8">
        <!--begin::Col-->
        <div class="col-md-4 fv-row">
            <label class="fs-5 fw-semibold mb-2">
                <span class="required">User</span>
            </label>
            <select name="user_id" id="user_id" class="form-control form-control-solid user_id">
                @foreach($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }}</option>
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
                   placeholder="Enter Dog name" name="name" id="name"/>
        </div>
        <!--end::Col-->

        <!--begin::Col-->
        <div class="col-md-4 fv-row">
            <label class="fs-5 fw-semibold mb-2">
                <span class="required">Preference</span>
            </label>
            <select name="preference" id="preference" class="form-control form-control-solid preference">

                <option value="play">Pay</option>
                <option value="missing">Missing</option>
                <option value="adopt">Adopt</option>

            </select>
        </div>
        <!--end::Col-->

        <!--begin::Col-->
        <div class="col-md-4 fv-row">
            <label class="fs-5 fw-semibold mb-2">
                <span class="">Breed</span>
            </label>
            <input type="text" class="form-control form-control-solid breed"
                   placeholder="Enter Breed" name="breed" id="breed"/>
        </div>
        <!--end::Col-->

        <!--begin::Col-->
        <div class="col-md-4 fv-row">
            <label class="fs-5 fw-semibold mb-2">
                <span class="">Gender</span>
            </label>
            <select name="gender" id="" class="form-control form-control-solid gender">

                <option value="male">Male</option>
                <option value="female">FeMale</option>
                <option value="other">Other</option>

            </select>
        </div>
        <!--end::Col-->

        <!--begin::Col-->
        <div class="col-md-4 fv-row">
            <label class="fs-5 fw-semibold mb-2">
                <span class="">Born Year</span>
            </label>
            <input type="number" class="form-control form-control-solid born_year"
                   placeholder="Enter Dog name" name="born_year" id="born_year"/>
        </div>
        <!--end::Col-->

        <!--begin::Col-->
        <div class="col-md-4 fv-row">
            <label class="fs-5 fw-semibold mb-2">
                <span class="">Born Month</span>
            </label>
            <input type="number" class="form-control form-control-solid born_month"
                   placeholder="Enter month" name="born_month" id="born_month"/>
        </div>
        <!--end::Col-->

        <!--begin::Submit-->
        <div class="separator border-light my-10"></div>

        <div class="row">
            <div class="col-12">
                <!--begin::Actions-->
                <div class="text-center">
                    <button type="reset" id="reset_form"
                            class="btn btn-light me-3">Reset
                    </button>
                    <button type="submit"
                            class="btn btn-primary submit-btn" id="dog-save-btn">
                        <span class="indicator-label submit-btn-label">Submit</span>
                        <span class="indicator-progress  submitted-processing-label">Please wait...
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

@section('create_form_js')
    <script type="text/javascript">
        $(document).on('click', '#dog-save-btn', function (e) {
            e.preventDefault();
            do_post_ajax({
                'api_hook': 'dogs/store',
                'data': getFormData(),
            });
        });

        function getFormData() {
            return {
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
