function initModal() {
  const btn = document.getElementById('btn-add-quote')
  const modal = document.getElementById('modal-add-quote')
  const closes = document.getElementsByClassName('close-add-quote')

  btn.addEventListener('click', e => {
    modal.classList.add('active')
  })

  for (let close of closes) {
    close.addEventListener('click', e => {
      modal.classList.remove('active')
    })
  }
}

function hiddenAddedInput(value) {
  input = document.createElement('input')
  input.setAttribute('name', 'added')
  input.setAttribute('type', 'hidden')
  input.setAttribute('value', value)
  return input
}

function initAdminButtons() {
  const editBtns = document.getElementsByClassName('btn-edit')
  const deleteBtns = document.getElementsByClassName('btn-delete')

  const modal = document.getElementById('modal-add-quote')
  const inputClass = document.getElementsByName('class')[0]
  const inputDate = document.getElementsByName('date')[0]
  const inputQuotation = document.getElementsByName('quotation')[0]
  const btnSubmit = modal.querySelector('button[type=submit]')

  for (let editBtn of editBtns) {
    editBtn.addEventListener('click', e => {
      document.getElementById('btn-add-quote').innerHTML = 'Bearbeitung fortsetzen'
      document.getElementsByName('password').forEach(el => el.remove())
      modal.querySelectorAll('input[name=added]').forEach(el => el.remove())
      modal.querySelector('.modal-title').innerHTML = 'Zitat bearbeiten'
      btnSubmit.innerHTML = 'Speichern'
      btnSubmit.setAttribute('name', 'edit-quotation')

      let card = editBtn.parentElement.parentElement
      let quotAdded = card.id.substr(5).replace('_', ' ')
      inputClass.value = card.querySelector('.card-title').innerHTML.trim()
      inputDate.value = card.querySelector('.card-subtitle').innerHTML.trim().split('.').reverse().join('-')
      inputQuotation.value = card.querySelector('.card-body').innerHTML.trim()

      modal.querySelector('form').appendChild(hiddenAddedInput(quotAdded))
      modal.classList.add('active')
    })
  }

  for (let deleteBtn of deleteBtns) {
    deleteBtn.addEventListener('click', e => {
      if (confirm('Zitat wirklich löschen?')) {
        inputClass.remove()
        inputDate.remove()
        inputQuotation.remove()
        document.getElementsByName('password').forEach(el => el.remove())
        let card = deleteBtn.parentElement.parentElement
        let quotAdded = card.id.substr(5).replace('_', ' ')
        modal.querySelector('form').appendChild(hiddenAddedInput(quotAdded))
        btnSubmit.setAttribute('name', 'delete-quotation')
        btnSubmit.click()
      }
    })
  }
}

window.onload = function () {
  initModal()
  initAdminButtons()
}
