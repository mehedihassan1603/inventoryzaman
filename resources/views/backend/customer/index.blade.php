@extends('backend.layout.main') @section('content')
@if(session()->has('create_message'))
    <div class="alert alert-success alert-dismissible text-center"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>{!! session()->get('create_message') !!}</div>
@endif
@if(session()->has('edit_message'))
    <div class="alert alert-success alert-dismissible text-center"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>{{ session()->get('edit_message') }}</div>
@endif
@if(session()->has('import_message'))
    <div class="alert alert-success alert-dismissible text-center"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>{!! session()->get('import_message') !!}</div>
@endif
@if(session()->has('not_permitted'))
  <div class="alert alert-danger alert-dismissible text-center"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>{{ session()->get('not_permitted') }}</div>
@endif

<section>
    <div class="container">
        @if(in_array("customers-add", $all_permission))
            <a href="{{route('customer.create')}}" class="btn btn-info"><i class="dripicons-plus"></i> {{trans('Add Customer')}}</a>&nbsp;
            <a href="#" data-toggle="modal" data-target="#importCustomer" class="btn btn-primary"><i class="dripicons-copy"></i> {{trans('Import Customer')}}</a>
        @endif
    </div>
    <div class="table-responsive">
        <table id="customer-table" class="table">
            <thead>
                <tr>
                    <th class="not-exported"></th>
                    <th>{{trans('Company Name')}}</th>
                    <th>{{trans('Group Name')}}</th>
                    <th>{{trans('Area Name')}}</th>
                    <th>{{trans('Contact Person')}}</th>
                    <th>{{trans('Designation')}}</th>
{{--                    <th>{{trans('file.Department')}}</th>--}}
                    <th>{{trans('Mobile')}}</th>
                    @foreach($custom_fields as $fieldName)
                    <th>{{$fieldName}}</th>
                    @endforeach
                    <th class="not-exported">{{trans('file.action')}}</th>
                </tr>
            </thead>
        </table>
    </div>
</section>

<div id="importCustomer" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
    <div role="document" class="modal-dialog">
      <div class="modal-content">
        {!! Form::open(['route' => 'customer.import', 'method' => 'post', 'files' => true]) !!}
        <div class="modal-header">
          <h5 id="exampleModalLabel" class="modal-title">{{trans('file.Import Customer')}}</h5>
          <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true"><i class="dripicons-cross"></i></span></button>
        </div>
        <div class="modal-body">
          <p class="italic"><small>{{trans('file.The field labels marked with * are required input fields')}}.</small></p>
           <p>{{trans('file.The correct column order is')}} (customer_group*, name*, company_name, email, phone_number*, address*, city*, state, postal_code, country) {{trans('file.and you must follow this')}}.</p>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>{{trans('file.Upload CSV File')}} *</label>
                        {{Form::file('file', array('class' => 'form-control','required'))}}
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label> {{trans('file.Sample File')}}</label>
                        <a href="sample_file/sample_customer.csv" class="btn btn-info btn-block btn-md"><i class="dripicons-download"></i>  {{trans('file.Download')}}</a>
                    </div>
                </div>
            </div>
            <input type="submit" value="{{trans('file.submit')}}" class="btn btn-primary" id="submit-button">
        </div>
        {!! Form::close() !!}
      </div>
    </div>
</div>

<div id="clearDueModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
    <div role="document" class="modal-dialog">
      <div class="modal-content">
        {!! Form::open(['route' => 'customer.clearDue', 'method' => 'post']) !!}
        <div class="modal-header">
          <h5 id="exampleModalLabel" class="modal-title">{{trans('file.Clear Due')}}</h5>
          <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true"><i class="dripicons-cross"></i></span></button>
        </div>
        <div class="modal-body">
          <p class="italic"><small>{{trans('file.The field labels marked with * are required input fields')}}.</small></p>
            <div class="form-group">
                <input type="hidden" name="customer_id">
                <label>{{trans('file.Amount')}} *</label>
                <input type="number" name="amount" step="any" class="form-control" required>
            </div>
            <div class="form-group">
                <label>{{trans('file.Note')}}</label>
                <textarea name="note" rows="4" class="form-control"></textarea>
            </div>
            <input type="submit" value="{{trans('file.submit')}}" class="btn btn-primary" id="submit-button">
        </div>
        {!! Form::close() !!}
      </div>
    </div>
</div>

