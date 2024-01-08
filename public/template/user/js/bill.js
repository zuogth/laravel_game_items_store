const expire = $('#expire_date').val();
const targetDate = new Date(expire);
setTimeout(function () {
    $('.alert-custom').hide();
}, 5000);

// Update the countdown every second
const countdownInterval = setInterval(updateCountdown, 1000);

// Function to update the countdown
function updateCountdown() {

    let now = new Date();
    let timeDifference = targetDate - now;

    if (timeDifference > 0) {
        // Calculate days, hours, minutes, and seconds
        let minutes = Math.floor((timeDifference % (1000 * 60 * 60)) / (1000 * 60));
        let seconds = Math.floor((timeDifference % (1000 * 60)) / 1000);

        // Display the countdown
        $('#countdown').html(minutes + 'm ' + seconds + 's');
    } else {
        // Display a message when the countdown reaches zero
        $('#confirm-pay').attr({'disabled': true,'href': '#'});
        $('#countdown').html('Hết hạn thanh toán');
        clearInterval(countdownInterval); // Stop the countdown
    }
}

// Hàm để chọn và sao chép nội dung của phần tử
function selectText(id) {
    let range, selection;

    let element = document.getElementById(id);

    if (document.body.createTextRange) { // For IE
        range = document.body.createTextRange();
        range.moveToElementText(element);
        range.select();
    } else if (window.getSelection) { // For other browsers
        selection = window.getSelection();
        range = document.createRange();
        range.selectNodeContents(element);
        selection.removeAllRanges();
        selection.addRange(range);
    }

    // Sao chép nội dung đã chọn vào clipboard
    document.execCommand('copy');

    $('.alert-custom span').html('Sao chép thành công');
    $('.alert-custom').show();
    setTimeout(function () {
        $('.alert-custom').hide();
    }, 5000);
}
