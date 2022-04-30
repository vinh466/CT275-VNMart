@extends('layouts.home')

@section('cssLink')
    <link rel="stylesheet" type="text/css" href="/plugins/sb-admin-2/sb-admin-2.css">
@endsection

@section('content')
   
    <!-- 404 Error Text -->
    <div class="text-center">
        <div class="error mx-auto mt-4" data-text="404">404</div>
        <p class="lead text-gray-800 mb-5">Page Not Found</p>
        <p class="text-gray-500 mb-0">Có vẻ bạn đã gặp vấn đề với đường dẫn ...</p>
        <a href="./">&larr; Trở lại trang chính</a>
    </div>
   
@endsection