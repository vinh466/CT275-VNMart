var list_product_btn = document.getElementById('list-product-btn');
var list_product = document.getElementById('list-product');
var black_layer = document.getElementById('black-layer');
var categoryItem = document.querySelectorAll('.list-group-item');

categoryItem.forEach( e => {
    console.log(e);
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
    $.post({
        url: '/cart/add-item',
        type: 'POST',
        data: { 
            SP_Ma: $(this).siblings("input").val()
        },
        success: function (result) { 
            showToast("Bạn đã thêm hàng");
        },

        fail: function (xhr, textStatus, errorThrown) { },

        complete: function (data) { }
    });

});