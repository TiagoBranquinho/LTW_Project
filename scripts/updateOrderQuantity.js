function getTotal(){
    const dishes = document.querySelectorAll('.restaurantDishes article');
    let total = 0.0;
    for(const dish of dishes){
        const price = dish.querySelector('section:nth-child(1) .price .value');
        const quantity = dish.querySelector('section:nth-child(3) h4');
        total += parseFloat(price.innerHTML) * parseFloat(quantity.innerHTML);
    }
    return total;
}


function uploadQuantity(){
    const buttons = document.querySelectorAll('.restaurantDishes section button');
    const total = document.querySelector('.restaurantDishes > div .price .value')
    for(const button of buttons){
        button.addEventListener('click', function(){
            const value = button.parentElement.querySelector('h4');
            if(button.innerHTML == '-'){
                if(value.innerHTML >= 1)
                    value.innerHTML--;
            }
            else
                value.innerHTML++;
            total.innerHTML = getTotal();
        })
    
    }
}
uploadQuantity();