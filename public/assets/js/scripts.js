document.addEventListener('DOMContentLoaded', function () {
    const flash = document.querySelector('.flash-alert');
    const progressBar = document.querySelector('.flash-progress .progress-bar');
    const duration = 400000;

    if (flash && progressBar) {
        progressBar.style.transitionDuration = duration + 'ms';
        progressBar.style.width = '0%';
        console.log(progressBar)
        setTimeout(() => {
            flash.classList.remove('show');
            flash.classList.add('hide');
            setTimeout(() => flash.remove(), 500);
        }, duration);
    }
});