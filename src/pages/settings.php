<?php
session_start();
$db = mysqli_connect('localhost','root', 'root', 'bistrie_nogi' );

if (isset($_POST['logout'])) {

    // Удаляем все переменные сессии
    $_SESSION = array();

    // Уничтожаем сессию
    session_destroy();

    // Перенаправляем на главную страницу или другую
    header('Location: http://localhost:5173/index.php');
    exit;
  }
?>     
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<link rel="stylesheet" href="../scss/style.css" />
		<title>Настройки</title>
	</head>
	<body class="page">
		<header class="header">
			<div class="container header__inner">
				<nav class="header__nav">
					<a href="#" class="logo"
						><img
							class="logo__image"
							src="/src/images/icons/logo.svg"
							alt="headerLogo"
						/>
					</a>
					<ul class="header__menu">
						<li class="header__menu-item">
							<a class="header__menu-link" href="./tracking.php"
								>Отслеживание</a
							>
						</li>
						<li class="header__menu-item">
							<a class="header__menu-link" href="./logistic.php"
								>Логистические решения
							</a>
						</li>
						<li class="header__menu-item">
							<a class="header__menu-link" href="./contact.php"
								>Контакты</a
							>
						</li>
						<li class="header__menu-item">
							<a class="header__menu-link" href="./career.php"
								>Карьера</a
							>
						</li>
					</ul>
					<!-- <a href="#" id="login-btn" class="header__menu-btn">Вход</a> -->
					<a href="#" id="login-btn" class="header__menu-btn"><?= $_SESSION ['name']?></a>
					<div class="header__burger">
						<span class="header__burger-bar"></span>
						<span class="header__burger-bar"></span>
						<span class="header__burger-bar"></span>
					</div>
					<nav class="header__nav-mobile">
						<div class="container">
							<a href="#" id="login-btn" class="header__menu-btn">Вход</a>
							<ul class="header__menu-mobile">
								<li class="header__menu-mobile-item">
									<a
										class="header__menu-mobile-link"
										href="./tracking.php"
										>Отслеживание</a
									>
								</li>
								<li class="header__menu-mobile-item">
									<a
										class="header__menu-mobile-link"
										href="./logistic.php"
										>Логистические решения
									</a>
								</li>
								<li class="header__menu-mobile-item">
									<a
										class="header__menu-mobile-link"
										href="./contact.php"
										>Контакты</a
									>
								</li>
								<li class="header__menu-mobile-item">
									<a
										class="header__menu-mobile-link"
										href="./career.php"
										>Карьера</a
									>
								</li>
							</ul>
						</div>
					</nav>
				</nav>
				<div class="dropdown">
					<ul class="dropdown-menu">
						<li class="dropdown-menu-list">
							<a class="dropdown-menu-list-link" href="/src/pages/profile.php">
								<img
									src="/src/images/icons/box-search.svg"
									alt="icon"
								/>Заказы</a
							>
						</li>
						<li class="dropdown-menu-list">
							<a class="dropdown-menu-list-link" href="/src/pages/settings.html"
								><img
									src="/src/images/icons/setting-2.svg"
									alt="icon"
								/>Настройки</a
							>
						</li>
						<li class="dropdown-menu-list">
							<form method='post' action='./settings.php' >	
								<button name="logout" class="dropdown-menu-list-link" 
								><img src="/src/images/icons/logout.svg" alt="icon" />Выход 
								</button>
							</form>
						</li>
					</ul>
				</div>
			</div>
		</header>
		<section class="setting">
			<div class="setting__content container">
				<h2 class="setting__title">Настройки</h2>
				<div class="setting__show">
					<h2 class="setting__title-buy">Способ оплаты</h2>
					<p class="setting__title-about">
						На данный момент оплата только при получении
					</p>
				</div>
			</div>
		</section>
		<footer class="footer">
			<div class="footer__inner container">
				<img src="/src/images/icons/logo.svg" alt="" />
				<div class="footer__socials">
					<p class="footer__title">Социальные сети</p>
					<div class="footer__socials-links">
						<a href="#" class="footer__socials-link">
							<img src="/src/images/icons/whatsapp.svg" alt="image" />
						</a>
						<a href="#" class="footer__socials-link">
							<img src="/src/images/icons/vk.svg" alt="image" />
						</a>
						<a href="#" class="footer__socials-link">
							<img src="/src/images/icons/tgtg.svg" alt="image" />
						</a>
					</div>
				</div>
				<div class="footer__menu">
					<p class="footer__title">Общее</p>
					<ul class="footer__list">
						<li class="footer__item">
							<a href="#" class="footer__link">Карьера</a>
						</li>
						<li class="footer__item">
							<a href="#" class="footer__link">Политика</a>
						</li>
						<li class="footer__item">
							<a href="#" class="footer__link">Личный кабинет</a>
						</li>
						<li class="footer__item">
							<a href="#" class="footer__link">Контакты</a>
						</li>
					</ul>
				</div>
			</div>
			<p class="footer__copyright">© Быстрые ноги 2024. Все права защищены.</p>
		</footer>
		<script type="module" src="/src/js/main.js"></script>
		<script type="module" src="/src/js/burger.js"></script>
		<script type="module" src="/src/js/dropDown.js"></script>
	</body>
</html>
