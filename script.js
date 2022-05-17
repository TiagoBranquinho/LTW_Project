
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
function executeScript(){
    paymentMenuSlide();
}

executeScript();