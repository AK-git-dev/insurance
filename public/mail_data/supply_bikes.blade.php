@extends('layouts.frontLayout.front-layout')
@section('title', 'Sell Bikes')
@section('content')
<section class="left-main-bg" id="search_res">
    <div class="container ">
        <div class="row">
            <div class="col-md-4 d-none d-md-block">
                <div class="right-block pt-5">
                    <div class="left-filters-block">
                        <form action="" id="sellBikeFilterForm">
                            <div class="d-flex align-items-center left-filters mb-4">
                                <span class="refine-heading">Refine your results</span>
                                <span class="ml-auto "><a href="javascript:void(0)" onclick="resetFilterForm()" class="reset-btn">Reset All</a></span>
                            </div>
                            <div class="input-field">
                                <input type="text" autocomplete="off" name="model_name" id="model_name" class="input-block  bg-white" onkeyup="getFilterData()" placeholder="  " value="">
                                <label for="group_name" class="input-lbl">Search Bikes</label>
                                <i class="fa fa-search cust-search"></i>
                            </div>

                            <hr class="full-h-line ml-0">
                            <div class="accordion" id="accordionExample">
                                <div class="accordian-block">
                                    <div id="headingOne" class="d-flex align-items-center">
                                        <h2 class="mb-2">Categories</h2>
                                        <a href="javascript:;" class="plus-icon" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne"></a>
                                    </div>

                                    <div id="collapseOne" class="collapse show ml-3 mt-2" aria-labelledby="headingOne" data-parent="#accordionExample">
                                        @foreach($categories as $category)
                                        <div class="custom-control custom-checkbox mb-2 mt-3">
                                            <input class="custom-control-input" type="checkbox" value="{{$category}}" name="category_id[]" id="{{$category}}" onclick="getFilterData()">
                                            <label class="custom-control-label" for="{{$category}}">
                                                {{$category}}
                                            </label>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                                <hr class="full-h-line ml-0 my-4">

                                <div class="accordian-block">
                                    <div id="headingFour" class="d-flex align-items-center">
                                        <h2 class="mb-2">Price</h2>
                                        <a href="javascript:;" class="plus-icon" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseOne"></a>
                                    </div>

                                    <div id="collapseFour" class="collapse ml-3 mt-2" aria-labelledby="headingFour" data-parent="#accordionExample">
                                        <div style="height:55px;">						
                                            <div class="rangeslider ml-0"  id="priceRangeslider" content="" info="" rangeDay="">
                                                <input type="hidden" name="min_price" id="minPrice" value="20000">				
                                                <input type="hidden" name="max_price" id="maxPrice" value="500000">				
                                                <p class="mb-0"><small class="range_min">20000</small> Rs. - <small class="range_max">500000</small> Rs.</p>
                                                <input class="min" name="range_1" type="range" min="20000" max="500000" value="2000" onchange="priceRangeSlider(event, 'min')"/>
                                                <input class="max" name="range_1" type="range" min="20000" max="500000" value="500000" onchange="priceRangeSlider(event, 'max')" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr class="full-h-line ml-0 my-4">

                                <div class="accordian-block">
                                    <div id="headingTwo" class="d-flex align-items-center">
                                        <h2 class="mb-0">
                                            Bike Brand
                                        </h2>
                                        <a href="javascript:;" class="plus-icon" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseEight"></a>
                                    </div>
                                    <div id="collapseTwo" class="collapse ml-3 mt-2" aria-labelledby="headingTwo" data-parent="#accordionExample">
                                        @foreach($brands as $brand)
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" value="{{$brand->id}}" name="bike_category" onclick="getFilterData();getBikeModelsByBrandId(this.value);">
                                            <label class="form-check-label" for="flexRadioDefault1">
                                                {{$brand->brand_name}}
                                            </label>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>

                                <hr class="full-h-line ml-0 my-4">
                                <div class="accordian-block">
                                    <div id="headingThree" class="d-flex align-items-center">
                                        <h2 class="mb-0">
                                            Bike Model
                                        </h2>
                                        <a href="javascript:;" class="plus-icon" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseEight"></a>
                                    </div>
                                    <div id="collapseThree" class="collapse ml-3 mt-2" aria-labelledby="headingThree" data-parent="#accordionExample">

                                    </div>
                                </div>

                                <hr class="full-h-line ml-0 my-4">

                            </div>
                    </div>
                    </form>
                </div>
            </div>
            <div class="col-md-8" id="filtered_supply_bike_data">
                <div class="cust-left-block pt-5">
                    <h2 class="page-heading">Total Bikes</h2>
                    <div class="d-flex align-items-center filter-details mb-4">
                        <span class="filter-block1">{{count($result)}} Results </strong></span>

                        <span class="ml-auto sort-block dropdown ">
                            <a href="#" class="sortby-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <label>Sort by</label>
                                Ratings <i class="fa fa-angle-down drop-arrow"></i></a>
                        </span>
                    </div>
                    <div class="row">
                        @if(count($result) > 0)
                        @foreach($result as $key => $bike)
                        <div class="col-6 mb-3">
                            <div class="rides-block d-none d-md-flex">
                                <div class="col-12">
                                    <a href="{{route('supply_bikes.show', $bike['slug'])}}" class="href">
                                        <img src="{{ asset('public/images/supply_bikes/')}}/{{$bike['image'] }}" class="img-fluid" width="250" height="180">
                                    </a>
                                    <div class="rider-details-block w-100 order-1 order-md-2">
                                        <div class="location-heading-block ">
                                            <div>
                                                <h4 class="location-title">{{$bike['model']}}</h4>
                                                <div class="d-flex align-items-center ">
                                                    <span class="other-details">
                                                        <i class="fa">Rs. </i> {{ucfirst($bike['total_price'])}}
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="location-details d-flex align-items-center">
                                            <span class="other-details">
                                                <i class="fa fa-tag text-warning"></i>{{ $bike['category']}}
                                            </span>
                                            <span class="other-details">
                                                <i class="fa fa-motorcycle text-danger"></i>{{ $bike['brand']}}
                                            </span>
                                        </div>
                                        <div>
                                            <a href="{{route('supply_bikes.show', $bike['slug'])}}" class="href">More Details</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        @else
                        <div class="col-12 mb-3">
                            <h4 class="location-title my-2">Record Not Found</h4>
                        </div>
                        @endif
                    </div>
                </div>

            </div>
        </div>

