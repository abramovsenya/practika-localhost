document
	.getElementById('login-btn')
	.addEventListener('mouseenter', function () {
		document.querySelector('.dropdown').classList.add('dropdown-active');
	});

document
	.getElementById('login-btn')
	.addEventListener('mouseleave', function () {
		document.querySelector('.dropdown').classList.remove('dropdown-active');
	});

document.querySelector('.dropdown').addEventListener('mouseover', function () {
	document.querySelector('.dropdown').classList.add('dropdown-active');
});

document.querySelector('.dropdown').addEventListener('mouseout', function () {
	document.querySelector('.dropdown').classList.remove('dropdown-active');
});
