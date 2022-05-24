let password = document.getElementById('newPass');
let confirm_password = document.getElementById('newPass2');
function validatePassword() {
    if(password.value != confirm_password.value) {
      confirm_password.setCustomValidity("Passwords Don't Match");
      return false;
    } else {
      confirm_password.setCustomValidity('');
      return true;
    }
}
password.onchange = validatePassword;
confirm_password.onkeyup = validatePassword;

validatePassword();