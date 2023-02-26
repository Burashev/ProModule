const notification = document.querySelector('.notification');
const notificationText = document.querySelector('.notification__text');
const notificationClose = document.querySelector('.notification__close');

function showNotification(text, type = 'info') {
    if (type === 'error') notification.classList.add('error');
    notification.classList.add('active');

    notificationText.innerText = text;

    setTimeout(() => {
        hideNotification();
    }, 4000)
}

function hideNotification() {
    notification.classList.remove('active');
    notification.addEventListener('transitionend', () => notification.classList.remove('error'));
}

notificationClose.addEventListener("click", hideNotification);
