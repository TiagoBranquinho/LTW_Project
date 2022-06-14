function updateRestaurantBox(){
    const checkbox = document.querySelector('.restaurantCategory > form input[type=checkbox]');
    const value = document.querySelector('.restaurantCategory > form input[type=hidden]');


    checkbox.addEventListener('click', function(){
        if(checkbox.checked){
            value.value ="on";
        }
        else{
            value.value = "off";
        }
    })
}
updateRestaurantBox();