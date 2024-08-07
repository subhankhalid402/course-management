<!--begin::Form-->
<form action="#" class="form mb-15" method="post">
    <!--begin::Row-->
    <div class="row g-3 mb-8">
        <!--begin::Col-->
        <div class="col-md-4 fv-row">
            <label class="fs-5 fw-semibold mb-2">
                <span class="required">Name</span>
            </label>
            <input type="text" class="form-control form-control-solid"
                   placeholder="Enter office name" name="name" id="name"/>
        </div>
        <!--end::Col-->

        <!--begin::Col-->
        <div class="col-md-4 fv-row">
            <label class="fs-5 fw-semibold mb-2">
                Phone
            </label>
            <input type="text" class="form-control form-control-solid"
                   placeholder="Enter Office phone" name="phone" id="phone"/>
        </div>
        <!--end::Col-->
        <!--begin::Col-->
        <div class="col-md-4 fv-row">
            <label class="fs-5 fw-semibold mb-2">
                Phone (Cell)
            </label>
            <input type="text" class="form-control form-control-solid"
                   placeholder="Enter Owner phone" name="cell" id="cell"/>
        </div>
        <!--end::Col-->

    </div>
    <!--end::Row-->

    <!--begin::Row-->
    <div class="row g-3 mb-8">
        <!--begin::Col-->
        <div class="col-md-4 fv-row">
            <label class="fs-5 fw-semibold mb-2">
                <span class="required">Owner Name</span>
            </label>
            <input type="text" class="form-control form-control-solid"
                   placeholder="Enter Owner name" name="owner_name" id="owner_name"/>
        </div>
        <!--end::Col-->
        <div class="col-md-4 fv-row">
            <label class="fs-5 fw-semibold mb-2">
                <span class="required">Email</span>
                <span class="ms-1" data-bs-toggle="tooltip"
                      title="Email must be unique and valid">
                    <i class="ki-duotone ki-information-5 text-gray-500 fs-6">
                        <span class="path1"></span>
                        <span class="path2"></span>
                        <span class="path3"></span>
                    </i>
                </span>
            </label>
            <input type="email" class="form-control form-control-solid"
                   placeholder="Email" name="email" id="email"/>
        </div>

        <!--begin::Col-->
        <div class="col-md-4 fv-row">
            <label class="fs-5 fw-semibold mb-2">
                <span class="required">Password</span>
                <span class="ms-1" data-bs-toggle="tooltip"
                      title="Password must be atleast 6 characters">
                    <i class="ki-duotone ki-information-5 text-gray-500 fs-6">
                        <span class="path1"></span>
                        <span class="path2"></span>
                        <span class="path3"></span>
                    </i>
                </span>
            </label>
            <input type="password" class="form-control form-control-solid"
                   placeholder="Enter Password" name="password" id="password"/>
        </div>
        <!--end::Col-->

        <!--begin::Col-->
        <div class="col-md-8 fv-row">
            <label class="fs-5 fw-semibold mb-2">
                Address
            </label>
            <input type="text" class="form-control form-control-solid"
                   placeholder="Enter office address" name="address" id="address"/>
        </div>
        <!--end::Col-->

        <!--begin::Col-->
        <div class="col-md-4 fv-row">
            <label class="required fs-6 fw-semibold mb-2">Country</label>
            <select data-control="select2"
                    data-placeholder="Select a country..."
                    class="form-select form-select-solid" name="country_id" id="country_id">
                <option value="">Select a country...</option>
            @foreach($countries as $country)
                    <option value="{{ $country->id }}">{{ $country->nice_name }}</option>
                @endforeach
            </select>
        </div>
        <!--end::Col-->
    </div>
    <!--end::Row-->

    <!--begin::Row-->
    <div class="row g-3 mb-8">
        <!--begin::Col-->
        <div class="col-md-12 fv-row">
            <label class="fs-5 fw-semibold mb-2">
                Notes
            </label>
            <textarea class="form-control form-control-solid" rows="6"
                      name="notes" id="notes"
                      placeholder="Type any additional information here..."></textarea>
        </div>
        <!--end::Col-->
    </div>
    <!--end::Row-->

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
                        class="btn btn-primary submit-btn" id="office-save-btn">
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
        $(document).on('click', '#office-save-btn', function (e) {
            e.preventDefault();
            do_post_ajax({
                'api_hook': 'offices/store',
                'data': getFormData(),
            });
        });

        function getFormData() {
            return {
                'name': $('#name').val(),
                'owner_name': $('#owner_name').val(),
                'email': $('#email').val(),
                'password': $('#password').val(),
                'phone': $('#phone').val(),
                'cell': $('#cell').val(),
                'address': $('#address').val(),
                'country_id': $('#country_id').val(),
                'notes': $('#notes').val(),
            }
        }
    </script>
@endsection
