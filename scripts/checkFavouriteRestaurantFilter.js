function updateCheckbox(){
    const checkbox = document.querySelector('.orderFilter > form input[type=checkbox]');
    const value = document.querySelector('.orderFilter > form input[type=hidden]');

    checkbox.addEventListener('click', function(){
        if(checkbox.checked){
            value.value ="on";
        }
        else{
            value.value = "off";
        }
    })
}
updateCheckbox();