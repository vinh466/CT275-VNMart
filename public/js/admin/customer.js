$(document).ready(function () {
    var customersData = {};
    var customersId = '#dataTable-customer';
    $.ajax({
        url: '/api/get-customers',
        type: 'POST',
        success: function (result) {
            try {
                customersData = JSON.parse(result);
                console.log(customersData);
            } catch (e) {
                console.error(e);
                customersData = {};
            }
        },
        fail: function (xhr, textStatus, errorThrown) {
            
        },
        complete: function (data) {
            // Editor
            var editor = new $.fn.dataTable.Editor({
                // ajax: "php/users.php",
                table: customersId,
                idSrc: "Email",
                fields: [
                    { label: "Email", name: 'Email' },
                    { label: "MatKhau", name: 'MatKhau' },
                    { label: "Ho", name: 'Ho' },
                    { label: "Ten", name: 'Ten' },
                    { label: "SoDienThoai", name: 'SoDienThoai' },
                    { label: "DiaChi", name: 'DiaChi' },
                    { label: "AnhCaNhan", name: 'AnhCaNhan' },
                ]
            });


            // DataTable
            var tableTitle = "VN Mart";
            var tableSubTitle = "Danh sách khách hàng";
            var table = $(customersId).DataTable({
                select: true,
                dom: 'Bfrtip', 
                lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "Tất cả"]],
                oLanguage: {
                    "sInfo": "Đang hiển thị _START_ đến _END_ của _TOTAL_ khách hàng",// text you want show for info section
                },
                language: {
                    "search": "Tìm:",
                    "lengthMenu": "Hiển thị _MENU_ ", 
                    "emptyTable": "Không có dữ liệu ... ",
                },
                responsive: {
                    details: {
                        type: 'column',
                        target: -1
                    }
                },
                columnDefs: [
                    { responsivePriority: 1, targets: -3},
                    { responsivePriority: 1, targets: -2},
                    {
                        className: 'dtr-control',
                        orderable: false,
                        targets: -1
                    }
                ],
                buttons: [
                    {
                        extend: 'create',
                        editor: editor,
                        formTitle: "Thêm mới khách hàng",
                        formButtons: [
                            {
                                text: 'Thêm', action: function () {
                                    var url = '/admin/customer/add';
                                    var form = $('<form action="' + url + '" method="post">' +
                                        '<input hidden name="Email" value="' + editor.val().Email + '" />' +
                                        '<input hidden name="MatKhau" value="' + editor.val().MatKhau + '" />' +
                                        '<input hidden name="Ho" value="' + editor.val().Ho + '" />' +
                                        '<input hidden name="Ten" value="' + editor.val().Ten + '" />' +
                                        '<input hidden name="SoDienThoai" value="' + editor.val().SoDienThoai + '" />' +
                                        '<input hidden name="DiaChi" value="' + editor.val().DiaChi + '" />' +
                                        '<input hidden name="AnhCaNhan" value="' + editor.val().AnhCaNhan + '" />' +
                                        '<input hidden name="addSubmit" value="addCustomer" />' +
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
                                    var url = '/admin/customer/edit';
                                    var form = $('<form action="' + url + '" method="post">' +
                                        '<input hidden name="Email" value="' + editor.val().Email + '" />' +
                                        '<input hidden name="MatKhau" value="' + editor.val().MatKhau + '" />' +
                                        '<input hidden name="Ho" value="' + editor.val().Ho + '" />' +
                                        '<input hidden name="Ten" value="' + editor.val().Ten + '" />' +
                                        '<input hidden name="SoDienThoai" value="' + editor.val().SoDienThoai + '" />' +
                                        '<input hidden name="DiaChi" value="' + editor.val().DiaChi + '" />' +
                                        '<input hidden name="AnhCaNhan" value="' + editor.val().AnhCaNhan + '" />' +
                                        '<input hidden name="editSubmit" value="editCustomer" />' +
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
                                    $id = table.row('tr').data().Email;
                                    var url = '/admin/customer/delete';
                                    var form = $('<form action="' + url + '" method="post">' +
                                        '<input hidden name="Email" value="' + $id + '" />' +
                                        '<input hidden name="deleteSubmit" value="deleteCustomer" />' +
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
                data: customersData,
                columns: [
                    { "data": 'Email' },
                    { "data": 'MatKhau' },
                    { "data": 'Ho' },
                    { "data": 'Ten' },
                    { "data": 'SoDienThoai' },
                    { "data": 'DiaChi' },
                    { "data": 'AnhCaNhan' },
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
                ],
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
            $(customersId).on('click', 'td.editor-edit', function (e) {
                e.preventDefault();
                $('.dt-button.buttons-selected.buttons-edit').trigger('click');
            });

            // Delete a record
            $(customersId).on('click', 'td.editor-delete', function (e) {
                e.preventDefault();
                $('.buttons-selected.buttons-remove').trigger('click');
            });
        }
    });
    
});