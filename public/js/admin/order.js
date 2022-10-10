
var grid, countries;

function Delete(e) {
    $('#modalProductMaSP').text(e.data.record.SP_Ma);
    dialogDelete.open('Xóa sản phẩm');
}
function Edit(e) {
    $('#modalSP_Ma').val(e.data.record.SP_Ma);
    $('#modalSP_MaInput').css('display', 'block');
    $('#modalTen').val(e.data.record.Ten);
    $('#modalMoTa').val(e.data.record.MoTa);
    $('#modalAnh').val(e.data.record.Anh);
    $('#modalSoLuong').val(e.data.record.SoLuong);
    $('#modalDonGia').val(e.data.record.DonGia);
    $('#modalGiamGia').val(e.data.record.GiamGia);
    $('#modalTrangThai').val(e.data.record.TrangThai);
    $('#modalDonVi').val(e.data.record.DonVi);
    $('#btnAdd').attr('id', 'btnEdit');
    $('#btnEdit').on('click', editProcess);
    e.data.record.category.forEach(element => {
        $('#modal' + element.DM_Ma).prop('checked', true);
    });
    dialogEdit.open('Cập nhập thông tin');
}
function Add(e) {
    $('#modalSP_Ma').val('');
    $('#modalSP_MaInput').css('display', 'none');
    $('#modalTen').val('');
    $('#modalMoTa').val('');
    $('#modalAnh').val('');
    $('#modalSoLuong').val('');
    $('#modalDonGia').val('');
    $('#modalGiamGia').val('');
    $('#modalTrangThai').val('');
    $('#modalDonVi').val('');
    $('#btnEdit').attr('id', 'btnAdd');
    $('#btnAdd').on('click', addProcess);
    $('#modalCategory input:checked').prop('disable', false);
    dialogEdit.open('Thêm sản phẩm');
}
function addProcess() {
    if ($('#modalTen').val()) {
        var url = '/admin/product/add';
        var category = '';
        $('#modalCategory input:checked').each(function (index) {
            category += '<input hidden name="DM_Ma[' + index + ']" value="' + this.name + '" /> '
        });
        if (category == '') category = '<input hidden name="DM_Ma[100]" value="9999" /> '
        console.log(category)
        var form = $('<form action="' + url + '" method="post">' +
            '<input hidden name="Ten" value="' + $('#modalTen').val() + '" />' +
            '<input hidden name="MoTa" value="' + $('#modalMoTa').val() + '" />' +
            '<input hidden name="Anh" value="' + $('#modalAnh').val() + '" />' +
            category +
            '<input hidden name="SoLuong" value="' + $('#modalSoLuong').val() + '" />' +
            '<input hidden name="DonGia" value="' + $('#modalDonGia').val() + '" />' +
            '<input hidden name="GiamGia" value="' + $('#modalGiamGia').val() + '" />' +
            '<input hidden name="TrangThai" value="' + $('#modalTrangThai').val() + '" />' +
            '<input hidden name="DonVi" value="' + $('#modalDonVi').val() + '" />' +
            '<input hidden name="addSubmit" value="addProduct" />' +
            '</form>');
        $('body').append(form);
        form.submit();
    }
    dialogEdit.close();
    grid.reload();
}
function deleteProcess() {
    console.log("asdadad")
    if ($('#modalProductMaSP').text()) {
        var id = ($('#modalProductMaSP').text()).toString();
        var url = '/admin/product/delete';
        var form = $('<form action="' + url + '" method="post">' +
            '<input hidden name="SP_Ma" value="' + id + '" />' +
            '<input hidden name="deleteSubmit" value="deleteProduct" />' +
            '</form>');
        $('body').append(form);
        form.submit();
    }
    dialogDelete.close();
    grid.reload();
}
function editProcess() {
    if ($('#modalSP_Ma').val()) {
        var id = ($('#modalSP_Ma').val()).toString();
        console.log("Update: " + id);
        var url = '/admin/product/edit';
        var category = '';
        $('#modalCategory input:checked').each(function (index) {
            category += '<input hidden name="DM_Ma[' + index + ']" value="' + this.name + '" /> '
        });
        if (category == '') category = '<input hidden name="DM_Ma[100]" value="9999" /> '
        console.log(category)
        var form = $('<form action="' + url + '" method="post">' +
            '<input hidden name="SP_Ma" value="' + id + '" />' +
            '<input hidden name="Ten" value="' + $('#modalTen').val() + '" />' +
            '<input hidden name="MoTa" value="' + $('#modalMoTa').val() + '" />' +
            '<input hidden name="Anh" value="' + $('#modalAnh').val() + '" />' +
            category +
            '<input hidden name="SoLuong" value="' + $('#modalSoLuong').val() + '" />' +
            '<input hidden name="DonGia" value="' + $('#modalDonGia').val() + '" />' +
            '<input hidden name="GiamGia" value="' + $('#modalGiamGia').val() + '" />' +
            '<input hidden name="TrangThai" value="' + $('#modalTrangThai').val() + '" />' +
            '<input hidden name="DonVi" value="' + $('#modalDonVi').val() + '" />' +
            '<input hidden name="editSubmit" value="editProduct" />' +
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
            <select class="form-select" width="52" id="rowsShownPaging">
                <option value="10">10</option>
                <option value="25">25</option>
                <option value="50">50</option>
            </select>
            <span class="gj-md-spacer-32">&nbsp;</span>
            <span class="">${startItem + 1}</span>
            <span class="">-</span><span class="">${endItem}</span>
            <span class="gj-grid-mdl-pager-label"> của </span>
            <span class="">${rowsTotal}</span>
        `);
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
function hidePaging() {
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
        dataSource: '/api/get-orders',
        uiLibrary: 'bootstrap5',
        primaryKey: 'SP_Ma',
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
            { field: 'DH_Ma', title: "Mã", width: 40, sortable: true },
            { field: 'Email', title: "Khách hàng", width: 120, sortable: true },
            {
                field: 'created_at', title: "Ngày tạo", width: 90, sortable: true, renderer: function (value, record) {
                    let s = '';
                    let day = (value.split("T")[0]).split("-");
                    reverseDay = day[2] + '-' + day[1] + '-' + day[0];
                    s = (value.split("T"))[1].split(".")[0] + ', ' + reverseDay ;
                    return s;
                } 
            },
            {
                field: 'TTDH_Ma', title: "Trạng thái", width: 70, sortable: true, renderer: function (value, record) {
                    if (value.TTDH_Ma == 1) {
                        return `<span class="bg-secondary p-2 text-white" style="border-radius: 20px">${value.Ten}</span>`
                    } else if (value.TTDH_Ma == 2) {
                        return `<span class="bg-warning p-2 text-white" style="border-radius: 20px">${value.Ten}</span>`
                    } else if (value.TTDH_Ma == 3) {
                        return `<span class="bg-info p-2 text-white" style="border-radius: 20px">${value.Ten}</span>`
                    } else if (value.TTDH_Ma == 4) {
                        return `<span class="bg-success p-2 text-white" style="border-radius: 20px">${value.Ten}</span>`
                    } else if (value.TTDH_Ma == 5) {
                        return `<span class="bg-danger p-2 text-white" style="border-radius: 20px">${value.Ten}</span>`
                    }
                } 
            },
            // { tmpl: "<i class='fas fa-pen text-warning'></i> Chi Tiết ", width: 100, class: "gj-button-md", align: "center", align: 'center', events: { 'click': Edit } },
            { tmpl: "<i class='fas fa-pen text-warning'></i> Chỉnh Sửa ", width: 100, class: "gj-button-md", align: "center", align: 'center', events: { 'click': Edit } },
            { tmpl: "<i class='fas fa-trash text-danger'></i> Xóa ", width: 60, class: "gj-button-md", align: "center", align: 'center', events: { 'click': Delete } },
            
        ],
    });
    grid.on('dataBound', function (e, records, totalRecords) {
        showPaging();
    });
    $("#searchData").on("keyup", function () {
        var value = removeVietnameseTones($(this).val().toLowerCase());
        if (value == '') {
            grid.reload();
            return;
        }
        $("#grid tbody tr").filter(function () {
            $(this).toggle(removeVietnameseTones($(this).text().toLowerCase()).indexOf(value) > -1)
        });
        $('#grid tbody tr').css('opacity', '1');
        hidePaging();
    });
    dialog = $('#dialog').dialog({
        resizable: true,
        draggable: true,
        closeOnEscape: true,
        width: 800,
        closed: function (e) {
            $('.modal-checkBox').prop('checked', false);
        }
    });

    dialogEdit = $('#dialog-product-edit').dialog({
        resizable: true,
        draggable: true,
        closeOnEscape: true,
        width: 800,
        closed: function (e) {
            $('.modal-checkBox').prop('checked', false);
        }
    });
    dialogDelete = $('#dialog-product-delete').dialog({
        // width: 700,
        closeOnEscape: true,
        resizable: false,
        draggable: false,
    });
    $('#dialog-product').find('input').on('keypress', function (e) {
        if (e.which == 13) {
            Save();
        }
    });
    $('.btnCancel').on('click', function () {
        dialogEdit.close();
        dialogDelete.close();
    });
    $('#btnDelete').on('click', deleteProcess);
    $('#btnSearch').on('click', function () {
        grid.reload();
    });
    $('#btnClear').on('click', function () {
        $('#srcName').val('');
        $('#srcPlaceOfBirth').val('');
        grid.reload({ Name: '', PlaceOfBirth: '' });
    });

    console.log(grid);
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