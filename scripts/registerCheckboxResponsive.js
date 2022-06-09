function register() {
  const userCheckbox = document.getElementById("option1")
  console.log(userCheckbox);
  const restaurantOwnerCheckbox = document.getElementById("option2")
  const registerUserForm = document.getElementById("registerUser")
  const registerROForm = document.getElementById("registerRO")
  const registerUserAndRO = document.getElementById("registerUserAndRO")

  if(userCheckbox.checked && restaurantOwnerCheckbox.checked) {
    registerUserForm.style.visibility = "hidden";
    registerROForm.style.visibility = "hidden";
    registerUserAndRO.style.visibility = "visible";
  } else if(userCheckbox.checked) {
    registerUserForm.style.visibility = "visible";
    registerUserAndRO.style.visibility = "hidden";
    registerROForm.style.visibility = "hidden";
  } else if(restaurantOwnerCheckbox.checked) {
    registerROForm.style.visibility = "visible";
    registerUserAndRO.style.visibility = "hidden";
    registerUserForm.style.visibility = "hidden";
  } else {
    registerUserAndRO.style.visibility = "hidden";
    registerUserForm.style.visibility = "hidden";
    registerROForm.style.visibility = "hidden";
  }
}

