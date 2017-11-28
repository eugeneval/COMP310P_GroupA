function check_pass() {
    if (document.getElementById('password').value == document.getElementById('confirm_password').value) {
        document.getElementById('submit').disabled = false;
        document.getElementById('passwordMatch').innerHTML = "";
    } else {
        document.getElementById('submit').disabled = true;
        document.getElementById('passwordMatch').innerHTML = "Passwords do not match!";
    }
}
