function uploadQuantity(){
    const buttons = document.querySelectorAll('.restaurantDishes section button');
    for(const button of buttons){
        button.addEventListener('click', function(){
            const value = button.parentElement.querySelector('h4');
            if(button.innerHTML == '-'){
                if(value.innerHTML >= 1)
                    value.innerHTML--;
            }
            else
                value.innerHTML++;
        })
    
    }
}
uploadQuantity();