@extends('layouts.admin')

@section('title', $title)

@section('css')
    <style>
    .custom-csv-button {}
    .custom-print-button {
        background-color: #36b9cc!important;
        color: #fff!important;
        border-radius: 10px!important;
        float: right!important;
        margin-right: 10px!important;
    }
    </style>
@endsection

@section('sidebar-active-product', 'active' )

@section('breadcrumb')
    <li class="breadcrumb-item active"><a href="/admin/product">Quản lý Sản phẩm</a></li>
@endsection

@section('content')
    <!-- Main Content -->
    <div id="content">

        <!-- Begin Page Content -->
        <div class="container-fluid">

            <!-- Content Row -->
            <div class="row">

                
                <div class="col card shadow mb-4">
                    <table id="grid">
                        <thead>
                            <tr>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th width="120" class="gj-button-md " data-tmpl="<i class='fas fa-pen text-warning'></i> Chỉnh Sửa "align="center" data-events="click: Edit"></th>
                                <th width="80" data-tmpl="<i class='fas fa-trash text-danger'></i> Xóa " align="center" data-events="click: Delete"></th>
                            </tr>
                        </thead>
                    </table>
                        
                </div>

            </div>

        </div>
        <!-- /.container-fluid -->
        
        {{-- Modal --}}
        <div id="dialog-product-edit" class="gj-display-none modal" width="360" data-auto-open="false" data-modal="true">
            <div data-role="body" id="dialog-product">
                <input type="hidden" id="ID" />
                <div id="modalSP_MaInput">
                    <span class="gj-dialog-md-title title-form">Mã</span>
                    <input type="text" class="gj-textbox-md " id="modalSP_Ma"  disabled>
                </div>
                <div class="gj-margin-top-20">
                    <span class="gj-dialog-md-title title-form">Tên</span>
                    <input type="text" class="gj-textbox-md" id="modalTen" />
                </div>
                {{-- group --}}
                <span class="gj-dialog-md-title title-form">Loại</span><br>
                <div class="row gj-margin-top-20" id="modalCategory">
                    @foreach ($category as $item)
                        <label class="col-4 label-choose" for="modal{{$item->DM_Ma}}">
                            <input class="modal-checkBox" type="checkbox" id="modal{{$item->DM_Ma}}" name="{{$item->DM_Ma}}">
                            <label class="gj-dialog-md-title" for="modal{{$item->DM_Ma}}">{{$item->Ten}}</label>
                        </label>
                    @endforeach
                </div>
                {{-- group --}}
                <div class="gj-margin-top-20 d-flex justify-content-between flex-1">
                    <div class="gj-margin-top-20 flex-fill mr-3">
                        <span class="gj-dialog-md-title title-form">Đơn vị</span>
                        <input type="text" class="gj-textbox-md" id="modalDonVi">
                    </div>
                    <div class="gj-margin-top-20 flex-fill">
                        <span class="gj-dialog-md-title title-form">Trạng thái</span>
                        <input type="text" class="gj-textbox-md" id="modalTrangThai">
                    </div>
                </div>
                {{-- group --}}
                <div class="gj-margin-top-20 d-flex justify-content-between">
                    <div class="gj-margin-top-20 flex-fill mr-3">
                        <span class="gj-dialog-md-title title-form">Số lượng</span>
                        <input type="text" class="gj-textbox-md" id="modalSoLuong" />
                    </div>
                    <div class="gj-margin-top-20 flex-fill mr-3">
                        <span class="gj-dialog-md-title title-form">Đơn giá (vnd)</span>
                        <input type="text" class="gj-textbox-md" id="modalDonGia" />
                    </div>
                    <div class="gj-margin-top-20 flex-fill">
                        <span class="gj-dialog-md-title title-form">Giảm giá (%)</span>
                        <input type="text" class="gj-textbox-md" id="modalGiamGia">
                    </div>
                </div>
                <div class="gj-margin-top-20">
                    <span class="gj-dialog-md-title title-form">Ảnh</span>
                    <input type="text" class="gj-textbox-md" id="modalAnh" />
                </div>
                <div class="gj-margin-top-20">
                    <span class="gj-dialog-md-title title-form">Mô tả</span>
                    <textarea type="text" class="gj-textbox-md" id="modalMoTa" rows="4"></textarea>
                </div>
            </div>
            <div data-role="footer">
                <button type="button" id="btnEdit" class="gj-button-md text-warning h4"><b>Lưu</b></button>
                <button type="button" id="" class="gj-button-md text-danger h4 btnCancel"><b>Hủy</b></button>
            </div>
        </div>
        {{-- Modal End --}}

        {{-- Modal Delete --}}
        <div id="dialog-product-delete" class="gj-display-none modal" width="360" data-auto-open="false" data-modal="true">
            <div data-role="body">
                <h4>Bạn chắc là muốn xóa sản phẩm mã <span id="modalProductMaSP"></span></h4>
            </div>
            <div data-role="footer">
                <button type="button" id="btnDelete" class="gj-button-md text-danger">Xác nhận</button>
                <button type="button" id="" class="gj-button-md text-warning btnCancel">Hủy</button>
            </div>
        </div>
        {{-- Modal Edit End --}}
    </div>
    <!-- End of Main Content -->
@endsection

@section('script')
<script src="/js/admin/product.js" defer></script>
@endsection