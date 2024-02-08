const imageSlider = document.getElementById('slider');
let currentIndex = 0;

const images = [
    '/img/FOTO HOTEL/Hotel (1).jpg',
    '/img/FOTO HOTEL/Hotel (2).jpg',
    '/img/FOTO HOTEL/Hotel (3).jpg',
    '/img/FOTO HOTEL/Hotel (4).jpg',
    '/img/FOTO HOTEL/Hotel (5).jpg',
    '/img/FOTO HOTEL/Hotel (6).jpg',
    '/img/FOTO HOTEL/Hotel (7).jpg',
    '/img/FOTO HOTEL/Hotel (8).jpg',
    '/img/FOTO HOTEL/Hotel (9).jpg',
    '/img/FOTO HOTEL/Hotel (10).jpg',
    '/img/FOTO HOTEL/Hotel (11).jpg',
    '/img/FOTO HOTEL/Hotel (12).jpg',
    '/img/FOTO HOTEL/Hotel (13).jpg',
    '/img/FOTO HOTEL/Hotel (14).jpg',
    '/img/FOTO HOTEL/Hotel (15).jpg',
    '/img/FOTO HOTEL/Hotel (16).jpg',
    '/img/FOTO HOTEL/Hotel (17).jpg',
];

function showImage(index) {
    imageSlider.src = images[index];
}

function nextImage() {
    currentIndex = (currentIndex + 1) % images.length;
    showImage(currentIndex);
}

function prevImage() {
    currentIndex = (currentIndex - 1 + images.length) % images.length;
    showImage(currentIndex);
}

// Menampilkan gambar pertama saat halaman dimuat
showImage(currentIndex);

// Menambahkan event listener untuk tombol next dan prev
document.getElementById('btnNext').addEventListener('click', nextImage);
document.getElementById('btnPrev').addEventListener('click', prevImage);

// Mengatur interval untuk otomatis slideshow
setInterval(nextImage, 8000);