<div id="depositModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
    <div role="document" class="modal-dialog">
      <div class="modal-content">
        {!! Form::open(['route' => 'customer.addDeposit', 'method' => 'post']) !!}
        <div class="modal-header">
          <h5 id="exampleModalLabel" class="modal-title">{{trans('file.Add Deposit')}}</h5>
          <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true"><i class="dripicons-cross"></i></span></button>
        </div>
        <div class="modal-body">
          <p class="italic"><small>{{trans('file.The field labels marked with * are required input fields')}}.</small></p>
            <div class="form-group">
                <input type="hidden" name="customer_id">
                <label>{{trans('file.Amount')}} *</label>
                <input type="number" name="amount" step="any" class="form-control" required>
            </div>
            <div class="form-group">
                <label>{{trans('file.Note')}}</label>
                <textarea name="note" rows="4" class="form-control"></textarea>
            </div>
            <input type="submit" value="{{trans('file.submit')}}" class="btn btn-primary" id="submit-button">
        </div>
        {!! Form::close() !!}
      </div>
    </div>
</div>

<div id="view-deposit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
    <div role="document" class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 id="exampleModalLabel" class="modal-title">{{trans('file.All Deposit')}}</h5>
                <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true"><i class="dripicons-cross"></i></span></button>
            </div>
            <div class="modal-body">
                <table class="table table-hover deposit-list">
                    <thead>
                        <tr>
                            <th>{{trans('file.date')}}</th>
                            <th>{{trans('file.Amount')}}</th>
                            <th>{{trans('file.Note')}}</th>
                            <th>{{trans('file.Created By')}}</th>
                            <th>{{trans('file.action')}}</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div id="edit-deposit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
    <div role="document" class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 id="exampleModalLabel" class="modal-title">{{trans('file.Update Deposit')}}</h5>
                <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true"><i class="dripicons-cross"></i></span></button>
            </div>
            <div class="modal-body">
                {!! Form::open(['route' => 'customer.updateDeposit', 'method' => 'post']) !!}
                    <div class="form-group">
                        <label>{{trans('file.Amount')}} *</label>
                        <input type="number" name="amount" step="any" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>{{trans('file.Note')}}</label>
                        <textarea name="note" rows="4" class="form-control"></textarea>
                    </div>
                    <input type="hidden" name="deposit_id">
                    <button type="submit" class="btn btn-primary">{{trans('file.update')}}</button>
                {{ Form::close() }}
            </div>
        </div>
    </div>
</div>


@endsection

