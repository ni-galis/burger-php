const menu = document.querySelector('.row-info__bottom');
const menuBtn = document.querySelector('.burger-btn');

const body = document.body;

if (menu && menuBtn) {
  menuBtn.addEventListener('click', () => {
    menu.classList.toggle('active');
    menuBtn.classList.toggle('active');
    body.classList.toggle('lock');
  })

  //? для закрытия меню из любого пустого места
  menu.addEventListener('click', e => {
    if (e.target.classList.contains('row-info__bottom')) {
      menu.classList.remove('active');
      menuBtn.classList.remove('active');
      body.classList.remove('lock');
    }
  })
}

// ============= слайдер ===============

const swiper = new Swiper('.swiper', {

  loop: true,
  speed: 900,

  effect: 'cube',

  pagination: {
    el: '.swiper-pagination',
    clickable: true,
  },
});
