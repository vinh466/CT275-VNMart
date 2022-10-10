var grid, countries;

$(document).ready(function () {
    grid = $('#grid').grid({
        dataSource: '/api/get-hot-customer',
        uiLibrary: 'bootstrap5',
        // primaryKey: 'Email',
        toolbarTemplate: `
        <div class="row">
            <div class="col" style="line-height:34px">
                <div class="input-group mt-2">Khách hàng năng động</div>
            </div>
        </div>`,
        responsive: true,
        minWidth: 200,
        columns: [
            { field: 'Email', title: "Email", maxWidth: 400, sortable: true },
            { field: 'sodon', title: "Số dơn", width: 120, priority: 1 },
        ],
    });
    grid2= $('#grid2').grid({
        dataSource: '/api/get-hot-product',
        uiLibrary: 'bootstrap5',
        toolbarTemplate: `
        <div class="row">
            <div class="col" style="line-height:34px">
                <div class="input-group mt-2">Bán chạy</div>
            </div>
        </div>`,
        responsive: true,
        minWidth: 200,
        columns: [
            { field: 'SP_Ma', title: "Mã", width: 20, sortable: true },
            { field: 'Ten', title: "Tên sản phẩm", width: 200, priority: 1 },
            { field: 'TongBan', title: "Tổng bán", width: 20, priority: 1 },
            {
                field: 'TongTien',
                title: "Doanh thu", 
                renderer: function (value, record) {
                    console.log(value);
                    console.log(123123);
                    return parseInt(value).toLocaleString('it-IT', { style: 'currency', currency: 'VND' });
                },
                width: 120,
                priority: 1, 
            },
        ],
    });
    var fisrt = true;
    grid.on('dataBound', function (e, records, totalRecords) {
        if (fisrt) {
            fisrt = false;

        }
    });
});