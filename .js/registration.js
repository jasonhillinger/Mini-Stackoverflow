function check() { //checks if password and confirm password values match, if so notifies user by indicating passwords match
    if ((document.getElementById("password").value.length >= 8) && (document.getElementById('confirm_password').value
        .length >= 8)) {
        if (document.getElementById("password").value == document.getElementById('confirm_password').value) {
            document.getElementById("match").style.color = "green";
            document.getElementById("match").innerHTML = "Passwords match.";
            document.getElementById("submit").type = "submit"; //only if passwords match, submit button will submit the form
        } else {
            document.getElementById("match").style.color = "red";
            document.getElementById("match").innerHTML = "Passwords do not match.";
            document.getElementById("submit").type = "button";
        }
    }
}