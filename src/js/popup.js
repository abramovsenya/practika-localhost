// Открытие формы авторизации
document.getElementById('login-btn').addEventListener('click', function () {
	document.getElementById('login-popup').style.display = 'block';
});

// Закрытие формы авторизации
document.querySelectorAll('.popup__block-close').forEach(button => {
	button.addEventListener('click', function () {
		document.getElementById('login-popup').style.display = 'none';
		document.getElementById('register-popup').style.display = 'none';
	});
});

// Открытие формы регистрации
document.getElementById('register-btn').addEventListener('click', function () {
	document.getElementById('login-popup').style.display = 'none';
	document.getElementById('register-popup').style.display = 'block';
});

// Закрытие формы регистрации
document.querySelectorAll('.popup__block-close').forEach(button => {
	button.addEventListener('click', function () {
		document.getElementById('login-popup').style.display = 'none';
		document.getElementById('register-popup').style.display = 'none';
	});
});

// маска
$(document).ready(function () {
	// Применяем маску к полю ввода телефона
	$('.form__input-reg-phone').inputmask({
		mask: '+7 (999) 999-99-99', // Маска для российского номера телефона
		placeholder: ' ', // Символ заполнителя
		showMaskOnHover: false, // Показывать маску при наведении
		showMaskOnFocus: true, // Показывать маску при фокусе
	});
});
