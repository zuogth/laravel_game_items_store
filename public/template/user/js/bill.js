// Set the target date and time (change as needed)
// Get the current date and time
var expire = document.getElementById('expire_date').value;
var targetDate = new Date(expire);

// Update the countdown every second
var countdownInterval = setInterval(updateCountdown, 1000);

// Function to update the countdown
function updateCountdown() {
    var now = new Date().getTime();
    var timeDifference = targetDate - now;

    if (timeDifference > 0) {
        // Calculate days, hours, minutes, and seconds
        var days = Math.floor(timeDifference / (1000 * 60 * 60 * 24));
        var hours = Math.floor((timeDifference % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        var minutes = Math.floor((timeDifference % (1000 * 60 * 60)) / (1000 * 60));
        var seconds = Math.floor((timeDifference % (1000 * 60)) / 1000);

        // Display the countdown
        document.getElementById('countdown').innerHTML = minutes + 'm ' + seconds + 's';
    } else {
        // Display a message when the countdown reaches zero
        document.getElementById('confirm-pay').setAttribute('disabled', true);
        document.getElementById('confirm-pay').setAttribute('href', '#');
        document.getElementById('countdown').innerHTML = 'Hết hạn thanh toán';
        clearInterval(countdownInterval); // Stop the countdown
    }
}

// Hàm để chọn và sao chép nội dung của phần tử
function selectText(id) {
    var range, selection;

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
