const menuBtn = document.querySelector('.header__burger');

const menu = document.querySelector('.header__nav-mobile');

menuBtn.addEventListener('click', () => {
	menu.classList.toggle('show');
	menuBtn.classList.toggle('active');
});
