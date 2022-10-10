var grid, countries;

function Add () {
    $('#modalEmail').val('');
    $('#modalEmail').prop('disabled', false);
    $('#modalTen').val('');
    $('#modalMatKhau').val('');
    $('#modalHo').val('');
    $('#modalSDT').val('');
    $('#modalDiaChi').val('');
    $('#modalAnhCaNhan').val('');
    $('#btnEdit').attr('id', 'btnAdd');
    $('#btnAdd').on('click', addProcess);
    dialogEdit.open('Thêm tài khoản.');
}
function Edit(e) {
    $('#modalEmail').val(e.data.record.Email);
    $('#modalEmail').prop('disabled', true);
    $('#modalTen').val(e.data.record.Ten);
    $('#modalHo').val(e.data.record.Ho);
    $('#modalMatKhau').val(e.data.record.MatKhau);
    $('#modalSDT').val(e.data.record.SoDienThoai);
    $('#modalDiaChi').val(e.data.record.DiaChi);
    $('#modalAnhCaNhan').val(e.data.record.AnhCaNhan);
    $('#btnAdd').attr('id', 'btnEdit');
    $('#btnEdit').on('click', editProcess);
    dialogEdit.open('Cập nhập thông tin');
}
function Delete(e) {
    $('#modalEmailDelete').text(e.data.record.Email);
    dialogDelete.open('Xác nhận');
}
function deleteProcess() {
    console.log("asdadad")
    if ($('#modalEmailDelete').text()) {
        var id = ($('#modalEmailDelete').text()).toString();
        console.log("Delete: " + id);
        var url = '/admin/customer/delete';
        var form = $('<form action="' + url + '" method="post">' +
            '<input hidden name="Email" value="' + id + '" />' +
            '<input hidden name="deleteSubmit" value="deleteCustomer" />' +
            '</form>');
        $('body').append(form);
        form.submit();
    }
    dialogDelete.close();
    grid.reload();
}
function editProcess() {
    if ($('#modalEmail').val()) {
        var id = ($('#modalEmail').val()).toString();
        console.log("Update: " + id);
        var url = '/admin/customer/edit';
        var form = $('<form action="' + url + '" method="post">' +
            '<input hidden name="Email" value="' + id + '" />' +
            '<input hidden name="MatKhau" value="' + $('#modalMatKhau').val() + '" />' +
            '<input hidden name="Ho" value="' + $('#modalTen').val() + '" />' +
            '<input hidden name="Ten" value="' + $('#modalHo').val() + '" />' +
            '<input hidden name="SoDienThoai" value="' + $('#modalSDT').val() + '" />' +
            '<input hidden name="DiaChi" value="' + $('#modalDiaChi').val() + '" />' +
            '<input hidden name="AnhCaNhan" value="' + $('#modalAnhCaNhan').val() + '" />' +
            '<input hidden name="editSubmit" value="editCustomer" />' +
            '</form>');
        $('body').append(form);
        form.submit();
    } 
    dialogEdit.close();
    grid.reload();
}
function addProcess() {
    if ($('#modalEmail').val()) {
        var id = ($('#modalEmail').val()).toString();
        console.log("Add: " + id);
        var url = '/admin/customer/add';
        var form = $('<form action="' + url + '" method="post">' +
            '<input hidden name="Email" value="' + id + '" />' +
            '<input hidden name="MatKhau" value="' + $('#modalMatKhau').val() + '" />' +
            '<input hidden name="Ho" value="' + $('#modalTen').val() + '" />' +
            '<input hidden name="Ten" value="' + $('#modalHo').val() + '" />' +
            '<input hidden name="SoDienThoai" value="' + $('#modalSDT').val() + '" />' +
            '<input hidden name="DiaChi" value="' + $('#modalDiaChi').val() + '" />' +
            '<input hidden name="AnhCaNhan" value="' + $('#modalAnhCaNhan').val() + '" />' +
            '<input hidden name="addSubmit" value="addCustomer" />' +
            '</form>');
        $('body').append(form);
        form.submit();
    }
    dialogEdit.close();
    grid.reload();
}
function showPaginationInfo(startItem, endItem, rowsTotal) {
    endItem = (endItem < rowsTotal) ? endItem : rowsTotal;
    $('#paging-info').html(`
            <span class="">Số hàng mỗi trang:</span>
            <select class="form-select" width="52">
                <option value="5">5</option>
                <option value="10">10</option>
                <option value="20">20</option>
                <option value="50">50</option>
            </select>
            <span class="gj-md-spacer-32">&nbsp;</span>
            <span class="">${startItem + 1}</span>
            <span class="">-</span><span class="">${endItem}</span>
            <span class="gj-grid-mdl-pager-label"> của </span>
            <span class="">${rowsTotal}</span>
        `)
}
function showPagination(currPage, rowsShown, rowsTotal) {
    var startItem = currPage * rowsShown;
    var endItem = startItem + rowsShown;
    $('#paging li').removeClass('active');
    $("#paging li[rel=" + currPage + "]").addClass('active');
    $('#grid tbody tr').css('opacity', '0.0').hide().slice(startItem, endItem).
        css('display', 'table-row').animate({ opacity: 1 }, 300);
    showPaginationInfo(startItem, endItem, rowsTotal);
} 
function hidePaging () {
    $('#after-table').remove();
}
function showPaging() {
    var rowsShown = 10;
    var rowsTotal = $('#grid tbody tr').length;
    
    var numPages = rowsTotal / rowsShown;
    $('#after-table').remove();
    $('#grid').after(`
                <div id="after-table" class="d-flex justify-content-between align-items-center">
                    <div class="pagination-info" id="paging-info"></div>
                    <div>
                        <ul class="pagination" id="paging"></ul>
                    </div>
                </div>
            `);
    var pageNum;
    for (i = 0; i < numPages; i++) {
        pageNum = i + 1;
        $('#paging').append('<li class="page-item" rel="' + i + '"><a class="page-link" href="#!">' + pageNum + '</a></li>');
    }
    $('#grid tbody tr').hide();
    showPagination(0, rowsShown, rowsTotal);
    $('#paging li:first').addClass('active');
    $('#paging').prepend('<li class="page-item"><a class="page-link page-link-icon" href="#"><i class="gj-icon chevron-left"></i></a></li>');
    $('#paging').append('<li class="page-item"><a class="page-link page-link-icon" href="#"><i class="gj-icon chevron-right"></i></a></li>');

    $('#paging li:not(:first-child):not(:last-child)').bind('click', function () {
        var currPage = $(this).attr('rel');
        showPagination(currPage, rowsShown, rowsTotal);
    });

    $('#paging li:first-child').bind('click', function () {
        var currPage = parseInt($('#paging li.active').attr('rel')) - 1;
        currPage = (currPage < 0) ? pageNum - 1 : currPage;
        showPagination(currPage, rowsShown, rowsTotal);
    });

    $('#paging li:last-child').bind('click', function () {
        var currPage = parseInt($('#paging li.active').attr('rel')) + 1;
        console.log(currPage)
        currPage = (currPage > pageNum - 1) ? 0 : currPage;
        showPagination(currPage, rowsShown, rowsTotal);
    });
}
$(document).ready(function () {
    grid = $('#grid').grid({
        dataSource: '/api/get-customers',
        uiLibrary: 'bootstrap5',
        // primaryKey: 'Email',
        detailTemplate: '<div ></div>', 
        toolbarTemplate: `
        <div class="row">
            <div class="col" style="line-height:34px">
                <div class="input-group mt-2">
                    <div class="form-outline">
                        <input id="searchData" type="search" id="form1" class="form-control" placeholder="Tìm kiếm"/>
                    </div>
                    <button id="btnSearch" type="button" class="btn btn-primary" style="border-radius: 0px 4px 4px 0px">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </div>
            <div class="col text-right">
                <button onClick="Add()" class="btn btn-success"><i class="fas fa-plus-circle"></i> Thêm</button>
            </div>
        </div>`,
        responsive: true,
        showHiddenColumnsAsDetails: true,
        minWidth: 560,
        columns: [
            { field: 'AnhCaNhan', tmpl: '<img src="{AnhCaNhan}" class="rounded-circle" width="40" alt="avatar" >', width: 60, align: 'left'},
            { field: 'Email', title: "Email", width: 220, sortable: true},
            { field: 'MatKhau', title: "Mật khẩu", width: 120, priority: 1 },
            // { field: 'Ho', title: 'Nationality', type: 'dropdown', editField: 'CountryID', editor: { dataSource: '/Locations/GetCountries', valueField: 'id' } },
            { field: 'Ten', title: "Tên", width: 120, priority: 1 },
            { field: 'Ho', title: "Họ", width: 120, priority: 2},
            { field: 'SoDienThoai', title: "Số điện thoại", width: 120, align: 'center', priority: 4 },
            { field: 'DiaChi', title: "Địa chỉ", minWidth: 400, align: 'center', priority: 5 },
        ],
    });
    grid.on('dataBound', function (e, records, totalRecords) {
        showPaging();
    });
    $("#searchData").on("keyup", function () {
        var value = removeVietnameseTones($(this).val().toLowerCase());
        if (value == '') {
            grid.reload();
        }
        $("#grid tbody tr").filter(function () {
            $(this).toggle(removeVietnameseTones($(this).text().toLowerCase()).indexOf(value) > -1)
        });
        $('#grid tbody tr').css('opacity', '1');
        hidePaging();
    });
    dialogEdit = $('#dialog-customter-edit').dialog({
        width: 700,
        closeOnEscape: true,
        resizable: true,
        draggable: true,
    });
    dialogDelete = $('#dialog-customter-delete').dialog({
        // width: 700,
        closeOnEscape: true,
        resizable: false,
        draggable: false,
    });

    $('#dialog-customter').find('input').on('keypress', function (e) {
        if (e.which == 13) {
            SaveEdit();
        }
    });
    $('.btnCancel').on('click', function () {
        dialogEdit.close();
        dialogDelete.close();
    });
    $('#btnDelete').on('click', deleteProcess );
    $('#btnSearch').on('click', function () {
        grid.reload();
    });
    $('#btnClear').on('click', function () {
        $('#srcName').val('');
        $('#srcPlaceOfBirth').val('');
        grid.reload({ Name: '', PlaceOfBirth: '' });
    });
});
function removeVietnameseTones(str) {
    str = str.replace(/à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ/g, "a");
    str = str.replace(/è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ/g, "e");
    str = str.replace(/ì|í|ị|ỉ|ĩ/g, "i");
    str = str.replace(/ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ/g, "o");
    str = str.replace(/ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ/g, "u");
    str = str.replace(/ỳ|ý|ỵ|ỷ|ỹ/g, "y");
    str = str.replace(/đ/g, "d");
    str = str.replace(/À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ẩ|Ẫ|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ/g, "A");
    str = str.replace(/È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ/g, "E");
    str = str.replace(/Ì|Í|Ị|Ỉ|Ĩ/g, "I");
    str = str.replace(/Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ/g, "O");
    str = str.replace(/Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ/g, "U");
    str = str.replace(/Ỳ|Ý|Ỵ|Ỷ|Ỹ/g, "Y");
    str = str.replace(/Đ/g, "D");
    // Some system encode vietnamese combining accent as individual utf-8 characters
    // Một vài bộ encode coi các dấu mũ, dấu chữ như một kí tự riêng biệt nên thêm hai dòng này
    str = str.replace(/\u0300|\u0301|\u0303|\u0309|\u0323/g, ""); // ̀ ́ ̃ ̉ ̣  huyền, sắc, ngã, hỏi, nặng
    str = str.replace(/\u02C6|\u0306|\u031B/g, ""); // ˆ ̆ ̛  Â, Ê, Ă, Ơ, Ư
    // Remove extra spaces
    // Bỏ các khoảng trắng liền nhau
    str = str.replace(/ + /g, " ");
    str = str.trim();
    // Remove punctuations
    // Bỏ dấu câu, kí tự đặc biệt
    str = str.replace(/!|@|%|\^|\*|\(|\)|\+|\=|\<|\>|\?|\/|,|\.|\:|\;|\'|\"|\&|\#|\[|\]|~|\$|_|`|-|{|}|\||\\/g, " ");
    return str;
}