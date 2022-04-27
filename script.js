const checkboxes = document.querySelectorAll('.payment input')

document.body.addEventListener('click', (e) => {
  let found = 0;
  for (const c of checkboxes) {
    c.checked = false
  }

  for (const c of checkboxes) {
      if(c === e.target){
        c.checked = true
        found = 1;
      }
  }  
  if(!found){
    checkboxes[0].checked = true;
  }
})