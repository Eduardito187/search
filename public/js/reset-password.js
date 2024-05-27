$(document).ready(function() {
    $('#reset-password-form').on('submit', function(event) {
        var emailInput = $('#email').val();
        if (!validateEmail(emailInput)) {
            event.preventDefault();
            alert('Please enter a valid email address.');
        }
    });

    function validateEmail(email) {
        var re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return re.test(String(email).toLowerCase());
    }
});