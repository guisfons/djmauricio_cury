$(window).on('load', function () {
  $('body').css('opacity', 1);
  
  // Chama loadPodcast apenas após o carregamento completo do site
  loadPodcast();
});

$(document).ready(function () {
  const triggerMenu = $('.header__nav-btn');
  triggerMenu.on('click', function () {
    $(this).toggleClass('header__nav-btn--active');
    $('.header__nav').toggleClass('header__nav--active');
  });

  $('.biografia__img').slick({
    arrows: false,
    autoplay: true,
    autoplaySpeed: 2000,
  });
});

async function loadPodcast() {
  const xmlUrl = 'https://www.djmauriciocury.com.br/podcast/groove.xml'; // Caminho para o arquivo XML

  try {
    const response = await fetch(xmlUrl);
    const xmlText = await response.text();
    const parser = new DOMParser();
    const xml = parser.parseFromString(xmlText, 'application/xml');
    const items = xml.querySelectorAll('item');

    const podcastList = $('.podcast-slider');
    podcastList.empty(); // Limpa qualquer conteúdo existente

    items.forEach(item => {
      const title = item.querySelector('title')?.textContent || 'Sem título';
      const audioUrl = item.querySelector('enclosure')?.getAttribute('url');
      const description = item.querySelector('description')?.textContent || 'Sem descrição';

      const imageElement = item.querySelector('itunes\\:image, image');
      const imageUrl = imageElement ? imageElement.getAttribute('href') : 'https://via.placeholder.com/150';

      if (audioUrl) {
        const episodeDiv = $(`
          <div class="episode">
            <h2>${title}</h2>
            <img src="${imageUrl}" alt="${title}">
            <p>${description}</p>
            <button class="episode__play" data-src="${audioUrl}">Play</button>
          </div>
        `);

        podcastList.append(episodeDiv);
      }
    });

    // Inicializa o Slick Slider após carregar os episódios
    podcastList.slick({
      slidesToShow: 1,
      slidesToScroll: 1,
      autoplay: false,
      dots: false,
      arrows: true,
      infinite: false,
      adaptiveHeight: true,
    });

    // Delegação de evento para botões de play
    $('.podcast-slider').on('click', '.episode__play', function () {
      const audioUrl = $(this).data('src');
      const audioTitle = $(this).closest('.episode').find('h2').text();
      loadAudio(audioUrl, audioTitle);
    });
  } catch (error) {
    console.error('Erro ao carregar o XML:', error);
    $('.podcast-slider').text('Erro ao carregar os episódios.');
  }
}

const audio = new Audio();
const audioPlayer = document.querySelector('.audio-player');
const playBtn = audioPlayer.querySelector('.toggle-play');
const nameEl = audioPlayer.querySelector('.name');
const timeline = audioPlayer.querySelector('.timeline');
const progressBar = audioPlayer.querySelector('.progress');
const currentTimeEl = audioPlayer.querySelector('.time .current');
const lengthTimeEl = audioPlayer.querySelector('.time .length');
const volumeSlider = document.querySelector('.volume-slider');
const volumePercentage = document.querySelector('.volume-percentage');

function loadAudio(url, title) {
  audioPlayer.style = 'opacity: 1; visibility: visible;';
  audio.src = url;
  nameEl.textContent = title;
  audio.play();
  playBtn.classList.remove('play');
  playBtn.classList.add('pause');
}

playBtn.addEventListener('click', () => {
  if (audio.paused) {
    audio.play();
    playBtn.classList.remove('play');
    playBtn.classList.add('pause');
  } else {
    audio.pause();
    playBtn.classList.remove('pause');
    playBtn.classList.add('play');
  }
});

// Evento para ajustar o volume ao clicar na barra de volume
volumeSlider.addEventListener('click', (e) => {
  const sliderWidth = volumeSlider.clientWidth;
  const clickPosition = e.offsetX;
  const newVolume = clickPosition / sliderWidth;

  audio.volume = newVolume;
  volumePercentage.style.width = newVolume * 100 + '%';
});

// Garantir que o volume inicial seja 75%
audio.volume = 0.75;
volumePercentage.style.width = '75%';

audio.addEventListener('timeupdate', () => {
  progressBar.style.width = (audio.currentTime / audio.duration) * 100 + '%';
  currentTimeEl.textContent = formatTime(audio.currentTime);
});

audio.addEventListener('loadedmetadata', () => {
  lengthTimeEl.textContent = formatTime(audio.duration);
});

function formatTime(seconds) {
  const minutes = Math.floor(seconds / 60);
  seconds = Math.floor(seconds % 60);
  return `${minutes}:${seconds.toString().padStart(2, '0')}`;
}

timeline.addEventListener('click', (e) => {
  const timelineWidth = timeline.clientWidth;
  const clickPosition = e.offsetX;
  const newTime = (clickPosition / timelineWidth) * audio.duration;
  audio.currentTime = newTime;
});

// Evento de arrastar a timeline para ajustar a posição do áudio
let isDragging = false;

timeline.addEventListener('mousedown', () => {
  isDragging = true;
});

document.addEventListener('mousemove', (e) => {
  if (isDragging) {
    const timelineRect = timeline.getBoundingClientRect();
    const offsetX = e.clientX - timelineRect.left;
    const newTime = (offsetX / timelineRect.width) * audio.duration;
    audio.currentTime = Math.min(Math.max(newTime, 0), audio.duration);
  }
});

document.addEventListener('mouseup', () => {
  isDragging = false;
});
