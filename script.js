const checkboxes = document.querySelectorAll('.payment input')

document.body.addEventListener('click', (e) => {
  for (const c of checkboxes) {
    c.checked = false
  }

  for (const c of checkboxes) {
      if(c === e.target){
        c.checked = true
      }
  }  
})