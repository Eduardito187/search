document.addEventListener('DOMContentLoaded', () => {
    const playPauseBtn = document.querySelector('.play-pause-btn');
    const playBtn = document.querySelector('.play-btn');
    let isPlaying = false;
  
    playPauseBtn.addEventListener('click', () => {
      isPlaying = !isPlaying;
      playPauseBtn.textContent = isPlaying ? 'Pause' : 'Play';
    });
  
    playBtn.addEventListener('click', () => {
      isPlaying = !isPlaying;
      playBtn.textContent = isPlaying ? 'Pause' : 'Play';
    });
  });
  