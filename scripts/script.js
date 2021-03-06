
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
    const cardPayment = document.querySelector('.payment input[type="hidden"]');
    checkbox.addEventListener('change', (event) => {
        for(const info of creditCardInfo){
            info.classList.toggle('hidden');
            info.classList.toggle('visible');
        }
        if(event.currentTarget.checked){
            button.innerHTML = "Pay with card";
            for(const input of creditCardInputs){
                setRequired(input);
                cardPayment.value = true;
            }
        }
        else{
            button.innerHTML = "Pay with money";
            for(const input of creditCardInputs){
                removeRequired(input);
                cardPayment.value = false;
            }
        }
      })
}

function executeScript(){
    paymentMenuSlide();
}

executeScript();