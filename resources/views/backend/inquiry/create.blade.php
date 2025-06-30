<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Inquiry Form</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

</head>
<body>

<section class="py-5">
    <button class="btn btn-info">
        <a href="{{route('inquiries.index')}}">Back</a>
    </button>
    <div class="container">
        <form action="{{ route('inquiries.store') }}" method="POST">
            @csrf
            <div class="row">

                <!-- Date Field -->
                <div class="col-md-6 mb-3">
                    <label>Date <span class="text-danger">*</span></label>
                    <input type="date" name="date" class="form-control" value="{{ date('Y-m-d') }}" required>
                </div>

                <!-- Area Dropdown -->
                {{--<div class="col-md-6 mb-3">
                    <label>Area <span class="text-danger">*</span></label>
                    <select name="area" id="area" class="form-control" required>
                        <option value="">Select Area</option>
                        @foreach($areas as $area)
                            <option value="{{ $area }}">{{ $area }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Group Name Dropdown -->
                <div class="col-md-6 mb-3">
                    <label>Group Name <span class="text-danger">*</span></label>
                    <select name="group_name" id="group_name" class="form-control" required>
                        <option value="">Select Group Name</option>
                    </select>
                </div>--}}

                <!-- Company Name Dropdown -->
                <div class="col-md-6 mb-3">
                    <label>Company Name <span class="text-danger">*</span></label>
                    <select name="company_name" id="company_name" class="form-control" required>
                        <option value=" " selected disabled>Select Company Name</option>
                        @foreach($companies as $company)
                        <option value="{{ $company->id }}">{{ $company->name }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Contact Person Dropdown -->
                <div class="col-md-6 mb-3">
                    <label>Contact Person <span class="text-danger">*</span></label>
                    <select name="customer_id" id="contact_person" class="form-control" required>
                        <option value="">Select Contact Person</option>
                    </select>
                    <input type="hidden" name="contact_person" id="contact_person_name">
                </div>


{{--
                <!-- Designation -->
                <div class="col-md-6 mb-3">
                    <label>Designation</label>
                    <input type="text" name="designation" class="form-control">
                </div>

                <!-- Contact Number -->
                <div class="col-md-6 mb-3">
                    <label>Contact Number <span class="text-danger">*</span></label>
                    <input type="number" name="contact_number" class="form-control" required>
                </div>

                <!-- Email -->
                <div class="col-md-6 mb-3">
                    <label>Email</label>
                    <input type="email" name="email" class="form-control">
                </div>

                <!-- Head Office -->
                <div class="col-md-6 mb-3">
                    <label>Head Office</label>
                    <input type="text" name="head_office" class="form-control">
                </div>

                <!-- Factory -->
                <div class="col-md-6 mb-3">
                    <label>Factory</label>
                    <input type="text" name="factory" class="form-control">
                </div>--}}

                <!-- Requirement -->
                <div class="col-md-6 mb-3">
                    <label>Requirement (Select Products)</label>
                    <select name="requirement[]" class="form-control select2" multiple required>
                        @foreach($products as $product)
                            <option value="{{ $product->name }}({{ $product->code }})">
                                {{ $product->name }} ({{ $product->code }})
                            </option>
                        @endforeach
                    </select>
                    <small class="text-muted">You can select multiple products</small>
                </div>

                 <!-- Reffered By -->
                <div class="col-md-6 mb-3">
                    <div class="form-group">
                        <label>Reffered By</strong> </label>
                        <input type="text" name="reffer" class="form-control" id="reffer" aria-describedby="reffer">
                        <span class="validation-msg" id="reffer-error"></span>
                    </div>
                </div>
                 <!-- Remark  -->
                 <div class="col-md-6 mb-3">
                    <div class="form-group">
                        <label>Remark</strong> </label>
                        <input type="text" name="remark" class="form-control" id="remark" aria-describedby="remark">
                        <span class="validation-msg" id="remark-error"></span>
                    </div>
                </div>


                <!-- Submit Button -->
                <div class="col-md-12 text-center mt-4">
                    <button type="submit" class="btn btn-primary px-4">Submit</button>
                </div>
            </div>
        </form>
    </div>
</section>

<!-- jQuery and Bootstrap JS CDN -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
    $(document).ready(function() {
        $('.select2').select2({
            placeholder: "Select Products",
            width: '100%'
        });
        $('#area').on('change', function() {
            var area = $(this).val();
            if(area) {
                $.ajax({
                    url: '{{ route("getGroupNames") }}',
                    type: 'GET',
                    data: { area: area },
                    success: function(data) {
                        let $groupSelect = $('#group_name');
                        let $companySelect = $('#company_name');

                        $groupSelect.empty().append('<option value="">Select Group Name</option>');
                        $companySelect.empty().append('<option value="">Select Company Name</option>');

                        $.each(data, function(key, value) {
                            $groupSelect.append('<option value="'+ value +'">'+ value +'</option>');
                        });
                    }
                });
            } else {
                $('#group_name').empty().append('<option value="">Select Group Name</option>');
                $('#company_name').empty().append('<option value="">Select Company Name</option>');
            }
        });

        $('#group_name').on('change', function() {
            var area = $('#area').val();
            var group_name = $(this).val();
            if(area && group_name) {
                $.ajax({
                    url: '{{ route("getCompanyNames") }}',
                    type: 'GET',
                    data: { area: area, group_name: group_name },
                    success: function(data) {
                        $('#company_name').empty().append('<option value="">Select Company Name</option>');
                        $.each(data, function(key, value) {
                            $('#company_name').append('<option value="'+ value +'">'+ value +'</option>');
                        });
                    }
                });
            } else {
                $('#company_name').empty().append('<option value="">Select Company Name</option>');
            }
        });
        $('#company_name').on('change', function() {
    var company = $(this).val();
    if(company) {
        $.ajax({
            url: '{{ route("getContactPerson") }}',
            type: 'GET',
            data: { company_name: company },
            success: function(data) {
                let $personSelect = $('#contact_person');
                $personSelect.empty().append('<option value="">Select Contact Person</option>');

                $.each(data, function(index, person) {
                    let displayText = `${person.name} (${person.phone_number})`;
                    $personSelect.append(`<option value="${person.id}" data-name="${person.name}">${displayText}</option>`);
                });
            }
        });
    } else {
        $('#contact_person').empty().append('<option value="">Select Contact Person</option>');
    }
});

// Set contact person name into hidden field when selected
$('#contact_person').on('change', function () {
    var name = $(this).find(':selected').data('name') || '';
    $('#contact_person_name').val(name);
});




    });
</script>

</body>
</html>
