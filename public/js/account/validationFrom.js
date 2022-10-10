// $.validator.setDefaults({
//     submitHandler: function () { alert("submitted!"); }
// });
$(document).ready(function () {


    $("#userRegister").validate({
        rules: {
            firstNameRegister: "required",
            lastNameRegister: "required",
            userNameRegister: { required: true, minlength: 2 },
            passwordRegister: { required: true, minlength: 5 },
            rePasswordRegister: { required: true, minlength: 5, equalTo: "#passwordRegister" },
            emailRegister: { required: true, email: true },
            agree: "required"
        },
        messages: {
            firstNameRegister: "Bạn chưa nhập vào họ của bạn",
            lastNameRegister: "Bạn chưa nhập vào tên của bạn",
            userNameRegister: {
                required: "Bạn chưa nhập vào tên đăng nhập",
                minlength: "Tên đăng nhập phải có ít nhất 2 ký tự"
            },
            passwordRegister: {
                required: "Bạn chưa nhập mật khẩu",
                minlength: "Mật khẩu phải có ít nhất 5 ký tự"
            },
            rePasswordRegister: {
                required: "Bạn chưa nhập mật khẩu",
                minlength: "Mật khẩu phải có ít nhất 5 ký tự",
                equalTo: "Mật khẩu không trùng khớp với mật khẩu đã nhập"
            },
            emailRegister: "Hộp thư điện tử không hợp lệ",
            agree: "Bạn phải đồng ý với các quy định của chúng tôi"
        },
        errorElement: "div",
        errorPlacement: function (error, element) {
            error.addClass("invalid-feedback");
            if (element.prop("type") === "checkbox") {
                error.insertAfter(element.siblings("label"));
            } else {
                error.insertAfter(element);
            }
        },
        highlight: function (element, errorClass, validClass) {
            $(element).addClass("is-invalid").removeClass("is-valid");
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).addClass("is-valid").removeClass("is-invalid");
        }
    });
}); 