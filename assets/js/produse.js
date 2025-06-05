const prevButton = document.querySelector('.produse-slider-prev');
const nextButton = document.querySelector('.produse-slider-next');
const track = document.querySelector('.produse-slider-track');
const items = document.querySelectorAll('.produse-slider-item');

let currentIndex = 0;
const itemWidth = items[0].clientWidth + 20; // Width + margin (10px * 2)

function updateSliderPosition() {
  track.style.transform = `translateX(-${currentIndex * itemWidth}px)`;
}

prevButton.addEventListener('click', () => {
  if (currentIndex > 0) {
    currentIndex--;
    updateSliderPosition();
  }
});

nextButton.addEventListener('click', () => {
  if (currentIndex < items.length - 1) {
    currentIndex++;
    updateSliderPosition();
  }
});