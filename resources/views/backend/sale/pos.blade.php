@extends('backend.layout.top-head')

@push('css')
<style type="text/css">
    body{font-family:'Inter',sans-serif}
    .bootstrap-select-sm .btn {font-size: 13px;padding: 3px 25px 3px 10px;height: 30px !important}
    .minus,.plus {padding: .35rem .75rem}
    .numkey.qty {font-size: 13px;padding: 0 0;max-width: 50px;text-align: center}
    .sub-total{font-weight:500;}
    .pos-page .container-fluid {padding: 0 15px}
    .pos-page .side-navbar {top: 0}
    section.pos-section {padding: 10px 0}
    .pos-page .table-fixed {margin-bottom: 0}
    .pos-text {line-height: 1.8}
    .pos-page section header {padding: 0 0 5px}
    .pos .bootstrap-select button {padding-right: 21px !important}
    .pos .bootstrap-select.form-control:not([class*=col-]) {width: 100px}
    .pos-page .order-list .btn {padding: 2px 5px}
    .pos-page [class=row] {margin-left:-10px;margin-right:-10px}
    .pos-page [class*=col-] {padding: 0 10px}
    .pos-page #myTable [class*=col-] {padding: .5rem}
    .pos-page #myTable tr th {background: #f5f6f7;color:#5e5873}
    .product-btns{margin:5px -5px}
    .edit-product{white-space: break-spaces;font-size:13px;font-weight:500;text-align:left;padding:0 0!important}
    .edit-product i{color:#00cec9}
    .product-title span{font-size:12px}
    .more-options{box-shadow: -5px 0px 10px 0px rgba(44,44,44,0.3);font-size:12px;margin:10px 0;padding-left:3px;padding-right:3px}
    label{font-size:13px}
    #tbody-id tr td {font-size:13px;padding: 0}
    table,tr,td {border-collapse: collapse;}
    .top-fields{margin-top:10px;position: relative;}
    .top-fields label {background:#FFF;font-size:11px;margin-left:10px;padding:0 3px;position:absolute;top:-8px;z-index:9;}
    .top-fields input,.top-fields .btn{font-size:13px;height:37px}
    .product-grid{display: flex;flex-wrap: wrap;padding: 0;margin: 0;width: 100%;}
    .product-grid > div {border: 1px solid #e4e6fc;overflow: hidden;padding:.5rem;position: relative;max-width: 300px;min-width: 100px;vertical-align: top;width: calc(100%/4);}
    .product-grid > div p {color: #5e5873;font-size:12px;font-weight: 500;margin: 10px 0 0;min-height: 36px;display: -webkit-box;-webkit-line-clamp: 2;overflow: hidden;text-overflow: ellipsis;-webkit-box-orient: vertical}
    .product-grid > div span {font-size: 12px}
    .more-payment-options.column-5{margin:0;padding:0}
    .ui-helper-hidden-accessible{display: none;}
    #print-layout{padding: 0 0;margin: 0 0;}
    .category-img p,.brand-img p{color: #5e5873;font-size:12px;font-weight:500}
    .brand-img,.category-img{display:flex;flex-direction:column;justify-content:center;align-items:center;}
    .brand-img img{max-width:70%}
    .load-more{margin-top:15px}
    .load-more:disabled{opacity:0.5}
    .ui-helper-hidden-accessible{display:none!important}
    @media (max-width: 500px) {
        .product-grid > div {width: calc(100%/3);}
    }
    @media (max-width: 375px) {
        .product-grid > div {width: calc(100%/2);}
    }
    @media all and (max-width:767px){
        section.pos-section {padding: 0 5px}
        nav.navbar{margin: 0 -10px}
        .pos-form{padding:0 0 !important}
        .payment-options {padding: 5px 0}
        .payment-options .column-5{margin:5px 0;}
        .payment-options .btn-sm{font-size:12px;}
        .more-payment-options, .more-payment-options .btn-group{width:100%}
        .more-payment-options.column-5{padding:0 5px;}
        .product-btns{margin:0 -15px 10px -15px}
        .product-btns .btn{font-size: 12px;}
        .more-options{margin-top: 0;}
        .transaction-list {height: 35vh;}
        .filter-window{position:fixed;}
    }

    @media print {
        .hidden-print {display: none !important;}
    }

    #print-layout * {font-size: 10px;line-height: 20px;font-family: 'Ubuntu', sans-serif;text-transform: capitalize;}
    #print-layout .btn {padding: 7px 10px;text-decoration: none;border: none;display: block;text-align: center;margin: 7px;cursor:pointer;}

    #print-layout .btn-info {background-color: #999;color: #FFF;}

    #print-layout .btn-primary {background-color: #6449e7;color: #FFF;width: 100%;}
    #print-layout td,
    #print-layout th,
    #print-layout tr,
    #print-layout table {border-collapse: collapse;}
    #print-layout tr {border-bottom: 1px dotted #ddd;}
    #print-layout td,#print-layout th {padding: 7px 0;width: 50%;}

    #print-layout table {width: 100%;}

    #print-layout .centered {display: block;text-align: center;align-content: center;}
    #print-layout small{font-size:10px;}

    @media print {
        #print-layout * {font-size:10px!important;line-height: 20px;}
        #print-layout table {width: 100%;margin: 0 0;}
        #print-layout td,#print-layout th {padding: 5px 0;}
        #print-layout .hidden-print {display: none !important;}
    }
</style>
@endpush
@section('content')
@if($errors->has('phone_number'))
<div class="alert alert-danger alert-dismissible text-center">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>{{ $errors->first('phone_number') }}
</div>
@endif
@if(session()->has('message'))
<div class="alert alert-success alert-dismissible text-center"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>{!! session()->get('message') !!}</div>
@endif
@if(session()->has('error'))
<div class="alert alert-danger alert-dismissible text-center"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>{!! session()->get('error') !!}</div>
@endif
@if(session()->has('not_permitted'))
<div class="alert alert-danger alert-dismissible text-center"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>{{ session()->get('not_permitted') }}</div>
@endif
<section id="pos-layout" class="forms pos-section hidden-print">
    <div class="container-fluid">
        <div class="row">
            <audio id="mysoundclip1" preload="auto">
                <source src="{{url('beep/beep-timber.mp3')}}">
                </source>
            </audio>
            <audio id="mysoundclip2" preload="auto">
                <source src="{{url('beep/beep-07.mp3')}}">
                </source>
            </audio>
            <!-- product list -->
            <div class="col-md-5 order-first order-md-2">
                <!-- navbar-->
                <header>
                    <nav class="navbar">

                        <a class="menu-btn" href="{{url('/dashboard')}}"><i class="dripicons-home"></i></a>
                        <ul class="nav-menu list-unstyled d-flex flex-md-row align-items-md-center">
                            <li class="nav-item ml-4 d-md-none"><a  data-toggle="collapse" href="#collapseProducts" role="button" aria-expanded="false" aria-controls="collapseProducts"><i class="fa fa-cubes"></i></a></li>
                            <li class="nav-item ml-4 d-none d-lg-block"><a id="btnFullscreen" data-toggle="tooltip" title="Full Screen"><i class="dripicons-expand"></i></a></li>
                            <?php
                            $general_setting_permission = $permission_list->where('name', 'general_setting')->first();
                            $general_setting_permission_active = DB::table('role_has_permissions')->where([
                                ['permission_id', $general_setting_permission->id],
                                ['role_id', Auth::user()->role_id]
                            ])->first();

                            $pos_setting_permission = $permission_list->where('name', 'pos_setting')->first();

                            $pos_setting_permission_active = DB::table('role_has_permissions')->where([
                                ['permission_id', $pos_setting_permission->id],
                                ['role_id', Auth::user()->role_id]
                            ])->first();

                            $authUser = Auth::user()->role_id;
                            ?>
                            @if($pos_setting_permission_active)
                            <li class="nav-item"><a class="dropdown-item" data-toggle="tooltip" href="{{route('setting.pos')}}" title="{{trans('file.POS Setting')}}"><i class="dripicons-gear"></i></a> </li>
                            @endif
                            <li class="nav-item">
                                <a href="{{route('sales.printLastReciept')}}" data-toggle="tooltip" title="{{trans('file.Print Last Reciept')}}"><i class="dripicons-print"></i></a>
                            </li>
                            <li class="nav-item d-none d-lg-block">
                                <a href="" id="register-details-btn" data-toggle="tooltip" title="{{trans('file.Cash Register Details')}}"><i class="dripicons-briefcase"></i></a>
                            </li>
                            <?php
                            $today_sale_permission = $permission_list->where('name', 'today_sale')->first();
                            $today_sale_permission_active = DB::table('role_has_permissions')->where([
                                ['permission_id', $today_sale_permission->id],
                                ['role_id', Auth::user()->role_id]
                            ])->first();

                            $today_profit_permission = $permission_list->where('name', 'today_profit')->first();
                            $today_profit_permission_active = DB::table('role_has_permissions')->where([
                                ['permission_id', $today_profit_permission->id],
                                ['role_id', Auth::user()->role_id]
                            ])->first();
                            ?>

                            @if($today_sale_permission_active)
                            <li class="nav-item d-none d-lg-block">
                                <a href="" id="today-sale-btn" data-toggle="tooltip" title="{{trans('file.Today Sale')}}"><i class="dripicons-shopping-bag"></i></a>
                            </li>
                            @endif
                            @if($today_profit_permission_active)
                            <li class="nav-item d-none d-lg-block">
                                <a href="" id="today-profit-btn" data-toggle="tooltip" title="{{trans('file.Today Profit')}}"><i class="dripicons-graph-line"></i></a>
                            </li>
                            @endif
                            @if(($alert_product + count(\Auth::user()->unreadNotifications)) > 0)
                            <li class="nav-item d-none d-lg-block" id="notification-icon">
                                <a rel="nofollow" data-toggle="tooltip" title="{{__('Notifications')}}" class="nav-link dropdown-item"><i class="dripicons-bell"></i><span class="badge badge-danger notification-number">{{$alert_product + count(\Auth::user()->unreadNotifications)}}</span>
                                    <span class="caret"></span>
                                    <span class="sr-only">Toggle Dropdown</span>
                                </a>
                                <ul class="right-sidebar" user="menu">
                                    <li class="notifications">
                                        <a href="{{route('report.qtyAlert')}}" class="btn btn-link">{{$alert_product}} product exceeds alert quantity</a>
                                    </li>
                                    @foreach(\Auth::user()->unreadNotifications as $key => $notification)
                                    <li class="notifications">
                                        <a href="#" class="btn btn-link">{{ $notification->data['message'] }}</a>
                                    </li>
                                    @endforeach
                                </ul>
                            </li>
                            @endif
                            <li class="nav-item">
                                <a rel="nofollow" data-toggle="tooltip" class="nav-link dropdown-item"><i class="dripicons-user"></i> <span>{{ucfirst(Auth::user()->name)}}</span> <i class="fa fa-angle-down"></i>
                                </a>
                                <ul class="right-sidebar">
                                    <li>
                                        <a href="{{route('user.profile', ['id' => Auth::id()])}}"><i class="dripicons-user"></i> {{trans('file.profile')}}</a>
                                    </li>
                                    @if($general_setting_permission_active)
                                    <li>
                                        <a href="{{route('setting.general')}}"><i class="dripicons-gear"></i> {{trans('file.settings')}}</a>
                                    </li>
                                    @endif
                                    <li>
                                        <a href="{{url('my-transactions/'.date('Y').'/'.date('m'))}}"><i class="dripicons-swap"></i> {{trans('file.My Transaction')}}</a>
                                    </li>
                                    @if(Auth::user()->role_id != 5)
                                    <li>
                                        <a href="{{url('holidays/my-holiday/'.date('Y').'/'.date('m'))}}"><i class="dripicons-vibrate"></i> {{trans('file.My Holiday')}}</a>
                                    </li>
                                    @endif
                                    <li>
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                        document.getElementById('logout-form').submit();"><i class="dripicons-power"></i>
                                            {{trans('file.logout')}}
                                        </a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            @csrf
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </nav>
                </header>
                <div class="filter-window">
                    <div class="category mt-3">
                        <div class="row ml-2 mr-2 px-2">
                            <div class="col-7">Choose category</div>
                            <div class="col-5 text-right">
                                <span class="btn btn-default btn-sm btn-close">
                                    <i class="dripicons-cross"></i>
                                </span>
                            </div>
                        </div>
                        <div class="row ml-2 mt-3">
                            @foreach($lims_category_list as $category)
                            <div class="col-md-3 col-6 category-img text-center" data-category="{{$category->id}}">
                                @if($category->image)
                                <img src="{{url('images/category', $category->image)}}" />
                                @else
                                <img src="{{url('/images/product/zummXD2dvAtI.png')}}" />
                                @endif
                                <p class="text-center">{{$category->name}}</p>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="brand mt-3">
                        <div class="row ml-2 mr-2 px-2">
                            <div class="col-7">Choose brand</div>
                            <div class="col-5 text-right">
                                <span class="btn btn-default btn-sm btn-close">
                                    <i class="dripicons-cross"></i>
                                </span>
                            </div>
                        </div>
                        <div class="row ml-2 mt-3">
                            @foreach($lims_brand_list as $brand)
                            <div class="col-md-3 col-6 brand-img text-center" data-brand="{{$brand->id}}">
                                @if($brand->image)
                                <img src="{{url('images/brand',$brand->image)}}" />
                                @else
                                <img src="{{url('/images/product/zummXD2dvAtI.png')}}" />
                                @endif
                                <p class="text-center">{{$brand->title}}</p>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="products-m mt-3">
                        <div class="row ml-2 mr-2 px-2">
                            <div class="col-7"></div>
                            <div class="col-5 text-right">
                                <span class="btn btn-default btn-sm btn-close">
                                    <i class="dripicons-cross"></i>
                                </span>
                            </div>
                        </div>
                        <div class="product_list_mobile table-container row mt-3" data-cat="" data-brand="">

                        </div>
                    </div>
                </div>
                <div id="collapseProducts" class="">
                    <div class="d-flex justify-content-between product-btns">

                        <button class="btn btn-block btn-primary mt-0 ml-1 mr-1" id="category-filter">{{trans('file.category')}}</button>

                        <button class="btn btn-block btn-info mt-0 ml-1 mr-1" id="brand-filter">{{trans('file.Brand')}}</button>

                        <button class="btn btn-block btn-danger mt-0 ml-1 mr-1" id="featured-filter">{{trans('file.Featured')}}</button>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 table-container main mt-2" data-cat="" data-brand="">
                        <div class="product-grid">

                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-7 pos-form">
                {!! Form::open(['route' => 'sales.store', 'method' => 'post', 'files' => true, 'class' => 'payment-form']) !!}
                @php
                if($lims_pos_setting_data)
                $keybord_active = $lims_pos_setting_data->keybord_active;
                else
                $keybord_active = 0;

                $customer_active = DB::table('permissions')
                ->join('role_has_permissions', 'permissions.id', '=', 'role_has_permissions.permission_id')
                ->where([
                ['permissions.name', 'customers-add'],
                ['role_id', \Auth::user()->role_id] ])->first();
                @endphp
                <div class="row">
                    <div class="col-md-11 col-12">
                        <div class="row">
                            <div class="col-md-3 col-6">
                                <div class="form-group top-fields">
                                    <label>{{trans('file.Date')}}</label>
                                    <div class="input-group">
                                        <input type="text" name="created_at" class="form-control date" value="{{date($general_setting->date_format,strtotime('now'))}}" onkeyup='saveValue(this);' />
                                    </div>
                                </div>
                            </div>
                            @if(isset(auth()->user()->warehouse_id))
                            <input type="hidden" name="warehouse_id" id="warehouse_id" value="{{auth()->user()->warehouse_id}}" />
                            @else
                            <div class="col-md-3 col-6">
                                <div class="form-group top-fields">
                                    @if(!empty($lims_sale_data) && $lims_sale_data->warehouse_id)
                                    <input type="hidden" name="warehouse_id_hidden" value="{{$lims_sale_data->warehouse_id}}">
                                    @elseif($lims_pos_setting_data)
                                    <input type="hidden" name="warehouse_id_hidden" value="{{$lims_pos_setting_data->warehouse_id}}">
                                    @endif
                                    <label>{{trans('file.Warehouse')}}</label>
                                    <select required id="warehouse_id" name="warehouse_id" class="selectpicker form-control" data-live-search="true" data-live-search-style="begins" title="Select warehouse...">
                                        @foreach($lims_warehouse_list as $warehouse)
                                        <option value="{{$warehouse->id}}">{{$warehouse->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            @endif
                            @if(isset(auth()->user()->biller_id))
                            <input type="hidden" name="biller_id" id="biller_id" value="{{auth()->user()->biller_id}}" />
                            @else
                            <div class="col-md-3 col-6">
                                <div class="form-group top-fields">
                                    @if(!empty($lims_sale_data) && $lims_sale_data->biller_id)
                                    <input type="hidden" name="biller_id_hidden" value="{{$lims_sale_data->biller_id}}">
                                    @elseif($lims_pos_setting_data)
                                    <input type="hidden" name="biller_id_hidden" value="{{$lims_pos_setting_data->biller_id}}">
                                    @endif
                                    <label>{{trans('file.Biller')}}</label>
                                    <select required id="biller_id" name="biller_id" class="selectpicker form-control" data-live-search="true" data-live-search-style="begins" title="Select Biller...">
                                        @foreach($lims_biller_list as $biller)
                                        <option value="{{$biller->id}}">{{$biller->name . ' (' . $biller->company_name . ')'}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            @endif
                            <div class="col-md-3 col-6">
                                <div class="form-group top-fields">
                                    @if(!empty($lims_sale_data) && $lims_sale_data->customer_id)
                                    <input type="hidden" name="customer_id_hidden" value="{{$lims_sale_data->customer_id}}">
                                    @elseif($lims_pos_setting_data)
                                    <input type="hidden" name="customer_id_hidden" value="{{$lims_pos_setting_data->customer_id}}">
                                    @endif
                                    <label>{{trans('file.customer')}}</label>
                                    <div class="input-group pos">
                                        <select required name="customer_id" id="customer_id" class="selectpicker form-control" data-live-search="true" title="Select customer..." style="width: 100px">
                                            <?php
                                            $deposit = [];
                                            $points = [];
                                            ?>
                                            @foreach($lims_customer_list as $customer)
                                                @php
                                                $deposit[$customer->id] = $customer->deposit - $customer->expense;

                                                $points[$customer->id] = $customer->points;
                                                @endphp
                                                <option value="{{$customer->id}}">{{$customer->name}} @if($customer->phone_number)({{$customer->phone_number}})@endif</option>
                                            @endforeach
                                        </select>
                                        @if($customer_active)
                                        <button type="button" class="btn btn-default btn-sm" data-toggle="modal" data-target="#addCustomer"><i class="dripicons-plus"></i></button>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            @if(in_array('restaurant',explode(',',$general_setting->modules)))
                            <div class="col-md-3 col-6">
                                <div class="form-group top-fields">
                                    <label>{{trans('file.Service')}}</label>
                                    <div class="input-group pos">
                                        <select required id="service_id" name="service_id" class="selectpicker form-control" title="Select service...">
                                            <option value="1" selected>{{trans('file.Dine In')}}</option>
                                            <option value="2">{{trans('file.Take Away')}}</option>
                                            <option value="3">{{trans('file.Delivery')}}</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 col-6">
                                <div class="form-group top-fields">
                                    <label>{{trans('file.table')}}</label>
                                    <div class="input-group pos">
                                        <select required id="table_id" name="table_id" class="selectpicker form-control" data-live-search="true" data-live-search-style="begins" title="Select table...">
                                            @foreach($lims_table_list as $table)
                                            <option value="{{$table->id}}">{{$table->name}} at {{$table->floor}} ( 👤 {{$table->number_of_person}})</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-3 col-6">
                                <div class="form-group top-fields">
                                    <label>{{trans('file.Waiter')}}</label>
                                    <div class="input-group pos">
                                        <select required id="waiter_id" name="waiter_id" class="selectpicker form-control" title="Select waiter...">
                                            @if(auth()->user()->service_staff == 1)
                                            <option value="{{auth()->user()->id}}" selected >{{auth()->user()->name}}</option>
                                            @else
                                                @foreach($waiter_list as $waiter)
                                                <option value="{{$waiter->id}}">{{$waiter->name}}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-1 col-12">
                        <a class="btn btn-primary btn-block more-options" data-toggle="collapse" href="#moreOptions" role="button" aria-expanded="false" aria-controls="moreOptions"><i class="dripicons-dots-3"></i></a>
                    </div>
                </div>
                <div>
                    <div class="collapse" id="moreOptions">
                        <div class="card card-body">
                            <div class="row">
                                <div class="col-md-3">
                                    <label>{{trans('file.Sale Reference No.')}}</label>
                                    <div class="form-group">
                                        <input type="text" id="reference-no" name="reference_no" class="form-control" placeholder="Type reference number" onkeyup='saveValue(this);' />
                                    </div>
                                    @if($errors->has('reference_no'))
                                    <span>
                                        <strong>{{ $errors->first('reference_no') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="col-md-4">
                                    <label>{{trans('file.Currency')}} & {{trans('file.Exchange Rate')}}</label>
                                    <div class="form-group d-flex">
                                        <div class="input-group-prepend">
                                            <select name="currency_id" id="currency" class="form-control selectpicker" data-toggle="tooltip" title="" data-original-title="Sale currency">
                                                @foreach($currency_list as $currency_data)
                                                <option value="{{$currency_data->id}}" data-rate="{{$currency_data->exchange_rate}}">{{$currency_data->code}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <input class="form-control" type="text" id="exchange_rate" name="exchange_rate" value="{{$currency->exchange_rate}}">
                                        <div class="input-group-append">
                                            <span class="input-group-text" data-toggle="tooltip" title="" data-original-title="currency exchange rate">i</span>
                                        </div>
                                    </div>
                                </div>
                                @foreach($custom_fields as $field)
                                @if(!$field->is_admin || \Auth::user()->role_id == 1)
                                <div class="{{'col-md-'.$field->grid_value}}">
                                    <div class="form-group">
                                        <label>{{$field->name}}</label>
                                        @if($field->type == 'text')
                                        <input type="text" name="{{str_replace(' ', '_', strtolower($field->name))}}" value="{{$field->default_value}}" class="form-control" @if($field->is_required){{'required'}}@endif>
                                        @elseif($field->type == 'number')
                                        <input type="number" name="{{str_replace(' ', '_', strtolower($field->name))}}" value="{{$field->default_value}}" class="form-control" @if($field->is_required){{'required'}}@endif>
                                        @elseif($field->type == 'textarea')
                                        <textarea rows="5" name="{{str_replace(' ', '_', strtolower($field->name))}}" value="{{$field->default_value}}" class="form-control" @if($field->is_required){{'required'}}@endif></textarea>
                                        @elseif($field->type == 'checkbox')
                                        <br>
                                        <?php $option_values = explode(",", $field->option_value); ?>
                                        @foreach($option_values as $value)
                                        <label>
                                            <input type="checkbox" name="{{str_replace(' ', '_', strtolower($field->name))}}[]" value="{{$value}}" @if($value==$field->default_value){{'checked'}}@endif @if($field->is_required){{'required'}}@endif> {{$value}}
                                        </label>
                                        &nbsp;
                                        @endforeach
                                        @elseif($field->type == 'radio_button')
                                        <br>
                                        <?php $option_values = explode(",", $field->option_value); ?>
                                        @foreach($option_values as $value)
                                        <label class="radio-inline">
                                            <input type="radio" name="{{str_replace(' ', '_', strtolower($field->name))}}" value="{{$value}}" @if($value==$field->default_value){{'checked'}}@endif @if($field->is_required){{'required'}}@endif> {{$value}}
                                        </label>
                                        &nbsp;
                                        @endforeach
                                        @elseif($field->type == 'select')
                                        <?php $option_values = explode(",", $field->option_value); ?>
                                        <select class="form-control" name="{{str_replace(' ', '_', strtolower($field->name))}}" @if($field->is_required){{'required'}}@endif>
                                            @foreach($option_values as $value)
                                            <option value="{{$value}}" @if($value==$field->default_value){{'selected'}}@endif>{{$value}}</option>
                                            @endforeach
                                        </select>
                                        @elseif($field->type == 'multi_select')
                                        <?php $option_values = explode(",", $field->option_value); ?>
                                        <select class="form-control" name="{{str_replace(' ', '_', strtolower($field->name))}}[]" @if($field->is_required){{'required'}}@endif multiple>
                                            @foreach($option_values as $value)
                                            <option value="{{$value}}" @if($value==$field->default_value){{'selected'}}@endif>{{$value}}</option>
                                            @endforeach
                                        </select>
                                        @elseif($field->type == 'date_picker')
                                        <input type="text" name="{{str_replace(' ', '_', strtolower($field->name))}}" value="{{$field->default_value}}" class="form-control date" @if($field->is_required){{'required'}}@endif>
                                        @endif
                                    </div>
                                </div>
                                @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                    @if($lims_pos_setting_data->is_table && !in_array('restaurant',explode(',',$general_setting->modules)))
                    <div class="col-12 pl-0 pr-0">
                        <div class="form-group">
                            <select required id="table_id" name="table_id" class="selectpicker form-control" data-live-search="true" data-live-search-style="begins" title="Select table...">
                                @foreach($lims_table_list as $table)
                                <option value="{{$table->id}}">{{$table->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    @endif
                    <div class="col-12 pl-0 pr-0">
                        <div class="search-box form-group mb-2">
                            <div class="input-group pos">
                                <input style="border: 1px solid #7c5cc4;" type="text" name="product_code_name" id="lims_productcodeSearch" placeholder="Scan/Search product by name/code" class="form-control" />
                                <button type="button" class="btn btn-primary" id="openScannerBtn"><i class="fa fa-barcode"></i></button>
                            </div>
                            <div id="scannerContainer" style="width: 300px;height: 300px;display: none;position: fixed; z-index:999;top:50%;left:50%; transform:translate(-50%,-50%)">
                                <button type="button" class="btn btn-danger" id="closeScannerBtn" style="display:none"><i class="fa fa-close"></i></button>
                                <div id="qrScanner" style="width: 300px;height: 300px;"></div>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive transaction-list">
                        <table id="myTable" class="table table-hover table-striped order-list table-fixed">
                            <thead class="d-none d-md-block">
                                <tr>
                                    <th class="col-sm-5 col-6">{{trans('file.product')}}</th>
                                    <th class="col-sm-2">{{trans('file.Price')}}</th>
                                    <th class="col-sm-3">{{trans('file.Quantity')}}</th>
                                    <th class="col-sm-2">{{trans('file.Subtotal')}}</th>
                                </tr>
                            </thead>
                            <tbody id="tbody-id">
                                @if(isset($lims_product_sale_data))
                                <?php
                                    $temp_unit_name = [];
                                    $temp_unit_operator = [];
                                    $temp_unit_operation_value = [];
                                ?>
                                @foreach($lims_product_sale_data as $product_sale)
                                <tr>
                                    <?php
                                        $product_data = DB::table('products')->find($product_sale->product_id);
                                        if($product_sale->variant_id) {
                                            $product_variant_data = \App\Models\ProductVariant::select('id', 'item_code')->FindExactProduct($product_data->id, $product_sale->variant_id)->first();
                                            $product_data->code = $product_variant_data->item_code;
                                        }

                                        if($product_data->tax_method == 1){
                                            $product_price = $product_sale->net_unit_price + ($product_sale->discount / $product_sale->qty);
                                        }
                                        elseif ($product_data->tax_method == 2) {
                                            $product_price =($product_sale->total / $product_sale->qty) + ($product_sale->discount / $product_sale->qty);
                                        }

                                        $tax = DB::table('taxes')->where('rate',$product_sale->tax_rate)->first();
                                        $unit_name = array();
                                        $unit_operator = array();
                                        $unit_operation_value = array();
                                        if($product_data->type == 'standard'){
                                            $units = DB::table('units')->where('base_unit', $product_data->unit_id)->orWhere('id', $product_data->unit_id)->get();

                                            foreach($units as $unit) {
                                                if($product_sale->sale_unit_id == $unit->id) {
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

                                        $product_batch_data = \App\Models\ProductBatch::select('batch_no', 'expired_date')->find($product_sale->product_batch_id);
                                    ?>
                                    <td class="col-sm-5 col-6 product-title">
                                    <strong class="edit-product btn btn-link" data-toggle="modal" data-target="#editModal">{{$product_data->name}} <i class="fa fa-edit"></i></strong><br><span>{{$product_data->code}}</span> | In Stock: <span class="in-stock">{{$product_data->in_stock}}</span> <strong class="product-price d-md-none">{{ number_format((float)($product_sale->total / $product_sale->qty), $general_setting->decimal, '.', '')}}</strong>

                                    @if($product_batch_data)
                                    <br><input style="font-size:13px;padding:3px 25px 3px 10px;height:30px !important" type="text" class="form-control batch-no" value="{{$product_batch_data->batch_no}}" required/> <input type="hidden" class="product-batch-id" name="product_batch_id[]" value="{{$product_sale->product_batch_id}}"/>
                                    @else
                                    <input type="text" class="form-control batch-no d-none" disabled/> <input type="hidden" class="product-batch-id" name="product_batch_id[]"/>
                                    @endif
                                    </td>
                                    <td class="col-sm-2 product-price d-none d-md-block">{{ number_format((float)($product_sale->total / $product_sale->qty), $general_setting->decimal, '.', '')}}</td>
                                    <td class="col-sm-3"><div class="input-group"><span class="input-group-btn"><button type="button" class="ibtnDel btn btn-danger btn-sm mr-3"><i class="dripicons-cross"></i></button><button type="button" class="btn btn-default minus"><span class="dripicons-minus"></span></button></span><input type="text" name="qty[]" class="form-control qty numkey input-number" value="{{$product_sale->qty}}" step="any" required><span class="input-group-btn"><button type="button" class="btn btn-default plus"><span class="dripicons-plus"></span></button></span></div></td>
                                    <td class="col-sm-2 sub-total">{{ number_format((float)$product_sale->total, $general_setting->decimal, '.', '')}}</td>
                                    <input type="hidden" class="product-code" name="product_code[]" value="{{$product_data->code}}"/>
                                    <input type="hidden" class="product-id" name="product_id[]" value="{{$product_data->id}}"/>
                                    <input type="hidden" class="product_price" name="product_price[]" value="{{$product_price}}"/>
                                    <input type="hidden" class="net_unit_price" name="net_unit_price[]" value="{{$product_sale->net_unit_price}}" />
                                    <input type="hidden" class="discount-value" name="discount[]" value="{{$product_sale->discount}}" />
                                    <input type="hidden" class="tax-rate" name="tax_rate[]" value="{{$product_sale->tax_rate}}"/>
                                    @if($tax)
                                    <input type="hidden" class="tax-name" value="{{$tax->name}}" />
                                    @else
                                    <input type="hidden" class="tax-name" value="No Tax" />
                                    @endif
                                    <input type="hidden" class="tax-method" value="{{$product_data->tax_method}}"/>
                                    <input type="hidden" class="tax-value" name="tax[]" value="{{$product_sale->tax}}" />
                                    <input type="hidden" class="total-discount" value="{{$product_sale->discount}}">
                                    <input type="hidden" class="subtotal-value" name="subtotal[]" value="{{$product_sale->total}}" />
                                    <input type="hidden" class="sale-unit" name="sale_unit[]" value="{{$unit_name}}"/>
                                    <input type="hidden" class="sale-unit-operator" value="{{$unit_operator}}"/>
                                    <input type="hidden" class="sale-unit-operation-value" value="{{$unit_operation_value}}"/>
                                    <input type="hidden" class="imei-number" name="imei_number[]"  value="{{$product_sale->imei_number}}" />
                                </tr>
                                @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                    <div class="row" style="display: none;">
                        <div class="col-md-2">
                            <div class="form-group">
                                <input type="hidden" name="total_qty" value="{{$lims_sale_data->total_qty ?? 0}}" />
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <input type="hidden" name="total_discount" value="@if(isset($lims_sale_data)) {{$lims_sale_data->total_discount}} @else {{number_format(0, $general_setting->decimal, '.', '')}} @endif" />
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <input type="hidden" name="total_tax" value="@if(isset($lims_sale_data)) {{$lims_sale_data->total_tax}} @else {{number_format(0, $general_setting->decimal, '.', '')}} @endif" />
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <input type="hidden" name="total_price" value="@if(isset($lims_sale_data)) {{$lims_sale_data->total_discount}} @else {{number_format(0, $general_setting->decimal, '.', '')}} @endif" />
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <input type="hidden" name="item" value="{{$lims_sale_data->item ?? 0}}" />
                                <input type="hidden" name="order_tax" value="@if(isset($lims_sale_data)) {{$lims_sale_data->order_tax}} @else {{number_format(0, $general_setting->decimal, '.', '')}} @endif" />
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <input type="hidden" name="grand_total" value="@if(isset($lims_sale_data)) {{number_format((float)$lims_sale_data->grand_total, $general_setting->decimal, '.', '')}} @else {{number_format(0, $general_setting->decimal, '.', '')}} @endif"/>
                                <input type="hidden" name="used_points" />

                                @if(in_array('restaurant',explode(',',$general_setting->modules)))
                                <input type="hidden" name="sale_status" value="5" />
                                @else
                                <input type="hidden" name="sale_status" value="1" />
                                @endif

                                @if(isset($lims_sale_data) && $lims_sale_data->coupon_id)
                                    @php
                                        $coupon = \App\Models\Coupon::find($lims_sale_data->coupon_id)
                                    @endphp
                                    <input type="hidden" name="coupon_active" value="1">
                                @else
                                    <input type="hidden" name="coupon_active">
                                @endif
                                <input type="hidden" name="coupon_id" value="{{$lims_sale_data->coupon_id ?? ''}}">
                                <input type="hidden" name="coupon_discount" value="{{$lims_sale_data->coupon_discount ?? 0}}"/>

                                <input type="hidden" name="pos" value="1" />
                                <input type="hidden" name="draft" value="0" />
                            </div>
                        </div>
                    </div>
                    <div class="col-12 totals" style="background-color:#f5f6f7;border-top: 2px solid #ebe9f1;padding-bottom: 7px;padding-top: 7px;">
                        <div class="row">
                            <div class="col-sm-4 col-6">
                                <strong class="totals-title">{{trans('file.Items')}}</strong><strong id="item">{{$lims_sale_data->item ?? 0}} ({{$lims_sale_data->total_qty ?? 0}})</strong>
                            </div>
                            <div class="col-sm-4 col-6">
                                <strong class="totals-title">{{trans('file.Total')}}</strong><strong id="subtotal">@if(isset($lims_sale_data)) {{number_format((float)$lims_sale_data->total_price, $general_setting->decimal, '.', '')}} @else {{number_format(0, $general_setting->decimal, '.', '')}} @endif</strong>
                            </div>
                            <div class="col-sm-4 col-6">
                                <strong class="totals-title">{{trans('file.Discount')}} <button type="button" class="btn btn-link btn-sm" data-toggle="modal" data-target="#order-discount-modal"> <i class="dripicons-document-edit"></i></button></strong><strong id="discount">@if(isset($lims_sale_data)) {{number_format((float)$lims_sale_data->order_discount, $general_setting->decimal, '.', '')}} @else {{number_format(0, $general_setting->decimal, '.', '')}} @endif</strong>
                            </div>
                            <div class="col-sm-4 col-6">
                                <strong class="totals-title">{{trans('file.Coupon')}} <button type="button" class="btn btn-link btn-sm" data-toggle="modal" data-target="#coupon-modal"><i class="dripicons-document-edit"></i></button></strong><strong id="coupon-text">@if(isset($lims_sale_data)) {{number_format((float)$lims_sale_data->coupon_discount, $general_setting->decimal, '.', '')}} @else {{number_format(0, $general_setting->decimal, '.', '')}} @endif</strong>
                            </div>
                            <div class="col-sm-4 col-6">
                                <strong class="totals-title">{{trans('file.Tax')}} <button type="button" class="btn btn-link btn-sm" data-toggle="modal" data-target="#order-tax"><i class="dripicons-document-edit"></i></button></strong><strong id="tax">@if(isset($lims_sale_data)) {{number_format((float)$lims_sale_data->order_tax, $general_setting->decimal, '.', '')}} @else {{number_format(0, $general_setting->decimal, '.', '')}} @endif</strong>
                            </div>
                            <div class="col-sm-4 col-6">
                                <strong class="totals-title">{{trans('file.Shipping')}} <button type="button" class="btn btn-link btn-sm" data-toggle="modal" data-target="#shipping-cost-modal"><i class="dripicons-document-edit"></i></button></strong><strong id="shipping-cost">@if(isset($lims_sale_data)) {{number_format((float)$lims_sale_data->shipping_cost, $general_setting->decimal, '.', '')}} @else {{number_format(0, $general_setting->decimal, '.', '')}} @endif</strong>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="payment-amount d-none d-md-block">
                    <h2>{{trans('file.grand total')}} <span id="grand-total">@if(isset($lims_sale_data)) {{number_format((float)$lims_sale_data->grand_total, $general_setting->decimal, '.', '')}} @else {{number_format(0, $general_setting->decimal, '.', '')}} @endif</span></h2>
                </div>
                <div class="payment-options">
                    <div class="column-5 more-payment-options">
                        <div class="btn-group dropup">
                            <button type="button" class="btn btn-primary btn-custom  dropdown-toggle d-md-none" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-cube"></i> Pay <span id="grand-total-m"></span>
                            </button>
                            <div class="">
                                @if(in_array("card",$options))
                                <div class="column-5">
                                    <button style="background: #0984e3" type="button" class="btn btn-sm btn-custom payment-btn" data-toggle="modal" data-target="#add-payment" id="credit-card-btn"><i class="fa fa-credit-card"></i> {{trans('file.Card')}}</button>
                                </div>
                                @endif
                                @if(in_array("cash",$options))
                                <div class="column-5">
                                    <button style="background: #00cec9" type="button" class="btn btn-sm btn-custom payment-btn" data-toggle="modal" data-target="#add-payment" id="cash-btn"><i class="fa fa-money"></i> {{trans('file.Cash')}}</button>
                                </div>
                                @endif
                                <div class="column-5">
                                    <button style="background: #010429" type="button" class="btn btn-sm btn-custom payment-btn" data-toggle="modal" data-target="#add-payment" id="multiple-payment-btn"><i class="fa fa-money"></i> {{trans('file.Multiple Payment')}}</button>
                                </div>
                                {{-- @if(in_array("paypal",$options) && $lims_pos_setting_data && (strlen($lims_pos_setting_data->paypal_live_api_username)>0) && (strlen($lims_pos_setting_data->paypal_live_api_password)>0) && (strlen($lims_pos_setting_data->paypal_live_api_secret)>0))
                                <div class="column-5">
                                    <button style="background-color: #213170" type="button" class="btn btn-sm btn-block btn-custom payment-btn" data-toggle="modal" data-target="#add-payment" id="paypal-btn"><i class="fa fa-paypal"></i> {{trans('file.PayPal')}}</button>
                                </div>
                                @endif --}}
                                @if(in_array("cheque",$options))
                                <div class="column-5">
                                    <button style="background-color: #fd7272" type="button" class="btn btn-sm btn-block btn-custom payment-btn" data-toggle="modal" data-target="#add-payment" id="cheque-btn"><i class="fa fa-money"></i> {{trans('file.Cheque')}}</button>
                                </div>
                                @endif
                                @if(in_array("gift_card",$options))
                                <div class="column-5">
                                    <button style="background-color: #5f27cd" type="button" class="btn btn-sm btn-block btn-custom payment-btn" data-toggle="modal" data-target="#add-payment" id="gift-card-btn"><i class="fa fa-credit-card-alt"></i> {{trans('file.Gift Card')}}</button>
                                </div>
                                @endif
                                @if(in_array("deposit",$options))
                                <div class="column-5">
                                    <button style="background-color: #b33771" type="button" class="btn btn-sm btn-block btn-custom payment-btn" data-toggle="modal" data-target="#add-payment" id="deposit-btn"><i class="fa fa-university"></i> {{trans('file.Deposit')}}</button>
                                </div>
                                @endif
                                @if($lims_reward_point_setting_data && $lims_reward_point_setting_data->is_active)
                                <div class="column-5">
                                    <button style="background-color: #319398" type="button" class="btn btn-sm btn-block btn-custom payment-btn" data-toggle="modal" data-target="#add-payment" id="point-btn"><i class="dripicons-rocket"></i> {{trans('file.Points')}}</button>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="column-5">
                        <button style="background-color: #e28d02" type="button" class="btn btn-sm btn-custom" id="draft-btn"><i class="dripicons-flag"></i> {{trans('file.Draft')}}</button>
                    </div>
                    <div class="column-5">
                        <button style="background-color: #d63031;" type="button" class="btn btn-sm btn-custom" id="cancel-btn" onclick="return confirmCancel()"><i class="fa fa-close"></i> {{trans('file.Cancel')}}</button>
                    </div>
                    <div class="column-5">
                        <button style="background-color: #ffc107;" type="button" class="btn btn-sm btn-custom" data-toggle="modal" data-target="#recentTransaction"><i class="dripicons-clock"></i> {{trans('file.Recent Transaction')}}</button>
                    </div>
                </div>
                <!-- payment modal -->
                <div id="add-payment" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
                    <div role="document" class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 id="exampleModalLabel" class="modal-title">{{trans('file.Finalize Sale')}}</h5>
                                <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true"><i class="dripicons-cross"></i></span></button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-10" id="payment-select-row">
                                        <div class="row">
                                            <div class="col-md-3 col-6 mt-1 paying-amount-container">
                                                <label>{{trans('file.Paying Amount')}} *</label>
                                                <input type="text" name="paid_amount[]" value="0" class="form-control paid_amount numkey" step="any">
                                            </div>
                                            <div class="col-md-3 col-6 mt-1">
                                                <input type="hidden" name="paid_by_id[]">
                                                <label>{{trans('file.Paid By')}}</label>
                                                <select name="paid_by_id_select[]" class="form-control selectpicker">
                                                    @if(in_array("cash",$options))
                                                    <option value="1">Cash</option>
                                                    @endif
                                                    @if(in_array("gift_card",$options))
                                                    <option value="2">Gift Card</option>
                                                    @endif
                                                    @if(in_array("card",$options))
                                                    <option value="3">Credit Card</option>
                                                    @endif
                                                    @if(in_array("cheque",$options))
                                                    <option value="4">Cheque</option>
                                                    @endif
                                                    @if(in_array("paypal",$options) && (strlen(env('PAYPAL_LIVE_API_USERNAME'))>0) && (strlen(env('PAYPAL_LIVE_API_PASSWORD'))>0) && (strlen(env('PAYPAL_LIVE_API_SECRET'))>0))
                                                    <option value="5">Paypal</option>
                                                    @endif
                                                    @if(in_array("deposit",$options))
                                                    <option value="6">Deposit</option>
                                                    @endif
                                                    @if($lims_reward_point_setting_data && $lims_reward_point_setting_data->is_active)
                                                    <option value="7">Points</option>
                                                    @endif
                                                    <option value="9">Moneipoint</option>
                                                </select>
                                            </div>
                                            <div class="col-md-3 col-6 mt-1 cash-received-container">
                                                <label>{{trans('file.Cash Received')}} *</label>
                                                <input type="text" name="paying_amount[]" class="form-control paying_amount numkey" required step="any">
                                            </div>
                                        </div>
                                        <div class="row add-more-row mt-2">
                                            <div class="col-md-12 text-center"><button class="btn btn-info add-more">+ {{trans('file.Add More Payment')}}</button></div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12 mt-1">
                                                <label>{{trans('file.Payment Receiver')}}</label>
                                                <input type="text" name="payment_receiver" class="form-control">
                                            </div>
                                            <div class="form-group col-md-12">
                                                <label>{{trans('file.Payment Note')}}</label>
                                                <textarea id="payment_note" rows="2" class="form-control" name="payment_note"></textarea>
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label>{{trans('file.Sale Note')}}</label>
                                                <textarea rows="3" class="form-control" name="sale_note"></textarea>
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label>{{trans('file.Staff Note')}}</label>
                                                <textarea rows="3" class="form-control" name="staff_note"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-2 p-2 bg-info text-light pt-4 pb-4">
                                        <div class="mt-4">
                                            <h2>Total Payable</h2>
                                            <p class="total_payable text-light"></p>
                                        </div>
                                        <div class="mt-4">
                                            <h2>Total Paying</h2>
                                            <p class="total_paying text-light">0.00</p>
                                        </div>
                                        <div class="mt-4">
                                            <h2>Change</h2>
                                            <p class="change text-light">0.00</p>
                                        </div>
                                        <div class="mt-4">
                                            <h2>Due</h2>
                                            <p class="due text-light">0.00</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="mt-3">
                                            <button id="submit-btn" type="button" class="btn btn-primary">{{trans('file.submit')}}</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- order_discount modal -->
                <div id="order-discount-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
                    <div role="document" class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">{{trans('file.Order Discount')}}</h5>
                                <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true"><i class="dripicons-cross"></i></span></button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-6 form-group">
                                        <label>{{trans('file.Order Discount Type')}}</label>
                                        <select id="order-discount-type" name="order_discount_type_select" class="form-control">
                                            <option value="Flat">{{trans('file.Flat')}}</option>
                                            <option value="Percentage">{{trans('file.Percentage')}}</option>
                                        </select>
                                        <input type="hidden" name="order_discount_type">
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label>{{trans('file.Value')}}</label>
                                        <input type="text" name="order_discount_value" class="form-control numkey" id="order-discount-val" onkeyup='saveValue(this);'>
                                        <input type="hidden" name="order_discount" class="form-control" id="order-discount" onkeyup='saveValue(this);'>
                                    </div>
                                </div>
                                <button type="button" name="order_discount_btn" class="btn btn-primary" data-dismiss="modal">{{trans('file.submit')}}</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- coupon modal -->
                <div id="coupon-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
                    <div role="document" class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">{{trans('file.Coupon Code')}}</h5>
                                <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true"><i class="dripicons-cross"></i></span></button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <input type="text" id="coupon-code" class="form-control" placeholder="Type Coupon Code...">
                                </div>
                                <button type="button" class="btn btn-primary coupon-check" data-dismiss="modal">{{trans('file.submit')}}</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- order_tax modal -->
                <div id="order-tax" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
                    <div role="document" class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">{{trans('file.Order Tax')}}</h5>
                                <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true"><i class="dripicons-cross"></i></span></button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <input type="hidden" name="order_tax_rate">
                                    <select class="form-control" name="order_tax_rate_select" id="order-tax-rate-select">
                                        <option value="0">No Tax</option>
                                        @foreach($lims_tax_list as $tax)
                                        <option value="{{$tax->rate}}">{{$tax->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <button type="button" name="order_tax_btn" class="btn btn-primary" data-dismiss="modal">{{trans('file.submit')}}</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- shipping_cost modal -->
                <div id="shipping-cost-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
                    <div role="document" class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">{{trans('file.Shipping Cost')}}</h5>
                                <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true"><i class="dripicons-cross"></i></span></button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <input type="text" name="shipping_cost" class="form-control numkey" id="shipping-cost-val" step="any" onkeyup='saveValue(this);'>
                                </div>
                                <button type="button" name="shipping_cost_btn" class="btn btn-primary" data-dismiss="modal">{{trans('file.submit')}}</button>
                            </div>
                        </div>
                    </div>
                </div>

                {!! Form::close() !!}

                {{-- invoice modal start --}}
                <div id="invoice-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
                    <div role="document" class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true"><i class="dripicons-cross"></i></span></button>
                            </div>
                            <div id="invoice-modal-content" class="modal-body">
                            </div>
                        </div>
                    </div>
                </div>
                {{-- invoice modal end --}}

                <!-- product edit modal -->
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
                                            <input type="text" name="edit_qty" class="form-control numkey">
                                        </div>
                                        <div class="col-md-4 form-group">
                                            <label>{{trans('file.Unit Discount')}}</label>
                                            <input type="text" name="edit_discount" class="form-control numkey">
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>{{trans('file.Price Option')}}</strong> </label>
                                                <div class="input-group">
                                                    <select class="form-control selectpicker" name="price_option" class="price-option">
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 form-group">
                                            <label>{{trans('file.Unit Price')}}</label>
                                            <input type="text" name="edit_unit_price" class="form-control numkey" step="any">
                                        </div>
                                        <?php
                                        $tax_name_all[] = 'No Tax';
                                        $tax_rate_all[] = 0;
                                        foreach ($lims_tax_list as $tax) {
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
                                        <div class="col-md-4 form-group">
                                            <label>{{trans('file.Cost')}}</label>
                                            <p id="product-cost"></p>
                                        </div>
                                    </div>
                                    <button type="button" name="update_btn" class="btn btn-primary">{{trans('file.update')}}</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- add customer modal -->
                <div id="addCustomer" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
                    <div role="document" class="modal-dialog">
                        <div class="modal-content">
                            {!! Form::open(['route' => 'customer.store', 'method' => 'post', 'files' => true, 'id' => 'customer-form']) !!}
                            <div class="modal-header">
                                <h5 id="exampleModalLabel" class="modal-title">{{trans('file.Add Customer')}}</h5>
                                <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true"><i class="dripicons-cross"></i></span></button>
                            </div>
                            <div class="modal-body">
                                <p class="italic"><small>{{trans('file.The field labels marked with * are required input fields')}}.</small></p>
                                <div class="form-group">
                                    <label>{{trans('file.Customer Group')}} *</strong> </label>
                                    <select required class="form-control selectpicker" name="customer_group_id">
                                        @foreach($lims_customer_group_all as $customer_group)
                                        <option value="{{$customer_group->id}}">{{$customer_group->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>{{trans('file.name')}} *</strong> </label>
                                    <input type="text" name="customer_name" required class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>{{trans('file.Email')}}</label>
                                    <input type="text" name="email" placeholder="example@example.com" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>{{trans('file.Phone Number')}} *</label>
                                    <input type="text" name="phone_number" required class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>{{trans('file.Address')}}</label>
                                    <input type="text" name="address" required class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>{{trans('file.City')}}</label>
                                    <input type="text" name="city" required class="form-control">
                                </div>
                                <div class="form-group">
                                    <input type="hidden" name="pos" value="1">
                                    <button type="button" class="btn btn-primary customer-submit-btn">{{trans('file.submit')}}</button>

                                </div>
                            </div>
                            {{ Form::close() }}
                        </div>
                    </div>
                </div>
                <!-- recent transaction modal -->
                <div id="recentTransaction" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
                    <div role="document" class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 id="exampleModalLabel" class="modal-title">{{trans('file.Recent Transaction')}}
                                    <div class="badge badge-primary">{{trans('file.latest')}} 10</div>
                                </h5>
                                <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true"><i class="dripicons-cross"></i></span></button>
                            </div>
                            <div class="modal-body">
                                <ul class="nav nav-tabs" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" href="#sale-latest" role="tab" data-toggle="tab">{{trans('file.Sale')}}</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#draft-latest" role="tab" data-toggle="tab">{{trans('file.Draft')}}</a>
                                    </li>
                                </ul>
                                <div class="tab-content">
                                    <div role="tabpanel" class="tab-pane show active" id="sale-latest">
                                        <div class="table-responsive">
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th>{{trans('file.date')}}</th>
                                                        <th>{{trans('file.reference')}}</th>
                                                        <th>{{trans('file.customer')}}</th>
                                                        <th>{{trans('file.grand total')}}</th>
                                                        <th>{{trans('file.action')}}</th>
                                                    </tr>
                                                </thead>
                                                <tbody>

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div role="tabpanel" class="tab-pane fade" id="draft-latest">
                                        <div class="table-responsive">
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th>{{trans('file.date')}}</th>
                                                        <th>{{trans('file.reference')}}</th>
                                                        <th>{{trans('file.customer')}}</th>
                                                        <th>{{trans('file.grand total')}}</th>
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
                        </div>
                    </div>
                </div>
                <!-- Sale detaisl -->
                <div id="get-sale-details" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
                    <div role="document" class="modal-dialog">
                        <div class="modal-content">
                            <div class="container mt-3 pb-2 border-bottom">
                                <div class="row">
                                    <div class="col-md-6 d-print-none">
                                        <button id="print-btn" type="button" class="btn btn-default btn-sm"><i class="dripicons-print"></i> {{trans('file.Print')}}</button>

                                        {{ Form::open(['route' => 'sale.sendmail', 'method' => 'post', 'class' => 'sendmail-form'] ) }}
                                            <input type="hidden" name="sale_id">
                                            <button class="btn btn-default btn-sm d-print-none"><i class="dripicons-mail"></i> {{trans('file.Email')}}</button>
                                        {{ Form::close() }}
                                    </div>
                                    <div class="col-md-6 d-print-none">
                                        <button type="button" id="close-btn" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true"><i class="dripicons-cross"></i></span></button>
                                    </div>
                                    <div class="col-md-4 text-left">
                                        <img src="{{url('logo', $general_setting->site_logo)}}" width="90px;">
                                    </div>
                                    <div class="col-md-4 text-center">
                                        <h3 id="exampleModalLabel" class="modal-title container-fluid">{{$general_setting->site_title}}</h3>
                                    </div>
                                    <div class="col-md-4 text-right">
                                        <i style="font-size: 15px;">{{trans('file.Sale Details')}}</i>
                                    </div>
                                </div>
                            </div>
                            <div id="sale-content" class="modal-body">
                            </div>
                            <br>
                            <table class="table table-bordered product-sale-list">
                                <thead>
                                    <th>#</th>
                                    <th>{{trans('file.product')}}</th>
                                    <th>{{trans('file.Batch No')}}</th>
                                    <th>{{trans('file.Qty')}}</th>
                                    <th>{{trans('file.Returned')}}</th>
                                    <th>{{trans('file.Unit Price')}}</th>
                                    <th>{{trans('file.Tax')}}</th>
                                    <th>{{trans('file.Discount')}}</th>
                                    <th>{{trans('file.Subtotal')}}</th>
                                    <th>{{trans('file.Delivered')}}</th>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                            <div id="sale-footer" class="modal-body"></div>
                        </div>
                    </div>
                </div>
                <!-- add cash register modal -->
                <div id="cash-register-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
                    <div role="document" class="modal-dialog">
                        <div class="modal-content">
                            {!! Form::open(['route' => 'cashRegister.store', 'method' => 'post']) !!}
                            <div class="modal-header">
                                <h5 id="exampleModalLabel" class="modal-title">{{trans('file.Add Cash Register')}}</h5>
                                <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true"><i class="dripicons-cross"></i></span></button>
                            </div>
                            <div class="modal-body">
                                <p class="italic"><small>{{trans('file.The field labels marked with * are required input fields')}}.</small></p>
                                <div class="row">
                                    <div class="col-md-6 form-group warehouse-section">
                                        <label>{{trans('file.Warehouse')}} *</strong> </label>
                                        <select required name="warehouse_id" class="selectpicker form-control" data-live-search="true" data-live-search-style="begins" title="Select warehouse...">
                                            @foreach($lims_warehouse_list as $warehouse)
                                            <option value="{{$warehouse->id}}">{{$warehouse->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label>{{trans('file.Cash in Hand')}} *</strong> </label>
                                        <input type="number" step="any" name="cash_in_hand" required class="form-control">
                                    </div>
                                    <div class="col-md-12 form-group">
                                        <button type="submit" class="btn btn-primary">{{trans('file.submit')}}</button>
                                    </div>
                                </div>
                            </div>
                            {{ Form::close() }}
                        </div>
                    </div>
                </div>
                <!-- cash register details modal -->
                <div id="register-details-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
                    <div role="document" class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 id="exampleModalLabel" class="modal-title">{{trans('file.Cash Register Details')}}</h5>
                                <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true"><i class="dripicons-cross"></i></span></button>
                            </div>
                            <div class="modal-body">
                                <p>{{trans('file.Please review the transaction and payments.')}}</p>
                                <div class="row">
                                    <div class="col-md-12">
                                        <table class="table table-hover">
                                            <tbody>
                                                <tr>
                                                    <td>{{trans('file.Cash in Hand')}}:</td>
                                                    <td id="cash_in_hand" class="text-right">0</td>
                                                </tr>
                                                <tr>
                                                    <td>{{trans('file.Total Sale Amount')}}:</td>
                                                    <td id="total_sale_amount" class="text-right"></td>
                                                </tr>
                                                <tr>
                                                    <td>{{trans('file.Total Payment')}}:</td>
                                                    <td id="total_payment" class="text-right"></td>
                                                </tr>
                                                @if(in_array("cash",$options))
                                                <tr>
                                                    <td>{{trans('file.Cash Payment')}}:</td>
                                                    <td id="cash_payment" class="text-right"></td>
                                                </tr>
                                                @endif
                                                @if(in_array("card",$options))
                                                <tr>
                                                    <td>{{trans('file.Credit Card Payment')}}:</td>
                                                    <td id="credit_card_payment" class="text-right"></td>
                                                </tr>
                                                @endif
                                                @if(in_array("cheque",$options))
                                                <tr>
                                                    <td>{{trans('file.Cheque Payment')}}:</td>
                                                    <td id="cheque_payment" class="text-right"></td>
                                                </tr>
                                                @endif
                                                @if(in_array("gift_card",$options))
                                                <tr>
                                                    <td>{{trans('file.Gift Card Payment')}}:</td>
                                                    <td id="gift_card_payment" class="text-right"></td>
                                                </tr>
                                                @endif
                                                @if(in_array("deposit",$options))
                                                <tr>
                                                    <td>{{trans('file.Deposit Payment')}}:</td>
                                                    <td id="deposit_payment" class="text-right"></td>
                                                </tr>
                                                @endif
                                                @if(in_array("paypal",$options) && (strlen(env('PAYPAL_LIVE_API_USERNAME'))>0) && (strlen(env('PAYPAL_LIVE_API_PASSWORD'))>0) && (strlen(env('PAYPAL_LIVE_API_SECRET'))>0))
                                                <tr>
                                                    <td>{{trans('file.Paypal Payment')}}:</td>
                                                    <td id="paypal_payment" class="text-right"></td>
                                                </tr>
                                                @endif
                                                <tr>
                                                    <td>{{trans('file.Total Sale Return')}}:</td>
                                                    <td id="total_sale_return" class="text-right"></td>
                                                </tr>
                                                <tr>
                                                    <td>{{trans('file.Total Expense')}}:</td>
                                                    <td id="total_expense" class="text-right"></td>
                                                </tr>
                                                <tr>
                                                    <td><strong>{{trans('file.Total Cash')}}:</strong></td>
                                                    <td id="total_cash" class="text-right"></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="col-md-6" id="closing-section">
                                        <form action="{{route('cashRegister.close')}}" method="POST">
                                            @csrf
                                            <input type="hidden" name="cash_register_id">
                                            <button type="submit" class="btn btn-primary">{{trans('file.Close Register')}}</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- today sale modal -->
                <div id="today-sale-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
                    <div role="document" class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 id="exampleModalLabel" class="modal-title">{{trans('file.Today Sale')}}</h5>
                                <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true"><i class="dripicons-cross"></i></span></button>
                            </div>
                            <div class="modal-body">
                                <p>{{trans('file.Please review the transaction and payments.')}}</p>
                                <div class="row">
                                    <div class="col-md-12">
                                        <table class="table table-hover">
                                            <tbody>
                                                <tr>
                                                    <td>{{trans('file.Total Sale Amount')}}:</td>
                                                    <td class="total_sale_amount text-right"></td>
                                                </tr>
                                                <tr>
                                                    <td>{{trans('file.Cash Payment')}}:</td>
                                                    <td class="cash_payment text-right"></td>
                                                </tr>
                                                <tr>
                                                    <td>{{trans('file.Credit Card Payment')}}:</td>
                                                    <td class="credit_card_payment text-right"></td>
                                                </tr>
                                                <tr>
                                                    <td>{{trans('file.Cheque Payment')}}:</td>
                                                    <td class="cheque_payment text-right"></td>
                                                </tr>
                                                <tr>
                                                    <td>{{trans('file.Gift Card Payment')}}:</td>
                                                    <td class="gift_card_payment text-right"></td>
                                                </tr>
                                                <tr>
                                                    <td>{{trans('file.Deposit Payment')}}:</td>
                                                    <td class="deposit_payment text-right"></td>
                                                </tr>
                                                @if(in_array("paypal",$options) && (strlen(env('PAYPAL_LIVE_API_USERNAME'))>0) && (strlen(env('PAYPAL_LIVE_API_PASSWORD'))>0) && (strlen(env('PAYPAL_LIVE_API_SECRET'))>0))
                                                <tr>
                                                    <td>{{trans('file.Paypal Payment')}}:</td>
                                                    <td class="paypal_payment text-right"></td>
                                                </tr>
                                                @endif
                                                <tr>
                                                    <td>{{trans('file.Total Payment')}}:</td>
                                                    <td class="total_payment text-right"></td>
                                                </tr>
                                                <tr>
                                                    <td>{{trans('file.Total Sale Return')}}:</td>
                                                    <td class="total_sale_return text-right"></td>
                                                </tr>
                                                <tr>
                                                    <td>{{trans('file.Total Expense')}}:</td>
                                                    <td class="total_expense text-right"></td>
                                                </tr>
                                                <tr>
                                                    <td><strong>{{trans('file.Total Cash')}}:</strong></td>
                                                    <td class="total_cash text-right"></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- today profit modal -->
                <div id="today-profit-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
                    <div role="document" class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 id="exampleModalLabel" class="modal-title">{{trans('file.Today Profit')}}</h5>
                                <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true"><i class="dripicons-cross"></i></span></button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <select required name="warehouseId" class="form-control">
                                            <option value="0">{{trans('file.All Warehouse')}}</option>
                                            @foreach($lims_warehouse_list as $warehouse)
                                            <option value="{{$warehouse->id}}">{{$warehouse->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-12 mt-2">
                                        <table class="table table-hover">
                                            <tbody>
                                                <tr>
                                                    <td>{{trans('file.Product Revenue')}}:</td>
                                                    <td class="product_revenue text-right"></td>
                                                </tr>
                                                <tr>
                                                    <td>{{trans('file.Product Cost')}}:</td>
                                                    <td class="product_cost text-right"></td>
                                                </tr>
                                                <tr>
                                                    <td>{{trans('file.Expense')}}:</td>
                                                    <td class="expense_amount text-right"></td>
                                                </tr>
                                                <tr>
                                                    <td><strong>{{trans('file.Profit')}}:</strong></td>
                                                    <td class="profit text-right"></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</section>
<section id="print-layout" class="">
</section>

@endsection


@push('scripts')
<script src="https://unpkg.com/html5-qrcode@2.0.9/dist/html5-qrcode.min.js"></script>
<script>
    const openScannerBtn = document.getElementById("openScannerBtn");
    const closeScannerBtn = document.getElementById("closeScannerBtn");
    const scannerContainer = document.getElementById("scannerContainer");
    const qrScannerDiv = document.getElementById("qrScanner");
    const scannedCodeInput = document.getElementById("lims_productcodeSearch");

    let html5QrCode;

    openScannerBtn.addEventListener("click", function () {
        qrScannerDiv.style.display = "block";
        scannerContainer.style.display = "block";
        closeScannerBtn.style.display = "inline-block";
        //openScannerBtn.style.display = "none";

        // Initialize Html5Qrcode
        html5QrCode = new Html5Qrcode("qrScanner");

        // Start the scanner
        html5QrCode.start(
            { facingMode: "environment" }, // Use the back camera
            { fps: 10, qrbox: { width: 250, height: 250 } },
            (decodedText, decodedResult) => {
                console.log(`Scanned result: ${decodedText}`);

                // Set the scanned result into the input field
                scannedCodeInput.value = decodedText;

                // Trigger input event to invoke autocomplete and related logic
                $(scannedCodeInput).trigger("input");

                // Stop the scanner after successful scan
                html5QrCode.stop().then(() => {
                    qrScannerDiv.style.display = "none";
                    scannerContainer.style.display = "none";
                    closeScannerBtn.style.display = "none";
                    //openScannerBtn.style.display = "inline-block";
                }).catch(err => console.error(`Error stopping scanner: ${err}`));
            },
            errorMessage => {
                console.warn(`Scan error: ${errorMessage}`);
            }
        ).catch(err => console.error(`Error starting scanner: ${err}`));

    });

    closeScannerBtn.addEventListener("click", function () {
        if (html5QrCode) {
            html5QrCode.stop().then(() => {
                //qrScannerDiv.style.display = "none";
                scannerContainer.style.display = "none";
                closeScannerBtn.style.display = "none";
                openScannerBtn.style.display = "inline-block";
            }).catch(err => console.error(`Error stopping scanner: ${err}`));
        }
    });


    $(window).on('load',function(){
        $.get('{{url("/sales/getfeatured")}}/', function(data) {
            populateProduct(data);
        });

        $.get('{{url("/sales/recent-sale")}}/', function(data) {
            populateRecentSale(data);
        });

        $.get('{{url("/sales/recent-draft")}}/', function(data) {
            populateRecentDraft(data);
        });
    })

    // Load more
    var quit = 0;
    var next_page_url = '{{url("/")}}/sales/getfeatured?page=2';

    $(document).on('click', '.load-more', function() {
        // console.log(next_page_url);
        if (quit < 1) {
            loadMoreData();
        }
    });

    function loadMoreData() {
        if (!next_page_url) {
            quit = 1; // If no more pages, stop loading
            $('.load-more').attr("disabled", true);
            return;
        }
        $.ajax({
            url: next_page_url,
            type: "get",
        }).done(function(response) {
            if (response.data['name'].length > 0) {
                appendProduct(response.data); // Append data to the div

                // Update next_page_url for the next request
                next_page_url = response.next_page_url;
            } else {
                quit = 1; // Stop requesting if no more data
            }
        }).fail(function(jqXHR, ajaxOptions, thrownError) {
            quit = 1;
            // console.log('Server not responding...');
        });
    }


    $("ul#sale").siblings('a').attr('aria-expanded','true');
    $("ul#sale").addClass("show");
    $("ul#sale #sale-pos-menu").addClass("active");

    var isMobile = false;
    if (($(window).width() < 767)) {
        isMobile = true;
    }

    if(isMobile ==  true){
        $('.table-container').hide();
        $('.more-payment-options > div > div').addClass('dropdown-menu');
        $('#collapseProducts').addClass('collapse');
        $('#grand-total-m').html($('input[name="grand_total"]').val());
    }

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    @if(config('database.connections.saleprosaas_landlord'))
        numberOfInvoice = <?php echo json_encode($numberOfInvoice)?>;
    $.ajax({
            type: 'GET',
            async: false,
            url: '{{route("package.fetchData", $general_setting->package_id)}}',
            success: function(data) {
                if(data['number_of_invoice'] > 0 && data['number_of_invoice'] <= numberOfInvoice) {
                    localStorage.setItem("message", "You don't have permission to create another invoice as you already exceed the limit! Subscribe to another package if you wants more!");
                    location.href = "{{route('sales.index')}}";
                }
            }
        });
    @endif

    @if(session()->get('message') == 'Sale successfully added to draft')
        localStorage.clear();
    @endif

    @if($lims_pos_setting_data)
    var public_key = <?php echo json_encode($lims_pos_setting_data->stripe_public_key) ?>;
    @endif
    var without_stock = <?php echo json_encode($general_setting->without_stock) ?>;
    var alert_product = <?php echo json_encode($alert_product) ?>;
    var currency = <?php echo json_encode($currency) ?>;
    var valid;
    var authUser = <?php echo json_encode($authUser) ?>;
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
    var wholesale_price = [];
    var cost = [];
    var product_discount = [];
    var tax_rate = [];
    var tax_name = [];
    var tax_method = [];
    var unit_name = [];
    var unit_operator = [];
    var unit_operation_value = [];
    var is_imei = [];
    var is_variant = [];
    var gift_card_amount = [];
    var gift_card_expense = [];

    // temporary array
    var temp_unit_name = [];
    var temp_unit_operator = [];
    var temp_unit_operation_value = [];

    var deposit = <?php echo json_encode($deposit) ?>;
    var points = <?php echo json_encode($points) ?>;
    var reward_point_setting = <?php echo json_encode($lims_reward_point_setting_data) ?>;

    @if($lims_pos_setting_data)
    var product_row_number = <?php echo json_encode($lims_pos_setting_data->product_number) ?>;
    @endif
    var rowindex;
    var customer_group_rate;
    var row_product_price;
    var pos;
    var keyboard_active = <?php echo json_encode($keybord_active); ?>;
    var role_id = <?php echo json_encode(\Auth::user()->role_id) ?>;
    var warehouse_id = <?php echo json_encode(\Auth::user()->warehouse_id) ?>;
    //console.log(warehouse_id);
    var biller_id = <?php echo json_encode(\Auth::user()->biller_id) ?>;
    var coupon_list = <?php echo json_encode($lims_coupon_list) ?>;
    var currency = <?php echo json_encode($currency) ?>;
    var currencyChange = false;
    $('#currency').val(currency['id']);

    $('#currency').change(function(){
        var rate = $(this).find(':selected').data('rate');
        var currency_id = $(this).val();
        $('#exchange_rate').val(rate);
        //$('input[name="currency_id"]').val(currency_id);
        currency['exchange_rate'] = rate;
        $("table.order-list tbody .qty").each(function(index) {
            rowindex = index;
            currencyChange = true;
            checkDiscount($(this).val(), true);
            couponDiscount();
        });
    });

    var localStorageQty = [];
    var localStorageProductId = [];
    var localStorageProductDiscount = [];
    var localStorageTaxRate = [];
    var localStorageNetUnitPrice = [];
    var localStorageTaxValue = [];
    var localStorageTaxName = [];
    var localStorageTaxMethod = [];
    var localStorageSubTotalUnit = [];
    var localStorageSubTotal = [];
    var localStorageProductCode = [];
    var localStorageSaleUnit = [];
    var localStorageTempUnitName = [];
    var localStorageSaleUnitOperator = [];
    var localStorageSaleUnitOperationValue = [];

    $("#reference-no").val(getSavedValue("reference-no"));
    $("#order-discount").val(getSavedValue("order-discount"));
    $("#order-discount-val").val(getSavedValue("order-discount-val"));
    $("#order-discount-type").val(getSavedValue("order-discount-type"));
    $("#order-tax-rate-select").val(getSavedValue("order-tax-rate-select"));


    $("#shipping-cost-val").val(getSavedValue("shipping-cost-val"));

    @if(!isset($lims_sale_data))
    if(localStorage.getItem("tbody-id")) {
    $("#tbody-id").html(localStorage.getItem("tbody-id"));
    }
    @endif

    function saveValue(e) {
        var id = e.id;  // get the sender's id to save it.
        var val = e.value; // get the value.
        localStorage.setItem(id, val);// Every time user writing something, the localStorage's value will override.
    }
    //get the saved value function - return the value of "v" from localStorage.
    function getSavedValue  (v) {
        if (!localStorage.getItem(v)) {
            return "";// You can change this to your defualt value.
        }
        return localStorage.getItem(v);
    }

    if(getSavedValue("localStorageQty")) {
        localStorageQty = getSavedValue("localStorageQty").split(",");
        localStorageProductDiscount = getSavedValue("localStorageProductDiscount").split(",");
        localStorageTaxRate = getSavedValue("localStorageTaxRate").split(",");
        localStorageNetUnitPrice = getSavedValue("localStorageNetUnitPrice").split(",");
        localStorageTaxValue = getSavedValue("localStorageTaxValue").split(",");
        localStorageTaxName = getSavedValue("localStorageTaxName").split(",");
        localStorageTaxMethod = getSavedValue("localStorageTaxMethod").split(",");
        localStorageSubTotalUnit = getSavedValue("localStorageSubTotalUnit").split(",");
        localStorageSubTotal = getSavedValue("localStorageSubTotal").split(",");
        localStorageProductId = getSavedValue("localStorageProductId").split(",");
        localStorageProductCode = getSavedValue("localStorageProductCode").split(",");
        localStorageSaleUnit = getSavedValue("localStorageSaleUnit").split(",");
        localStorageTempUnitName = getSavedValue("localStorageTempUnitName").split(",,");
        localStorageSaleUnitOperator = getSavedValue("localStorageSaleUnitOperator").split(",,");
        localStorageSaleUnitOperationValue = getSavedValue("localStorageSaleUnitOperationValue").split(",,");
        /*localStorageQty.pop();
        localStorage.setItem("localStorageQty", localStorageQty);*/
        for(var i = 0; i < localStorageQty.length; i++) {
            $('table.order-list tbody tr:nth-child(' + (i + 1) + ') .qty').val(localStorageQty[i]);
            $('table.order-list tbody tr:nth-child(' + (i + 1) + ')').find('.discount-value').val(localStorageProductDiscount[i]);
            $('table.order-list tbody tr:nth-child(' + (i + 1) + ')').find('.tax-rate').val(localStorageTaxRate[i]);
            $('table.order-list tbody tr:nth-child(' + (i + 1) + ')').find('.net_unit_price').val(localStorageNetUnitPrice[i]);
            $('table.order-list tbody tr:nth-child(' + (i + 1) + ')').find('.tax-value').val(localStorageTaxValue[i]);
            $('table.order-list tbody tr:nth-child(' + (i + 1) + ')').find('.tax-name').val(localStorageTaxName[i]);
            $('table.order-list tbody tr:nth-child(' + (i + 1) + ')').find('.tax-method').val(localStorageTaxMethod[i]);
            $('table.order-list tbody tr:nth-child(' + (i + 1) + ')').find('.product-price').text(localStorageSubTotalUnit[i]);
            $('table.order-list tbody tr:nth-child(' + (i + 1) + ')').find('.sub-total').text(localStorageSubTotal[i]);
            $('table.order-list tbody tr:nth-child(' + (i + 1) + ')').find('.subtotal-value').val(localStorageSubTotal[i]);
            $('table.order-list tbody tr:nth-child(' + (i + 1) + ')').find('.product-id').val(localStorageProductId[i]);
            $('table.order-list tbody tr:nth-child(' + (i + 1) + ')').find('.product-code').val(localStorageProductCode[i]);
            $('table.order-list tbody tr:nth-child(' + (i + 1) + ')').find('.sale-unit').val(localStorageSaleUnit[i]);
            if(i==0) {
                localStorageTempUnitName[i] += ',';
                localStorageSaleUnitOperator[i] += ',';
                localStorageSaleUnitOperationValue[i] += ',';
            }
            $('table.order-list tbody tr:nth-child(' + (i + 1) + ')').find('.sale-unit-operator').val(localStorageSaleUnitOperator[i]);
            $('table.order-list tbody tr:nth-child(' + (i + 1) + ')').find('.sale-unit-operation-value').val(localStorageSaleUnitOperationValue[i]);

            product_price.push(parseFloat($('table.order-list tbody tr:nth-child(' + (i + 1) + ')').find('.product_price').val()));
            var quantity = parseFloat($('table.order-list tbody tr:nth-child(' + (i + 1) + ')').find('.qty').val());
            product_discount.push(parseFloat(localStorageProductDiscount[i] / localStorageQty[i]).toFixed({{$general_setting->decimal}}));
            tax_rate.push(parseFloat($('table.order-list tbody tr:nth-child(' + (i + 1) + ')').find('.tax-rate').val()));
            tax_name.push($('table.order-list tbody tr:nth-child(' + (i + 1) + ')').find('.tax-name').val());
            tax_method.push($('table.order-list tbody tr:nth-child(' + (i + 1) + ')').find('.tax-method').val());
            temp_unit_name = $('table.order-list tbody tr:nth-child(' + (i + 1) + ')').find('.sale-unit').val().split(',');
            unit_name.push(localStorageTempUnitName[i]);
            unit_operator.push($('table.order-list tbody tr:nth-child(' + (i + 1) + ')').find('.sale-unit-operator').val());
            unit_operation_value.push($('table.order-list tbody tr:nth-child(' + (i + 1) + ')').find('.sale-unit-operation-value').val());
            $('table.order-list tbody tr:nth-child(' + (i + 1) + ')').find('.sale-unit').val(temp_unit_name[0]);
            calculateTotal();
            //calculateRowProductData(localStorageQty[i]);
        }
    }


    $('.selectpicker').selectpicker({
    style: 'btn-link',
    });

    if(keyboard_active==1){

        $("input.numkey:text").keyboard({
            usePreview: false,
            layout: 'custom',
            display: {
            'accept'  : '&#10004;',
            'cancel'  : '&#10006;'
            },
            customLayout : {
            'normal' : ['1 2 3', '4 5 6', '7 8 9','0 {dec} {bksp}','{clear} {cancel} {accept}']
            },
            restrictInput : true, // Prevent keys not in the displayed keyboard from being typed in
            preventPaste : true,  // prevent ctrl-v and right click
            autoAccept : true,
            css: {
                // input & preview
                // keyboard container
                container: 'center-block dropdown-menu', // jumbotron
                // default state
                buttonDefault: 'btn btn-default',
                // hovered button
                buttonHover: 'btn-primary',
                // Action keys (e.g. Accept, Cancel, Tab, etc);
                // this replaces "actionClass" option
                buttonAction: 'active'
            },
        });

        $('input[type="text"]').keyboard({
            usePreview: false,
            autoAccept: true,
            autoAcceptOnEsc: true,
            css: {
                // input & preview
                // keyboard container
                container: 'center-block dropdown-menu', // jumbotron
                // default state
                buttonDefault: 'btn btn-default',
                // hovered button
                buttonHover: 'btn-primary',
                // Action keys (e.g. Accept, Cancel, Tab, etc);
                // this replaces "actionClass" option
                buttonAction: 'active',
                // used when disabling the decimal button {dec}
                // when a decimal exists in the input area
                buttonDisabled: 'disabled'
            },
            change: function(e, keyboard) {
                    keyboard.$el.val(keyboard.$preview.val())
                    keyboard.$el.trigger('propertychange')
                }
        });

        $('textarea').keyboard({
            usePreview: false,
            autoAccept: true,
            autoAcceptOnEsc: true,
            css: {
                // input & preview
                // keyboard container
                container: 'center-block dropdown-menu', // jumbotron
                // default state
                buttonDefault: 'btn btn-default',
                // hovered button
                buttonHover: 'btn-primary',
                // Action keys (e.g. Accept, Cancel, Tab, etc);
                // this replaces "actionClass" option
                buttonAction: 'active',
                // used when disabling the decimal button {dec}
                // when a decimal exists in the input area
                buttonDisabled: 'disabled'
            },
            change: function(e, keyboard) {
                    keyboard.$el.val(keyboard.$preview.val())
                    keyboard.$el.trigger('propertychange')
                }
        });

        $('#lims_productcodeSearch').keyboard().autocomplete().addAutocomplete({
            // add autocomplete window positioning
            // options here (using position utility)
            position: {
            of: '#lims_productcodeSearch',
            my: 'top+18px',
            at: 'center',
            collision: 'flip'
            }
        });
    }
    // Add More Button of Multiple Payment Modal
    $('.add-more').on("click", function(e) {
        e.preventDefault();

        var htmlText = `<div class="row new-row">
                            <div class="col-md-3 col-6 mt-2 paying-amount-container">
                                <label>{{trans('file.Paying Amount')}} *</label>
                                <input type="text" name="paid_amount[]" value="0" class="form-control paid_amount numkey" step="any">
                            </div>
                            <div class="col-md-3 col-6 mt-2">
                                <input type="hidden" name="paid_by_id[]">
                                <label>{{trans('file.Paid By')}}</label>
                                <select name="paid_by_id_select[]" class="form-control selectpicker">
                                    @if(in_array("cash",$options))
                                    <option value="1">Cash</option>
                                    @endif
                                    @if(in_array("gift_card",$options))
                                    <option value="2">Gift Card</option>
                                    @endif
                                    @if(in_array("card",$options))
                                    <option value="3">Credit Card</option>
                                    @endif
                                    @if(in_array("cheque",$options))
                                    <option value="4">Cheque</option>
                                    @endif
                                    @if(in_array("paypal",$options) && (strlen(env('PAYPAL_LIVE_API_USERNAME'))>0) && (strlen(env('PAYPAL_LIVE_API_PASSWORD'))>0) && (strlen(env('PAYPAL_LIVE_API_SECRET'))>0))
                                    <option value="5">Paypal</option>
                                    @endif
                                    @if(in_array("deposit",$options))
                                    <option value="6">Deposit</option>
                                    @endif
                                    @if($lims_reward_point_setting_data && $lims_reward_point_setting_data->is_active)
                                    <option value="7">Points</option>
                                    @endif
                                </select>
                            </div>
                            <div class="col-md-3 col-5 mt-2 cash-received-container">
                                <label>{{trans('file.Cash Received')}} *</label>
                                <input type="text" name="paying_amount[]" class="form-control paying_amount numkey" required step="any">
                            </div>
                            <div class="col-1 mt-2">
                                <button class="btn btn-danger remove-row mt-4">X</button>
                            </div></div>`;
        $('.add-more-row').before(htmlText);
        var total_paid_amount = 0;
        $('.paid_amount').each(function(){
            var value = parseFloat($(this).val()) || 0;
            total_paid_amount += value;

        });
        var more_to_pay = ($("#grand-total").text() - total_paid_amount).toFixed({{$general_setting->decimal}});
        $('.paid_amount:last').val(more_to_pay);
        $('.paying_amount:last').val(more_to_pay);
        $('.selectpicker').selectpicker('refresh');
        if ($('.qc').length) {
            $('.qc').data('initial', 1); // Update the data attribute
        }
        calculatePayingAmount();
    });

    $(document).on("click", ".remove-row", function() {
        $(this).parent().parent().remove();
        calculatePayingAmount();
        updateChange();
    });

    $('.customer-submit-btn').on("click", function() {
        $.ajax({
            type:'POST',
            url:'{{route('customer.store')}}',
            data: $("#customer-form").serialize(),
            success:function(response) {
                key = response['id'];
                value = response['name']+' ['+response['phone_number']+']';
                $('select[name="customer_id"]').append('<option value="'+ key +'">'+ value +'</option>');
                $('select[name="customer_id"]').val(key);
                $('.selectpicker').selectpicker('refresh');
                $("#addCustomer").modal('hide');
            }
        });
    });

    $("li#notification-icon").on("click", function (argument) {
        $.get('notifications/mark-as-read', function(data) {
            $("span.notification-number").text(alert_product);
        });
    });

    $("#register-details-btn").on("click", function (e) {
        e.preventDefault();
        $.ajax({
            url: '{{url("/cash-register/showDetails/")}}/'+warehouse_id,
            type: "GET",
            success:function(data) {
                $('#register-details-modal #cash_in_hand').text(data['cash_in_hand']);
                $('#register-details-modal #total_sale_amount').text(data['total_sale_amount']);
                $('#register-details-modal #total_payment').text(data['total_payment']);
                $('#register-details-modal #cash_payment').text(data['cash_payment']);
                $('#register-details-modal #credit_card_payment').text(data['credit_card_payment']);
                $('#register-details-modal #cheque_payment').text(data['cheque_payment']);
                $('#register-details-modal #gift_card_payment').text(data['gift_card_payment']);
                $('#register-details-modal #deposit_payment').text(data['deposit_payment']);
                $('#register-details-modal #paypal_payment').text(data['paypal_payment']);
                $('#register-details-modal #total_sale_return').text(data['total_sale_return']);
                $('#register-details-modal #total_expense').text(data['total_expense']);
                $('#register-details-modal #total_cash').text(data['total_cash']);
                $('#register-details-modal input[name=cash_register_id]').val(data['id']);
            }
        });
        $('#register-details-modal').modal('show');
    });

    $("#today-sale-btn").on("click", function (e) {
        e.preventDefault();
        $.ajax({
            url: 'sales/today-sale/',
            type: "GET",
            success:function(data) {
                $('#today-sale-modal .total_sale_amount').text(data['total_sale_amount']);
                $('#today-sale-modal .total_payment').text(data['total_payment']);
                $('#today-sale-modal .cash_payment').text(data['cash_payment']);
                $('#today-sale-modal .credit_card_payment').text(data['credit_card_payment']);
                $('#today-sale-modal .cheque_payment').text(data['cheque_payment']);
                $('#today-sale-modal .gift_card_payment').text(data['gift_card_payment']);
                $('#today-sale-modal .deposit_payment').text(data['deposit_payment']);
                $('#today-sale-modal .paypal_payment').text(data['paypal_payment']);
                $('#today-sale-modal .total_sale_return').text(data['total_sale_return']);
                $('#today-sale-modal .total_expense').text(data['total_expense']);
                $('#today-sale-modal .total_cash').text(data['total_cash']);
            }
        });
        $('#today-sale-modal').modal('show');
    });

    $("#today-profit-btn").on("click", function (e) {
        e.preventDefault();
        calculateTodayProfit(0);
    });

    $("#today-profit-modal select[name=warehouseId]").on("change", function() {
        calculateTodayProfit($(this).val());
    });

    function calculateTodayProfit(warehouse_id) {
        $.ajax({
                url: 'sales/today-profit/' + warehouse_id,
                type: "GET",
                success:function(data) {
                    $('#today-profit-modal .product_revenue').text(data['product_revenue']);
                    $('#today-profit-modal .product_cost').text(data['product_cost']);
                    $('#today-profit-modal .expense_amount').text(data['expense_amount']);
                    $('#today-profit-modal .profit').text(data['profit']);
                }
            });
        $('#today-profit-modal').modal('show');
    }

    if(role_id > 2){
        //$('#biller_id').parent().parent().parent().addClass('d-none');
        //$('#warehouse_id').parent().parent().parent().addClass('d-none');
        $('select[name=warehouse_id]').val(warehouse_id);
        $('select[name=biller_id]').val(biller_id);
        $('.selectpicker').selectpicker('refresh');
        // console.log(warehouse_id + '|' +biller_id);
        isCashRegisterAvailable(warehouse_id);
    }
    else {
        if(getSavedValue("warehouse_id")){
            warehouse_id = getSavedValue("warehouse_id");
            biller_id = getSavedValue("biller_id");
        }
        else {
            warehouse_id = $("input[name='warehouse_id_hidden']").val();
            biller_id = $("input[name='biller_id_hidden']").val();
        }
        //console.log(biller_id);
        $('select[name=warehouse_id]').val(warehouse_id);
        $('select[name=biller_id]').val(biller_id);
    }

    if(getSavedValue("biller_id")) {
        $('select[name=customer_id]').val(getSavedValue("customer_id"));
    }
    else {
        $('select[name=customer_id]').val($("input[name='customer_id_hidden']").val());
    }

    $('.selectpicker').selectpicker('refresh');

    var id = $("#customer_id").val();
    $.get('sales/getcustomergroup/' + id, function(data) {
        customer_group_rate = (data / 100);
    });

    var id = $("#warehouse_id").val();

    getProduct(warehouse_id);

    isCashRegisterAvailable(id);

    function isCashRegisterAvailable(warehouse_id) {
        $.ajax({
            url: 'cash-register/check-availability/'+warehouse_id,
            type: "GET",
            success:function(data) {
                if(data == 'false') {
                $("#register-details-btn").addClass('d-none');
                $('#cash-register-modal select[name=warehouse_id]').val(warehouse_id);

                if(role_id <= 2)
                    $("#cash-register-modal .warehouse-section").removeClass('d-none');
                else
                    $("#cash-register-modal .warehouse-section").addClass('d-none');

                $('.selectpicker').selectpicker('refresh');
                $("#cash-register-modal").modal('show');
                }
                else
                $("#register-details-btn").removeClass('d-none');
            }
        });
    }

    if(getSavedValue("biller_id")) {
        $('select[name=customer_id]').val(getSavedValue("customer_id"));
    }
    else {
        $('select[name=customer_id]').val($("input[name='customer_id_hidden']").val());
    }

    $('.selectpicker').selectpicker('refresh');

    var id = $("#customer_id").val();
    $.get('{{url("/")}}/sales/getcustomergroup/' + id, function(data) {
        customer_group_rate = (data / 100);
    });

    var id = $("#warehouse_id").val();
    getProduct(warehouse_id);

    isCashRegisterAvailable(id);

    function isCashRegisterAvailable(warehouse_id) {
        $.ajax({
            url: '{{url("/cash-register/check-availability")}}/'+warehouse_id,
            type: "GET",
            success:function(data) {
                if(data == 'false') {
                $("#register-details-btn").addClass('d-none');
                $('#cash-register-modal select[name=warehouse_id]').val(warehouse_id);

                if(role_id <= 2)
                    $("#cash-register-modal .warehouse-section").removeClass('d-none');
                else
                    $("#cash-register-modal .warehouse-section").addClass('d-none');

                $('.selectpicker').selectpicker('refresh');
                $("#cash-register-modal").modal('show');
                }
                else
                $("#register-details-btn").removeClass('d-none');
            }
        });
    }

    if(keyboard_active==1){
        $('#lims_productcodeSearch').bind('keyboardChange', function (e, keyboard, el) {
            var customer_id = $('#customer_id').val();
            var warehouse_id = $('#warehouse_id').val();
            var biller_id = $('#biller_id').val();
            temp_data = $('#lims_productcodeSearch').val();
            if(!customer_id){
                $('#lims_productcodeSearch').val(temp_data.substring(0, temp_data.length - 1));
                alert('Please select Customer!');
            }
            else if(!warehouse_id){
                $('#lims_productcodeSearch').val(temp_data.substring(0, temp_data.length - 1));
                alert('Please select Warehouse!');
            }
            else if(!biller_id){
                $('#lims_productcodeSearch').val(temp_data.substring(0, temp_data.length - 1));
                alert('Please select Biller!');
            }
            @if(in_array('restaurant',explode(',',$general_setting->modules)))
            else if(!table_id){
                $('#lims_productcodeSearch').val(temp_data.substring(0, temp_data.length - 1));
                alert('Please select Table!');
            }
            else if(!waiter_id){
                $('#lims_productcodeSearch').val(temp_data.substring(0, temp_data.length - 1));
                alert('Please select Waiter!');
            }
            @endif
        });
    }
    else{
        $('#lims_productcodeSearch').on('input', function(){
            var customer_id = $('#customer_id').val();
            var warehouse_id = $('#warehouse_id').val();
            var biller_id = $('#biller_id').val();
            temp_data = $('#lims_productcodeSearch').val();
            if(!customer_id){
                $('#lims_productcodeSearch').val(temp_data.substring(0, temp_data.length - 1));
                alert('Please select Customer!');
            }
            else if(!warehouse_id){
                $('#lims_productcodeSearch').val(temp_data.substring(0, temp_data.length - 1));
                alert('Please select Warehouse!');
            }
            else if(!biller_id){
                $('#lims_productcodeSearch').val(temp_data.substring(0, temp_data.length - 1));
                alert('Please select Warehouse!');
            }
            @if(in_array('restaurant',explode(',',$general_setting->modules)))
            else if(!table_id){
                $('#lims_productcodeSearch').val(temp_data.substring(0, temp_data.length - 1));
                alert('Please select Table!');
            }
            else if(!waiter_id){
                $('#lims_productcodeSearch').val(temp_data.substring(0, temp_data.length - 1));
                alert('Please select Waiter!');
            }
            @endif
        });
    }

    $("#print-btn").on("click", function(){
        var divToPrint=document.getElementById('sale-details');
        var newWin=window.open('','Print-Window');
        newWin.document.open();
        newWin.document.write('<link rel="stylesheet" href="<?php echo asset('vendor/bootstrap/css/bootstrap.min.css') ?>" type="text/css"><style type="text/css">@media print {.modal-dialog { max-width: 1000px;} }</style><body onload="window.print()">'+divToPrint.innerHTML+'</body>');
        //   newWin.document.close();
        //   setTimeout(function(){newWin.close();},10);
    });

    $(document).on('click','.btn-close', function(e){
        $('.filter-window').hide('slide', {direction: 'right'}, 'fast');
        if(isMobile == true){
            $(".table-container").hide();
        }
    });

    $('#category-filter').on('click', function(e){
        quit = 0;
        e.stopPropagation();
        $('.filter-window').show('slide', {direction: 'right'}, 'fast');
        $('.category').show();
        $('.brand').hide();
        $('.products-m').hide();
        $(".table-container").removeClass('brand').removeClass('featured').addClass('category');
    });

    $(document).on('click','.category-img', function(){
        var category_id = $(this).data('category');
        var brand_id = 0;
        $('.filter-window').hide('slide', {direction: 'right'}, 'fast');
        $(".table-container").children().remove();
        next_page_url = '{{url("/")}}/sales/getproduct/'+category_id+'/0?page=2';
        $.get('{{url("/sales/getproduct")}}/' + category_id + '/' + brand_id, function(response) {
            populateProduct(response);
        });
        if(isMobile == true){
            $('.filter-window').show('slide', {direction: 'right'}, 'fast');
        }
    });

    $('#brand-filter').on('click', function(e){
        quit = 0;
        e.stopPropagation();
        $('.filter-window').show('slide', {direction: 'right'}, 'fast');
        $('.brand').show();
        $('.category').hide();
        $('.products-m').hide();
        $(".table-container").removeClass('category').removeClass('featured').addClass('brand');
    });

    $(document).on('click','.brand-img', function(){
        var brand_id = $(this).data('brand');
        var category_id = 0;
        $('.filter-window').hide('slide', {direction: 'right'}, 'fast');
        $(".table-container").children().remove();
        next_page_url = '{{url("/")}}/sales/getproduct/0/'+brand_id+'?page=2';
        $.get('{{url("/sales/getproduct")}}/' + category_id + '/' + brand_id, function(data) {
            populateProduct(data);
        });
        if(isMobile == true){
            $('.filter-window').show('slide', {direction: 'right'}, 'fast');
        }
    });

    $('#featured-filter').on('click', function(e){
        quit = 0;

        next_page_url = '{{url("/")}}/sales/getfeatured?page=2';

        $(".table-container").removeClass('category').removeClass('brand').addClass('featured');

        $.get('{{url("/sales/getfeatured")}}/', function(data) {
            if (Object.keys(data).length != 0) {
                populateProduct(data);
            }
        });

        if(isMobile == true){
            e.stopPropagation();
            $(".product_list_mobile.table-container").show();
            $('.product_list_mobile').html('');
            var featured_products = $(".table-container .product-grid").clone();
            $('.product_list_mobile').html(featured_products);
            $('.filter-window').show('slide', {direction: 'right'}, 'fast');
            $('.brand').hide();
            $('.category').hide();
        }
      isCashRegisterAvailable(warehouse_id);
});

function getProduct(warehouse_id){
    console.log('index3');
    $.get('sales/getproduct/' + warehouse_id, function(data) {
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
        expired_date = data[10];
        product_batch_id = data[9];
        is_embeded = data[11];
        imei_number = data[12];

        // is_variant = [];
        $.each(product_code, function(index) {
            lims_product_array.push(product_code[index]+'|'+product_name[index]+'|'+imei_number[index]+'|'+is_embeded[index]);
        });
        // console.log(is_variant, 'getProduct');
        // console.log(data, 'getProduct');

        //updating in stock
        var rownumber = $('table.order-list tbody tr:last').index();
        for(rowindex  = 0; rowindex <= rownumber; rowindex++) {
            var row_product_code = $('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ')').find('.product-code').val();
            pos = product_code.indexOf(row_product_code);
            $('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ')').find('.in-stock').text(product_qty[pos]);
        }
    });
}



    function populateProduct(response) {
        console.log('index1');
        var tableData = '<div class="product-grid">';

        $.each(response.data['name'], function(index) {
            console.log('index4', index);
            var product_info = response.data['code'][index]+'|' + response.data['name'][index] + '|null|0';
            if(response.data['image'][index])
                image = response.data['image'][index];
            else
                image = 'zummXD2dvAtI.png';
            tableData += '<div class="product-img sound-btn" title="'+response.data['name'][index]+'" data-product = "'+product_info+'"><img  src="{{url("/images/product")}}/'+image+'" width="100%" /><p>'+response.data['name'][index]+'</p><span>'+response.data['code'][index]+'</span></div>';
        });
        tableData += '</div><button class="btn btn-primary btn-block load-more"><i class="dripicons-arrow-thin-down"</button>';
        $(".table-container").html(tableData);

        if(isMobile){
            $('.brand').hide();
            $('.category').hide();
            $('.products-m').show();
            $(".product_list_mobile.table-container").show();
        }else{
            $(".table-container").show();
        }
    }

    function appendProduct(data) {
        console.log('index2');
        var tableData = '';
        $.each(data['name'], function(index) {
        console.log('index',index);

            var product_info = data['code'][index]+'|' + data['name'][index] + '|null|0';
            if(data['image'][index])
                image = data['image'][index];
            else
                image = 'zummXD2dvAtI.png';
            tableData += '<div class="product-img sound-btn" title="'+data['name'][index]+'" data-product = "'+product_info+'"><img  src="{{url("/images/product")}}/'+image+'" width="100%" /><p>'+data['name'][index]+'</p><span>'+data['code'][index]+'</span></div>';
        });
        $(".table-container .product-grid").append(tableData);
    }

    function convertDate(isoDate) {
        var date = new Date(isoDate);
        var day = String(date.getDate()).padStart(2, '0');
        var month = String(date.getMonth() + 1).padStart(2, '0'); // Months are zero-based
        var year = date.getFullYear();

        if('{{$general_setting->date_format}}' == 'd-m-Y') {
            return day + '-' + month + '-' + year;
        } else if('{{$general_setting->date_format}}' == 'd/m/Y') {
            return day + '/' + month + '/' + year;
        } else if('{{$general_setting->date_format}}' == 'd.m.Y') {
            return day + '.' + month + '.' + year;
        } else if('{{$general_setting->date_format}}' == 'm-d-Y') {
            return month + '-' + day + '-' + year;
        } else if('{{$general_setting->date_format}}' == 'm/d/Y') {
            return month + '/' + day + '/' + year;
        } else if('{{$general_setting->date_format}}' == 'm.d.Y') {
            return month + '.' + day + '.' + year;
        } else if('{{$general_setting->date_format}}' == 'Y-m-d') {
            return year + '-' + month + '-' + day;
        } else if('{{$general_setting->date_format}}' == 'Y/m/d') {
            return year + '/' + month + '/' + day;
        } else if('{{$general_setting->date_format}}' == 'Y.m.d') {
            return year + '.' + month + '.' + day;
        }

    }

    var all_permission = '<?php echo json_encode($all_permission) ?>';



    $(document).on('click', '.view-sale', function() {
        sale_id = $(this).val();

        $.ajax({
            url: 'sales/get-sale/' + sale_id,
            type: 'GET',
            success: function(sale) {
                // console.log(sale, 'sale details from pos');
                saleDetails(sale);
            },
            error: function(xhr, status, error) {
                alert('Error: ' + error);
            }
        });
        $('#recentTransaction').modal('hide')
    });

    $(document).on('click', '#close-btn', function () {
        $('#recentTransaction').modal('show')
    });

    function saleDetails(sale){

        var htmltext = '<strong>{{trans("file.date")}}: </strong>'+sale[0]+
            '<br><strong>{{trans("file.reference")}}: </strong>'+sale[1]+
            '<br><strong>{{trans("file.Warehouse")}}: </strong>'+sale[27]+
            '<br><strong>{{trans("file.Sale Status")}}: </strong>'+sale[2]+
            '<br><strong>{{trans("file.Currency")}}: </strong>'+sale[31];

        if(sale[32])
            htmltext += '<br><strong>{{trans("file.Exchange Rate")}}: </strong>'+sale[32]+'<br>';
        else
            htmltext += '<br><strong>{{trans("file.Exchange Rate")}}: </strong>N/A<br>';
        if(sale[33])
            htmltext += '<strong>{{trans("file.Table")}}: </strong>'+sale[33]+'<br>';
        if(sale[30])
            htmltext += '<strong>{{trans("file.Attach Document")}}: </strong><a href="documents/sale/'+sale[30]+'">Download</a><br>';

        htmltext += '<br><div class="row"><div class="col-md-6"><strong>{{trans("file.From")}}:</strong><br>'+sale[3]+'<br>'+sale[4]+'<br>'+sale[5]+'<br>'+sale[6]+'<br>'+sale[7]+'<br>'+sale[8]+
        '</div><div class="col-md-6"><div class="float-right"><strong>{{trans("file.To")}}:</strong><br>'+sale[9]+'<br>'+sale[10]+'<br>'+sale[11]+'<br>'+sale[12]+'</div></div></div>';

        $.get('sales/product_sale/' + sale[13], function(data){
            console.log(data, '2469');
            $(".product-sale-list tbody").remove();
            var name_code = data[0];
            var qty = data[1];
            var unit_code = data[2];
            var tax = data[3];
            var tax_rate = data[4];
            var discount = data[5];
            var subtotal = data[6];
            var batch_no = data[7];
            var return_qty = data[8];
            var is_delivered = data[9];
            // Check if data[10] exists
            var toppings = data[10] ? data[10] : [];
            var total_qty = 0;
            var newBody = $("<tbody>");

            $.each(name_code, function(index){
                var newRow = $("<tr>");
                var cols = '';
                cols += '<td><strong>' + (index+1) + '</strong></td>';
                cols += '<td>' + name_code[index];

                // Append topping names if toppings[index] exists
                if (toppings[index]) {
                    try {
                        // Parse and extract topping names
                        var toppingData = JSON.parse(toppings[index]);
                        var toppingNames = toppingData.map(topping => topping.name).join(', ');
                        cols += ' (' + toppingNames + ')';
                    } catch (error) {
                        console.error('Error parsing toppings for index', index, toppings[index], error);
                    }
                }

                cols += '</td>';
                cols += '<td>' + batch_no[index] + '</td>';
                cols += '<td>' + qty[index] + ' ' + unit_code[index] + '</td>';
                cols += '<td>' + return_qty[index] + '</td>';
                // Calculate unit price
                var unitPrice = parseFloat(subtotal[index] / qty[index]).toFixed({{$general_setting->decimal}});

                // Calculate topping prices if toppings[index] exists
                var toppingPrices = '';
                if (toppings[index]) {
                    try {
                        var toppingData = JSON.parse(toppings[index]); // Parse topping data
                        toppingPrices = toppingData
                            .map(topping => parseFloat(topping.price).toFixed({{$general_setting->decimal}})) // Extract and format each topping price
                            .join(' + '); // Join prices with '+'
                    } catch (error) {
                        console.error('Error calculating topping prices for index', index, toppings[index], error);
                    }
                }

                cols += '<td>' + unitPrice + ' (' + toppingPrices + ')</td>';
                cols += '<td>' + tax[index] + '(' + tax_rate[index] + '%)' + '</td>';
                cols += '<td>' + discount[index] + '</td>';
                // Update subtotal to include topping prices
                var toppingPricesRowTotal = 0;
                if (toppings[index]) {
                    try {
                        var toppingData = JSON.parse(toppings[index]);
                        toppingPricesRowTotal = toppingData.reduce((sum, topping) => sum + parseFloat(topping.price), 0);
                    } catch (error) {
                        console.error('Error calculating topping prices for index', index, toppings[index], error);
                    }
                }
                subtotal[index] = parseFloat(subtotal[index]) + toppingPricesRowTotal;
                cols += '<td>' + subtotal[index].toFixed({{$general_setting->decimal}}) + '</td>';
                cols += '<td>' + is_delivered[index] + '</td>';
                total_qty += parseFloat(qty[index]);
                newRow.append(cols);
                newBody.append(newRow);
            });

            var newRow = $("<tr>");
            cols = '';
            cols += '<td colspan=3><strong>{{trans("file.Total")}}:</strong></td>';
            cols += '<td>' + total_qty + '</td>';
            cols += '<td colspan=2></td>';
            cols += '<td>' + sale[14] + '</td>';
            cols += '<td>' + sale[15] + '</td>';
            cols += '<td>' + sale[16] + '</td>';
            cols += '<td></td>';
            newRow.append(cols);
            newBody.append(newRow);

            var newRow = $("<tr>");
            cols = '';
            cols += '<td colspan=9><strong>{{trans("file.Order Tax")}}:</strong></td>';
            cols += '<td>' + sale[17] + '(' + sale[18] + '%)' + '</td>';
            newRow.append(cols);
            newBody.append(newRow);

            var newRow = $("<tr>");
            cols = '';
            cols += '<td colspan=9><strong>{{trans("file.Order Discount")}}:</strong></td>';
            cols += '<td>' + sale[19] + '</td>';
            newRow.append(cols);
            newBody.append(newRow);
            if(sale[28]) {
                var newRow = $("<tr>");
                cols = '';
                cols += '<td colspan=9><strong>{{trans("file.Coupon Discount")}} ['+sale[28]+']:</strong></td>';
                cols += '<td>' + sale[29] + '</td>';
                newRow.append(cols);
                newBody.append(newRow);
            }

            var newRow = $("<tr>");
            cols = '';
            cols += '<td colspan=9><strong>{{trans("file.Shipping Cost")}}:</strong></td>';
            cols += '<td>' + sale[20] + '</td>';
            newRow.append(cols);
            newBody.append(newRow);

            var newRow = $("<tr>");
            cols = '';
            cols += '<td colspan=9><strong>{{trans("file.grand total")}}:</strong></td>';
            cols += '<td>' + sale[21] + '</td>';
            newRow.append(cols);
            newBody.append(newRow);

            var newRow = $("<tr>");
            cols = '';
            cols += '<td colspan=9><strong>{{trans("file.Paid Amount")}}:</strong></td>';
            cols += '<td>' + sale[22] + '</td>';
            newRow.append(cols);
            newBody.append(newRow);

            var newRow = $("<tr>");
            cols = '';
            cols += '<td colspan=9><strong>{{trans("file.Due")}}:</strong></td>';
            cols += '<td>' + parseFloat(sale[21] - sale[22]).toFixed({{$general_setting->decimal}}) + '</td>';
            newRow.append(cols);
            newBody.append(newRow);

            $("table.product-sale-list").append(newBody);
        });
        var htmlfooter = '<p><strong>{{trans("file.Sale Note")}}:</strong> '+sale[23]+'</p><p><strong>{{trans("file.Staff Note")}}:</strong> '+sale[24]+'</p><strong>{{trans("file.Created By")}}:</strong><br>'+sale[25]+'<br>'+sale[26];
        $('#sale-content').html(htmltext);
        $('#sale-footer').html(htmlfooter);
        $('#sale-details').modal('show');
    }


    function populateRecentSale(data) {
        // console.log(data, '2521');
        var tableData = '';
        $.each(data, function(index,sale) {
            tableData += '<tr>';
            tableData += '<td>' + convertDate(sale.created_at) + '</td>';
            tableData += '<td>' + sale.reference_no + '</td>';
            tableData += '<td>' + sale.name + '</td>';
            tableData += '<td>' + sale.grand_total + '</td>';

            tableData += '<td>'

            // if (all_permission.includes("sales-edit")) {
                tableData += '<button  type="button" class="btn btn-success btn-sm view-sale" title="View" data-toggle="modal" data-target="#get-sale-details" value="' + sale.id + '"><i class="dripicons-preview"></i></button>&nbsp';
            // }
            if (all_permission.includes("sales-edit")) {
                tableData += '<a href="sales/' + sale.id + '/edit" class="btn btn-warning btn-sm" title="Edit"><i class="dripicons-document-edit"></i></a>&nbsp';
            }
            if (all_permission.includes("sales-delete")) {
                tableData += '<form class="d-inline" action="{{ url("/sales")}}/'+ sale.id +'" method ="POST"><input name="_method" type="hidden" value="DELETE">@csrf';
                tableData += '<button type="submit" class="btn btn-danger btn-sm" onclick="return confirmDelete()" title="Delete"><i class="dripicons-trash"></i></button>';
                tableData += '</form>';
            }
            tableData += '</td>'

            tableData += '</tr>';
        });

        $("#sale-latest tbody").html(tableData);
    }

    function populateRecentDraft(data) {
        var tableData = '';

        $.each(data, function(index,draft) {
            tableData += '<tr>';
            tableData += '<td>' + convertDate(draft.created_at) + '</td>';
            tableData += '<td>' + draft.reference_no + '</td>';
            tableData += '<td>' + draft.name + '</td>';
            tableData += '<td>' + draft.grand_total + '</td>';

            tableData += '<td>'

            if (all_permission.includes("sales-edit")) {
                tableData += '<a href="sales/' + draft.id + '/create" class="btn btn-warning btn-sm" title="Edit"><i class="dripicons-document-edit"></i></a>&nbsp';
            }

            if (all_permission.includes("sales-delete")) {
                tableData += '<form class="d-inline" action="{{ url("/sales")}}/'+ draft.id +'" method ="POST"><input name="_method" type="hidden" value="DELETE">@csrf';
                tableData += '<button type="submit" class="btn btn-danger btn-sm" onclick="return confirmDelete()" title="Delete"><i class="dripicons-trash"></i></button>';
                tableData += '</form>';
            }
            tableData += '</td>'

            tableData += '</tr>';
        });

        $("#draft-latest tbody").html(tableData);
    }

    $('select[name="customer_id"]').on('change', function() {
        saveValue(this);
        var id = $(this).val();
        $.get('{{url("/sales/getcustomergroup")}}/' + id, function(data) {
            customer_group_rate = (data / 100);
        });
    });

    $('select[name="biller_id"]').on('change', function() {
        saveValue(this);
    });

    $('#warehouse_id').on('change', function() {
        saveValue(this);
        warehouse_id = $(this).val();
        getProduct(warehouse_id);

        isCashRegisterAvailable(warehouse_id);
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
            }
            else if(ui.content.length == 0 && $('#lims_productcodeSearch').val().length == 13) {
                productSearch($('#lims_productcodeSearch').val()+'|'+1);
            }
        },
        select: function(event, ui) {
            var data = ui.item.value;
            ui.item.value = '';
            productSearch(data);
        },
    });

    $('#myTable').keyboard({
        accepted : function(event, keyboard, el) {
        checkQuantity(el.value, true);
    }
    });

    $("#myTable").on('click', '.plus', function() {
        rowindex = $(this).closest('tr').index();
        var qty = $('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ') .qty').val();
        if(!qty)
        qty = 1;
        else
        qty = parseFloat(qty) + 1;
        if(is_variant[rowindex])
            checkQuantity(String(qty), true);
        else
            checkDiscount(qty, true);
    });

    $("#myTable").on('click', '.minus', function() {
        rowindex = $(this).closest('tr').index();
        var qty = parseFloat($('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ') .qty').val()) - 1;
        if (qty > 0) {
            $('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ') .qty').val(qty);

            if(is_variant[rowindex])
                checkQuantity(String(qty), true);
            else
                checkDiscount(qty, '3');
        }
        else {
            qty = 1;
        }

    });

    $("select[name=price_option]").on("change", function () {
        $("#editModal input[name=edit_unit_price]").val($(this).val());
    });

    // $("#myTable").on("change", ".batch-no", function () {
    //     console.log('bbb');

    //     rowindex = $(this).closest('tr').index();
    //     var product_id = $('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ')').find('.product-id').val();
    //     var warehouse_id = $('#warehouse_id').val();
    //     $.get('check-batch-availability/' + product_id + '/' + $(this).val() + '/' + warehouse_id, function(data) {
    //         if(data['message'] != 'ok') {
    //             alert(data['message']);
    //             $('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ')').find('.batch-no').val('');
    //             $('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ')').find('.product-batch-id').val('');
    //             $('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ')').find('.net_unit_price').text('');
    //         }
    //         else {
    //             $('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ')').find('.product-batch-id').val(data['product_batch_id']);
    //             $('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ')').find('.net_unit_price').text(data['price']);
    //             code = $('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ')').find('.product-code').val();
    //             pos = product_code.indexOf(code);
    //             product_qty[pos] = data['qty'];
    //         product_price[0] = data['price'];
    //         }
    //         checkQuantity(String($('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ')').find('.qty').val()), true);
    //     });
    // });

    $("#myTable").on("change", ".batch-no1", function () {
        console.log('aadsdsda');

        var row = $(this).closest('tr'); // Get the closest table row
        var rowindex = row.index(); // Get row index
        console.log('rowindex', rowindex);

        var product_id = row.find('.product-id').val(); // Get product ID from the row
        var batch_no = $(this).val();

        var warehouse_id = $('#warehouse_id').val(); // Get warehouse ID

        console.log('product_id', product_id, 'batch_no', batch_no);

        var getBatchesUrl = "{{ url('check-batch-availability') }}";
        let url = getBatchesUrl + '/' + product_id + '/' + batch_no + '/' + warehouse_id;

        $.get(url, function (data) {

        // $.get('../check-batch-availability/' + product_id + '/' + batch_no + '/' + warehouse_id, function(data) {
            console.log('Response:', data);

            if (data['message'] !== 'ok') {
                alert(data['message']);

                // Reset batch details if not available
                row.find('.batch-no').val('');
                row.find('.product-batch-id').val('');
                row.find('.expired-date').text('');
                row.find('.net_unit_price').text('');
            } else {
                // Update batch details if available
                row.find('.product-batch-id').val(data['product_batch_id']);
                row.find('.expired-date').text(data['expired_date']);
                row.find('.net_unit_price').text(data['price']);

                var code = row.find('.product-code').val();
                var pos = product_code.indexOf(code);
                product_qty[pos] = data['qty'];
                product_price[0] = data['price'];

                console.log('Updated Quantity:', row.find('.qty').val());
            }

            // Call checkQuantity function to verify stock availability
            checkQuantity(String(row.find('.qty').val()), true);
        });
    });

    let previousqty = '';

    $("#myTable").on('focus', '.qty', function() {
        previousqty = $(this).val();
    });

    //Change quantity
    $("#myTable").on('input', '.qty', function() {
        rowindex = $(this).closest('tr').index();
        if($(this).val() < 0 && $(this).val() != '') {
            $('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ') .qty').val(1);
            alert("Quantity can't be less than 0");
        }
        if(is_variant[rowindex]){
            checkQuantity($(this).val(), true);
        }else{
            checkDiscount($(this).val(), 'input');
        }
    });

    $("#myTable").on('click', '.qty', function() {
        rowindex = $(this).closest('tr').index();
    });

    $(document).on('click', '.sound-btn', function() {
        var audio = $("#mysoundclip1")[0];
        audio.play();
    });

    $(document).on('click', '.product-img', function() {
        var customer_id = $('#customer_id').val();
        var warehouse_id = $('#warehouse_id').val();
        if(isMobile){
            $('.filter-window').hide('slide', {direction: 'right'}, 'fast');
        }
        if(!customer_id)
            alert('Please select Customer!');
        else if(!warehouse_id)
            alert('Please select Warehouse!');
        else{
            var data = $(this).data('product');
            product_info = data.split("|");
            pos = product_code.indexOf(product_info[0]);
            if(pos < 0)
                alert('Product is not avaialable in the selected warehouse');
            else{
                productSearch(data);
            }
        }
    });
    //Delete product
    $("table.order-list tbody").on("click", ".ibtnDel", function(event) {
        var audio = $("#mysoundclip2")[0];
        audio.play();
        rowindex = $(this).closest('tr').index();
        var qty = $('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ')').find('.qty').val();
        checkDiscount(qty,false);
        product_price.splice(rowindex, 1);
        wholesale_price.splice(rowindex, 1);
        product_discount.splice(rowindex, 1);
        tax_rate.splice(rowindex, 1);
        tax_name.splice(rowindex, 1);
        tax_method.splice(rowindex, 1);
        unit_name.splice(rowindex, 1);
        unit_operator.splice(rowindex, 1);
        unit_operation_value.splice(rowindex, 1);

        localStorageProductId.splice(rowindex, 1);
        localStorageQty.splice(rowindex, 1);
        localStorageSaleUnit.splice(rowindex, 1);
        localStorageProductDiscount.splice(rowindex, 1);
        localStorageTaxRate.splice(rowindex, 1);
        localStorageNetUnitPrice.splice(rowindex, 1);
        localStorageTaxValue.splice(rowindex, 1);
        localStorageSubTotalUnit.splice(rowindex, 1);
        localStorageSubTotal.splice(rowindex, 1);
        localStorageProductCode.splice(rowindex, 1);

        localStorageTaxName.splice(rowindex, 1);
        localStorageTaxMethod.splice(rowindex, 1);
        localStorageTempUnitName.splice(rowindex, 1);
        localStorageSaleUnitOperator.splice(rowindex, 1);
        localStorageSaleUnitOperationValue.splice(rowindex, 1);

        localStorage.setItem("localStorageProductId", localStorageProductId);
        localStorage.setItem("localStorageQty", localStorageQty);
        localStorage.setItem("localStorageSaleUnit", localStorageSaleUnit);
        localStorage.setItem("localStorageProductCode", localStorageProductCode);
        localStorage.setItem("localStorageProductDiscount", localStorageProductDiscount);
        localStorage.setItem("localStorageTaxRate", localStorageTaxRate);
        localStorage.setItem("localStorageTaxName", localStorageTaxName);
        localStorage.setItem("localStorageTaxMethod", localStorageTaxMethod);
        localStorage.setItem("localStorageTempUnitName", localStorageTempUnitName);
        localStorage.setItem("localStorageSaleUnitOperator", localStorageSaleUnitOperator);
        localStorage.setItem("localStorageSaleUnitOperationValue", localStorageSaleUnitOperationValue);
        localStorage.setItem("localStorageNetUnitPrice", localStorageNetUnitPrice);
        localStorage.setItem("localStorageTaxValue", localStorageTaxValue);
        localStorage.setItem("localStorageSubTotalUnit", localStorageSubTotalUnit);
        localStorage.setItem("localStorageSubTotal", localStorageSubTotal);

        $(this).closest("tr").remove();
        localStorage.setItem("tbody-id", $("table.order-list tbody").html());
        calculateTotal();
    });

    //Edit product
    $("table.order-list").on("click", ".edit-product", function() {
        rowindex = $(this).closest('tr').index();
        edit();
    });

    //Update product
    $('button[name="update_btn"]').on("click", function() {

        if(is_imei[rowindex]) {
            var imeiNumbers = '';
            $("#editModal .imei-numbers").each(function(i) {
                if (i)
                    imeiNumbers += ','+ $(this).val();
                else
                    imeiNumbers = $(this).val();
            });
            $('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ')').find('.imei-number').val(imeiNumbers);
        }

        var edit_discount = $('input[name="edit_discount"]').val();
        var edit_qty = $('input[name="edit_qty"]').val();
        var edit_unit_price = $('input[name="edit_unit_price"]').val();

        if (parseFloat(edit_discount) > parseFloat(edit_unit_price)) {
            alert('Invalid Discount Input!');
            return;
        }

        if(edit_qty < 0) {
            $('input[name="edit_qty"]').val(1);
            edit_qty = 1;
            alert("Quantity can't be less than 0");
        }

        var tax_rate_all = <?php echo json_encode($tax_rate_all) ?>;

        tax_rate[rowindex] = localStorageTaxRate[rowindex] = parseFloat(tax_rate_all[$('select[name="edit_tax_rate"]').val()]);
        tax_name[rowindex] = localStorageTaxName[rowindex] = $('select[name="edit_tax_rate"] option:selected').text();

        product_discount[rowindex] = $('input[name="edit_discount"]').val();
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

            unit_name[rowindex] = localStorageTempUnitName[rowindex] = temp_unit_name.toString() + ',';
            unit_operator[rowindex] = localStorageSaleUnitOperator[rowindex] = temp_unit_operator.toString() + ',';
            unit_operation_value[rowindex] = localStorageSaleUnitOperationValue[rowindex] = temp_unit_operation_value.toString() + ',';

            localStorage.setItem("localStorageTaxRate", localStorageTaxRate);
            localStorage.setItem("localStorageTaxName", localStorageTaxName);
            localStorage.setItem("localStorageTempUnitName", localStorageTempUnitName);
            localStorage.setItem("localStorageSaleUnitOperator", localStorageSaleUnitOperator);
            localStorage.setItem("localStorageSaleUnitOperationValue", localStorageSaleUnitOperationValue);
        }
        else {
            product_price[rowindex] = $('input[name="edit_unit_price"]').val();
        }
        checkDiscount(edit_qty, false);
    });

    $('button[name="order_discount_btn"]').on("click", function() {
        calculateGrandTotal();
    });

    $('button[name="shipping_cost_btn"]').on("click", function() {
        calculateGrandTotal();
    });

    $('button[name="order_tax_btn"]').on("click", function() {
        calculateGrandTotal();
    });

    $(".coupon-check").on("click",function() {
        couponDiscount();
    });

    $(".payment-btn").on("click", function() {
        var audio = $("#mysoundclip2")[0];
        audio.play();
        $('.paid_amount').val($("#grand-total").text());
        $('.paying_amount').val($("#grand-total").text());
        $('.qc').data('initial', 1);
    });

    $("#draft-btn").on("click",function(){
        var audio = $("#mysoundclip2")[0];
        audio.play();
        $('input[name="sale_status"]').val(3);
        $('input[name="paying_amount"]').prop('required',false);
        $('input[name="paid_amount"]').prop('required',false);
        var rownumber = $('table.order-list tbody tr:last').index();
        if (rownumber < 0) {
            alert("Please insert product to order table!")
        }
        else
            $('.payment-form').submit();
    });

    $("#submit-btn").on("click", function() {
        $('.payment-form').submit();
    });

    $("#gift-card-btn").on("click",function() {
        appendRemoveElement('gift-card');
    });

    $("#credit-card-btn").on("click",function() {
        appendRemoveElement('credit-card');
    });

    $("#cheque-btn").on("click",function() {
        appendRemoveElement('cheque');
    });

    $("#cash-btn").on("click",function() {
        appendRemoveElement('cash');
    });

    $("#moneipoint-btn").on("click",function() {
        appendRemoveElement('moneipoint');
    });

    $("#multiple-payment-btn").on("click",function() {
        appendRemoveElement('multiplepay');
    });

    $("#deposit-btn").on("click",function() {
        appendRemoveElement('deposit');
    });

    $("#point-btn").on("click",function() {
        appendRemoveElement('points');
    });

    function appendRemoveElement(className){
        ismultiplepayment = 0;
        $('.remove-element').remove();
        $('.selectpicker').selectpicker('refresh');
        $('select[name="paid_by_id_select[]"]').parent().parent().addClass('d-none');
        $('.paid_amount').parent().addClass('d-none');
        $('.paying_amount').parent().addClass('d-none');
        $('.add-more').parent().addClass('d-none');
        $('.total_payable').text($('#grand-total').text());
        $('.total_paying').text($('#grand-total').text());
        $('.due').text(0);
        $('.new-row').remove();
        $('#submit-btn').prop('disabled',false);
        updateChange();
        var appendElement = '';
        if (className == 'cash' || className == 'moneipoint') {
            if(className == 'cash')
                $('select[name="paid_by_id_select[]"]').val(1);
            else
                $('select[name="paid_by_id_select[]"]').val(9);

            $('.paying_amount').parent().addClass('col-md-12').removeClass('col-md-3 d-none');
            $('.paying_amount').addClass('cash_paying_amount');
        }
        else if (className == 'credit-card') {
            $('select[name="paid_by_id_select[]"]').val(3);
            appendElement = `<div class="form-group col-md-12 credit-card remove-element">
                                <div class="row">
                                    <div class="col-md-5">
                                        <label>Card Number</label>
                                        <input class="form-control" name="card_number" class="card_name">
                                    </div>
                                    <div class="col-md-5">
                                        <label>Card Holder Name</label>
                                        <input class="form-control" name="card_holder_name">
                                    </div>
                                    <div class="col-md-2">
                                        <label>Card Type</label>
                                        <select class="form-control" name="card_type">
                                            <option>Visa</option>
                                            <option>Master Card</option>
                                        </select>
                                    </div>
                                </div>
                            </div>`;
        }
        else if (className == 'cheque') {
            $('select[name="paid_by_id_select[]"]').val(4);
            appendElement = `<div class="form-group col-md-12 cheque remove-element">
                            <label>{{trans('file.Cheque Number')}} *</label>
                            <input type="text" name="cheque_no" class="form-control" value="" required>
                        </div>`;

        }
        else if (className == 'gift-card') {
            $('select[name="paid_by_id_select[]"]').val(2);
            appendElement = `<div class="form-group col-md-12 gift-card remove-element">
                                <label> {{trans('file.Gift Card')}} *</label>
                                <input type="hidden" name="gift_card_id">
                                <select id="gift_card_id_select" name="gift_card_id_select" class="selectpicker form-control" data-live-search="true" data-live-search-style="begins" title="Select Gift Card..."></select>
                            </div>`;
            $.ajax({
                url: '{{url("/sales/get_gift_card")}}/',
                type: "GET",
                dataType: "json",
                success:function(data) {
                    $('#add-payment select[name="gift_card_id_select"]').empty();
                    $.each(data, function(index) {
                        gift_card_amount[data[index]['id']] = data[index]['amount'];
                        gift_card_expense[data[index]['id']] = data[index]['expense'];
                        $('#add-payment select[name="gift_card_id_select"]').append('<option value="'+ data[index]['id'] +'">'+ data[index]['card_no'] +'</option>');
                    });
                    $('.selectpicker').selectpicker('refresh');
                    $('.selectpicker').selectpicker();
                }
            });
        }
        else if (className == 'deposit') {
            $('select[name="paid_by_id_select[]"]').val(6);
            if($('input[name="paid_amount[]"]').val() > deposit[$('#customer_id').val()]){
                alert('Amount exceeds customer deposit! Customer deposit : '+ deposit[$('#customer_id').val()]);

            }
            else {
                $('#add-payment').modal('show');
            }
        }
        else if (className == 'points') {
            $('select[name="paid_by_id_select[]"]').val(7);
            pointCalculation();
        }
        else if (className == 'multiplepay') {
            ismultiplepayment = 1;
            $('select[name="paid_by_id_select[]"]').val(1);
            $('select[name="paid_by_id_select[]"]').parent().parent().removeClass('d-none');
            $('.paid_amount').parent().removeClass('d-none');
            $('.paying_amount').parent().removeClass('col-md-12 d-none').addClass('col-md-3');
            $('.paying_amount').removeClass('cash_paying_amount')
            $('.add-more').parent().removeClass('d-none');
        }
        $("#payment-select-row .row:eq(0)").append(appendElement);

    }

    function pointCalculation() {
        paid_amount = $('input[name=paid_amount]').val();
        required_point = Math.ceil(paid_amount / reward_point_setting['per_point_amount']);
        if(required_point > points[$('#customer_id').val()]) {
        alert('Customer does not have sufficient points. Available points: '+points[$('#customer_id').val()]);
        }
        else {
        $("input[name=used_points]").val(required_point);
        }
    }

    $(document).on("change", 'select[name="paid_by_id_select[]"]', function() {
        updateChange();
        var id = $(this).val();
        var appendElement = '';
        $(".payment-form").off("submit");
        $(this).parent().parent().siblings('.cash-received-container').addClass('d-none');
        $(this).parent().parent().siblings('.gift-card').remove();
        $(this).parent().parent().siblings('.credit-card').remove();
        $(this).parent().parent().siblings('.cheque').remove();
        //cash
        if(id == 1){
            $(this).parent().parent().siblings('.cash-received-container').removeClass('d-none');
        }
        //gift
        else if(id == 2) {
            appendElement = `<div class="form-group col-md-10 gift-card remove-element">
                                <label> {{trans('file.Gift Card')}} *</label>
                                <input type="hidden" name="gift_card_id">
                                <select id="gift_card_id_select" name="gift_card_id_select" class="selectpicker form-control" data-live-search="true" data-live-search-style="begins" title="Select Gift Card..."></select>
                            </div>`;
            $(this).closest('.col-md-3').after(appendElement);

            $.ajax({
                url: '{{url("/sales/get_gift_card")}}/',
                type: "GET",
                dataType: "json",
                success:function(data) {
                    $('#add-payment select[name="gift_card_id_select"]').empty();
                    $.each(data, function(index) {
                        gift_card_amount[data[index]['id']] = data[index]['amount'];
                        gift_card_expense[data[index]['id']] = data[index]['expense'];
                        $('#add-payment select[name="gift_card_id_select"]').append('<option value="'+ data[index]['id'] +'">'+ data[index]['card_no'] +'</option>');
                    });
                    $('.selectpicker').selectpicker('refresh');
                    $('.selectpicker').selectpicker();
                }
            });
        }
        //credit
        else if (id == 3) {
            appendElement = `<div class="form-group col-md-10 credit-card remove-element">
                                <div class="row">
                                    <div class="col-md-5">
                                        <label>Card Number</label>
                                        <input class="form-control" name="card_number" class="card_name">
                                    </div>
                                    <div class="col-md-5">
                                        <label>Card Holder Name</label>
                                        <input class="form-control" name="card_holder_name">
                                    </div>
                                    <div class="col-md-2">
                                        <label>Card Type</label>
                                        <select class="form-control" name="card_type">
                                            <option>Visa</option>
                                            <option>Master Card</option>
                                        </select>
                                    </div>
                                </div>
                            </div>`;
            $(this).closest('.col-md-3').after(appendElement);
        }
        //cheque
        else if (id == 4) {
            appendElement = `<div class="form-group col-md-10 cheque remove-element">
                            <label>{{trans('file.Cheque Number')}} *</label>
                            <input type="text" name="cheque_no" class="form-control" value="" required>
                        </div>`;
            $(this).closest('.col-md-3').after(appendElement);
        }
        //deposit
        else if(id == 6) {

        }
        //point
        else if(id == 7) {
            pointCalculation();
        }
    });

    $(document).on("change", '#add-payment select[name="gift_card_id_select"]', function() {
        var balance = gift_card_amount[$(this).val()] - gift_card_expense[$(this).val()];
        $('#add-payment input[name="gift_card_id"]').val($(this).val());
        if (ismultiplepayment == 0) {
            if($('input[name="paid_amount[]"]').val() > balance){
                $('#submit-btn').prop('disabled',true);
                alert('Amount exceeds card balance! Gift Card balance: '+ balance);
            }else{
                $('#submit-btn').prop('disabled',false);
            }
        }else{
            // $(this).parent().parent().siblings('.paying-amount-container').children('.paid_amount').val(balance);
            updateChange();
        }

    });

    function change(paying_amount, paid_amount) {
        $("#change").text( parseFloat(paying_amount - paid_amount).toFixed({{$general_setting->decimal}}));
    }

    // Event listener for changes to paid_amount
    $(document).on("keyup", '.paid_amount', function() {
        let paid_amount = parseFloat($(this).val()) || 0;
        if(paid_amount < 0){
            $(this).val(0);
        }
        // Call the change function to update the change amount for this specific row
        calculatePayingAmount();
        updateChange();
    });
    // Event listener for changes to paid_amount
    $(document).on("keyup", '.paying_amount', function() {
        let paying_amount = parseFloat($(this).val()) || 0;
        if(paying_amount < 0){
            $(this).val(0);
        }
        updateChange();
    });

    $(document).on("keyup", '.cash_paying_amount', function() {
        let paying_amount = parseFloat($(this).val()) || 0;
        let grandTotal = parseFloat($("#grand-total").text()) || 0;
        let paid_amount = 0;
        if(paying_amount < grandTotal){
            // console.log(1);
            $('.paid_amount').val(paying_amount);
            $('.total_paying').text(paying_amount);
            $('.due').text(grandTotal - paying_amount);

            paid_amount = $('.paid_amount').val();
        }else if(paying_amount > grandTotal){
            // console.log(2);
            $('.paid_amount').val(grandTotal);
            $('.total_paying').text(grandTotal);
            $('.due').text(0);

            paid_amount = $('.paid_amount').val();
        }else if(paying_amount == grandTotal){
            // console.log(3);
            $('.paid_amount').val(grandTotal);
            $('.total_paying').text(grandTotal);
            $('.due').text(0);
            paid_amount = $('.paid_amount').val();
        }

        if(paying_amount < 0){
            $(this).val(0);
        }
        updateChange();
    });

    // Update the change text for the specific row
    function updateChange() {
        let change = 0;
        $('select[name="paid_by_id_select[]"]').each(function() {
            if ($(this).val() == '1') {
                let $row = $(this).closest('.row');
                let paying_amount = parseFloat($row.find('.paying_amount').val()) || 0;
                let paid_amount = parseFloat($row.find('.paid_amount').val()) || 0;
                change += paying_amount - paid_amount;
            }
        });
        $('.change').text((change).toFixed({{$general_setting->decimal}}));
    }

    // Function to calculate the total and update the total_payable
    function calculatePayingAmount() {

        let total = 0;
        let due = 0;
        let grandTotal = parseFloat($("#grand-total").text()) || 0;

        // Loop through each paying_amount field and sum their values
        $('.paid_amount').each(function() {
            let value = $(this).val();

            // Check if the value is a valid number
            if ($.isNumeric(value)) {
                total += parseFloat(value);
                due = grandTotal - total;
            }
        });
        // Update the total_payable with the total
        $('.total_paying').text(total);
        $('.due').text(due);
    }

    function confirmDelete() {
        if (confirm("Are you sure want to delete?")) {
            return true;
        }
        return false;
    }

    $('.transaction-btn-plus').on("click", function() {
        $(this).addClass('d-none');
        $('.transaction-btn-close').removeClass('d-none');
    });

    $('.transaction-btn-close').on("click", function() {
        $(this).addClass('d-none');
        $('.transaction-btn-plus').removeClass('d-none');
    });

    $('.coupon-btn-plus').on("click", function() {
        $(this).addClass('d-none');
        $('.coupon-btn-close').removeClass('d-none');
    });

    $('.coupon-btn-close').on("click", function() {
        $(this).addClass('d-none');
        $('.coupon-btn-plus').removeClass('d-none');
    });

    $(document).on('click', '.qc-btn', function(e) {
        if($(this).data('amount')) {
            if($('.qc').data('initial')) {
                $('input[name="paying_amount"]').val($(this).data('amount').toFixed({{ $general_setting->decimal }}));
                $('.qc').data('initial', 0);
            }else {
                $('input[name="paying_amount"]').val( (parseFloat($('input[name="paying_amount"]').val()) + $(this).data('amount')).toFixed({{$general_setting->decimal}}));
            }
        }
        else
            $('input[name="paying_amount"]').val('{{number_format(0, $general_setting->decimal, '.','')}}');
        change( $('input[name="paying_amount"]').val(), $('input[name="paid_amount"]').val() );
    });

    // function change(paying_amount, paid_amount) {
    //     $("#change").text( parseFloat(paying_amount - paid_amount).toFixed({{$general_setting->decimal}}));
    // }

    function confirmDelete() {
        if (confirm("Are you sure want to delete?")) {
            return true;
        }
        return false;
    }

    function productSearch(data) {
        var product_info = data.split("|");
        // ['61170981', 'Hello', 'bello1', '0']
        // console.log(data, 'productSearch');
        var item_code = product_info[0];
        var pre_qty = 0;
        var flag = true;

        $(".product-code").each(function(i) {
            // console.log(item_code);
            if ($(this).val() == item_code) {
                rowindex = i;
                // console.log(product_info[2], 'hello');
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
            @if(in_array('restaurant',explode(',',$general_setting->modules)))
            data += '?'+$('#customer_id').val()+'?'+1;
            @else
            data += '?'+$('#customer_id').val()+'?'+(parseFloat(pre_qty) + 1);
            @endif
            //console.log(data);
            $.ajax({
                type: 'GET',
                async: false,
                url: '{{url("sales/lims_product_search")}}',
                data: {
                    data: data
                },
                success: function(data) {
                    // console.log(data);
                    var flag = 1;
                    @if(!in_array('restaurant',explode(',',$general_setting->modules)))
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
                            checkDiscount(String(qty), true);
                            flag = 0;
                            checkQuantity(String(qty), true);
                            flag = 0;

                            localStorage.setItem("tbody-id", $("table.order-list tbody").html());
                        }

                    @endif

                    $("input[name='product_code_name']").val('');

                    if(flag){
                        // console.log('hello');
                        addNewProduct(data);
                    }
                    else if(data[18]) {
                        var imeiNumbers = $('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ')').find('.imei-number').val();
                        if(imeiNumbers)
                            imeiNumbers += ','+data[18];
                        else
                            imeiNumbers = data[18];
                        $('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ')').find('.imei-number').val(imeiNumbers);
                    }
                }
            });
        }

    }

    function addNewProduct(data){
        // console.log(data, 'addNewProd');
        var newRow = $("<tr>");
        var cols = '';
        temp_unit_name = (data[6]).split(',');
        pos = product_code.indexOf(data[1]);
        if(authUser > 2){
            cols += '<td class="col-sm-5 col-6 product-title"><strong>' + data[0] + '<br><span>' + data[1] + '</span> | In Stock: <span class="in-stock"></span> <strong class="product-price d-md-none"></strong>';
        }else{
            cols += '<td class="col-sm-5 col-6 product-title"><strong class="edit-product btn btn-link" data-toggle="modal" data-target="#editModal">' + data[0] + ' <i class="fa fa-edit"></i></strong><br><span>' + data[1] + '</span> | In Stock: <span class="in-stock"></span> <strong class="product-price d-md-none"></strong>';
        }

        if(data[12]) {
            // cols += '<br><input style="font-size:13px;padding:3px 25px 3px 10px;height:30px !important" type="text" class="form-control batch-no" value="'+batch_no[pos]+'" required/> <input type="hidden" class="product-batch-id" name="product_batch_id[]" value="'+product_batch_id[pos]+'"/>';
            cols += '<br><select class="form-control batch-no1" name="product_batch_id1[]" required></select> <input type="text" class="form-control batch-no d-none" value="" required /><input type="hidden" class="product-batch-id" name="product_batch_id[]" value=""/>';
        }
        else {
            cols += '<input type="text" class="form-control batch-no d-none" disabled/> <input type="hidden" class="product-batch-id" name="product_batch_id[]"/>';
        }
        cols += '</td>';
        cols += '<td class="col-sm-2 product-price d-none d-md-block"></td>';
        cols += '<td class="col-sm-3"><div class="input-group"><span class="input-group-btn"><button type="button" class="ibtnDel btn btn-danger btn-sm mr-3"><i class="dripicons-cross"></i></button><button type="button" class="btn btn-default minus"><span class="dripicons-minus"></span></button></span><input type="text" name="qty[]" class="form-control qty numkey input-number" step="any" value="'+data[15]+'" required><span class="input-group-btn"><button type="button" class="btn btn-default plus"><span class="dripicons-plus"></span></button></span></div></td>';
        cols += '<td class="col-sm-2 sub-total"></td>';
        cols += '<input type="hidden" class="product-code" name="product_code[]" value="' + data[1] + '"/>';
        cols += '<input type="hidden" class="product-id" name="product_id[]" value="' + data[9] + '"/>';
        cols += '<input type="hidden" class="product_price" />';
        cols += '<input type="hidden" class="sale-unit" name="sale_unit[]" value="' + temp_unit_name[0] + '"/>';
        cols += '<input type="hidden" class="net_unit_price" name="net_unit_price[]" />';
        cols += '<input type="hidden" class="discount-value" name="discount[]" />';
        cols += '<input type="hidden" class="tax-rate" name="tax_rate[]" value="' + data[3] + '"/>';
        cols += '<input type="hidden" class="tax-value" name="tax[]" />';
        cols += '<input type="hidden" class="tax-name" value="'+data[4]+'" />';
        cols += '<input type="hidden" class="tax-method" value="'+data[5]+'" />';
        cols += '<input type="hidden" class="sale-unit-operator" value="'+data[7]+'" />';
        cols += '<input type="hidden" class="sale-unit-operation-value" value="'+data[8]+'" />';
        cols += '<input type="hidden" class="subtotal-value" name="subtotal[]" />';
        if(data[18])
            cols += '<input type="hidden" class="imei-number" name="imei_number[]" value="'+data[18]+'" />';
        else
            cols += '<input type="hidden" class="imei-number" name="imei_number[]" value="" />';
        if(data[19])
            cols += '<input type="hidden" class="topping_product_code" name="topping_product_code[]" value="" />';
            cols += '<input type="hidden" class="topping-price" name="topping-price" value="" />';

        newRow.append(cols);

        // mehedi
        // Append row to table
        $('table.order-list tbody').append(newRow);

        // Find the batch dropdown inside the newly added row
        var batchDropdown = newRow.find('.batch-no1');

        // Make the AJAX request to get batches
        // $.get('../get-batches/' + data[9] + '/' + data[10], function (data1) {
            var getBatchesBaseUrl = "{{ url('get-batches') }}";
            let url = getBatchesBaseUrl + '/' + data[9] + '/' + data[10];

        $.get(url, function (data1) {
            console.log('Available Batches:', data1);

            batchDropdown.empty(); // Clear previous options

            if (data1.length > 0) {
                batchDropdown.append('<option value="">Select Batch</option>');

                data1.forEach(function (batch) {
                    batchDropdown.append('<option value="' + batch.batch_no + '">' + batch.batch_no + '</option>');
                });
            } else {
                batchDropdown.append('<option value="">No Batches Available</option>');
            }
        }).fail(function () {
            console.error("Error fetching batches. Check API endpoint.");
        });




        if(keyboard_active==1) {
            $("table.order-list tbody").prepend(newRow).find('.qty').keyboard({usePreview: false, layout: 'custom', display: { 'accept'  : '&#10004;', 'cancel'  : '&#10006;' }, customLayout : {
            'normal' : ['1 2 3', '4 5 6', '7 8 9','0 {dec} {bksp}','{clear} {cancel} {accept}']}, restrictInput : true, preventPaste : true, autoAccept : true, css: { container: 'center-block dropdown-menu', buttonDefault: 'btn btn-default', buttonHover: 'btn-primary',buttonAction: 'active', buttonDisabled: 'disabled'},});
        }
        else
            $("table.order-list tbody").prepend(newRow);

        rowindex = newRow.index();

        if(!data[11] && product_warehouse_price[pos]) {
            product_price.splice(rowindex, 0, parseFloat(product_warehouse_price[pos] * currency['exchange_rate']) + parseFloat(product_warehouse_price[pos] * currency['exchange_rate'] * customer_group_rate));
        }
        else {
            product_price.splice(rowindex, 0, parseFloat(data[2] * currency['exchange_rate']) + parseFloat(data[2] * currency['exchange_rate'] * customer_group_rate));
        }
        if(data[16])
            wholesale_price.splice(rowindex, 0, parseFloat(data[16] * currency['exchange_rate']) + parseFloat(data[16] * currency['exchange_rate'] * customer_group_rate));
        else
            wholesale_price.splice(rowindex, 0, '{{number_format(0, $general_setting->decimal, '.', '')}}');
        cost.splice(rowindex, 0, parseFloat(data[17] * currency['exchange_rate']));
        product_discount.splice(rowindex, 0, '{{number_format(0, $general_setting->decimal, '.', '')}}');
        tax_rate.splice(rowindex, 0, parseFloat(data[3]));
        tax_name.splice(rowindex, 0, data[4]);
        tax_method.splice(rowindex, 0, data[5]);
        unit_name.splice(rowindex, 0, data[6]);
        unit_operator.splice(rowindex, 0, data[7]);
        unit_operation_value.splice(rowindex, 0, data[8]);
        is_imei.splice(rowindex, 0, data[13]);
        is_variant.splice(rowindex, 0, data[14]);
        $('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ')').find('.product_price').val(product_price[rowindex]);
        localStorageQty.splice(rowindex, 0, data[15]);
        localStorageProductId.splice(rowindex, 0, data[9]);
        localStorageProductCode.splice(rowindex, 0, data[1]);
        localStorageSaleUnit.splice(rowindex, 0, temp_unit_name[0]);
        localStorageProductDiscount.splice(rowindex, 0, product_discount[rowindex]);
        localStorageTaxRate.splice(rowindex, 0, tax_rate[rowindex].toFixed({{$general_setting->decimal}}));
        localStorageTaxName.splice(rowindex, 0, data[4]);
        localStorageTaxMethod.splice(rowindex, 0, data[5]);
        localStorageTempUnitName.splice(rowindex, 0, data[6]);
        localStorageSaleUnitOperator.splice(rowindex, 0, data[7]);
        localStorageSaleUnitOperationValue.splice(rowindex, 0, data[8]);
        //put some dummy value
        localStorageNetUnitPrice.splice(rowindex, 0, '{{number_format(0, $general_setting->decimal, '.', '')}}');
        localStorageTaxValue.splice(rowindex, 0, '{{number_format(0, $general_setting->decimal, '.', '')}}');
        localStorageSubTotalUnit.splice(rowindex, 0, '{{number_format(0, $general_setting->decimal, '.', '')}}');
        localStorageSubTotal.splice(rowindex, 0, '{{number_format(0, $general_setting->decimal, '.', '')}}');

        localStorage.setItem("localStorageProductId", localStorageProductId);
        localStorage.setItem("localStorageSaleUnit", localStorageSaleUnit);
        localStorage.setItem("localStorageProductCode", localStorageProductCode);
        localStorage.setItem("localStorageTaxName", localStorageTaxName);
        localStorage.setItem("localStorageTaxMethod", localStorageTaxMethod);
        localStorage.setItem("localStorageTempUnitName", localStorageTempUnitName);
        localStorage.setItem("localStorageSaleUnitOperator", localStorageSaleUnitOperator);
        localStorage.setItem("localStorageSaleUnitOperationValue", localStorageSaleUnitOperationValue);
        checkQuantity(data[15], true);
        checkDiscount(data[15], true);

        localStorage.setItem("tbody-id", $("table.order-list tbody").html());
        if(data[16]) {
            populatePriceOption();
            $('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ')').find('.edit-product').click();
        }

        if(data[18]) {
            var imeiNumbers = $('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ')').find('.imei-number').val();
            if(imeiNumbers)
                imeiNumbers += ','+data[18];
            else
                imeiNumbers = data[18];
            $('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ')').find('.imei-number').val(imeiNumbers);
        }

        if (data[19] && Array.isArray(data[19]) && data[19].length > 0) {
            // Create modal content
            let modalContent = '<form id="product-selection-form">';
            data[19].forEach(product => {
                modalContent += `
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="productOption" id="product_${product.id}" value="${product.id}" data-name="${product.name}" data-price="${product.price}">
                        <label class="form-check-label" for="product_${product.id}">
                            ${product.name} (${product.code}) - $${product.price}
                        </label>
                    </div>`;
            });
            modalContent += '</form>';

            // Show modal
            const modalHTML = `
                <div class="modal fade" id="productSelectionModal" tabindex="-1" role="dialog" aria-labelledby="productSelectionModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="productSelectionModalLabel">Select Additional Products</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                ${modalContent}
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                <button type="button" class="btn btn-primary" id="confirmSelection">Confirm</button>
                            </div>
                        </div>
                    </div>
                </div>`;

            // Append modal to the body and show it
            $("body").append(modalHTML);
            $("#productSelectionModal").modal('show');

            // Handle selection confirmation
            $("#confirmSelection").on('click', function () {
                let selectedProductIds = [];
                let selectedProducts = [];
                let totalAdditionalPrice = 0;

                $("input[name='productOption']:checked").each(function () {
                    const productId = $(this).val();
                    const productName = $(this).data('name');
                    const productPrice = parseFloat($(this).data('price'));

                    selectedProducts.push(productName);
                    selectedProductIds.push(productId);
                    totalAdditionalPrice += productPrice;
                });

                if (selectedProducts.length > 0) {
                    // Add selected product names and price to the main product row
                    const selectedProductsText = selectedProducts.join(', ');
                    newRow.find('.product-title').append(`<br><small>Includes: ${selectedProductsText}</small>`);

                    const selectedProductIdsText = selectedProductIds.join(', ');
                    newRow.find('.topping_product_code').val(selectedProductIdsText);

                    // Update the total price
                    const currentPrice = parseFloat(newRow.find('.product-price').text()) || 0;
                    const newPrice = currentPrice + totalAdditionalPrice;
                    newRow.find('.product-price').text(`${newPrice.toFixed({{$general_setting->decimal}})}`);
                    newRow.find('.sub-total').text(`${newPrice.toFixed({{$general_setting->decimal}})}`);
                    newRow.find('.product_price').val(`${newPrice.toFixed({{$general_setting->decimal}})}`);
                    newRow.find('.topping-price').val(`${totalAdditionalPrice.toFixed({{$general_setting->decimal}})}`);
                }

                $("#productSelectionModal").modal('hide');
                $(".modal-backdrop").remove();
                $("#productSelectionModal").remove(); // Clean up the modal
                calculateTotal();
                //calculateGrandTotal();
            });

            // Stop further processing until the modal is resolved
            return;
        }
    }

    function populatePriceOption() {
        $('#editModal select[name=price_option]').empty();
        $('#editModal select[name=price_option]').append('<option value="'+ product_price[rowindex] +'">'+ product_price[rowindex] +'</option>');
        if(wholesale_price[rowindex] > 0)
            $('#editModal select[name=price_option]').append('<option value="'+ wholesale_price[rowindex] +'">'+ wholesale_price[rowindex] +'</option>');
        $('.selectpicker').selectpicker('refresh');
    }

    function edit(){
        $(".imei-section").remove();
        if(is_imei[rowindex]) {

            var imeiNumbers = $('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ')').find('.imei-number').val();

            if(imeiNumbers.length) {
                imeiArrays = [...new Set(imeiNumbers.split(","))];
                // imeiArrays = imeiNumbers.split(",");
                htmlText = `<div class="col-md-8 form-group imei-section">
                            <label>IMEI or Serial Numbers</label>
                            <div class="table-responsive ml-2">
                                <table id="imei-table" class="table table-hover">
                                    <tbody>`;
                for (var i = 0; i < imeiArrays.length; i++) {
                    htmlText += `<tr>
                                    <td>
                                        <input type="text" class="form-control imei-numbers" name="imei_numbers[]" value="`+imeiArrays[i]+`" />
                                    </td>
                                    <td>
                                        <button type="button" class="imei-del btn btn-sm btn-danger">X</button>
                                    </td>
                                </tr>`;
                }
                htmlText += `</tbody>
                                </table>
                            </div>
                        </div>`;
                $("#editModal .modal-element").append(htmlText);
            }
        }
        populatePriceOption();
        $("#product-cost").text(cost[rowindex]);
        var row_product_name_code = $('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ')').find('td:nth-child(1) > strong:nth-child(1)').text();
        $('#modal_header').text(row_product_name_code);

        var qty = $('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ')').find('.qty').val();
        $('input[name="edit_qty"]').val(qty);

        $('input[name="edit_discount"]').val(parseFloat(product_discount[rowindex]).toFixed({{$general_setting->decimal}}));

        var tax_name_all = <?php echo json_encode($tax_name_all) ?>;
        pos = tax_name_all.indexOf(tax_name[rowindex]);
        $('select[name="edit_tax_rate"]').val(pos);

        var row_product_code = $('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ')').find('.product-code').val();
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

    //Delete imei
    $(document).on("click", "table#imei-table tbody .imei-del", function() {
        $(this).closest("tr").remove();
        //decreaing qty
        var edit_qty = parseFloat($('input[name="edit_qty"]').val());
        $('input[name="edit_qty"]').val(edit_qty-1);
    });

    function couponDiscount() {
        var rownumber = $('table.order-list tbody tr:last').index();
        if (rownumber < 0) {
            alert("Please insert product to order table!")
        }
        else if($("#coupon-code").val() != ''){
            valid = 0;
            $.each(coupon_list, function(key, value) {
                if($("#coupon-code").val() == value['code']){
                    valid = 1;
                    todyDate = <?php echo json_encode(date('Y-m-d'))?>;
                    if(parseFloat(value['quantity']) <= parseFloat(value['used']))
                        alert('This Coupon is no longer available');
                    else if(todyDate > value['expired_date'])
                        alert('This Coupon has expired!');
                    else if(value['type'] == 'fixed'){
                        if(parseFloat($('input[name="grand_total"]').val()) >= value['minimum_amount']) {
                            $('input[name="grand_total"]').val($('input[name="grand_total"]').val() - (value['amount'] * currency['exchange_rate']));
                            $('#grand-total').text(parseFloat($('input[name="grand_total"]').val()).toFixed({{$general_setting->decimal}}));
                            $('#grand-total-m').text(parseFloat($('input[name="grand_total"]').val()).toFixed({{$general_setting->decimal}}));
                            if(!$('input[name="coupon_active"]').val())
                                alert('Congratulation! You got '+(value['amount'] * currency['exchange_rate'])+' '+currency['code']+' discount');
                            $(".coupon-check").prop("disabled",true);
                            $("#coupon-code").prop("disabled",true);
                            $('input[name="coupon_active"]').val(1);
                            $("#coupon-modal").modal('hide');
                            $('input[name="coupon_id"]').val(value['id']);
                            $('input[name="coupon_discount"]').val(value['amount'] * currency['exchange_rate']);
                            $('#coupon-text').text(parseFloat(value['amount'] * currency['exchange_rate']).toFixed({{$general_setting->decimal}}));
                        }
                        else
                            alert('Grand Total is not sufficient for discount! Required '+value['minimum_amount']+' '+currency['code']);
                    }
                    else{
                        var grand_total = $('input[name="grand_total"]').val();
                        var coupon_discount = grand_total * (value['amount'] / 100);
                        grand_total = grand_total - coupon_discount;
                        $('input[name="grand_total"]').val(grand_total);
                        $('#grand-total').text(parseFloat(grand_total).toFixed({{$general_setting->decimal}}));
                        $('#grand-total-m').text(parseFloat(grand_total).toFixed({{$general_setting->decimal}}));
                        if(!$('input[name="coupon_active"]').val())
                                alert('Congratulation! You got '+value['amount']+'% discount');
                        $(".coupon-check").prop("disabled",true);
                        $("#coupon-code").prop("disabled",true);
                        $('input[name="coupon_active"]').val(1);
                        $("#coupon-modal").modal('hide');
                        $('input[name="coupon_id"]').val(value['id']);
                        $('input[name="coupon_discount"]').val(coupon_discount);
                        $('#coupon-text').text(parseFloat(coupon_discount).toFixed({{$general_setting->decimal}}));
                    }
                }
            });
            if(!valid)
                alert('Invalid coupon code!');
        }
    }

    function checkDiscount(qty, flag) {
        var customer_id = $('#customer_id').val();
        var warehouse_id = $('#warehouse_id').val();
        var product_id = $('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ') .product-id').val();

            $.ajax({
                type: 'GET',
                async: false,
                url: '{{url("/")}}/sales/check-discount?qty='+qty+'&customer_id='+customer_id+'&product_id='+product_id+'&warehouse_id='+warehouse_id,
                success: function(data) {
                    //console.log(data);
                    pos = product_code.indexOf($('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ') .product-code').val());
                    //product_price[rowindex] = parseFloat(data[0] * currency['exchange_rate']) + parseFloat(data[0] * currency['exchange_rate'] * customer_group_rate);
                    var productDiscount = parseFloat($('#discount').text());

                    if(flag == true)
                        $('#discount').text(productDiscount+data[2]);
                    else if(flag == false)
                        $('#discount').text(productDiscount-data[2]*qty);
                    else if(flag == 'input')
                        $('#discount').text(productDiscount-data[2]*previousqty+data[2]*qty);
                    else
                        $('#discount').text(productDiscount-data[2]);
                }
            });

        $('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ') .qty').val(qty);
        flag = true;
        checkQuantity(String(qty), flag);
        localStorage.setItem("tbody-id", $("table.order-list tbody").html());
    }

    function checkQuantity(sale_qty, flag) {
        var row_product_code = $('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ')').find('.product-code').val();
        pos = product_code.indexOf(row_product_code);
        $('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ')').find('.in-stock').text(product_qty[pos]);
        localStorageQty[rowindex] = sale_qty;
        localStorage.setItem("localStorageQty", localStorageQty);
        if(without_stock == 'no') {
            if(product_type[pos] == 'standard' || product_type[pos] == 'combo') {
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
                        localStorageQty[rowindex] = sale_qty;
                        localStorage.setItem("localStorageQty", localStorageQty);
                        checkQuantity(sale_qty, true);
                    }
                    else {
                        localStorageQty[rowindex] = sale_qty;
                        localStorage.setItem("localStorageQty", localStorageQty);
                        edit();
                        return;
                    }
                }
                $('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ')').find('.qty').val(sale_qty);
            }
        }
        else
            $('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ')').find('.qty').val(sale_qty);
        if(!flag) {
            $('#editModal').modal('hide');
            $('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ')').find('.qty').val(sale_qty);
        }
        calculateRowProductData(sale_qty);
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

    function calculateRowProductData(quantity) {
        if(product_type[pos] == 'standard')
            unitConversion();
        else
            row_product_price = product_price[rowindex];
        if (tax_method[rowindex] == 1) {
            var net_unit_price = row_product_price - product_discount[rowindex];
            var tax = net_unit_price * quantity * (tax_rate[rowindex] / 100);
            var sub_total = (net_unit_price * quantity) + tax;

            if(parseFloat(quantity))
                var sub_total_unit = sub_total / quantity;
            else
                var sub_total_unit = sub_total;
        }
        else {
            var sub_total_unit = row_product_price - product_discount[rowindex];
            var net_unit_price = (100 / (100 + tax_rate[rowindex])) * sub_total_unit;
            var tax = (sub_total_unit - net_unit_price) * quantity;
            var sub_total = sub_total_unit * quantity;
        }

        var topping_price = ($('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ')').find('.topping-price').val() * quantity) || 0;

        $('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ')').find('.discount-value').val((product_discount[rowindex] * quantity).toFixed({{$general_setting->decimal}}));
        $('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ')').find('.tax-rate').val(tax_rate[rowindex].toFixed({{$general_setting->decimal}}));
        $('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ')').find('.net_unit_price').val(net_unit_price.toFixed({{$general_setting->decimal}}));
        $('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ')').find('.tax-value').val(tax.toFixed({{$general_setting->decimal}}));
        $('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ')').find('.product-price').text(sub_total_unit.toFixed({{$general_setting->decimal}}));
        $('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ')').find('.sub-total').text((sub_total+topping_price).toFixed({{$general_setting->decimal}}));
        $('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ')').find('.subtotal-value').val((sub_total+topping_price).toFixed({{$general_setting->decimal}}));


        localStorageProductDiscount.splice(rowindex, 1, (product_discount[rowindex] * quantity).toFixed({{$general_setting->decimal}}));
        localStorageTaxRate.splice(rowindex, 1, tax_rate[rowindex].toFixed({{$general_setting->decimal}}));
        localStorageNetUnitPrice.splice(rowindex, 1, net_unit_price.toFixed({{$general_setting->decimal}}));
        localStorageTaxValue.splice(rowindex, 1, tax.toFixed({{$general_setting->decimal}}));
        localStorageSubTotalUnit.splice(rowindex, 1, sub_total_unit.toFixed({{$general_setting->decimal}}));
        localStorageSubTotal.splice(rowindex, 1, sub_total.toFixed({{$general_setting->decimal}}));
        localStorage.setItem("localStorageProductDiscount", localStorageProductDiscount);
        localStorage.setItem("localStorageTaxRate", localStorageTaxRate);
        localStorage.setItem("localStorageNetUnitPrice", localStorageNetUnitPrice);
        localStorage.setItem("localStorageTaxValue", localStorageTaxValue);
        localStorage.setItem("localStorageSubTotalUnit", localStorageSubTotalUnit);
        localStorage.setItem("localStorageSubTotal", localStorageSubTotal);

        calculateTotal();
    }

    function calculateTotal() {
        //Sum of quantity
        var total_qty = 0;
        $("table.order-list tbody .qty").each(function(index) {
            if ($(this).val() == '') {
                total_qty += 0;
            } else {
                total_qty += parseFloat($(this).val());
            }
        });
        $('input[name="total_qty"]').val(total_qty);

        //Sum of discount
        var total_discount = 0;
        $("table.order-list tbody .discount-value").each(function() {
            total_discount += parseFloat($(this).val());
        });

        $('input[name="total_discount"]').val(total_discount.toFixed({{$general_setting->decimal}}));

        //Sum of tax
        var total_tax = 0;
        $(".tax-value").each(function() {
            total_tax += parseFloat($(this).val());
        });

        $('input[name="total_tax"]').val(total_tax.toFixed({{$general_setting->decimal}}));

        //Sum of subtotal
        var total = 0;
        $(".sub-total").each(function() {
            total += parseFloat($(this).text());
        });
        $('input[name="total_price"]').val(total.toFixed({{$general_setting->decimal}}));

        calculateGrandTotal();
    }

    function calculateGrandTotal() {
        var item = $('table.order-list tbody tr:last').index();
        var total_qty = parseFloat($('input[name="total_qty"]').val());
        var subtotal = parseFloat($('input[name="total_price"]').val());
        var order_tax = parseFloat($('select[name="order_tax_rate_select"]').val());
        var order_discount_type = $('select[name="order_discount_type_select"]').val();
        var order_discount_value = parseFloat($('input[name="order_discount_value"]').val());

        if (!order_discount_value)
            order_discount_value = {{number_format(0, $general_setting->decimal, '.', '')}};

        if(order_discount_type == 'Flat') {
            if(!currencyChange) {
                var order_discount = parseFloat(order_discount_value);
            }
            else
                var order_discount = parseFloat(order_discount_value*currency['exchange_rate']);
        }
        else
            var order_discount = parseFloat(subtotal * (order_discount_value / 100));

        localStorage.setItem("order-tax-rate-select", order_tax);
        localStorage.setItem("order-discount-type", order_discount_type);
        // $("#discount").text(order_discount.toFixed({{$general_setting->decimal}}));
        $('input[name="order_discount"]').val(order_discount);
        $('input[name="order_discount_type"]').val(order_discount_type);
        if(!currencyChange)
            var shipping_cost = parseFloat($('input[name="shipping_cost"]').val());
        else
            var shipping_cost = parseFloat($('input[name="shipping_cost"]').val() * currency['exchange_rate']);
        if (!shipping_cost)
            shipping_cost = {{number_format(0, $general_setting->decimal, '.', '')}};

        item = ++item + '(' + total_qty + ')';
        order_tax = (subtotal - order_discount) * (order_tax / 100);
        var grand_total = (subtotal + order_tax + shipping_cost) - order_discount;
        $('input[name="grand_total"]').val(grand_total.toFixed({{$general_setting->decimal}}));

        if($("#coupon-code").val() != '')
            couponDiscount();
        if(!currencyChange)
            var coupon_discount = parseFloat($('input[name="coupon_discount"]').val());
        else
            var coupon_discount = parseFloat($('input[name="coupon_discount"]').val() * currency['exchange_rate']);
        if (!coupon_discount)
            coupon_discount = {{number_format(0, $general_setting->decimal, '.', '')}};
        grand_total -= coupon_discount;

        $('#item').text(item);
        $('input[name="item"]').val($('table.order-list tbody tr:last').index() + 1);
        $('#subtotal').text(subtotal.toFixed({{$general_setting->decimal}}));
        $('#tax').text(order_tax.toFixed({{$general_setting->decimal}}));
        $('input[name="order_tax"]').val(order_tax.toFixed({{$general_setting->decimal}}));
        $('#shipping-cost').text(shipping_cost.toFixed({{$general_setting->decimal}}));
        $('input[name="shipping_cost"]').val(shipping_cost);
        $('#grand-total').text(grand_total.toFixed({{$general_setting->decimal}}));
        $('#grand-total-m').text(grand_total.toFixed({{$general_setting->decimal}}));
        $('input[name="grand_total"]').val(grand_total.toFixed({{$general_setting->decimal}}));
        currencyChange = false;
    }



    function cancel(rownumber) {
        while(rownumber >= 0) {
            product_price.pop();
            wholesale_price.pop();
            product_discount.pop();
            tax_rate.pop();
            tax_name.pop();
            tax_method.pop();
            unit_name.pop();
            unit_operator.pop();
            unit_operation_value.pop();
            $('table.order-list tbody tr:last').remove();
            rownumber--;
        }
        $('input[name="shipping_cost"]').val('');
        $('input[name="order_discount_value"]').val('');
        $('select[name="order_tax_rate_select"]').val(0);
        localStorage.clear();
        calculateTotal();
    }

    function confirmCancel() {
        var audio = $("#mysoundclip2")[0];
        audio.play();
        if (confirm("Are you sure want to cancel?")) {
            cancel($('table.order-list tbody tr:last').index());
        }
        return false;
    }

    $(document).on('submit', '.payment-form', function(e) {
        $("table.order-list tbody .qty").each(function(index) {
            if ($(this).val() == '') {
                alert('One of products has no quantity!');
                e.preventDefault();
            }
        });
        var rownumber = $('table.order-list tbody tr:last').index();
        if (rownumber < 0) {
            alert("Please insert product to order table!")
            e.preventDefault();
        }
        else if(parseFloat($('input[name="total_qty"]').val()) <= 0) {
            alert('Product quantity is 0');
            e.preventDefault();
        }
        else if( parseFloat( $('input[name="paying_amount[]"]').val() ) < parseFloat( $('input[name="paid_amount[]"]').val() ) ){
            alert('Paying amount cannot be bigger than recieved amount');
            e.preventDefault();
        }
        else {
            if ($('input[name="sale_status"]').val() == 1) {
                $("#submit-btn").prop('disabled', true).html('<span class="spinner-border text-light" role="status"></span>');
            }
            $('input[name="paid_by_id"]').val($('select[name="paid_by_id_select"]').val());
            $('select[name="paid_by_id_select[]"]').each(function(index) {
                $('input[name="paid_by_id[]"]').eq(index).val($(this).val());
            });
            $('input[name="order_tax_rate"]').val($('select[name="order_tax_rate_select"]').val());

            e.preventDefault(); // Prevents the default form submission behavior

            $.ajax({
                url: $('.payment-form').attr('action'), // The form's action URL
                type: $('.payment-form').attr('method'), // The form's method (GET or POST)
                data: $('.payment-form').serialize(), // Serialize the form data
                success: function(response) {
                    console.log(response);

                    @if(in_array('restaurant',explode(',',$general_setting->modules)))
                    if ($('input[name="sale_status"]').val() == 1 || $('input[name="sale_status"]').val() == 5) {
                    @else
                    if ($('input[name="sale_status"]').val() == 1) {
                    @endif

                        getProduct($("#warehouse_id").val());

                        let link = "{{url('sales/gen_invoice/')}}" +'/'+ response;

                        $('#pos-layout').css('display','none');
                        var head = $('head').html();
                        $('head').html('');

                        $('#print-layout').load(link, function() {
                            setTimeout(function() {
                                window.print();
                            }, 50);
                        });

                        $("#submit-btn").prop('disabled', false).html("{{trans('file.submit')}}");
                        $('#add-payment').modal('hide');
                        cancel($('table.order-list tbody tr:last').index());

                        setTimeout(function() {
                            window.onafterprint = (event) => {
                                if(isMobile == false){
                                    $('#pos-layout').css('display','block');
                                    $('#print-layout').html('');
                                    $('head').html(head);
                                    location.reload();
                                }
                            };
                        }, 100);

                        $.get('{{url("/sales/recent-sale")}}/', function(data) {
                            populateRecentSale(data);
                        });
                    }
                    else if ($('input[name="sale_status"]').val() == 3) {
                        $('#pos-layout').prepend('<div class="alert alert-success alert-dismissible text-center"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>{{trans("file.Sale successfully added to draft")}}</div>');
                        $('input[name="sale_status"]').val(1);
                        cancel($('table.order-list tbody tr:last').index());
                        $.get('{{url("/sales/recent-draft")}}/', function(data) {
                            populateRecentDraft(data);
                        });
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

    @if(in_array('restaurant',explode(',',$general_setting->modules)))
    $('#service_id').change(function() {
        if($(this).val() == 1) {
            $('#table_id').prop('disabled', false);
            $('#table_id').selectpicker('refresh');


            $('#waiter_id').prop('disabled', false);
            $('#waiter_id').selectpicker('refresh');

            $('#table_id').prop('required', true);
            $('#waiter_id').prop('required', true);
        }
        else {
            $('#table_id').prop('disabled', true);
            $('#table_id').selectpicker('refresh');

            $('#waiter_id').prop('disabled', true);
            $('#waiter_id').selectpicker('refresh');

            $('#table_id').prop('required', false);
            $('#waiter_id').prop('required', false);
        }
    });

    @endif


</script>

@endpush
