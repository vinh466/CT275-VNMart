$(document).ready(function () {
    var productId = '#dataTable-products';
    var productsData = {};
    $.ajax({
        url: '/api/get-products',
        type: 'POST',
        success: function (result) {
            try {
                productsData = JSON.parse(result);
                console.log(productsData);
            } catch (e) {
                console.error(e);
                productsData = {};
            }
        },
        fail: function (xhr, textStatus, errorThrown) {

        }, 
        complete: function (data) {
            var editor = new $.fn.dataTable.Editor({
                // ajax: "/api/get-products",
                table: productId,
                idSrc: "SP_Ma",
                dom: "Bfrtip",
                fields: [
                    { label: "Tên sản phẩm", name: 'SP_Ma', type: "hidden"},
                    { label: "Tên sản phẩm", name: 'Ten' },
                    { label: "Mô tả", name: 'MoTa', type: "textarea" },
                    { label: "Ảnh", name: 'Anh' },
                    { label: "SoLuong", name: 'SoLuong' },
                    { label: "DonGia", name: 'DonGia' },
                    { label: "GiamGia", name: 'GiamGia' },
                    { label: "TrangThai", name: 'TrangThai' },
                    { label: "DonVi", name: 'DonVi' },
                ]
            });
            var tableTitle = "VN Mart";
            var tableSubTitle = "Danh sách sản phẩm";
            var table =$(productId).DataTable({
                data: productsData,
                select: true,
                "pageLength": 5,
                lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "Tất cả"]],
                "oLanguage": {
                    "sInfo": "Đang hiển thị _START_ đến _END_ của _TOTAL_ sản phẩm",// text you want show for info section
                },
                language: {
                    "search": "Tìm:",
                    "lengthMenu": "Show _MENU_ entries",
                    "emptyTable": "Không có dữ liệu ... ",
                },
                dom: 'Bfrtip',
                responsive: {
                    details: {
                        type: 'column',
                        target: -1
                    }
                },
                columnDefs: [
                    { responsivePriority: 1, targets: -3 },
                    { responsivePriority: 1, targets: -2 },
                    { responsivePriority: 1, targets: 0 },
                    { responsivePriority: 1, targets: 1 },
                    { responsivePriority: 1111111, targets: 2 },
                    { responsivePriority: 1111110, targets: 3},
                    {
                        className: 'dtr-control',
                        orderable: false,
                        targets: -1
                    },
                    {
                        targets: 2,
                        render: function (data, type, row) {
                            return data.length > 90 ? data.substr(0, 90) + '…' :data;
                        }
                    },
                ],
                buttons: [
                    {
                        extend: 'create', 
                        editor: editor, 
                        formTitle: "Thêm mới sản phẩm",
                        formButtons: [
                            {
                                text: 'Thêm', action: function () {
                                    var url = '/admin/product/add';
                                    var form = $('<form action="' + url + '" method="post">' +
                                        '<input hidden name="Anh" value="' + editor.val().Anh + '" />' +
                                        '<input hidden name="DonGia" value="' + editor.val().DonGia + '" />' +
                                        '<input hidden name="DonVi" value="' + editor.val().DonVi + '" />' +
                                        '<input hidden name="GiamGia" value="' + editor.val().GiamGia + '" />' +
                                        '<input hidden name="MoTa" value="' + editor.val().MoTa + '" />' +
                                        '<input hidden name="SoLuong" value="' + editor.val().SoLuong + '" />' +
                                        '<input hidden name="Ten" value="' + editor.val().Ten + '" />' +
                                        '<input hidden name="TrangThai" value="' + editor.val().TrangThai + '" />' +
                                        '<input hidden name="addSubmit" value="addProduct" />' +
                                        '</form>');
                                    $('body').append(form);
                                    form.submit();
                                },
                                className: ""
                            },
                            {
                                text: 'Đóng', action: function () {
                                    this.close();
                                }, className: ""
                            }
                        ]
                    },
                    {
                        extend: 'edit', editor: editor,
                        formTitle: "Chỉnh sửa thông tin",
                        formButtons: [
                            {
                                text: 'Cập nhập', action: function () {
                                    var url = '/admin/product/edit';
                                    var form = $('<form action="' + url + '" method="post">' +
                                        '<input hidden name="SP_Ma" value="' + editor.val().SP_Ma + '" />' +
                                        '<input hidden name="Anh" value="' + editor.val().Anh + '" />' +
                                        '<input hidden name="DonGia" value="' + editor.val().DonGia + '" />' +
                                        '<input hidden name="DonVi" value="' + editor.val().DonVi + '" />' +
                                        '<input hidden name="GiamGia" value="' + editor.val().GiamGia + '" />' +
                                        '<input hidden name="MoTa" value="' + editor.val().MoTa + '" />' +
                                        '<input hidden name="SoLuong" value="' + editor.val().SoLuong + '" />' +
                                        '<input hidden name="Ten" value="' + editor.val().Ten + '" />' +
                                        '<input hidden name="TrangThai" value="' + editor.val().TrangThai + '" />' +
                                        '<input hidden name="editSubmit" value="editProduct" />' +
                                        '</form>');
                                    $('body').append(form);
                                    form.submit();
                                },
                                className: ""
                            },
                            {
                                text: 'Đóng', action: function () {
                                    this.close();
                                }, className: ""
                            }
                        ]
                    },
                    {
                        extend: 'remove', editor: editor,
                        formTitle: "Xóa",
                        formButtons: [
                            {
                                text: 'Xóa', action: function () {
                                    $id = table.row('tr').data().SP_Ma;
                                    var url = '/admin/product/delete';
                                    var form = $('<form action="' + url + '" method="post">' +
                                        '<input hidden name="SP_Ma" value="' + $id + '" />' +
                                        '<input hidden name="deleteSubmit" value="deleteProduct" />' +
                                        '</form>');
                                    $('body').append(form);
                                    form.submit();
                                },
                                className: ""
                            },
                            {
                                text: 'Đóng', action: function () {
                                    this.close();
                                }, className: ""
                            }
                        ]
                    },
                    "pageLength",
                    {
                        extend: 'print',
                        text: '<i class="fas fa-print"><span class="fw-normal"> In</span></i>',
                        className: 'btn-primary custom-print-button',
                        title: tableTitle,
                        messageTop: tableSubTitle,
                        titleAttr: 'Print Table'
                    },
                    {
                        extend: 'csv',
                        text: '<i class="fas fa-file-csv"><span class="fw-normal"> Xuất csv</span></i>',
                        className: 'btn-primary custom-csv-button',
                        titleAttr: 'Export to CSV'
                    },
                    {
                        extend: 'excel',
                        text: '<i class="fas fa-file-excel"><span class="fw-normal"> Xuất Excel</span></i>',
                        className: 'btn-primary',
                        title: tableTitle,
                        messageTop: tableSubTitle,
                        titleAttr: 'Export to Excel'
                    },
                    {
                        extend: 'pdf',
                        text: '<i class="fas fa-file-pdf"><span class="fw-normal"> Xuất PDF</span></i>',
                        className: 'btn-primary',
                        title: tableTitle,
                        messageTop: tableSubTitle,
                        titleAttr: 'Export to PDF'
                    },
                    {
                        extend: 'copy',
                        text: '<i class="fas fa-copy"><span class="fw-normal"> Chép</span></i>',
                        className: 'btn-primary',
                        title: tableTitle,
                        messageTop: tableSubTitle,
                        titleAttr: 'Copy to Clipboard'
                    },
                ],
                
                "columns": [
                    { data: 'SP_Ma' },
                    { data: 'Ten' },
                    { data: 'MoTa' },
                    { data: 'Anh' },
                    { data: "category", render: "[, ].Ten"},
                    { data: 'SoLuong' },
                    { data: 'DonGia' },
                    { data: 'GiamGia' },
                    { data: 'TrangThai' },
                    { data: 'DonVi' },
                    {
                        data: null,
                        className: "dt-center editor-edit text-warning",
                        defaultContent: '<i class="fa fa-pencil"/>',
                        orderable: true
                    },
                    {
                        data: null,
                        className: "dt-center editor-delete text-danger",
                        defaultContent: '<i class="fa fa-trash"/>',
                        orderable: true
                    },
                    {
                        // class: "details-control",
                        orderable: false,
                        data: null,
                        defaultContent: ""
                    },
                ]
            });

            // New record
            $('a.editor-create').on('click', function (e) {
                e.preventDefault();

                editor.create({
                    title: 'Create new record',
                    buttons: 'Add'
                });
            });

            // Edit record
            $(productId).on('click', 'td.editor-edit', function (e) {
                e.preventDefault();
                $('.dt-button.buttons-selected.buttons-edit').trigger('click');
            });

            // Delete a record
            $(productId).on('click', 'td.editor-delete', function (e) {
                e.preventDefault();
                $('.buttons-selected.buttons-remove').trigger('click');
            });
        }
    });
});