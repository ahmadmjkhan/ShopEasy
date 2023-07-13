@extends('backend.admin.layouts.admin-master-layout')

@section('title')
Update Roles
@endsection

@section('content')


<div class="row">
    <div class="col-md-12">
        <!-- general form elements -->
        <div class="card card-primary">
            <div class="card-header">
                <h5 class="text-center"><b>{{$title}}</b><a href="" class="btn btn-sm btn-success float-right">BACK</a>
                </h5>
            </div>
            <!-- /.card-header -->
            <!-- form start -->

            @if(Session::has('error_message'))

                <span class="alert alert-danger ">
                    {{Session::get('error_message')}}
                </span>
                @endif

                @if(Session::has('success_message'))

                <span class="alert alert-success ">
                    {{Session::get('success_message')}}
                </span>
                @endif
            <form action="{{route('admin.update-role',$adminDetails['id'])}}" method="post">
                @csrf
                <div class="card-body">
                    @if(!empty($adminRoles))
                    @foreach($adminRoles as $role)
                    @if($role['module']=="categories")
                       @if($role['view_access']==1)
                        @php $viewCategories = "checked"; @endphp
                       @else
                          @php $viewCategories = "";  @endphp
                       @endif
                       @if($role['edit_access']==1)
                        @php $editCategories = "checked"; @endphp
                       @else
                          @php $editCategories = "";  @endphp
                       @endif
                       @if($role['full_access']==1)
                        @php $fullCategories = "checked"; @endphp
                       @else
                          @php $fullCategories = "";  @endphp
                       @endif
                    @endif
                    @endforeach
                    @endif
                    <div class="form-group">
                        <label for="Categories">Categories</label>
                        <div class="form-check">
                            <input type="checkbox" name="categories[view]" value="1" @if(isset($viewCategories)) {{$viewCategories}} @endif class="form-check-input" id="">
                            <label class="form-check-label" for="">View Access</label>

                        </div>

                        <div class="form-check">
                        <input type="checkbox" name="categories[edit]" value="1" @if(isset($editCategories))  {{$editCategories}} @endif  class="form-check-input" id="">
                            <label class="form-check-label" for="">View/Edit Access</label>
                        </div>

                        <div class="form-check"> 
                        <input type="checkbox" name="categories[full]" value="1" @if(isset($fullCategories))  {{$fullCategories}} @endif class="form-check-input" id="">
                            <label class="form-check-label" for="">Full Access</label>
                        </div>

                    </div>


                    <div class="form-group">
                    @if(!empty($adminRoles))
                    @foreach($adminRoles as $role)
                    @if($role['module']=="products")
                       @if($role['view_access']==1)
                        @php $viewProducts = "checked"; @endphp
                       @else
                          @php $viewProducts = "";  @endphp
                       @endif
                       @if($role['edit_access']==1)
                        @php $editProducts = "checked"; @endphp
                       @else
                          @php $editProducts = "";  @endphp
                       @endif
                       @if($role['full_access']==1)
                        @php $fullProducts = "checked"; @endphp
                       @else
                          @php $fullProducts = "";  @endphp
                       @endif
                    @endif
                    @endforeach
                    @endif
                        <label for="Products">Products</label>
                        <div class="form-check">
                            <input type="checkbox" name="products[view]" value="1" @if(isset($viewProducts)) {{$viewProducts}} @endif class="form-check-input" id="">
                            <label class="form-check-label" for="">View Access</label>

                        </div>

                        <div class="form-check">
                        <input type="checkbox" name="products[edit]" value="1" @if(isset($editProducts)) {{$editProducts}} @endif  class="form-check-input" id="">
                            <label class="form-check-label" for="">View/Edit Access</label>
                        </div>

                        <div class="form-check">
                        <input type="checkbox" name="products[full]" value="1" @if(isset($fullProducts)) {{$fullProducts}} @endif class="form-check-input" id="">
                            <label class="form-check-label" for="">Full Access</label>
                        </div>

                    </div>


                    <div class="form-group">
                    @if(!empty($adminRoles))
                    @foreach($adminRoles as $role)
                    @if($role['module']=="orders")
                       @if($role['view_access']==1)
                        @php $viewOrders = "checked"; @endphp
                       @else
                          @php $viewOrders = "";  @endphp
                       @endif
                       @if($role['edit_access']==1)
                        @php $editOrders = "checked"; @endphp
                       @else
                          @php $editOrders = "";  @endphp
                       @endif
                       @if($role['full_access']==1)
                        @php $fullOrders = "checked"; @endphp
                       @else
                          @php $fullOrders = "";  @endphp
                       @endif
                    @endif
                    @endforeach
                    @endif
                        <label for="Orders">Orders</label>
                        <div class="form-check">
                            <input type="checkbox" name="orders[view]" value="1" class="form-check-input" @if(isset($viewOrders)) {{$viewOrders}} @endif id="">
                            <label class="form-check-label" for="">View Access</label>

                        </div>

                        <div class="form-check">
                        <input type="checkbox" name="orders[edit]" value="1"  class="form-check-input" @if(isset($editOrders)) {{$editOrders}} @endif id="">
                            <label class="form-check-label" for="">View/Edit Access</label>
                        </div>

                        <div class="form-check">
                        <input type="checkbox" name="orders[full]" value="1" class="form-check-input" @if(isset($fullOrders)){{$fullOrders}} @endif id="">
                            <label class="form-check-label" for="">Full Access</label>
                        </div>

                    </div>


                    <div class="form-group">
                    @if(!empty($adminRoles))
                    @foreach($adminRoles as $role)
                    @if($role['module']=="coupons")
                       @if($role['view_access']==1)
                        @php $viewCoupons = "checked"; @endphp
                       @else
                          @php $viewCoupons = "";  @endphp
                       @endif
                       @if($role['edit_access']==1)
                        @php $editCoupons = "checked"; @endphp
                       @else
                          @php $editCoupons = "";  @endphp
                       @endif
                       @if($role['full_access']==1)
                        @php $fullCoupons = "checked"; @endphp
                       @else
                          @php $fullCoupons = "";  @endphp
                       @endif
                    @endif
                    @endforeach
                    @endif
                        <label for="Coupons">Coupons</label>
                        <div class="form-check">
                            <input type="checkbox" name="coupons[view]" value="1" @if(isset($viewCoupons)) {{$viewCoupons}} @endif class="form-check-input" id="">
                            <label class="form-check-label" for="">View Access</label>

                        </div>

                        <div class="form-check">
                        <input type="checkbox" name="coupons[edit]" value="1" @if(isset($editCoupons)) {{$editCoupons}} @endif  class="form-check-input" id="">
                            <label class="form-check-label" for="">View/Edit Access</label>
                        </div>

                        <div class="form-check">
                        <input type="checkbox" name="coupons[full]" value="1" @if(isset($fullCoupons)) {{$fullCoupons}} @endif class="form-check-input" id="">
                            <label class="form-check-label" for="">Full Access</label>
                        </div>

                    </div>
                    <!-- <span class="text-danger error-text section_name_error"></span> -->



                </div>
                <!-- /.card-body -->
  
                 <div class="card-footer">
                    <button type="submit" class="btn btn-info btn-sm" >Submit</button>
                 </div>
            </form>
        </div>
        <!-- /.card -->
    </div>
</div>



@endsection