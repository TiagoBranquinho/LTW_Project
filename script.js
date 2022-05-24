
function setRequired(element){
    element.setAttribute("required", "");
}

function removeRequired(element){
    element.removeAttribute("required");
}

function paymentMenuSlide(){
    const checkbox = document.querySelector('.payment input[type="checkbox"]');
    const creditCardInfo = document.querySelectorAll('.payment .hidden');
    const creditCardInputs = document.querySelectorAll('.payment .hidden input');
    const button = document.querySelector('.payment button');
    checkbox.addEventListener('change', (event) => {
        for(const info of creditCardInfo){
            info.classList.toggle('hidden');
            info.classList.toggle('visible');
        }
        if(event.currentTarget.checked){
            button.innerHTML = "Pay with card";
            for(const input of creditCardInputs){
                setRequired(input);
            }
        }
        else{
            button.innerHTML = "Pay with money";
            for(const input of creditCardInputs){
                removeRequired(input);
            }
        }
      })
}

var password = document.getElementById('newPass');
var confirm_password = document.getElementById('newPass2');
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
  

function executeScript(){
    paymentMenuSlide();
    validatePassword();
}

executeScript();