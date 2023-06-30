<?php

use App\Models\ProductFilter;


$productFilters = ProductFilter::productFilters();
if(isset($products->category_id)){
    $category_id = $products->category_id;
}

?>


@foreach($productFilters as $filter)
@if(isset($category_id))
<?php
$filterAvailable = ProductFilter::filterAvailable($filter->id, $category_id);
?>
@if($filterAvailable == "Yes")
<div class="form-group">

    <label for="">{{$filter->filter_name}}</label>
    <select name="{{$filter->filter_column}}" id="{{$filter->filter_column}}" class="form-control">
        <option value="">Select</option>
        @foreach($filter->filter_values as $value)
        <option value="{{$value->filter_value}}" @if(!empty($products->{$filter['filter_column']}) &&  $value->filter_value==$products->{$filter['filter_column']})selected="" @endif>{{ucwords($value->filter_value)}}</option>
        @endforeach
    </select>
    <span class="text-danger error-text section_id_error"></span>
</div>
@endif
@endif
@endforeach