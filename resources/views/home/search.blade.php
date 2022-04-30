@extends('layouts.home')

@section('content')

    <div class="container product">
        <div class="section-name">
            <h1 class="fs-3 text text-start m-3" style="font-weight: bold;">Kết quả tìm kiếm</h1>
        </div>
        <div class="row text-center section">
            <div class="col-12">
                <div class="row row-cols-5 justify-content-center">

                    @foreach ($products as $item)

                    <div class="col-2 m-1 item pt-3 pb-3 m-2" style="min-width:225px;" title="{{ $item->MoTa }}">
                        <img height="150px" src="/img/home/sanpham/{{ $item->Anh }}">
                        <h5 class="text-overflow fw-bold">{{ $item->Ten }}</h5>
                        <h6 class="text-danger">
                           @if($item->GiamGia > 0)
                              <del>@vnd($item->DonGia)</del>
                           @else
                              <br>
                           @endif 
                        </h6>
                        <h6 class="fw-bold">@vnd($item->DonGia - $item->DonGia * $item->GiamGia / 100)</h6>
                        <input hidden type="text" name="SP_Ma" value="{{$item->SP_Ma}}">
                        <a href="" class="btn btn-danger add-cart-btn">Thêm vào giỏ hàng</a>
                     </div>
                        
                    @endforeach
                </div>
            </div>
        </div>
    </div>

@endsection