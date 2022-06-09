function updateForm(){
    const button = document.querySelector('.restaurantDishes > div button');
    const values = document.querySelectorAll('.restaurantDishes article section:nth-child(3) input');
    button.addEventListener('click', function(){
        console.log(button);
        for(const value of values){
            value.value = nextElementSibling;
            console.log(value.value);
        }
    })
}

updateForm();