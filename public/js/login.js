$(document).ready(function() {
    $('#loginForm').on('submit', function(e) {
        e.preventDefault();
        
        var username = $('input[name="username"]').val();
        var password = $('input[name="password"]').val();

        if (username === "" || password === "") {
            alert("Please fill in all fields.");
            return;
        }

        $.ajax({
            type: 'POST',
            url: 'login.php',
            data: {
                username: username,
                password: password
            },
            success: function(response) {
                alert(response);
            }
        });
    });
});