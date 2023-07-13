<?php

use App\Models\ProductFilter;

$ProductFilter = ProductFilter::productFilters();


?>
   <!---- use this code on sublime editor because vscode cause error due to PHP file include here ---->
<script>
  $(document).ready(function() {

    
   
    $("#sort").on("change", function() {
      var color = get_filter('color');
      var size = get_filter('size');
      var brand = get_filter('brand');
      var sort = $("#sort").val();
      var url = $("#url").val();

      @foreach($ProductFilter as $filter)

            var {{$filter['filter_column']}} = get_filter('{{$filter['filter_column']}}');

      @endforeach

      
      $.ajax({
        headers: {
          "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        method: "post",

        data: {
           @foreach($ProductFilter as $filter)
                    {{$filter['filter_column']}}:{{$filter['filter_column']}},
          @endforeach
          url: url,
          sort: sort,
          color:color,
          size:size,
          brand:brand
        },
        success: function(data) {
          $(".filter-products").html(data);
        },
        error: function() {
          alert("error");
        },
      });
    });




    //changing on size //
     $(".size").on("change", function() {
      
      var color = get_filter('color');
      var size = get_filter('size');
      var brand = get_filter('brand');
      var sort = $("#sort").val();
      var url = $("#url").val();

      @foreach($ProductFilter as $filter)

            var {{$filter['filter_column']}} = get_filter('{{$filter['filter_column']}}');

      @endforeach

      
      $.ajax({
        headers: {
          "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        method: "post",

        data: {
           @foreach($ProductFilter as $filter)
                    {{$filter['filter_column']}}:{{$filter['filter_column']}},
          @endforeach
          url: url,
          sort: sort,
          color:color,
          size:size,
          brand:brand
        },
        success: function(data) {
          $(".filter-products").html(data);
        },
        error: function() {
          alert("error");
        },
      });
    });


     //changing on brand //
     $(".brand").on("change", function() {
      
      var color = get_filter('color');
      var size = get_filter('size');
      var brand = get_filter('brand');
      var sort = $("#sort").val();
      var url = $("#url").val();

      @foreach($ProductFilter as $filter)

            var {{$filter['filter_column']}} = get_filter('{{$filter['filter_column']}}');

      @endforeach

     
      $.ajax({
        headers: {
          "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        method: "post",

        data: {
           @foreach($ProductFilter as $filter)
                    {{$filter['filter_column']}}:{{$filter['filter_column']}},
          @endforeach
          url: url,
          sort: sort,
          color:color,
          size:size,
          brand:brand
        },
        success: function(data) {
          $(".filter-products").html(data);
        },
        error: function() {
          alert("error");
        },
      });
    });



      //changing on color //
     $(".color").on("change", function() {
  
      var color = get_filter('color');
      var size = get_filter('size');
      var brand = get_filter('brand');
      var sort = $("#sort").val();
      var url = $("#url").val();

      @foreach($ProductFilter as $filter)

            var {{$filter['filter_column']}} = get_filter('{{$filter['filter_column']}}');

      @endforeach

  
      $.ajax({
        headers: {
          "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        method: "post",

        data: {
           @foreach($ProductFilter as $filter)
                    {{$filter['filter_column']}}:{{$filter['filter_column']}},
          @endforeach
          url: url,
          sort: sort,
          color:color,
          size:size,
          brand:brand
        },
        success: function(data) {
          $(".filter-products").html(data);
        },
        error: function() {
          alert("error");
        },
      });
    });


 //changing on price //
    //  $(".price").on("change", function() {
    //   alert('hello');
    //   var color = get_filter('color');
    //   var size = get_filter('size');
    //   var brand = get_filter('brand');
    //   var price = get_filter('price');
    //   var sort = $("#sort").val();
    //   var url = $("#url").val();

    //   @foreach($ProductFilter as $filter)

    //         var {{$filter['filter_column']}} = get_filter('{{$filter['filter_column']}}');

    //   @endforeach

    //   alert(url);
    //   $.ajax({
    //     headers: {
    //       "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
    //     },
    //     method: "post",

    //     data: {
    //        @foreach($ProductFilter as $filter)
    //                 {{$filter['filter_column']}}:{{$filter['filter_column']}},
    //       @endforeach
    //       url: url,
    //       sort: sort,
    //       color:color,
    //       size:size,
    //       brand:brand,
    //       price:price
    //     },
    //     success: function(data) {
    //       $(".filter-products").html(data);
    //     },
    //     error: function() {
    //       alert("error");
    //     },
    //   });
    // });
    

    //Dynamic filter change //
    @foreach($ProductFilter as $filter)

          $(".{{$filter['filter_column']}}").on('click', function() {
          
            var color = get_filter('color');
            var size = get_filter('size');
            var brand = get_filter('brand');
            var price = get_filter('price');
            var sort = $("#sort").val();
            var url = $("#url").val();
          


            @foreach($ProductFilter as $filter)

            var {{$filter['filter_column']}} = get_filter('{{$filter['filter_column']}}');

            @endforeach

             $.ajax({

              headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
              },
              url: url,
              method: "POST",

              data:{
                 @foreach($ProductFilter as $filter)
                    {{$filter['filter_column']}}:{{$filter['filter_column']}},
                 @endforeach
                 url: url,
                sort: sort,
              },
                
              success: function(data) {
             
                $(".filter-products").html(data);
              }

             });

           });

    @endforeach

   // Clear button for unchecked checkbox and clear all filters//
    $('.clear-btn').on('click',function(){
        
        var result = confirm("Are you sure you want to Clear All Filters");

        if (!result) {
            return false;
        }
        $('input:checkbox').removeAttr('checked');
        var color = get_filter('color');
            var size = get_filter('size');
            var brand = get_filter('brand');
            var price = get_filter('price');
            var sort = $("#sort").val();
            var url = $("#url").val();
        
        @foreach($ProductFilter as $filter)

            var {{$filter['filter_column']}} = get_filter('{{$filter['filter_column']}}');

      @endforeach

      
      $.ajax({
        headers: {
          "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        method: "post",

        data: {
           @foreach($ProductFilter as $filter)
                    {{$filter['filter_column']}}:{{$filter['filter_column']}},
          @endforeach
          url: url,
          sort: sort,
          color:color,
          size:size,
          brand:brand
        },
        success: function(data) {
          $(".filter-products").html(data);
        },
        error: function() {
          alert("error");
        },
      });
    })
  });
</script>