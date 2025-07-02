<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Inquiry Form</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />


{{--    start--}}

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Select2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <style>
        .form-label {
            font-weight: 500;
        }
        .select2-container--default .select2-selection--single {
            height: 38px;
            padding: 6px 12px;
        }
        .select2-container--default .select2-selection--multiple {
            min-height: 38px;
        }
        a.btn-link {
            color: white;
            text-decoration: none;
        }
    </style>

</head>
<body>

{{--<section class="py-5">--}}
{{--    <button class="btn btn-info">--}}
{{--        <a href="{{route('inquiries.index')}}">Back</a>--}}
{{--    </button>--}}
{{--    <div class="container">--}}
{{--        <form action="{{ route('inquiries.store') }}" method="POST">--}}
{{--            @csrf--}}
{{--            <div class="row">--}}

{{--                <!-- Date Field -->--}}
{{--                <div class="col-md-4 mb-3">--}}
{{--                    <label>Date <span class="text-danger">*</span></label>--}}
{{--                    <input type="date" name="date" class="form-control" value="{{ date('Y-m-d') }}" required>--}}
{{--                </div>--}}

{{--                <!-- Company Name Dropdown -->--}}
{{--                <div class="col-md-4 mb-3">--}}
{{--                    <label>Company Name <span class="text-danger">*</span></label>--}}
{{--                    <select name="company_name" id="company_name" class="form-control" required>--}}
{{--                        <option value=" " selected disabled>Select Company Name</option>--}}
{{--                        @foreach($companies as $company)--}}
{{--                        <option value="{{ $company->id }}">{{ $company->name }}</option>--}}
{{--                        @endforeach--}}
{{--                    </select>--}}
{{--                </div>--}}

{{--                <!-- Contact Person Dropdown -->--}}
{{--                <div class="col-md-4 mb-3">--}}
{{--                    <label>Contact Person <span class="text-danger">*</span></label>--}}
{{--                    <select name="customer_id" id="contact_person" class="form-control" required>--}}
{{--                        <option value="">Select Contact Person</option>--}}
{{--                    </select>--}}
{{--                    <input type="hidden" name="contact_person" id="contact_person_name">--}}
{{--                </div>--}}

{{--                <!-- Requirement -->--}}
{{--                <div class="col-md-12 mb-3">--}}
{{--                    <label>Requirement (Select Products)</label>--}}
{{--                    <select name="requirement[]" class="form-control select2" multiple required>--}}
{{--                        @foreach($products as $product)--}}
{{--                            <option value="{{ $product->name }}({{ $product->code }})">--}}
{{--                                {{ $product->name }} ({{ $product->code }})--}}
{{--                            </option>--}}
{{--                        @endforeach--}}
{{--                    </select>--}}
{{--                    <small class="text-muted">You can select multiple products</small>--}}
{{--                </div>--}}

{{--                 <!-- Reffered By -->--}}
{{--                <div class="col-md-6 mb-3">--}}
{{--                    <div class="form-group">--}}
{{--                        <label>Reffered By</strong> </label>--}}
{{--                        <input type="text" name="reffer" class="form-control" id="reffer" aria-describedby="reffer">--}}
{{--                        <span class="validation-msg" id="reffer-error"></span>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                 <!-- Remark  -->--}}
{{--                 <div class="col-md-6 mb-3">--}}
{{--                    <div class="form-group">--}}
{{--                        <label>Remark</strong> </label>--}}
{{--                        <input type="text" name="remark" class="form-control" id="remark" aria-describedby="remark">--}}
{{--                        <span class="validation-msg" id="remark-error"></span>--}}
{{--                    </div>--}}
{{--                </div>--}}


