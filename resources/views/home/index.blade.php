@extends('layouts.home')

@section('content')
   {{-- Slider Start --}}
   <div class="container slider">
      <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
         <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active dot" aria-current="true" aria-label="Slide 1" style="width: 20px; height: 20px; border-radius: 50%;"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2" style="width: 20px; height: 20px; border-radius: 50%;"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3" style="width: 20px; height: 20px; border-radius: 50%;"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="3" aria-label="Slide 4" style="width: 20px; height: 20px; border-radius: 50%;"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="4" aria-label="Slide 5" style="width: 20px; height: 20px; border-radius: 50%;"></button>
         </div>
         <div class="carousel-inner">
            <div class="carousel-item active">
               <img src="/img/home/Slider1.png" class="d-block">
            </div>
            <div class="carousel-item">
               <img src="/img/home/Slider1.png" class="d-block">
            </div>
            <div class="carousel-item">
               <img src="/img/home/Slider1.png" class="d-block">
            </div>
            <div class="carousel-item">
               <img src="/img/home/Slider1.png" class="d-block">
            </div>
            <div class="carousel-item">
               <img src="/img/home/Slider1.png" class="d-block">
            </div>
         </div>
         <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
         <span class="carousel-control-prev-icon" aria-hidden="true"></span>
         {{-- <span class="visually-hidden">Previous</span> --}}
         </button>
         <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
         <span class="carousel-control-next-icon" aria-hidden="true"></span>
         {{-- <span class="visually-hidden">Next</span> --}}
         </button>
      </div>
   </div>
   {{-- End Slider --}}

   {{-- Product --}}
   <div class="container product">
      @foreach ($listData as $item)

         <div class="section-name">
            <h1 class="fs-3 text text-start m-3" style="font-weight: bold;">{{ $item->Ten }}</h1>
         </div>

         <div class="row text-center section">
            <div class="col-12">
               <div class="row row-cols-5 justify-content-center">

                  @foreach ($productsType as $key => $product)

                     @if($key === $item->DM_Ma)
                        @foreach ($product as $key => $item)
                              @if($loop->index == 10)
                                 @break
                              @endif
                              <div class="col-2 m-1 item pt-3 pb-3 m-2" style="min-width:225px;" title="">
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
                     @endif

                  @endforeach

               </div>
            </div>
         </div>
      @endforeach
   </div>
   {{-- End Product --}}
   
@endsection