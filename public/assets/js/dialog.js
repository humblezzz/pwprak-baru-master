$('.dialog__bg').on('click', () => {
    $('.dialog').map(x => {
        if ($('.dialog')[x].classList.contains('active')) {
            $('.dialog')[x].classList.remove('active')
        }
    })
})

$('.dialog__batal').on('click', e => {
    e.currentTarget.parentElement.parentElement.classList.remove('active');
})