{{--                <!-- Submit Button -->--}}
{{--                <div class="col-md-12 text-center mt-4">--}}
{{--                    <button type="submit" class="btn btn-primary px-4">Submit</button>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </form>--}}
{{--    </div>--}}
{{--</section>--}}
<section class="py-5 bg-light">
    <div class="container">
        <div class="mb-4 d-flex justify-content-between align-items-center">
            <h4 class="mb-0">Add New Inquiry</h4>
            <a href="{{route('inquiries.index')}}" class="btn btn-secondary">Back</a>
        </div>

        <form action="{{ route('inquiries.store') }}" method="POST" class="bg-white p-4 rounded shadow-sm">
            @csrf
            <div class="row g-3">

                <div class="col-md-4">
                    <label class="form-label">Date <span class="text-danger">*</span></label>
                    <input type="date" name="date" class="form-control" value="{{ date('Y-m-d') }}" required>
                </div>

                <div class="col-md-4">
                    <label class="form-label">Company Name <span class="text-danger">*</span></label>
                    <select name="company_name" id="company_name" class="form-control" required>
                        <option value="" selected disabled>Select Company Name</option>
                        @foreach($companies as $company)
                            <option value="{{ $company->id }}">{{ $company->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-4">
                    <label class="form-label">Contact Person <span class="text-danger">*</span></label>
                    <select name="customer_id" id="contact_person" class="form-control" required>
                        <option value="">Select Contact Person</option>
                    </select>
                    <input type="hidden" name="contact_person" id="contact_person_name">
                </div>

                <div class="col-12">
                    <label class="form-label">Requirement (Select Products)</label>
                    <select name="requirement[]" class="form-control select2" multiple required>
                        @foreach($products as $product)
                            <option value="{{ $product->name }}({{ $product->code }})">
                                {{ $product->name }} ({{ $product->code }})
                            </option>
                        @endforeach
                    </select>
                    <small class="text-muted">You can select multiple products</small>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Referred By</label>
                    <input type="text" name="reffer" class="form-control">
                </div>

                <div class="col-md-6">
                    <label class="form-label">Remark</label>
                    <input type="text" name="remark" class="form-control">
                </div>

                <div class="col-12 text-center mt-3">
                    <button type="submit" class="btn btn-primary px-5">Submit Inquiry</button>
                </div>
            </div>
        </form>
    </div>
</section>

{{--<!-- jQuery and Bootstrap JS CDN -->--}}
{{--<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>--}}
{{--<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>--}}
{{--<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>--}}

{{--<script>--}}
{{--    $(document).ready(function() {--}}
{{--        $('.select2').select2({--}}
{{--            placeholder: "Select Products",--}}
{{--            width: '100%'--}}
{{--        });--}}
{{--        $('#area').on('change', function() {--}}
{{--            var area = $(this).val();--}}
{{--            if(area) {--}}
{{--                $.ajax({--}}
{{--                    url: '{{ route("getGroupNames") }}',--}}
{{--                    type: 'GET',--}}
{{--                    data: { area: area },--}}
{{--                    success: function(data) {--}}
{{--                        let $groupSelect = $('#group_name');--}}
{{--                        let $companySelect = $('#company_name');--}}

{{--                        $groupSelect.empty().append('<option value="">Select Group Name</option>');--}}
{{--                        $companySelect.empty().append('<option value="">Select Company Name</option>');--}}

{{--                        $.each(data, function(key, value) {--}}
{{--                            $groupSelect.append('<option value="'+ value +'">'+ value +'</option>');--}}
{{--                        });--}}
{{--                    }--}}
{{--                });--}}
{{--            } else {--}}
{{--                $('#group_name').empty().append('<option value="">Select Group Name</option>');--}}
{{--                $('#company_name').empty().append('<option value="">Select Company Name</option>');--}}
{{--            }--}}
{{--        });--}}

{{--        $('#group_name').on('change', function() {--}}
{{--            var area = $('#area').val();--}}
{{--            var group_name = $(this).val();--}}
{{--            if(area && group_name) {--}}
{{--                $.ajax({--}}
{{--                    url: '{{ route("getCompanyNames") }}',--}}
{{--                    type: 'GET',--}}
{{--                    data: { area: area, group_name: group_name },--}}
{{--                    success: function(data) {--}}
{{--                        $('#company_name').empty().append('<option value="">Select Company Name</option>');--}}
{{--                        $.each(data, function(key, value) {--}}
{{--                            $('#company_name').append('<option value="'+ value +'">'+ value +'</option>');--}}
{{--                        });--}}
{{--                    }--}}
{{--                });--}}
{{--            } else {--}}
{{--                $('#company_name').empty().append('<option value="">Select Company Name</option>');--}}
{{--            }--}}
{{--        });--}}

{{--        // company and customer ajax start--}}
{{--        $('#company_name').on('change', function() {--}}
{{--            var company = $(this).val();--}}
{{--            if(company) {--}}
{{--                $.ajax({--}}
{{--                    url: '{{ route("getContactPerson") }}',--}}
{{--                    type: 'GET',--}}
{{--                    data: { company_name: company },--}}
{{--                    success: function(data) {--}}
{{--                        let $personSelect = $('#contact_person');--}}
{{--                        $personSelect.empty().append('<option value="">Select Contact Person</option>');--}}

{{--                        $.each(data, function(index, person) {--}}
{{--                            let displayText = `${person.name} (${person.phone_number})`;--}}
{{--                            $personSelect.append(`<option value="${person.id}" data-name="${person.name}">${displayText}</option>`);--}}
{{--                        });--}}
{{--                    }--}}
{{--                });--}}
{{--            } else {--}}
{{--                $('#contact_person').empty().append('<option value="">Select Contact Person</option>');--}}
{{--            }--}}
{{--        });--}}

{{--        // Set contact person name into hidden field when selected--}}
{{--        $('#contact_person').on('change', function () {--}}

{{--            var name = $(this).find(':selected').data('name') || '';--}}
{{--            $('#contact_person_name').val(name);--}}

{{--        });--}}
{{--    });--}}
{{--</script>--}}

<!-- jQuery, Bootstrap JS, Select2 -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
    $(document).ready(function () {
        $('.select2').select2({
            placeholder: "Select Products",
            width: '100%'
        });

        $('#company_name').on('change', function () {
            var company = $(this).val();
            if (company) {
                $.ajax({
                    url: '{{ route("getContactPerson") }}',
                    type: 'GET',
                    data: { company_name: company },
                    success: function (data) {
                        let $personSelect = $('#contact_person');
                        $personSelect.empty().append('<option value="" disabled selected >Select Contact Person</option>');
                        $.each(data, function (index, person) {
                            let displayText = `${person.name} (${person.phone_number})`;
                            $personSelect.append(`<option value="${person.id}" data-name="${person.name}">${displayText}</option>`);
                        });
                    }
                });
            } else {
                $('#contact_person').empty().append('<option value="">Select Contact Person</option>');
            }
        });

        $('#contact_person').on('change', function () {
            var name = $(this).find(':selected').data('name') || '';
            $('#contact_person_name').val(name);
        });
    });
</script>

</body>
</html>
