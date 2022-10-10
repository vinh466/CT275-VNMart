//run real time clock
function checkTime(i) {
    if (i < 10) {
        i = "0" + i;
    } return i;
}
function time() {
    var today = new Date();
    var weekday = ["Chủ Nhật", "Thứ Hai", "Thứ Ba", "Thứ Tư", "Thứ Năm", "Thứ Sáu", "Thứ Bảy"]

    var now = {
        "day": weekday[today.getDay()],
        "dd": today.getDate(),
        "mm": today.getMonth() + 1,
        "yyyy": today.getFullYear(),
        "h": today.getHours(),
        "m": today.getMinutes(),
        "s": today.getSeconds(),
    }
    now.m = checkTime(now.m);
    now.s = checkTime(now.s);
    nowTime = now.h + " giờ " + now.m + " phút " + now.s + " giây";
    if (now.dd < 10) {
        now.dd = '0' + now.dd
    } if (now.mm < 10) {
        now.mm = '0' + now.mm
    }
    today = now.day + ', ' + now.dd + '/' + now.mm + '/' + now.yyyy;
    tmp = '<span class="date"> ' + today + ' - ' + nowTime + '</span>';
    document.getElementById("clock").innerHTML = tmp;

    clocktime = setTimeout("time()", "1000", "Javascript");
}
$(document).ready(function () {
    time();
}); 

