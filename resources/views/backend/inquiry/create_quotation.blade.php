@extends('backend.layout.main') @section('content')
@push('css')
<style>
    @media print {
        .hidden-print {
            display: none !important;
        }
    }
</style>
@endpush
@if(session()->has('not_permitted'))
  <div class="alert alert-danger alert-dismissible text-center"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>{{ session()->get('not_permitted') }}</div>
@endif
@if(session()->has('error'))
  <div class="alert alert-danger alert-dismissible text-center"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>{{ session()->get('error') }}</div>
@endif
<section id="pos-layout" class="forms hidden-print">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex align-items-center">
                        <h4>{{trans('Create Quotation')}}</h4>
                    </div>
                    <div class="card-body">
                        <p class="italic"><small>{{trans('file.The field labels marked with * are required input fields')}}.</small></p>
                        {!! Form::open(['route' => 'quotations.store', 'method' => 'post', 'files' => true, 'class' => 'sale-form']) !!}
                        <div class="row">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-4 d-none">
                                        <div class="form-group">
                                            <label>
                                                {{trans('file.Reference No')}}
                                            </label>
                                            <input type="text" name="reference_no" class="form-control" />
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>{{ trans('Company') }} *</label>
                                            <input type="hidden" name="customer_id_hidden" value="{{ $lims_quotation_data->company_name }}" />
                                            <select required name="company_name" class="selectpicker form-control" data-live-search="true" id="company_id" title="Select Company...">
                                                @foreach($lims_customer_list as $customer)
                                                        <?php $deposit[$customer->company_name] = $customer->deposit - $customer->expense; ?>
                                                    <option value="{{ $customer->company_name }}" {{ $lims_quotation_data->company_name == $customer->company_name ? 'selected' : '' }}>
                                                        {{ $customer->company_name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                    <div class="form-group">
                                        <label>{{trans('file.customer')}} *</label>
                                        <input type="hidden" name="customer_id_hidden" value="{{ $lims_quotation_data->customer_id }}" />
                                        <select required name="customer_id" class="selectpicker form-control" data-live-search="true" id="customer_id" title="Select customer...">
                                            @foreach($lims_customer_list as $customer)
                                            <?php $deposit[$customer->id] = $customer->deposit - $customer->expense; ?>
                                            <option value="{{$customer->id}}">{{$customer->name . ' (' . $customer->phone_number . ')'}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>


                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>{{trans('file.Warehouse')}} *</label>
                                            <input type="hidden" name="warehouse_id_hidden" value="{{$lims_quotation_data->warehouse_id}}" />
                                            <select required id="warehouse_id" name="warehouse_id" class="selectpicker form-control" data-live-search="true" title="Select warehouse...">
                                                @foreach($lims_warehouse_list as $warehouse)
                                                <option value="{{$warehouse->id}}">{{$warehouse->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    {{-- <div class="col-md-4">
                                        <div class="form-group">
                                            <label>{{trans('file.Biller')}} *</label>
                                            <select required name="biller_id" class="selectpicker form-control" data-live-search="true" id="biller-id" title="Select Biller...">
                                                @foreach($lims_biller_list as $biller)
                                                <option value="{{$biller->id}}">{{$biller->name . ' (' . $biller->company_name . ')'}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div> --}}
                                    <div class="col-md-4">
                                    <div class="form-group">
                                        <label>{{ trans('file.Biller') }} *</label>
                                        <input type="text" class="form-control" value="{{ Auth::user()->name }}" readonly>
                                        <input type="hidden" name="biller_id" value="{{ Auth::id() }}">
                                    </div>
                                </div>

                                    <div class="form-group d-none">
                                        <label>{{ trans('file.Supplier') }}</label>
                                        <select name="supplier_id" class="selectpicker form-control" data-live-search="true" id="supplier-id" title="Select Supplier...">
                                            @foreach($lims_supplier_list as $key => $supplier)
                                                <option value="{{ $supplier->id }}" {{ $key == 0 ? 'selected' : '' }}>
                                                    {{ $supplier->name . ' (' . $supplier->company_name . ')' }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>


                                    {{--                                    <div class="col-md-4">--}}
{{--                                        <div class="form-group">--}}
{{--                                            <label>{{trans('file.Supplier')}}</label>--}}
{{--                                            <select name="supplier_id" class="selectpicker form-control" data-live-search="true" id="supplier-id" title="Select Supplier...">--}}
{{--                                                @foreach($lims_supplier_list as $supplier)--}}
{{--                                                <option value="{{$supplier->id}}">{{$supplier->name . ' (' . $supplier->company_name . ')'}}</option>--}}
{{--                                                @endforeach--}}
{{--                                            </select>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
                                </div>
                                <div class="row">
                                    <div class="col-md-12 mt-3">
                                        <label>{{trans('file.Select Product')}}</label>
                                        <div class="search-box input-group">
                                            <button type="button" class="btn btn-secondary btn-lg"><i class="fa fa-barcode"></i></button>
                                            <input type="text" name="product_code_name" id="lims_productcodeSearch" placeholder="Please type product code and select..." class="form-control" />
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-5">
                                    <div class="col-md-12">
                                        <h5>{{trans('file.Order Table')}} *</h5>
                                        <div class="table-responsive mt-3">
                                            <table id="myTable" class="table table-hover order-list">
                                                <thead>
                                                    <tr>
                                                        <th>{{trans('file.name')}}</th>
                                                        <th>{{trans('file.Code')}}</th>
                                                        <th>{{trans('file.Quantity')}}</th>
                                                        <th>{{trans('file.Price')}}</th>
                                                        <th>{{trans('file.Subtotal')}}</th>
                                                        <th><i class="dripicons-trash"></i></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $temp_unit_name = [];
                                                    $temp_unit_operator = [];
                                                    $temp_unit_operation_value = [];

                                                    ?>
                                                    @foreach($products as $product_quotation)
                                                    <tr>
                                                    <?php
                                                        $product_data = $product_quotation;

                                                        $product_price = $product_data->price;

                                                        $unit_name = array();
                                                        $unit_operator = array();
                                                        $unit_operation_value = array();

                                                        if($product_data->type == 'standard'){
                                                            $units = DB::table('units')->where('base_unit', $product_data->unit_id)->orWhere('id', $product_data->unit_id)->get();

                                                            foreach($units as $unit) {
                                                                if($product_quotation->sale_unit_id == $unit->id) {
                                                                    array_unshift($unit_name, $unit->unit_name);
                                                                    array_unshift($unit_operator, $unit->operator);
                                                                    array_unshift($unit_operation_value, $unit->operation_value);
                                                                }
                                                                else {
                                                                    $unit_name[]  = $unit->unit_name;
                                                                    $unit_operator[] = $unit->operator;
                                                                    $unit_operation_value[] = $unit->operation_value;
                                                                }
                                                            }
                                                            if($unit_operator[0] == '*'){
                                                                $product_price = $product_price / $unit_operation_value[0];
                                                            }
                                                            elseif($unit_operator[0] == '/'){
                                                                $product_price = $product_price * $unit_operation_value[0];
                                                            }
                                                        }
                                                        else {
                                                            $unit_name[] = 'n/a'. ',';
                                                            $unit_operator[] = 'n/a'. ',';
                                                            $unit_operation_value[] = 'n/a'. ',';
                                                        }
                                                        $temp_unit_name = $unit_name = implode(",",$unit_name) . ',';
                                                        $temp_unit_operator = $unit_operator = implode(",",$unit_operator) .',';

                                                        $temp_unit_operation_value = $unit_operation_value =  implode(",",$unit_operation_value) . ',';
                                                        // $product_batch_data = \App\Models\ProductBatch::select('batch_no')->find($product_quotation->product_batch_id);
                                                        $product_batch_data = null;
                                                    ?>
                                                        <td>{{$product_data->name}} <button type="button" class="edit-product btn btn-link" data-toggle="modal" data-target="#editModal"> <i class="dripicons-document-edit"></i></button> </td>
                                                        <td>{{$product_data->code}}</td>

                                                        <td><input type="number" class="form-control qty" name="qty[]" value="1" step="any" readonly required/></td>
                                                        <td class="net_unit_price">{{ number_format((float)$product_quotation->price, $general_setting->decimal, '.', '')}} </td>
                                                        <td class="discount d-none">
                                                            {{ number_format((float)($product_quotation->discount ?? 0), $general_setting->decimal, '.', '') }}
                                                        </td>
                                                        <td class="tax d-none">
                                                            {{ number_format((float)($product_quotation->tax ?? 0), $general_setting->decimal, '.', '') }}
                                                        </td>

                                                        <td class="sub-total">{{ number_format((float) 1 * $product_quotation->price, $general_setting->decimal, '.', '')}}</td>
                                                        <td><button type="button" class="ibtnDel btn btn-md btn-danger">{{trans("file.delete")}}</button></td>
                                                        @if($product_batch_data)
                                                        <td>
                                                            <input type="hidden" class="product-batch-id" name="product_batch_id[]" value="{{$product_quotation->product_batch_id}}">
                                                            <input type="hidden" class="form-control batch-no" name="batch_no[]" value="{{$product_batch_data->batch_no}}" required/>
                                                        </td>
                                                        @else
                                                        <td>
                                                            <input type="hidden" class="product-batch-id" name="product_batch_id[]" value="">
                                                            <input type="hidden" class="form-control batch-no" name="batch_no[]" value="" />
                                                        </td>
                                                        @endif
                                                        <input type="hidden" class="product-code" name="product_code[]" value="{{$product_data->code}}"/>
                                                        <input type="hidden" class="product-id" name="product_id[]" value="{{$product_data->id}}"/>
                                                        <input type="hidden" class="product-price" name="net_unit_price[]" value="{{$product_price}}"/>
                                                        <input type="hidden" class="sale-unit" name="sale_unit[]" value="{{$unit_name}}"/>
                                                        <input type="hidden" class="sale-unit-operator" value="{{$unit_operator}}"/>
                                                        <input type="hidden" class="sale-unit-operation-value" value="{{$unit_operation_value}}"/>
                                                        <input type="hidden" class="discount-value" name="discount[]" value="{{ $product_quotation->discount ?? 0 }}" />

                                                        <input type="hidden" class="tax-rate" name="tax_rate[]" value="{{ $product_quotation->tax_rate ?? 0 }}" />

                                                        <input type="hidden" class="tax-name" value="{{ $tax->name ?? 'No Tax' }}" />
                                                        <input type="hidden" class="tax-method" value="{{ $product_data->tax_method ?? 0 }}" />

                                                        <input type="hidden" class="tax-value" name="tax[]" value="{{ number_format((float)($product_quotation->tax ?? 0), $general_setting->decimal, '.', '') }}" />

                                                        <input type="hidden" class="imei-number" name="imei_number[]" />
                                                        <input type="hidden" class="subtotal-value" name="subtotal[]" value="{{$product_quotation->total}}" />
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                                <tfoot class="tfoot active">
                                                    <th colspan="2">{{trans('file.Total')}}</th>
                                                    <th id="total-qty">{{$lims_quotation_data->total_qty}}</th>
                                                    <th colspan="1"></th>
                                                    <th id="total">{{ number_format((float)$lims_quotation_data->total_price, $general_setting->decimal, '.', '')}}</th>
                                                    <th><i class="dripicons-trash"></i></th>
                                                </tfoot>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <input type="hidden" name="total_qty" value="{{$lims_quotation_data->total_qty}}" />
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <input type="hidden" name="total_discount" />
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <input type="hidden" name="total_tax" />
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <input type="hidden" name="total_price" />
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <input type="hidden" name="item" />
                                            <input type="hidden" name="order_tax" />
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <input type="hidden" name="grand_total" />
                                        </div>
                                    </div>
                                </div>

                                <div class="row mt-2">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>{{trans('file.Sale Note')}}</label>
                                            <textarea rows="5" class="form-control" name="sale_note" >{{$lims_quotation_data->note}}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>{{trans('file.Staff Note')}}</label>
                                            <textarea rows="5" class="form-control" name="staff_note"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label><strong>Terms and Conditions</strong></label><br>
                                            @foreach($terms as $term)
                                                <input type="checkbox" id="term_{{ $term->id }}" name="terms[]" value="{{ $term->id }}" class="ml-3">
                                                <label for="term_{{ $term->id }}" class="">{{ $term->name }}</label><br>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group mt-4">
                                    <input type="submit" value="{{trans('file.submit')}}" class="btn btn-primary" id="submit-button">
                                </div>
                            </div>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <table class="table table-bordered table-condensed totals">
             <td><strong>{{trans('file.Items')}}</strong>
                <span class="pull-right" id="item">{{number_format(0, $general_setting->decimal, '.', '')}}</span>
            </td>
            <td><strong>{{trans('file.Total')}}</strong>
                <span class="pull-right" id="subtotal">{{number_format(0, $general_setting->decimal, '.', '')}}</span>
            </td>
            <td><strong>{{trans('file.Order Tax')}}</strong>
                <span class="pull-right" id="order_tax">{{number_format(0, $general_setting->decimal, '.', '')}}</span>
            </td>
            <td><strong>{{trans('file.Order Discount')}}</strong>
                <span class="pull-right" id="order_discount">{{number_format(0, $general_setting->decimal, '.', '')}}</span>
            </td>
            <td><strong>{{trans('file.Shipping Cost')}}</strong>
                <span class="pull-right" id="shipping_cost">{{number_format(0, $general_setting->decimal, '.', '')}}</span>
            </td>
            <td><strong>{{trans('file.grand total')}}</strong>
                <span class="pull-right" id="grand_total">{{number_format(0, $general_setting->decimal, '.', '')}}</span>
            </td>
        </table>
    </div>
    <div id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
        <div role="document" class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 id="modal_header" class="modal-title"></h5>
                    <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true"><i class="dripicons-cross"></i></span></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="row modal-element">
                            <div class="col-md-4 form-group">
                                <label>{{trans('file.Quantity')}}</label>
                                <input type="number" step="any" name="edit_qty" class="form-control">
                            </div>
                            <div class="col-md-4 form-group">
                                <label>{{trans('file.Unit Discount')}}</label>
                                <input type="number" name="edit_discount" class="form-control">
                            </div>
                            <div class="col-md-4 form-group">
                                <label>{{trans('file.Unit Price')}}</label>
                                <input type="number" name="edit_unit_price" class="form-control" step="any">
                            </div>
                            <?php
                                $tax_name_all[] = 'No Tax';
                                $tax_rate_all[] = 0;
                                foreach($lims_tax_list as $tax) {
                                    $tax_name_all[] = $tax->name;
                                    $tax_rate_all[] = $tax->rate;
                                }
                            ?>
                            <div class="col-md-4 form-group">
                                <label>{{trans('file.Tax Rate')}}</label>
                                <select name="edit_tax_rate" class="form-control selectpicker">
                                    @foreach($tax_name_all as $key => $name)
                                    <option value="{{$key}}">{{$name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div id="edit_unit" class="col-md-4 form-group">
                                <label>{{trans('file.Product Unit')}}</label>
                                <select name="edit_unit" class="form-control selectpicker">
                                </select>
                            </div>
                        </div>
                        <button type="button" name="update_btn" class="btn btn-primary">{{trans('file.update')}}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<section id="print-layout">
</section>

@endsection

@push('scripts')
<script type="text/javascript">
    $("#payment").hide();
    $(".card-element").hide();
    $("#gift-card").hide();
    $("#cheque").hide();

    $("ul#sale").siblings('a').attr('aria-expanded','true');
    $("ul#sale").addClass("show");
    $("ul#sale #sale-create-menu").addClass("active");

    var public_key = <?php echo json_encode($lims_pos_setting_data->stripe_public_key) ?>;

    // array data depend on warehouse
    var lims_product_array = [];
    var product_code = [];
    var product_name = [];
    var product_qty = [];
    var product_type = [];
    var product_id = [];
    var product_list = [];
    var qty_list = [];

    // array data with selection
    var product_price = [];
    var product_discount = [];
    var tax_rate = [];
    var tax_name = [];
    var tax_method = [];
    var unit_name = [];
    var unit_operator = [];
    var unit_operation_value = [];
    var is_imei = [];
    var gift_card_amount = [];
    var gift_card_expense = [];

    // temporary array
    var temp_unit_name = [];
    var temp_unit_operator = [];
    var temp_unit_operation_value = [];

    var deposit = <?php echo json_encode($deposit) ?>;
    var rowindex;
    var customer_group_rate;
    var row_product_price;
    var pos;
    var rownumber = $('table.order-list tbody tr:last').index();
    var currency = <?php echo json_encode($currency) ?>;
    var without_stock = <?php echo json_encode($general_setting->without_stock) ?>;

    for(rowindex  =0; rowindex <= rownumber; rowindex++){

        product_price.push(parseFloat($('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ')').find('.product-price').val()));
        var total_discount = parseFloat($('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ')').find('.discount').text());
        var quantity = parseFloat($('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ')').find('.qty').val());
        product_discount.push((total_discount / quantity).toFixed({{$general_setting->decimal}}));
        tax_rate.push(parseFloat($('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ')').find('.tax-rate').val()));
        tax_name.push($('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ')').find('.tax-name').val());
        tax_method.push($('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ')').find('.tax-method').val());
        temp_unit_name = $('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ')').find('.sale-unit').val().split(',');
        unit_name.push($('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ')').find('.sale-unit').val());
        unit_operator.push($('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ')').find('.sale-unit-operator').val());
        unit_operation_value.push($('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ')').find('.sale-unit-operation-value').val());
        $('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ')').find('.sale-unit').val(temp_unit_name[0]);
    }

    $('.selectpicker').selectpicker({
        style: 'btn-link',
    });

    $('[data-toggle="tooltip"]').tooltip();

    //assigning value
    $('select[name="customer_id"]').val($('input[name="customer_id_hidden"]').val());
    $('select[name="warehouse_id"]').val($('input[name="warehouse_id_hidden"]').val());
    $('select[name="biller_id"]').val($('input[name="biller_id_hidden"]').val());

    $('select[name="order_tax_rate"]').val($('input[name="order_tax_rate_hidden"]').val());
    $('.selectpicker').selectpicker('refresh');

    $('#item').text($('input[name="item"]').val() + '(' + $('input[name="total_qty"]').val() + ')');
    $('#subtotal').text(parseFloat($('input[name="total_price"]').val()).toFixed({{$general_setting->decimal}}));
    $('#order_tax').text(parseFloat($('input[name="order_tax"]').val()).toFixed({{$general_setting->decimal}}));
    if(!$('input[name="order_discount_value"]').val())
        $('input[name="order_discount_value"]').val('{{number_format(0, $general_setting->decimal, '.', '')}}');
    $('#order_discount').text(parseFloat($('input[name="order_discount_value"]').val()).toFixed({{$general_setting->decimal}}));
    if(!$('input[name="shipping_cost"]').val())
        $('input[name="shipping_cost"]').val('{{number_format(0, $general_setting->decimal, '.', '')}}');
    $('#shipping_cost').text(parseFloat($('input[name="shipping_cost"]').val()).toFixed({{$general_setting->decimal}}));
    $('#grand_total').text(parseFloat($('input[name="grand_total"]').val()).toFixed({{$general_setting->decimal}}));

    var id = $('select[name="customer_id"]').val();
    $.get('../getcustomergroup/' + id, function(data) {
        customer_group_rate = (data / 100);
    });

    var id = $('select[name="warehouse_id"]').val();
    $.get('../getproduct/' + id, function(data) {
        lims_product_array = [];
        product_code = data[0];
        product_name = data[1];
        product_qty = data[2];
        product_type = data[3];
        product_id = data[4];
        product_list = data[5];
        qty_list = data[6];
        product_warehouse_price = data[7];
        batch_no = data[8];
        product_batch_id = data[9];
        is_embeded = data[11];
            imei_number = data[12];
        $.each(product_code, function(index) {
            // lims_product_array.push(product_code[index] + ' (' + product_name[index] + ')');
            lims_product_array.push(product_code[index]+'|'+product_name[index]+'|'+imei_number[index]+'|'+is_embeded[index]);
        });
    });

    $('select[name="customer_id"]').on('change', function() {
        var id = $(this).val();
        $.get('../getcustomergroup/' + id, function(data) {
            customer_group_rate = (data / 100);
        });
    });

    $('select[name="warehouse_id"]').on('change', function() {
        var id = $(this).val();
        $.get('../getproduct/' + id, function(data) {
            lims_product_array = [];
            product_code = data[0];
            product_name = data[1];
            product_qty = data[2];
            product_type = data[3];
            product_id = data[4];
            product_list = data[5];
            qty_list = data[6];
            product_warehouse_price = data[7];
            batch_no = data[8];
            product_batch_id = data[9];
            is_embeded = data[11];
            imei_number = data[12];
            $.each(product_code, function(index) {
                // lims_product_array.push(product_code[index] + ' (' + product_name[index] + ')');
                lims_product_array.push(product_code[index]+'|'+product_name[index]+'|'+imei_number[index]+'|'+is_embeded[index]);
            });
        });
    });

    $('#lims_productcodeSearch').on('input', function(){
        var customer_id = $('select[name="customer_id"]').val();
        var warehouse_id = $('select[name="warehouse_id"]').val();
        temp_data = $('#lims_productcodeSearch').val();
        if(!customer_id){
            $('#lims_productcodeSearch').val(temp_data.substring(0, temp_data.length - 1));
            alert('Please select Customer!');
        }
        else if(!warehouse_id){
            $('#lims_productcodeSearch').val(temp_data.substring(0, temp_data.length - 1));
            alert('Please select Warehouse!');
        }
    });

    var lims_productcodeSearch = $('#lims_productcodeSearch');

    lims_productcodeSearch.autocomplete({
        source: function(request, response) {
            var matcher = new RegExp(".?" + $.ui.autocomplete.escapeRegex(request.term), "i");
            response($.grep(lims_product_array, function(item) {
                return matcher.test(item);
            }));
        },
        response: function(event, ui) {
            if (ui.content.length == 1) {
                var data = ui.content[0].value;
                $(this).autocomplete( "close" );
                productSearch(data);
            };
        },
        select: function(event, ui) {
            var data = ui.item.value;
            productSearch(data);
        }
    });

    //Change quantity
    $("#myTable").on('input', '.qty', function() {
        rowindex = $(this).closest('tr').index();
        if($(this).val() < 1 && $(this).val() != '') {
          $('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ') .qty').val(1);
          alert("Quantity can't be less than 1");
        }
        checkQuantity($(this).val(), true);
    });

    $("#myTable").on("change", ".batch-no", function () {
        rowindex = $(this).closest('tr').index();
        var product_id = $('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ')').find('.product-id').val();
        var warehouse_id = $('#warehouse_id').val();
        $.get('../../check-batch-availability/' + product_id + '/' + $(this).val() + '/' + warehouse_id, function(data) {
            if(data['message'] != 'ok') {
                alert(data['message']);
                $('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ')').find('.batch-no').val('');
            }
            else {
                $('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ')').find('.product-batch-id').val(data['product_batch_id']);
                code = $('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ')').find('.product-code').val();
                pos = product_code.indexOf(code);
                product_qty[pos] = data['qty'];
            }
        });
    });
    //Delete product
    $("table.order-list tbody").on("click", ".ibtnDel", function(event) {
        rowindex = $(this).closest('tr').index();
        product_price.splice(rowindex, 1);
        product_discount.splice(rowindex, 1);
        tax_rate.splice(rowindex, 1);
        tax_name.splice(rowindex, 1);
        tax_method.splice(rowindex, 1);
        unit_name.splice(rowindex, 1);
        unit_operator.splice(rowindex, 1);
        unit_operation_value.splice(rowindex, 1);
        $(this).closest("tr").remove();
        calculateTotal();
    });

    //Edit product
    $("table.order-list").on("click", ".edit-product", function() {
        rowindex = $(this).closest('tr').index();
        edit();
    });

    //Update product
    $('button[name="update_btn"]').on("click", function() {
        var imeiNumbers = $("#editModal input[name=imei_numbers]").val();
        if(imeiNumbers || is_imei[rowindex]) {
            $('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ')').find('.imei-number').val(imeiNumbers);
        }

        var edit_discount = $('input[name="edit_discount"]').val();
        var edit_qty = $('input[name="edit_qty"]').val();
        var edit_unit_price = $('input[name="edit_unit_price"]').val();

        if (parseFloat(edit_discount) > parseFloat(edit_unit_price)) {
            alert('Invalid Discount Input!');
            return;
        }

        if(edit_qty < 1) {
            $('input[name="edit_qty"]').val(1);
            edit_qty = 1;
            alert("Quantity can't be less than 1");
        }

        var tax_rate_all = <?php echo json_encode($tax_rate_all) ?>;
        tax_rate[rowindex] = parseFloat(tax_rate_all[$('select[name="edit_tax_rate"]').val()]);
        tax_name[rowindex] = $('select[name="edit_tax_rate"] option:selected').text();
        if(product_type[pos] == 'standard'){
            var row_unit_operator = unit_operator[rowindex].slice(0, unit_operator[rowindex].indexOf(","));
            var row_unit_operation_value = unit_operation_value[rowindex].slice(0, unit_operation_value[rowindex].indexOf(","));
            if (row_unit_operator == '*') {
                product_price[rowindex] = $('input[name="edit_unit_price"]').val() / row_unit_operation_value;
            } else {
                product_price[rowindex] = $('input[name="edit_unit_price"]').val() * row_unit_operation_value;
            }
            var position = $('select[name="edit_unit"]').val();
            var temp_operator = temp_unit_operator[position];
            var temp_operation_value = temp_unit_operation_value[position];
            $('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ')').find('.sale-unit').val(temp_unit_name[position]);
            temp_unit_name.splice(position, 1);
            temp_unit_operator.splice(position, 1);
            temp_unit_operation_value.splice(position, 1);

            temp_unit_name.unshift($('select[name="edit_unit"] option:selected').text());
            temp_unit_operator.unshift(temp_operator);
            temp_unit_operation_value.unshift(temp_operation_value);

            unit_name[rowindex] = temp_unit_name.toString() + ',';
            unit_operator[rowindex] = temp_unit_operator.toString() + ',';
            unit_operation_value[rowindex] = temp_unit_operation_value.toString() + ',';
        }
        else {
            product_price[rowindex] = $('input[name="edit_unit_price"]').val();
        }
        product_discount[rowindex] = $('input[name="edit_discount"]').val();
        checkQuantity(edit_qty, false);
    });



    function productSearch(data){
        //
        var product_info = data.split("|");
    var code = product_info[0];
    var pre_qty = 0;
    var flag = true;

    $(".product-code").each(function(i) {
        if ($(this).val() == code) {
            rowindex = i;
            if(product_info[2] != 'null') {
                imeiNumbers = $('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ') .imei-number').val();
                imeiNumbersArray = imeiNumbers.split(",");
                // console.log('arra '+ rowindex);

                if(imeiNumbersArray.includes(product_info[2])) {
                    alert('Same imei or serial number is not allowed!');
                    flag = false;
                    $('#lims_productcodeSearch').val('');
                }
            }
            pre_qty = $('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ') .qty').val();
        }
    });

    if(flag)
    {
        data += '?'+$('#customer_id').val()+'?'+(parseFloat(pre_qty) + 1);

        $.ajax({
            type: 'GET',
            url: '../lims_product_search',
            data: {
                data: data
            },
            success: function(data) {
                var flag = 1;
                if (pre_qty > 0) {
                    var qty = data[15];
                    $('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ') .qty').val(qty);
                    pos = product_code.indexOf(data[1]);
                    if(!data[11] && product_warehouse_price[pos]) {
                        product_price[rowindex] = parseFloat(product_warehouse_price[pos] * currency['exchange_rate']) + parseFloat(product_warehouse_price[pos] * currency['exchange_rate'] * customer_group_rate);
                    }
                    else{
                        product_price[rowindex] = parseFloat(data[2] * currency['exchange_rate']) + parseFloat(data[2] * currency['exchange_rate'] * customer_group_rate);
                    }
                    flag = 0;
                    checkQuantity(String(qty), true);
                    flag = 0;
                }
                $("input[name='product_code_name']").val('');
                if (flag) {
                    var newRow = $("<tr>");
                    var cols = '';
                    temp_unit_name = (data[6]).split(',');
                    // pos = product_code.indexOf(data[1]);
                    cols += '<td>' + data[0] + '<button type="button" class="edit-product btn btn-link" data-toggle="modal" data-target="#editModal"> <i class="dripicons-document-edit"></i></button></td>';
                    cols += '<td>' + data[1] + '</td>';
                    if(data[12]) {
                        cols += '<td><input type="text" class="form-control batch-no" value="'+batch_no[pos]+'" required/> <input type="hidden" class="product-batch-id" name="product_batch_id[]" value="'+product_batch_id[pos]+'"/> </td>';
                    }
                    else {
                        cols += '<td><input type="text" class="form-control batch-no" disabled/> <input type="hidden" class="product-batch-id" name="product_batch_id[]"/> </td>';
                    }
                    cols += '<td><input type="number" class="form-control qty" name="qty[]" value="1" step="any" required/></td>';
                    cols += '<td class="net_unit_price"></td>';
                    cols += '<td class="discount">{{number_format(0, $general_setting->decimal, '.', '')}}</td>';
                    cols += '<td class="tax"></td>';
                    cols += '<td class="sub-total"></td>';
                    cols += '<td><button type="button" class="ibtnDel btn btn-md btn-danger">{{trans("file.delete")}}</button></td>';
                    cols += '<input type="hidden" class="product-code" name="product_code[]" value="' + data[1] + '"/>';
                    cols += '<input type="hidden" class="product-id" name="product_id[]" value="' + data[9] + '"/>';
                    cols += '<input type="hidden" class="sale-unit" name="sale_unit[]" value="' + temp_unit_name[0] + '"/>';
                    cols += '<input type="hidden" class="net_unit_price" name="net_unit_price[]" />';
                    cols += '<input type="hidden" class="discount-value" name="discount[]" />';
                    cols += '<input type="hidden" class="tax-rate" name="tax_rate[]" value="' + data[3] + '"/>';
                    cols += '<input type="hidden" class="tax-value" name="tax[]" />';
                    cols += '<input type="hidden" class="subtotal-value" name="subtotal[]" />';
                    cols += '<input type="hidden" class="imei-number" name="imei_number[]" />';

                    newRow.append(cols);
                    $("table.order-list tbody").prepend(newRow);
                    rowindex = newRow.index();

                    if(!data[11] && product_warehouse_price[pos]) {
                        product_price.splice(rowindex, 0, parseFloat(product_warehouse_price[pos] * currency['exchange_rate']) + parseFloat(product_warehouse_price[pos] * currency['exchange_rate'] * customer_group_rate));
                    }
                    else {
                        product_price.splice(rowindex, 0, parseFloat(data[2] * currency['exchange_rate']) + parseFloat(data[2] * currency['exchange_rate'] * customer_group_rate));
                    }

                    product_discount.splice(rowindex, 0, '{{number_format(0, $general_setting->decimal, '.', '')}}');
                    tax_rate.splice(rowindex, 0, parseFloat(data[3]));
                    tax_name.splice(rowindex, 0, data[4]);
                    tax_method.splice(rowindex, 0, data[5]);
                    unit_name.splice(rowindex, 0, data[6]);
                    unit_operator.splice(rowindex, 0, data[7]);
                    unit_operation_value.splice(rowindex, 0, data[8]);
                    is_imei.splice(rowindex, 0, data[13]);
                    checkQuantity(1, true);
                    if(data[13]) {
                        $('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ')').find('.edit-product').click();
                    }
                }
            }
        });
    }
}

    function edit(){
        $(".imei-section").remove();
        var imeiNumbers = $('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ')').find('.imei-number').val();
        if(imeiNumbers || is_imei[rowindex]) {
            htmlText = '<div class="col-md-12 form-group imei-section"><label>IMEI or Serial Numbers</label><input type="text" name="imei_numbers" value="'+imeiNumbers+'" class="form-control imei_number" placeholder="Type imei or serial numbers and separate them by comma. Example:1001,2001" step="any"></div>';
            $("#editModal .modal-element").append(htmlText);
        }

        var row_product_name = $('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ')').find('td:nth-child(1)').text();
        var row_product_code = $('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ')').find('td:nth-child(2)').text();
        $('#modal_header').text(row_product_name + '(' + row_product_code + ')');

        var qty = $('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ')').find('.qty').val();
        $('input[name="edit_qty"]').val(qty);

        $('input[name="edit_discount"]').val(parseFloat(product_discount[rowindex]).toFixed({{$general_setting->decimal}}));

        var tax_name_all = <?php echo json_encode($tax_name_all) ?>;
        pos = tax_name_all.indexOf(tax_name[rowindex]);
        $('select[name="edit_tax_rate"]').val(pos);

        pos = product_code.indexOf(row_product_code);
        if(product_type[pos] == 'standard'){
            unitConversion();
            temp_unit_name = (unit_name[rowindex]).split(',');
            temp_unit_name.pop();
            temp_unit_operator = (unit_operator[rowindex]).split(',');
            temp_unit_operator.pop();
            temp_unit_operation_value = (unit_operation_value[rowindex]).split(',');
            temp_unit_operation_value.pop();
            $('select[name="edit_unit"]').empty();
            $.each(temp_unit_name, function(key, value) {
                $('select[name="edit_unit"]').append('<option value="' + key + '">' + value + '</option>');
            });
            $("#edit_unit").show();
        }
        else{
            row_product_price = product_price[rowindex];
            $("#edit_unit").hide();
        }
        $('input[name="edit_unit_price"]').val(row_product_price.toFixed({{$general_setting->decimal}}));
        $('.selectpicker').selectpicker('refresh');
    }

    function checkQuantity(sale_qty, flag) {
        var row_product_code = $('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ')').find('td:nth-child(2)').text();
        pos = product_code.indexOf(row_product_code);
        if(without_stock == 'no') {
            if(product_type[pos] == 'standard'){
                var operator = unit_operator[rowindex].split(',');
                var operation_value = unit_operation_value[rowindex].split(',');
                if(operator[0] == '*')
                    total_qty = sale_qty * operation_value[0];
                else if(operator[0] == '/')
                    total_qty = sale_qty / operation_value[0];
                if (total_qty > parseFloat(product_qty[pos])) {
                    alert('Quantity exceeds stock quantity!');
                    if (flag) {
                        sale_qty = sale_qty.substring(0, sale_qty.length - 1);
                        $('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ')').find('.qty').val(sale_qty);
                    }
                    else {
                        edit();
                        return;
                    }
                }
            }
            else if(product_type[pos] == 'combo'){
                child_id = product_list[pos].split(',');
                child_qty = qty_list[pos].split(',');
                $(child_id).each(function(index) {
                    var position = product_id.indexOf(parseInt(child_id[index]));
                    if( parseFloat(sale_qty * child_qty[index]) > product_qty[position] ) {
                        alert('Quantity exceeds stock quantity!');
                        if (flag) {
                            sale_qty = sale_qty.substring(0, sale_qty.length - 1);
                            $('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ')').find('.qty').val(sale_qty);
                        }
                        else {
                            edit();
                            flag = true;
                            return false;
                        }
                    }
                });
            }
        }
        if(!flag){
            $('#editModal').modal('hide');
            $('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ')').find('.qty').val(sale_qty);
        }
        calculateRowProductData(sale_qty);
    }

    function calculateRowProductData(quantity) {
        if(product_type[pos] == 'standard')
            unitConversion();
        else
            row_product_price = product_price[rowindex];

        $('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ')').find('.discount').text((product_discount[rowindex] * quantity).toFixed({{$general_setting->decimal}}));
        $('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ')').find('.discount-value').val((product_discount[rowindex] * quantity).toFixed({{$general_setting->decimal}}));
        $('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ')').find('.tax-rate').val(tax_rate[rowindex].toFixed({{$general_setting->decimal}}));

        if (tax_method[rowindex] == 1) {
            var net_unit_price = row_product_price - product_discount[rowindex];
            var tax = net_unit_price * quantity * (tax_rate[rowindex] / 100);
            var sub_total = (net_unit_price * quantity) + tax;

            $('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ')').find('.net_unit_price').text(net_unit_price.toFixed({{$general_setting->decimal}}));
            $('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ')').find('.net_unit_price').val(net_unit_price.toFixed({{$general_setting->decimal}}));
            $('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ')').find('.tax').text(tax.toFixed({{$general_setting->decimal}}));
            $('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ')').find('.tax-value').val(tax.toFixed({{$general_setting->decimal}}));
            $('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ')').find('.sub-total').text(sub_total.toFixed({{$general_setting->decimal}}));
            $('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ')').find('.subtotal-value').val(sub_total.toFixed({{$general_setting->decimal}}));
        } else {
            var sub_total_unit = row_product_price - product_discount[rowindex];
            var net_unit_price = (100 / (100 + tax_rate[rowindex])) * sub_total_unit;
            var tax = (sub_total_unit - net_unit_price) * quantity;
            var sub_total = sub_total_unit * quantity;

            $('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ')').find('.net_unit_price').text(net_unit_price.toFixed({{$general_setting->decimal}}));
            $('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ')').find('.net_unit_price').val(net_unit_price.toFixed({{$general_setting->decimal}}));
            $('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ')').find('.tax').text(tax.toFixed({{$general_setting->decimal}}));
            $('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ')').find('.tax-value').val(tax.toFixed({{$general_setting->decimal}}));
            $('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ')').find('.sub-total').text(sub_total.toFixed({{$general_setting->decimal}}));
            $('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ')').find('.subtotal-value').val(sub_total.toFixed({{$general_setting->decimal}}));
        }

        calculateTotal();
    }

    function unitConversion() {
        var row_unit_operator = unit_operator[rowindex].slice(0, unit_operator[rowindex].indexOf(","));
        var row_unit_operation_value = unit_operation_value[rowindex].slice(0, unit_operation_value[rowindex].indexOf(","));

        if (row_unit_operator == '*') {
            row_product_price = product_price[rowindex] * row_unit_operation_value;
        } else {
            row_product_price = product_price[rowindex] / row_unit_operation_value;
        }
    }

    function calculateTotal() {
        //Sum of quantity
        var total_qty = 0;
        $(".qty").each(function() {

            if ($(this).val() == '') {
                total_qty += 0;
            } else {
                total_qty += parseFloat($(this).val());
            }
        });
        $("#total-qty").text(total_qty);
        $('input[name="total_qty"]').val(total_qty);

        //Sum of discount
        var total_discount = 0;
        $(".discount").each(function() {
            total_discount += parseFloat($(this).text());
        });
        $("#total-discount").text(total_discount.toFixed({{$general_setting->decimal}}));
        $('input[name="total_discount"]').val(total_discount.toFixed({{$general_setting->decimal}}));

        //Sum of tax
        var total_tax = 0;
        $(".tax").each(function() {
            total_tax += parseFloat($(this).text());
        });
        $("#total-tax").text(total_tax.toFixed({{$general_setting->decimal}}));
        $('input[name="total_tax"]').val(total_tax.toFixed({{$general_setting->decimal}}));

        //Sum of subtotal
        var total = 0;
        $(".sub-total").each(function() {
            total += parseFloat($(this).text());
        });
        $("#total").text(total.toFixed({{$general_setting->decimal}}));
        $('input[name="total_price"]').val(total.toFixed({{$general_setting->decimal}}));

        calculateGrandTotal();
    }

    function calculateGrandTotal() {

        var item = $('table.order-list tbody tr:last').index();
console.log('item',item);
        var total_qty = parseFloat($('#total-qty').text());
        console.log('tq',total_qty);
        var subtotal = parseFloat($('#total').text());
        console.log('st',subtotal);
        // var order_tax = parseFloat($('select[name="order_tax_rate"]').val());
        var order_tax = 0;
        console.log('ot',order_tax);
        // var shipping_cost = parseFloat($('input[name="shipping_cost"]').val());
        var shipping_cost = 0;
        console.log('sc',shipping_cost);
        var order_discount_type = $('select[name="order_discount_type"]').val();
        var order_discount_value = parseFloat($('input[name="order_discount_value"]').val());
        if (!order_discount_value)
            order_discount_value = {{number_format(0, $general_setting->decimal, '.', '')}};

        if(order_discount_type == 'Flat')
            var order_discount = parseFloat(order_discount_value);
        else
            var order_discount = parseFloat(subtotal * (order_discount_value / 100));


        console.log('od',order_discount);
        if (!shipping_cost)
            shipping_cost = {{number_format(0, $general_setting->decimal, '.', '')}};

        item = ++item + '(' + total_qty + ')';
        console.log('tem2',item);
        order_tax = (subtotal - order_discount) * (order_tax / 100);
        console.log('ot2',order_tax);
        var grand_total = (subtotal + order_tax + shipping_cost) - order_discount;
        console.log(grand_total);

        $('input[name="order_discount"]').val(order_discount);
        $('#item').text(item);
        $('input[name="item"]').val($('table.order-list tbody tr:last').index() + 1);
        $('#subtotal').text(subtotal.toFixed({{$general_setting->decimal}}));
        $('#order_tax').text(order_tax.toFixed({{$general_setting->decimal}}));
        $('input[name="order_tax"]').val(order_tax.toFixed({{$general_setting->decimal}}));
        $('#order_discount').text(order_discount.toFixed({{$general_setting->decimal}}));
        $('#shipping_cost').text(shipping_cost.toFixed({{$general_setting->decimal}}));
        $('#grand_total').text(grand_total.toFixed({{$general_setting->decimal}}));
        if( $('select[name="payment_status"]').val() == 4 ){
            $('#paying-amount').val('');
            $('#paid-amount').val(grand_total.toFixed({{$general_setting->decimal}}));
        }
        $('input[name="grand_total"]').val(grand_total.toFixed({{$general_setting->decimal}}));
    }

    $('select[name="order_discount_type"]').on("change", function() {
        calculateGrandTotal();
    });

    $('input[name="order_discount_value"]').on("input", function() {
        calculateGrandTotal();
    });

    $('input[name="shipping_cost"]').on("input", function() {
        calculateGrandTotal();
    });

    $('select[name="order_tax_rate"]').on("change", function() {
        calculateGrandTotal();
    });

    $(window).keydown(function(e){
        if (e.which == 13) {
            var $targ = $(e.target);
            if (!$targ.is("textarea") && !$targ.is(":button,:submit")) {
                var focusNext = false;
                $(this).find(":input:visible:not([disabled],[readonly]), a").each(function(){
                    if (this === e.target) {
                        focusNext = true;
                    }
                    else if (focusNext){
                        $(this).focus();
                        return false;
                    }
                });
                return false;
            }
        }
    });

    $(document).on('submit', '.sale-form', function(e) {
        var rownumber = $('table.order-list tbody tr:last').index();
        if ( rownumber < 0 ) {
            alert("Please insert product to order table!")
            e.preventDefault();
        }
        else if(parseFloat($('input[name="total_qty"]').val()) <= 0) {
            alert('Product quantity is 0');
            e.preventDefault();
        }
        else if( parseFloat($("#paying-amount").val()) < parseFloat($("#paid-amount").val()) ){
            alert('Paying amount cannot be bigger than recieved amount');
            e.preventDefault();
        }
        else if( $('select[name="payment_status"]').val() == 3 && parseFloat($("#paid-amount").val()) == parseFloat($('input[name="grand_total"]').val()) ) {
            alert('Paying amount equals to grand total! Please change payment status.');
            e.preventDefault();
        }
        // else if(!$('#biller_id').val()) {
        //     alert('Please select a biller');
        //     e.preventDefault();
        // }
        else {
            $("#submit-button").prop('disabled', true);
            $("#paid-amount").prop('disabled',false);
            $(".batch-no").prop('disabled', false);

            e.preventDefault(); // Prevents the default form submission behavior
            $.ajax({
                url: $('.sale-form').attr('action'),
                type: $('.sale-form').attr('method'),
                data: $('.sale-form').serialize(),
                success: function(response) {
                    console.log(response);

                    if (response.payment_method === 'pesapal' && response.redirect_url) {
                        // Redirect to the URL returned for Pesapal payment method
                        location.href = response.redirect_url;
                    } else if ($('select[name="sale_status"]').val() == 1 && response !== 'pesapal') {
                        let link = "{{url('sales/gen_invoice/')}}" + '/' + response;
                        $('#print-layout').load(link, function() {
                            setTimeout(function() {
                                window.print();
                            }, 50);
                        });

                        $("#submit-button").prop('disabled', false);
                        $('#add-payment').modal('hide');
                        //cancel($('table.order-list tbody tr:last').index());

                        setTimeout(function() {
                            window.onafterprint = function(){
                                $('#print-layout').html('');
                            }
                        }, 100);
                    }
                    else if($('select[name="sale_status"]').val() != 1){
                        localStorage.clear();
                        location.href = "{{route('sales.index')}}";
                    }
                    else {
                        localStorage.clear();
                        location.href = response;
                    }
                },
                error: function(xhr) {
                    console.log('Form submission failed.');
                }
            });

        }
    });

    </script>
<script type="text/javascript" src="https://js.stripe.com/v3/"></script>
@endpush
