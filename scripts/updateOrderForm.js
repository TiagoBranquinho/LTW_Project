function updateForm(){
    const button = document.querySelector('.restaurantDishes > div button');
    const values = document.querySelectorAll('.restaurantDishes article section:nth-child(3) #quantity');
    button.addEventListener('click', function(){
        for(const value of values){
            value.value = value.nextElementSibling.innerHTML;
            console.log(value);
            console.log(value.value);
            console.log(value.nextElementSibling.nextElementSibling);
            console.log(value.nextElementSibling.nextElementSibling.value);
        }
    })
}

updateForm();