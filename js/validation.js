function validateForm() {
    var username = document.getElementById("username").value;
    var email = document.getElementById("email").value;
    var password = document.getElementById("password").value;

    if (username == "" || email == "" || password == "") {
        alert("All fields must be filled out");
        return false;
    }

    var emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailPattern.test(email)) {
        alert("Please enter a valid email address");
        return false;
    }

    if (password.length < 6) {
        alert("Password must be at least 6 characters long");
        return false;
    }

    return true;
}

function validateLoginForm() {
    var usernameOrEmail = document.getElementById("username_or_email").value;
    var password = document.getElementById("password").value;

    if (usernameOrEmail == "" || password == "") {
        alert("Both fields must be filled out");
        return false;
    }

    return true;
}