@push('scripts')
<script type="text/javascript">
    $("ul#people").siblings('a').attr('aria-expanded','true');
    $("ul#people").addClass("show");
    $("ul#people #customer-list-menu").addClass("active");

    function confirmDelete() {
      if (confirm("Are you sure want to delete?")) {
          return true;
      }
      return false;
    }

    var customer_id = [];
    var user_verified = <?php echo json_encode(env('USER_VERIFIED')) ?>;
    var all_permission = <?php echo json_encode($all_permission) ?>;

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

  $(document).on("click", ".deposit", function() {
        var id = $(this).data('id').toString();
        $("#depositModal input[name='customer_id']").val(id);
  });

  $(document).on("click", ".clear-due", function() {
        var id = $(this).data('id').toString();
        console.log(id);
        $("#clearDueModal input[name='customer_id']").val(id);
  });

  $(document).on("click", ".getDeposit", function() {
        var id = $(this).data('id').toString();
        $.get('customer/getDeposit/' + id, function(data) {
            $(".deposit-list tbody").remove();
            var newBody = $("<tbody>");
            $.each(data[0], function(index){
                var newRow = $("<tr>");
                var cols = '';

                cols += '<td>' + data[1][index] + '</td>';
                cols += '<td>' + data[2][index] + '</td>';
                if(data[3][index])
                    cols += '<td>' + data[3][index] + '</td>';
                else
                    cols += '<td>N/A</td>';
                cols += '<td>' + data[4][index] + '<br>' + data[5][index] + '</td>';
                cols += '<td><div class="btn-group"><button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{trans("file.action")}}<span class="caret"></span><span class="sr-only">Toggle Dropdown</span></button><ul class="dropdown-menu edit-options dropdown-menu-right dropdown-default" user="menu"><li><button type="button" class="btn btn-link edit-btn" data-id="' + data[0][index] +'" data-toggle="modal" data-target="#edit-deposit"><i class="dripicons-document-edit"></i> {{trans("file.edit")}}</button></li><li class="divider"></li>{{ Form::open(['route' => 'customer.deleteDeposit', 'method' => 'post'] ) }}<li><input type="hidden" name="id" value="' + data[0][index] + '" /> <button type="submit" class="btn btn-link" onclick="return confirmDelete()"><i class="dripicons-trash"></i> {{trans("file.delete")}}</button></li>{{ Form::close() }}</ul></div></td>'
                newRow.append(cols);
                newBody.append(newRow);
                $("table.deposit-list").append(newBody);
            });
            $("#view-deposit").modal('show');
        });
  });

  $(document).on("click", "table.deposit-list .edit-btn", function(event) {
        var id = $(this).data('id');
        var rowindex = $(this).closest('tr').index();
        var amount = $('table.deposit-list tbody tr:nth-child(' + (rowindex + 1) + ')').find('td:nth-child(2)').text();
        var note = $('table.deposit-list tbody tr:nth-child(' + (rowindex + 1) + ')').find('td:nth-child(3)').text();
        if(note == 'N/A')
            note = '';

        $('#edit-deposit input[name="deposit_id"]').val(id);
        $('#edit-deposit input[name="amount"]').val(amount);
        $('#edit-deposit textarea[name="note"]').val(note);
        $('#view-deposit').modal('hide');
    });

    var columns = [{"data": "key"}, {"data": "customer_group"}, {"data": "customer_details"}, {"data": "discount_plan"}, {"data": "reward_point"}, {"data": "deposited_balance"}, {"data": "total_due"}];
    var field_name = <?php echo json_encode($field_name) ?>;
    for(i = 0; i < field_name.length; i++) {
        columns.push({"data": field_name[i]});
    }
    columns.push({"data": "options"});

    $('#customer-table').DataTable( {
        "processing": true,
        "serverSide": true,
        "ajax":{
            url:"customers/customer-data",
            data:{
                all_permission: all_permission,
            },
            dataType: "json",
            type:"post"
        },
        // "createdRow": function( row, data, dataIndex ) {
        //     console.log(data);
        // },
        "columns": columns,
        'language': {

            'lengthMenu': '_MENU_ {{trans("file.records per page")}}',
             "info":      '<small>{{trans("file.Showing")}} _START_ - _END_ (_TOTAL_)</small>',
            "search":  '{{trans("file.Search")}}',
            'paginate': {
                    'previous': '<i class="dripicons-chevron-left"></i>',
                    'next': '<i class="dripicons-chevron-right"></i>'
            }
        },
        order:[['1', 'desc']],
        'columnDefs': [
            {
                "orderable": false,
                'targets': [0, 2, 3, 4, 5, 6, 7 ]
            },
            {
                'render': function(data, type, row, meta){
                    if(type === 'display'){
                        data = '<div class="checkbox"><input type="checkbox" class="dt-checkboxes"><label></label></div>';
                    }

                   return data;
                },
                'checkboxes': {
                   'selectRow': true,
                   'selectAllRender': '<div class="checkbox"><input type="checkbox" class="dt-checkboxes"><label></label></div>'
                },
                'targets': [0]
            }
        ],
        'select': { style: 'multi',  selector: 'td:first-child'},
        'lengthMenu': [[10, 25, 50, -1], [10, 25, 50, "All"]],
        dom: '<"row"lfB>rtip',
        rowId: 'ObjectID',
        buttons: [
            {
                extend: 'pdf',
                text: '<i title="export to pdf" class="fa fa-file-pdf-o"></i>',
                exportOptions: {
                    columns: ':visible:Not(.not-exported)',
                    rows: ':visible'
                }
            },
            {
                extend: 'excel',
                text: '<i title="export to excel" class="dripicons-document-new"></i>',
                exportOptions: {
                    columns: ':visible:Not(.not-exported)',
                    rows: ':visible'
                }
            },
            {
                extend: 'csv',
                text: '<i title="export to csv" class="fa fa-file-text-o"></i>',
                exportOptions: {
                    columns: ':visible:Not(.not-exported)',
                    rows: ':visible'
                }
            },
            {
                extend: 'print',
                text: '<i title="print" class="fa fa-print"></i>',
                exportOptions: {
                    columns: ':visible:Not(.not-exported)',
                    rows: ':visible'
                }
            },
            {
                text: '<i title="delete" class="dripicons-cross"></i>',
                className: 'buttons-delete',
                action: function ( e, dt, node, config ) {
                    if(user_verified == '1') {
                        customer_id.length = 0;
                        $(':checkbox:checked').each(function(i){
                            if(i){
                                customer_id[i-1] = $(this).closest('tr').data('id');
                            }
                        });
                        if(customer_id.length && confirm("Are you sure want to delete?")) {
                            $.ajax({
                                type:'POST',
                                url:'customer/deletebyselection',
                                data:{
                                    customerIdArray: customer_id
                                },
                                success:function(data){
                                    alert(data);
                                }
                            });
                            dt.rows({ page: 'current', selected: true }).remove().draw(false);
                        }
                        else if(!customer_id.length)
                            alert('No customer is selected!');
                    }
                    else
                        alert('This feature is disable for demo!');
                }
            },
            {
                extend: 'colvis',
                text: '<i title="column visibility" class="fa fa-eye"></i>',
                columns: ':gt(0)'
            },
        ]
    } );

  $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

  if(all_permission.indexOf("customers-delete") == -1)
        $('.buttons-delete').addClass('d-none');
</script>
@endpush
