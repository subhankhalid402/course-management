    <!--begin::Form-->
    <form action="#" class="form mb-15" method="post">
        <!--begin::Row-->
        <div class="row g-3 mb-8">
            <!--begin::Col-->
            <!--end::Col-->
            <!--begin::Col-->
            <!-- Student Information -->
            <div class="row g-3 mb-8">
                <!-- Amount -->
                <div class="col-md-4 fv-row">
                    <label class="fs-5 fw-semibold mb-2">
                        <span class="required">Amount</span>
                    </label>
                    <input type="number" step="0.01" class="form-control form-control-solid"
                        placeholder="Enter Amount" name="amount" id="amount" required />
                </div>

                <!-- Status -->
                <div class="col-md-4 fv-row">
                    <label class="fs-5 fw-semibold mb-2">
                        <span class="required">Status</span>
                    </label>
                    <select name="status" id="status" class="form-control form-control-solid" required>
                        <option value="paid">Paid</option>
                        <option value="pending">Pending</option>
                    </select>
                </div>

                <!-- Payment Method -->
                <div class="col-md-4 fv-row">
                    <label class="fs-5 fw-semibold mb-2">
                        <span class="required">Payment Method</span>
                    </label>
                    <select name="payment_method" id="payment_method" class="form-control form-control-solid" required>
                        <option value="cash">Cash</option>
                        <option value="easypaisa">EasyPaisa</option>
                        <option value="jazzcash">JazzCash</option>
                        <option value="banktransfer">Bank Transfer</option>
                    </select>
                </div>

                <!-- Paid By -->
                <div class="col-md-4 fv-row">
                    <label class="fs-5 fw-semibold mb-2">
                        <span class="">Paid By</span>
                    </label>
                    <input type="text" class="form-control form-control-solid" placeholder="Enter Paid By"
                        name="paid_by" id="paid_by" />
                </div>

                <!-- Attachments -->
                <div class="col-md-4 fv-row">
                    <label class="fs-5 fw-semibold mb-2">
                        <span class="">Attachments</span>
                    </label>
                    <input type="file" class="form-control form-control-solid" name="file" id="file" />
                </div>

                <!-- Submit Button -->
                <div class="col-12">
                    <div class="text-center">
                        <button type="reset" id="reset_form" class="btn btn-light me-3">Reset</button>
                        <button type="submit" class="btn btn-primary submit-btn" id="payment-save-btn">
                            <span class="indicator-label submit-btn-label">Submit</span>
                            <span class="indicator-progress submitted-processing-label">Please wait...
                                <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                            </span>
                        </button>
                    </div>
                </div>
            </div>
    </form>
    <!--end::Form-->
    @section('page_level_scripts')
        <script type="text/javascript">
            $(document).on('click', '#payment-save-btn', function(e) {
                e.preventDefault();
                do_post_ajax({
                    'api_hook': 'payments/store',
                    'data': getFormData(),
                });
            });

            function getFormData() {
                return {
                    'amount': $('#amount').val(),
                    'student_id': "{{ request()->student_id }}",
                    'status': $('#status').val(),
                    'payment_method': $('#payment_method').val(),
                    'paid_by': $('#paid_by').val(),
                    'file' : $('#file').val(),
                };
            }
        </script>
    @endsection
