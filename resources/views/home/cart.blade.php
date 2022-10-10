@extends('layouts.home')
@section('content')
<div class="container-sm">
    <div class="card">
        <div class="row justify-content-center pt-4 pb-4">
            <div class="col-6 cart">
                <div class="title">
                    <div class="row">
                        <div class="col-10">
                            <h4><b>Giỏ hàng của bạn</b></h4>
                        </div>
                        <div class="col-2"><span class="quantity">{{$products->count()}}</span><span> món</span></div>
                    </div>
                </div>
                <div class="row border-top border-bottom">
                    @isset( $message )
                        <h5> {{$message}} </h5>
                    @endisset

                    @php
                        $sum = 0;
                    @endphp
                    @foreach ($products as $product)

                        @foreach ($CartList as $cartID => $amount)

                            @if ($product->SP_Ma == $cartID)
                                <div class="row main align-items-center">
                                    <div class="col-2"><img class="img-fluid" src="/img/home/sanpham/{{ $product->Anh }}"></div>
                                    <div class="col-5">
                                        <div class="row">{{ $product->Ten }}</div>
                                    </div>
                                    <div class="col-2 d-flex amount-input">
                                        <span class="d-none spMa">{{ $product->SP_Ma }}</span>
                                        <button class="text-dark amount-input-sub px-2">- </button>
                                        <input type="text" class="" value="{{$amount}}" style="width: 40px">
                                        <button class="text-dark amount-input-add px-2"> +</button> 
                                    </div>
                                    <div class="col-2">
                                        <input hidden type="text" value="{{$product->DonGia * (100 - $product->GiamGia) / 100}}">
                                        <span class="text-right">
                                            @php
                                                $sum += $amount * $product->DonGia * (100 - $product->GiamGia) / 100;
                                            @endphp
                                            @vnd($amount * $product->DonGia - $product->DonGia * $product->GiamGia / 100)
                                        </span>
                                    </div><div class="col-1">
                                        <span class="btn removeFromCart"> 
                                            <input hidden type="text" value="{{$product->SP_Ma}}">
                                            <i class="fas fa-trash"></i>
                                        </span>
                                    </div>
                                </div>
                            @endif
                                            
                        @endforeach
                        
                    @endforeach
                </div>
            </div>

            {{-- Thanh toán --}}
            <div class="offset-1 col-4 summary">
                <div class="col">
                    <h4><b>Thanh toán</b></h4>
                </div>
                <form>
                    <p>Kiểu thanh toán</p><select>
                        <option class="">Thanh toán trực tiếp khi nhận hàng</option>
                        <option class="">Thanh toán online</option>
                    </select>
                    <p>Mã khuyến mãi</p> <input id="code" placeholder="Mã khuyến mãi của bạn">
                </form>
                <div class="row" style="border-top: 1px solid rgba(0,0,0,.1); padding: 2vh 0;">
                    <div class="col">Tổng tiền:</div>
                    <div class="col text-right" id="total">
                        <span>@vnd( $sum )</span><span></span>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-5 offset-1 back-to-shop">
                    <a style="text-decoration: none;" href="/"><i class="fas fa-arrow-alt-to-left text-dark"></i><span class="text-dark"> Mua thêm</span></a>
                </div>
                <form class="offset-1 col-5 " id="fr-payment" action="/cart/payment" method="POST"> 
                    @foreach ($CartList as $key => $value)
                        <input hidden type="text" name="{{$key}}" value="{{$value}}">
                    @endforeach
                    <button class="btn btn-danger btn-payment" @isset($CartList)
                        type="submit"
                    @endisset>THANH TOÁN</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection