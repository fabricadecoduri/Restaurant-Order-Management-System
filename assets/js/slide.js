let customIndex = 0;

const customSlider = document.querySelector('.custom-slider');
const customSlides = document.querySelectorAll('.custom-slider-slide');
const customDots = document.querySelectorAll('.custom-slider-dot');

// Funcție pentru schimbarea slide-ului
function changeSlide() {
    const slideWidth = customSlides[0].clientWidth;

    customIndex++; // Crește indexul pentru a trece la următorul slide

    // Dacă ajungem la ultimul slide, revenim la primul
    if (customIndex >= customSlides.length) {
        customIndex = 0;
    }

    // Calculăm poziția corectă pentru slide-ul următor
    const newTranslate = -customIndex * slideWidth;

    // Aplicăm tranziția pentru a alinia slider-ul la noul index
    customSlider.style.transition = 'transform 0.5s ease';
    customSlider.style.transform = `translateX(${newTranslate}px)`;

    updateCustomDots(); // Actualizăm punctele de navigare
}

// Click pe slider pentru a schimba la următorul slide
customSlider.addEventListener('click', () => {
    changeSlide();
});

// Eveniment touch pentru dispozitive mobile
customSlider.addEventListener('touchstart', (e) => {
    // Previne eventurile implicite și asigură compatibilitatea cu touch
    e.preventDefault();
    changeSlide();
});

// Funcție pentru actualizarea punctelor de navigare
function updateCustomDots() {
    customDots.forEach((dot, idx) => {
        dot.classList.remove('active');
        if (idx === customIndex) {
            dot.classList.add('active');
        }
    });
}

updateCustomDots(); // Inițializăm punctele de navigare

// Funcție care oprește propagarea evenimentului de click pe buton
function handleButtonClick(event) {
    event.stopPropagation(); // Oprește propagarea evenimentului de click
    // Poți adăuga orice altă funcționalitate pentru buton aici
}
