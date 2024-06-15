function initializeLoginModal() {
    console.log('1');
    const modal = document.querySelector('.login_modal');
    const modalOpen = document.getElementById('loginBtn');
    const modalClose = document.getElementById('close_btn');

    if (modalOpen) {
        modalOpen.addEventListener('click', function () {
            modal.classList.add('on');
        });
    }

    if (modalClose) {
        modalClose.addEventListener('click', function () {
            modal.classList.remove('on');
        });
    }
}