</section>
@stop

<script src="{{ asset('public/rider/js/jquery-3.4.1.min.js')}}"></script>
<script>
    function getBikeModelsByBrandId(brand_id) {
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
            url: "{{route('bike-brand.models')}}",
            type: "POST",
            data: {
                brand_id: brand_id
            },
            success: function(response) {
                $('#collapseThree').html(response);
            }
        });

    }

    function resetFilterForm() {
        location.reload();
    }

    function getFilterData() {
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
            url: "{{route('supply_bikes.search')}}",
            type: "POST",
            data: $('#sellBikeFilterForm').serialize(),
            success: function(response) {
                $('#filtered_supply_bike_data').html(response);
            }
        });
    }

function addSeparator(nStr) {
    nStr += '';
    var x = nStr.split('.');
    var x1 = x[0];
    var x2 = x.length > 1 ? '.' + x[1] : '';
    var rgx = /(\d+)(\d{3})/;
    while (rgx.test(x1)) {
        x1 = x1.replace(rgx, '$1' + '.' + '$2');
    }
    return x1 + x2;
}

function priceRangeSlider(e, origin){
    
    var minBtn = $('#priceRangeslider').children('.min'),
        maxBtn = $('#priceRangeslider').children('.max'),
   
        minVal = parseInt($(minBtn).val()),
        maxVal = parseInt($(maxBtn).val());

    if(origin === 'min' && minVal > maxVal-5){
        $(minBtn).val(maxVal-5);
    }
    var minVal = parseInt($(minBtn).val());
    $('#minPrice').val(minVal);
    $('small.range_min').html(minVal);


    if(origin === 'max' && maxVal-5 < minVal){
        $(maxBtn).val(5+ minVal);
    }
    var maxVal = parseInt($(maxBtn).val());
    $('#maxPrice').val(maxVal);
    $('small.range_max').html(maxVal);

    getFilterData();
}
</script>