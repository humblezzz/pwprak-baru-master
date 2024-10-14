$('.list-peserta__aksi-btn--delete').on('click', e => {
    e.currentTarget.nextElementSibling.classList.add('active')
})

$('.button.list-peserta__batal').on('click', e => {
    e.currentTarget.parentElement.parentElement.classList.remove('active')
})