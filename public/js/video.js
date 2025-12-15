let clicks = 0;
let timer = null;

const logo = document.getElementById('easter-egg');
const container = document.getElementById('videoContainer');
const video = document.getElementById('video');

logo.addEventListener('click', () => {
    clicks++;

    // Limpa o contador após 1 segundo sem clicar
    clearTimeout(timer);
    timer = setTimeout(() => {
        clicks = 0;
    }, 1000);

    if (clicks === 3) {
        container.style.display = 'flex';
        video.play();
        clicks = 0;
    }
});
    
video.addEventListener('click', () => {
    video.pause();
    container.style.display = 'none';
});
