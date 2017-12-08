function check_pass() {
    if (document.getElementById('password').value == document.getElementById('confirm_password').value) {
        document.getElementById('submit').disabled = false;
        document.getElementById('passwordMatch').innerHTML = "";
    } else {
        document.getElementById('submit').disabled = true;
        document.getElementById('passwordMatch').innerHTML = "Passwords do not match!";
    }
}

function check_admin() {
    if (Cookies.get('adminPriveleges') == true) {
        return true;
    } else {
        alert("Sorry - you cannot create a new event. Register as an organiser!");
        return false;
    }
}
