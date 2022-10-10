var list_product_btn = document.getElementById('list-product-btn');
var list_product = document.getElementById('list-product');
var black_layer = document.getElementById('black-layer');
var categoryItem = document.querySelectorAll('.list-group-item');

categoryItem.forEach( e => {
    e.addEventListener('click', (item) => {
        e.submit();
        console.log(e);
    }
    );
});

list_product_btn.addEventListener('mouseenter', () => {
        list_product.style.display = "block";
        black_layer.style.display = "block";
    }
);

list_product.onmouseleave = function() {
    list_product.style.display = "none";
    black_layer.style.display = "none";
};

// Toast
function showToast (message) {
    $(`<div class="toast-message">
            <div class="toast-icon"><i class="fas fa-check-circle"></i></div>
            <div class="toast-text"> ${message} </div>
            <div class="toast-close"><i class="fas fa-times"></i></div>
        </div>`).appendTo('.toast-container').delay(4500)
        .queue(function () {
            $(this).remove();
        });
}
$('.add-cart-btn').click(function (e) {
    e.preventDefault();
    console.log($(this).siblings("input").val());
    $.post({
        url: '/cart/add-item',
        type: 'POST',
        data: { 
            SP_Ma: $(this).siblings("input").val(),
            SoLuong: 1
        },
        success: function (result) {
            showToast("Bạn đã thêm hàng");
        },

        fail: function (xhr, textStatus, errorThrown) { },

        complete: function (data) { }
    });
});

function vndFormater (num) {
    return num.toLocaleString({ style: 'currency' }) + ' đ';
}
function showTotal() {
    let sum = 0;
    $('.amount-input').each(function (index) {
        sum += $(this).children('input').val() * $(this).next().children('input').val();
    })
    $('#total').text(vndFormater(sum));
}

$(document).ready(function () {
    $('.amount-input');
    $('.removeFromCart').on('click', function () {
        $.post({
            url: '/cart/remove-item',
            type: 'POST',
            data: {
                SP_Ma: $(this).children('input').val()
            },
            success: function (result) {
                location.reload();
            },
        });
    });
    $('.amount-input').children('input').on('keypress', function (e) {
        if (e.which == 13) {
            let n = $(this).val() + 1;
            $(this).val((n).toString());
            $(this).siblings('.amount-input-sub').trigger('click');
        }
    });
    $('.amount-input-sub').on('click', function () {
        let n = $(this).parent().children('input').val();
        let spMa = $(this).parent().children('.spMa').text();
        n--;
        n = (n > 99) ? 99 : n;
        n = (n < 1) ? 1 : n;
        $(this).parent().children('input').val(n.toString());
        let price = parseInt($(this).parent().next().children('input').val());
        $(this).parent().next().children('span').text(vndFormater(price * n));
        $('#fr-payment').children('input:hidden').each(function () {
            if ($(this).attr('name') === spMa){
                $(this).attr("value", n.toString());
            }
        });
        showTotal();
        $.post({
            url: '/cart/add-item',
            type: 'POST',
            data: {
                SP_Ma: spMa,
                SoLuong: n
            }
        });
    });
    $('.amount-input-add').on('click', function () {
        let n = $(this).parent().children('input').val();
        let spMa = $(this).parent().children('.spMa').text();
        n++;
        n = (n > 99) ? 99 : n;
        $(this).parent().children('input').val(n.toString());
        let price = parseInt($(this).parent().next().children('input').val());
        $(this).parent().next().children('span').text(vndFormater(price * n));
        $('#fr-payment').children('input:hidden').each(function () {
            if ($(this).attr('name') === spMa) {
                $(this).attr("value", n.toString());
            }
        });
        showTotal();
        $.post({
            url: '/cart/add-item',
            type: 'POST',
            data: {
                SP_Ma: spMa,
                SoLuong: n
            }
        });
    });
}); 