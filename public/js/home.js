var TrandingSlider = new Swiper('.tranding-slider', {
  effect: 'coverflow',
  spaceBetween: 60,
  grabCursor: true,
  centeredSlides: true,
  loop: true,
  slidesPerView: 'auto',
  coverflowEffect: {
      rotate: 0,
      stretch: 0,
      depth: 150,
      modifier: 2,
  },
});