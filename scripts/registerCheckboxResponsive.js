function register() {
  const userCheckbox = document.getElementById("option1")
  console.log(userCheckbox);
  const restaurantOwnerCheckbox = document.getElementById("option2")
  const registerUserForm = document.getElementById("registerUser")
  const registerROForm = document.getElementById("registerRO")
  const registerUserAndRO = document.getElementById("registerUserAndRO")

  if(userCheckbox.checked && restaurantOwnerCheckbox.checked) {
    registerUserForm.style.display = "none";
    registerROForm.style.display = "none";
    registerUserAndRO.style.display = "initial";
  } else if(userCheckbox.checked) {
    registerUserForm.style.display = "initial";
    registerUserAndRO.style.display = "none";
    registerROForm.style.display = "none";
  } else if(restaurantOwnerCheckbox.checked) {
    registerROForm.style.display = "initial";
    registerUserAndRO.style.display = "none";
    registerUserForm.style.display = "none";
  } else {
    registerUserAndRO.style.display = "none";
    registerUserForm.style.display = "none";
    registerROForm.style.display = "none";
  }
}

