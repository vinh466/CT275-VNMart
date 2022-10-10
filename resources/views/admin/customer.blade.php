@extends('layouts.admin')

@section('sidebar-active-customer', 'active' )

@section('title', $title )

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

@section('breadcrumb')
    <li class="breadcrumb-item active"><a href="/admin/customer">Quản lý Khách hàng</a></li>
@endsection

@section('content')
    <!-- Main Content -->
    <div id="content">

        <!-- Begin Page Content -->
        <div class="container-fluid">

            <!-- Content Row -->
            <div class="row">

                <!-- DataTales Example -->
                <div class="col card shadow mb-4">
                    <table id="grid">
                        <thead>
                            <tr>
                                <th></th>
                                <th data-sortable="true"></th>
                                <th></th>
                                {{-- <th data-field="PlaceOfBirth">Ten</th> --}}
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th width="120" class="gj-button-md " data-tmpl="<i class='fas fa-pen text-warning'></i> Chỉnh Sửa"align="center" data-events="click: Edit"></th>
                                <th width="80" data-tmpl="<i class='fas fa-trash text-danger'></i> Xóa" align="center" data-events="click: Delete"></th>
                            </tr>
                        </thead>
                    </table>
                        
                </div>

            </div>

        </div>
        <!-- /.container-fluid -->
        {{-- Modal Edit --}}
        <div id="dialog-customter-edit" class="gj-display-none modal" width="360" data-auto-open="false" data-modal="true">
            <div data-role="body">
                <input type="hidden" id="ID" />
                <div class="">
                    <span class="gj-dialog-md-title ">Email</span>
                    <input type="text" class="gj-textbox-md " id="modalEmail" disabled>
                </div>
                <div class="gj-margin-top-20">
                    <span class="gj-dialog-md-title">Mật khẩu</span>
                    <input type="text" class="gj-textbox-md" id="modalMatKhau" />
                </div>
                {{-- group --}}
                <div class="gj-margin-top-20 d-flex justify-content-between flex-1">
                    <div class="gj-margin-top-20 flex-fill mr-3">
                        <span class="gj-dialog-md-title">Tên</span>
                        <input type="text" class="gj-textbox-md" id="modalTen" />
                    </div>
                    <div class="gj-margin-top-20 flex-fill mr-3">
                        <span class="gj-dialog-md-title">Họ</span>
                        <input type="text" class="gj-textbox-md" id="modalHo" />
                    </div>
                    <div class="gj-margin-top-20 flex-fill">
                        <span class="gj-dialog-md-title">Giới tính</span>
                        <select class="gj-textbox-md" id="modalGioiTinh">
                        <option check>Nam</option>
                        <option>Nữ</option>
                        </select>
                    </div>
                </div>
                <div class="gj-margin-top-20 flex-fill">
                    <span class="gj-dialog-md-title">Số điện thoại</span>
                    <input type="text" class="gj-textbox-md" id="modalSDT">
                </div>
                <div class="gj-margin-top-20">
                    <span class="gj-dialog-md-title">Địa chỉ</span>
                    <textarea type="text" class="gj-textbox-md" id="modalDiaChi"></textarea>
                </div>
                <div class="gj-margin-top-20">
                    <span class="gj-dialog-md-title">Ảnh cá nhân</span>
                    <input type="text" class="gj-textbox-md" id="modalAnhCaNhan"/>
                </div>
            </div>
            <div data-role="footer">
                <button type="button" id="btnEdit" class="gj-button-md text-warning">Lưu</button>
                <button type="button" id="" class="gj-button-md text-danger btnCancel">Hủy</button>
            </div>
        </div>
        {{-- Modal Edit End --}}

        {{-- Modal Delete --}}
        <div id="dialog-customter-delete" class="gj-display-none modal" width="360" data-auto-open="false" data-modal="true">
            <div data-role="body">
                <h4>Bạn chắc là muốn xóa <span id="modalEmailDelete"></span></h4>
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
    <script src="/js/admin/customer.js" defer></script>
@endsection