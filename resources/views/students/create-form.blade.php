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
                    <span class="required">Name</span>
                </label>
                <input type="text" class="form-control form-control-solid" placeholder="Enter Name" name="name"
                    id="name" required />
            </div>

            <!-- Email -->
            <div class="col-md-4 fv-row">
                <label class="fs-5 fw-semibold mb-2">
                    <span class="required">Email</span>
                </label>
                <input type="email" class="form-control form-control-solid" placeholder="Enter Email" name="email"
                    id="email" required />
            </div>

            <!-- Phone -->
            <div class="col-md-4 fv-row">
                <label class="fs-5 fw-semibold mb-2">
                    <span class="required">Phone</span>
                </label>
                <input type="text" class="form-control form-control-solid" placeholder="Enter Phone" name="phone"
                    id="phone" required />
            </div>

            <!-- Education -->
            <div class="col-md-4 fv-row">
                <label class="fs-5 fw-semibold mb-2">
                    <span class="">Education</span>
                </label>
                <input type="text" class="form-control form-control-solid" placeholder="Enter Education"
                    name="education" id="education" />
            </div>

            <!-- Date of Birth -->
            <div class="col-md-4 fv-row">
                <label class="fs-5 fw-semibold mb-2">
                    <span class="">Date of Birth</span>
                </label>
                <input type="date" class="form-control form-control-solid" name="dob" id="dob" />
            </div>

            <!-- Admission Date -->
            <div class="col-md-4 fv-row">
                <label class="fs-5 fw-semibold mb-2">
                    <span class="">Admission Date</span>
                </label>
                <input type="date" class="form-control form-control-solid" name="admission_date"
                    id="admission_date" />
            </div>

            <!-- Gender -->
            <div class="col-md-4 fv-row">
                <label class="fs-5 fw-semibold mb-2">
                    <span class="">Gender</span>
                </label>
                <select name="gender" id="gender" class="form-control form-control-solid">
                    <option value="M">Male</option>
                    <option value="F">Female</option>
                </select>
            </div>

            <!-- CNIC -->
            <div class="col-md-4 fv-row">
                <label class="fs-5 fw-semibold mb-2">
                    <span class="">CNIC</span>
                </label>
                <input type="text" class="form-control form-control-solid" placeholder="Enter CNIC" name="cnic"
                    id="cnic" />
            </div>

            <!-- Batch -->
            <div class="col-md-4 fv-row">
                <label class="fs-5 fw-semibold mb-2">
                    <span class="">Batch</span>
                </label>
                <select name="batches[]" id="batches" class="form-control form-control-solid">
                    @foreach ($batches as $batch)
                        <option value="{{ $batch->id }}">{{ $batch->title }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Course -->
            <div class="col-md-4 fv-row">
                <label class="fs-5 fw-semibold mb-2">
                    <span class="required">Courses</span>
                </label>
                <select name="courses[]" id="courses" class="form-control form-control-solid" multiple>
                    @foreach ($courses as $course)
                        <option value="{{ $course->id }}">{{ $course->title }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Address -->
            <div class="col-md-4 fv-row">
                <label class="fs-5 fw-semibold mb-2">
                    <span class="">Address</span>
                </label>
                <input type="text" class="form-control form-control-solid" placeholder="Enter Address" name="address"
                    id="address" />
            </div>

            <!-- City -->
            <div class="col-md-4 fv-row">
                <label class="fs-5 fw-semibold mb-2">
                    <span class="">City</span>
                </label>
                <input type="text" class="form-control form-control-solid" placeholder="Enter City"
                    name="city" id="city" />
            </div>

            <!-- State -->
            <div class="col-md-4 fv-row">
                <label class="fs-5 fw-semibold mb-2">
                    <span class="">State</span>
                </label>
                <input type="text" class="form-control form-control-solid" placeholder="Enter State"
                    name="state" id="state" />
            </div>

           
            <!-- Notes -->
            <div class="col-md-4 fv-row">
                <label class="fs-5 fw-semibold mb-2">
                    <span class="">Notes</span>
                </label>
                <textarea class="form-control form-control-solid" placeholder="Enter Notes" name="notes" id="notes"></textarea>
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
                    <button type="submit" class="btn btn-primary submit-btn" id="student-save-btn">
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
        $(document).on('click', '#student-save-btn', function(e) {
            e.preventDefault();
            do_post_ajax({
                'api_hook': 'students/store',
                'data': getFormData(),
            });
        });

        $(document).ready(function() {
        $('#courses').select2({
            placeholder: 'Select courses',
            allowClear: true
        });
    });
        function getFormData() {
            return {
                'name': $('#name').val(),
                'email': $('#email').val(),
                'phone': $('#phone').val(),
                'education': $('#education').val(),
                'dob': $('#dob').val(),
                'admission_date': $('#admission_date').val(),
                'gender': $('#gender').val(),
                'cnic': $('#cnic').val(),
                'batches': $('#batches').val(),
                'address': $('#address').val(),
                'city': $('#city').val(),
                'state': $('#state').val(),
                'notes': $('#notes').val(),
                'courses': $('#courses').val(),
            }
        }
    </script>
@endsection
