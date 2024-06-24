<?php
session_start();

// Logout functionality
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

// Process the form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_orders = $_POST['parcel-number'];

    // Connect to the database
    $conn = mysqli_connect("localhost", "root", "root", "bistrie_nogi");

    // Check connection
    if (!$conn) {
        die("Connection failed: ". mysqli_connect_error());
    }

    // Query to get the order status
    $query = "SELECT status FROM orders WHERE id_orders = '$id_orders'";
    $result = mysqli_query($conn, $query);

    // Check if the order exists
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $status = $row['status'];
    } else {
        $status = "Order not found";
    }

    // Close the database connection
    mysqli_close($conn);
}
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<script src="https://www.google.com/recaptcha/api.js" async defer></script>
		<link rel="stylesheet" href="./src/scss/style.css" />
		<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/5.0.6/jquery.inputmask.min.js"></script>
		<title>Быстрые ноги</title>
	</head>
	<body class="page">
		<header class="header">
			<div class="container header__inner">
				<nav class="header__nav">
					<a href="#" class="logo"
						><img
							class="logo__image"
							src="./src/images/icons/logo.svg"
							alt="headerLogo"
						/>
					</a>
					<ul class="header__menu">
						<li class="header__menu-item">
							<a class="header__menu-link" href="/src/pages/tracking.php"
								>Отслеживание</a
							>
						</li>
						<li class="header__menu-item">
							<a class="header__menu-link" href="/src/pages/logistic.php"
								>Логистические решения
							</a>
						</li>
						<li class="header__menu-item">
							<a class="header__menu-link" href="/src/pages/contact.php"
								>Контакты</a
							>
						</li>
						<li class="header__menu-item">
							<a class="header__menu-link" href="/src/pages/career.php"
								>Карьера</a
							>
						</li>
					</ul>
				<?php if ($_SESSION['auth']) {
              echo  '<a href="#" id="login-btn" class="header__menu-btn">' .$_SESSION ["name"].'</a>';
            } else {
              echo '<a href="#" id="login-btn" class="header__menu-btn">Вход</a>';
            }
            ?>
					
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
										href="/src/pages/tracking.php"
										>Отслеживание</a
									>
								</li>
								<li class="header__menu-mobile-item">
									<a
										class="header__menu-mobile-link"
										href="/src/pages/logistic.php"
										>Логистические решения
									</a>
								</li>
								<li class="header__menu-mobile-item">
									<a
										class="header__menu-mobile-link"
										href="/src/pages/contact.php"
										>Контакты</a
									>
								</li>
								<li class="header__menu-mobile-item">
									<a
										class="header__menu-mobile-link"
										href="/src/pages/career.php"
										>Карьера</a
									>
								</li>
							</ul>
						</div>
					</nav>
				</nav>

				<?php if ($_SESSION['auth']) echo '
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
								<a class="dropdown-menu-list-link" href="/src/pages/settings.php"
									><img
										src="/src/images/icons/setting-2.svg"
										alt="icon"
									/>Настройки</a
								>
							</li>
							<li class="dropdown-menu-list">
								<form method="post" action="/index.php" >	
									<button name="logout" class="dropdown-menu-list-link" 
									><img src="/src/images/icons/logout.svg" alt="icon" />Выход 
									</button>
								</form>
								<!-- <a name="logout" class="dropdown-menu-list-link" href="/index.php" 
									><img src="/src/images/icons/logout.svg" alt="icon" />Выход</a> -->
							</li>
						</ul>
					</div>';
					?>	
			</div>
		</header>

		<section class="hero">
			<div class="hero__content container">
				<div class="hero__content-about">
					<h1 class="hero__title">Отследить свою посылку</h1>
										<form method="post">
							<div class="hero__radio-buttons">
									<input
											class="hero__radio"
											type="radio"
											id="otgruzki"
											name="delivery-type"
											checked
									/>
									<label class="hero__radio-label" for="otgruzki">Отгрузки и самовывоз</label>
									<input
											class="hero__radio"
											type="radio"
											id="gruzovie"
											name="delivery-type"
									/>
									<label class="hero__radio-label" for="gruzovie">Грузовые перевозки</label>
							</div>
							<div class="hero__search-form">
								<svg class="hero__svg"
									xmlns="http://www.w3.org/2000/svg" width="42" height="42" fill="none">
										<path stroke="#000" stroke-linecap="round" stroke-linejoin="round" stroke-width="3" 
										d="M21 24.5h1.75a3.51 3.51 0 0 0 3.5-3.5V3.5H10.5a6.993 6.993 0 0 0-6.107 3.587"/>			
										<path stroke="#000" stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
											d="M3.5 29.75A5.243 5.243 0 0 0 8.75 35h1.75a3.51 3.51 0 0 1 3.5-3.5 3.51 3.51 0 0 1 3.5 3.5h7a3.51 3.51 0 0 1 3.5-3.5 3.51 3.51 0 0 1 3.5 3.5h1.75a5.243 5.243 0 0 0 5.25-5.25V24.5h-5.25c-.962 0-1.75-.788-1.75-1.75V17.5c0-.962.788-1.75 1.75-1.75h2.258l-2.993-5.232A3.529 3.529 0 0 0 29.47 8.75h-3.22V21a3.51 3.51 0 0 1-3.5 3.5H21"
										/>
										<path stroke="#000" stroke-linecap="round"stroke-linejoin="round" stroke-width="3"
											d="M14 38.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7ZM28 38.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7ZM38.5 21v3.5h-5.25c-.962 0-1.75-.788-1.75-1.75V17.5c0-.962.788-1.75 1.75-1.75h2.258L38.5 21ZM3.5 14H14M3.5 19.25h7M3.5 24.5H7"
										/>
								</svg>
									<input
											class="hero__search-input"
											type="text"
											placeholder="Введите номер посылки"
											id="parcel-number"
											name="parcel-number"
									/>
									<button class="hero__search-button" type="submit">Найти</button>
							</div>
							<div class="form__response">
								<?php if (isset($status)):?>
									<p class="form__response-title">Статус заказа: <?php echo $status;?></p>
								<?php endif;?>
							</div>
					</form>
					<p class="hero__description">
						Разделяйте несколько номеров отслеживания пробелом или запятой.
						<a class="hero__description-link" href="#"
							>Расширенное отслеживание</a
						>
					</p>
				</div>
				<img class="hero__image" src="/src/images/image/dji.png" alt="" />
			</div>
		</section>
		<section class="links">
			<div class="links__content container">
				<div class="links__cards">
					<div class="links__card">
						<div class="links__card-inner">
							<img
								class="links__card-image"
								src="/src/images/icons/calculator.svg"
								alt="#"
							/>
							<p class="links__card-title">Калькулятор стоимости</p>
							<p class="links__card-subtitle">Узнайте стоимость доставки</p>
						</div>
					</div>
					<div class="links__card">
						<div class="links__card-inner">
							<img
								class="links__card-image"
								src="/src/images/icons/truck-fast.svg"
								alt="#"
							/>
							<p class="links__card-title">Отправить посылку</p>
							<p class="links__card-subtitle">Проще чем кажется</p>
						</div>
					</div>
					<div class="links__card">
						<div class="links__card-inner">
							<img
								class="links__card-image"
								src="/src/images/icons/supportIcon.svg"
								alt="#"
							/>
							<p class="links__card-title">Помощь и поддержка</p>
							<p class="links__card-subtitle">С Вами 24/7</p>
						</div>
					</div>
				</div>
			</div>
		</section>
		<section class="about">
			<div class="about__content container">
				<div class="about__cards">
					<div class="about__card">
						<img src="/src/images/image/box.png" alt="image" />
						<p class="about__card-title">Гибкие решения</p>
						<p class="about__card-description">
							Настраиваемые решения, которым вы можете доверять и которые
							соответствуют требованиям ваших клиентов.
						</p>
					</div>
					<div class="about__card">
						<img src="/src/images/image/plane.png" alt="image" />
						<p class="about__card-title">Устойчивость поставок</p>
						<p class="about__card-description">
							Надежные логистические решения для удовлетворения постоянно
							меняющихся рыночных потребностей вашего бизнеса.
						</p>
					</div>
					<div class="about__card">
						<img src="/src/images/image/man.png" alt="image" />
						<p class="about__card-title">Устойчивая логистика</p>
						<p class="about__card-description">
							Более экологичная грузовая логистика, которая помогает вашей
							прибыли, окружающей среде и сообществу.
						</p>
					</div>
				</div>
			</div>
		</section>
		<section class="delivery">
			<div class="delivery__content container">
				<div class="delivery__cards">
					<div class="delivery__card">
						<div class="delivery__card-inner">
							<img src="/src/images/icons/logo.svg" alt="#" />
							<p class="delivery__card-name">Экспресс</p>
							<div class="delivery__card-medium">
								<div class="delivery__card-medium-point">
									<img src="/src/images/icons/gift.svg" alt="#" />
									<p class="delivery__card-medium-point-text">Посылки</p>
								</div>
								<div class="delivery__card-medium-point">
									<img src="/src/images/icons/document-text.svg" alt="#" />
									<p class="delivery__card-medium-point-text">Документы</p>
								</div>
							</div>
							<div class="delivery__card-point">
								<img src="/src/images/icons/airplane-square.svg" alt="#" />
								<p class="delivery__card-point-text">Международная доставка</p>
							</div>
							<a href="#" class="delivery__card-link"> Узнать больше</a>
						</div>
					</div>
					<!--  -->
					<div class="delivery__card">
						<div class="delivery__card-inner">
							<img src="/src/images/icons/logo.svg" alt="#" />
							<p class="delivery__card-name">Экспресс</p>
							<div class="delivery__card-medium">
								<div class="delivery__card-medium-point">
									<img src="/src/images/icons/gift.svg" alt="#" />
									<p class="delivery__card-medium-point-text">Посылки</p>
								</div>
								<div class="delivery__card-medium-point">
									<img src="/src/images/icons/document-text.svg" alt="#" />
									<p class="delivery__card-medium-point-text">Документы</p>
								</div>
							</div>
							<div class="delivery__card-point">
								<img src="/src/images/icons/airplane-square.svg" alt="#" />
								<p class="delivery__card-point-text">Международная доставка</p>
							</div>
							<div class="delivery__card-point">
								<img src="/src/images/icons/ship.svg" alt="#" />
								<p class="delivery__card-point-text">Морская доставка</p>
							</div>
							<a href="#" class="delivery__card-link"> Узнать больше</a>
						</div>
					</div>
				</div>
			</div>
		</section>
		<section class="promo">
			<div class="promo__content container">
				<h2 class="promo__title">
					Возможность совершать покупки по всему миру
				</h2>
				<img class="promo__img" src="/src/images/image/negr.png" alt="image" />
				<div class="promo__aside">
					<h3 class="promo__aside-title">Всегда успеете на распродажу</h3>
					<a class="promo__aside-btn" href="#">Войти сейчас</a>
				</div>
			</div>
		</section>
		<section class="links">
			<div class="links__content container">
				<div class="links__cards">
					<div class="links__card">
						<div class="links__card-inner">
							<img
								class="links__card-image"
								src="/src/images/icons/calculator.svg"
								alt="#"
							/>
							<p class="links__card-title">Калькулятор стоимости</p>
							<p class="links__card-subtitle">Узнайте стоимость доставки</p>
						</div>
					</div>
					<div class="links__card">
						<div class="links__card-inner">
							<img
								class="links__card-image"
								src="/src/images/icons/chart-square.svg"
								alt="#"
							/>
							<p class="links__card-title">Карьера</p>
							<p class="links__card-subtitle">Рады новым кадрам</p>
						</div>
					</div>
					<div class="links__card">
						<div class="links__card-inner">
							<img
								class="links__card-image"
								src="/src/images/icons/supportIcon.svg"
								alt="#"
							/>
							<p class="links__card-title">Помощь и поддержка</p>
							<p class="links__card-subtitle">Всегда готовы помочь</p>
						</div>
					</div>
				</div>
			</div>
		</section>
		<section class="news">
			<div class="news__content container">
				<h2 class="news__title">Новости</h2>
				<div class="news__cards">
					<div class="news__card">
						<img src="/src/images/image/Businesses.png" alt="image" />
						<p class="news__card-title">Как наладить коннект с сотрудниками</p>
						<p class="news__card-date">30 мая 2024 год</p>
					</div>
					<div class="news__card">
						<img src="/src/images/image/people.png" alt="image" />
						<p class="news__card-title">
							10 стратегий чтобы выделить Ваш бизнес
						</p>
						<p class="news__card-date">20 мая 2024 год</p>
					</div>
					<div class="news__card">
						<img src="/src/images/image/manBox.png" alt="image" />
						<p class="news__card-title">5 причин улучшить логистику бизнеса</p>
						<p class="news__card-date">21 мая 2024 год</p>
					</div>
				</div>
			</div>
		</section>
		<section class="helps">
			<div class="helps__content container">
				<div class="helps__aside">
					<h2 class="helps__aside-title">Как мы можем помочь Вам?</h2>
					<form class="helps__form" method="post" action="/src/pages/contact_form.php">
						<div class="contact-form__field">
							<label class="contact-form__label" for="contact_name'">Ваше имя</label>
							<input
								class="contact-form__input"
								type="text"
								id="contact_name'"
								name="contact_name"
							/>
						</div>
						<div class="contact-form__field">
							<label class="contact-form__label" for="contact_surname"
								>Ваша фамилия</label
							>
							<input
								class="contact-form__input"
								type="text"
								id="contact_surname"
								name="contact_surname"
							/>
						</div>
						<div class="contact-form__field">
							<label class="contact-form__label" for="contact_social"
								>Ссылка на социальную сеть</label
							>
							<input
								class="contact-form__input"
								type="text"
								id="contact_social"
								name="contact_social"
							/>
						</div>

						<div class="contact-form__field">
							<label class="contact-form__label" for="contact_phone"
								>Номер телефона</label
							>
							<input
								class="contact-form__input"
								type="text"
								id="contact_phone"
								name="contact_phone"
							/>
						</div>
						<div class="contact-form__field">
							<label class="contact-form__label" for="contact_email">Ваша почта</label>
							<input
								class="contact-form__input"
								type="email"
								id="contact_email"
								name="contact_email"
							/>
						</div>
						<button class="contact-form__button" type="submit">
							Связаться
						</button>
					</form>
				</div>
				<img
					class="helps__image"
					src="/src/images/image/consultant.png"
					alt="image"
				/>
			</div>
		</section>
		<section class="map">
			<div class="map__content container">
				<!-- <img class="map__image" src="/src/images/image/map.png" alt="image" /> -->
				<div style="position: relative; overflow: hidden">
					<a
						href="https://yandex.ru/maps/org/moskovskiy_kreml/1023322799/?utm_medium=mapframe&utm_source=maps"
						style="color: #eee; font-size: 12px; position: absolute; top: 0px"
						>Московский Кремль</a
					><a
						href="https://yandex.ru/maps/213/moscow/category/museum/184105894/?utm_medium=mapframe&utm_source=maps"
						style="color: #eee; font-size: 12px; position: absolute; top: 14px"
						>Музей в Москве</a
					><a
						href="https://yandex.ru/maps/213/moscow/category/landmark_attraction/89683368508/?utm_medium=mapframe&utm_source=maps"
						style="color: #eee; font-size: 12px; position: absolute; top: 28px"
						>Достопримечательность в Москве</a
					><iframe
						src="https://yandex.ru/map-widget/v1/?ll=37.694177%2C55.707046&mode=poi&poi%5Bpoint%5D=37.618875%2C55.751428&poi%5Buri%5D=ymapsbm1%3A%2F%2Forg%3Foid%3D1023322799&z=11.54"
						max-width="1060"
						width="100%"
						height="400"
						frameborder="1"
						allowfullscreen="true"
						style="position: relative"
					></iframe>
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

		<!-- Форма авторизации в окне Popup -->
		<div id="login-popup" class="popup popup_login">
			<div class="popup__content">
				<div class="popup__content-title">
					<h2 class="popup__title">Войти в аккаунт</h2>
					<button type="reset" class="popup__block-close">✖</button>
				</div>

				<form
					method="post"
					action="/src/pages/enter.php"
					class="form form_login"
				>
					<div class="form-login__input">
						<label class="form__label" for="loginEmail">Почта:</label>
						<input
							class="form__input"
							type="text"
							id="loginEmail"
							name="loginEmail"
						/>
					</div>
					<div class="form-login__input">
						<label class="form__label" for="loginPassword">Пароль:</label>
						<input
							class="form__input"
							type="password"
							id="loginPassword"
							name="loginPassword"
						/>
					</div>
					<div
						class="g-recaptcha"
						data-sitekey="6LfOU_opAAAAAM4-wsXGUtQEkMIu9RYdj_CsbaiT"
					></div>
					<button class="form__submit" type="submit" id="login-submit">
						Войти
					</button>
					<div class="form__login-aside">
						<div class="form__login-aside-text">
							<img src="/src/images/icons/user-add.svg" alt="img" />
							<p>Впервые в компании?</p>
						</div>
						<!-- <button class="form__link" id="register-btn">
							Создать аккаунт
						</button> -->
					</div>
					<script>
						function onClick(e) {
							e.preventDefault();
							grecaptcha.enterprise.ready(async () => {
								const token = await grecaptcha.enterprise.execute(
									'6LfOU_opAAAAAM4-wsXGUtQEkMIu9RYdj_CsbaiT',
									{ action: 'REGISTER' }
								);
								if (token) {
									// если капча пройдена, то можно перейти на страницу регистрации
									document.querySelector('#register-btn').disabled = false;
								} else {
									// если капча не пройдена, то кнопка регистрации недоступна
									document.querySelector('#register-btn').disabled = true;
								}
							});
						}
					</script>
				</form>
				<button class="form__link" id="register-btn">Создать аккаунт</button>
			</div>
		</div>

		<!-- Форма регистрации в окне Popup -->


		<!-- work -->
		<div id="register-popup" class="popup popup_register">
			<div class="popup__content popup__content-reg">
				<div class="popup__content-title">
					<h2 class="popup__title">Регистрация</h2>
					<button type="reset" class="popup__block-close">✖</button>
				</div>

				<form
					method="post"
					action="./src/pages/reg.php"
					class="form form_register"
				>
					<div class="aas">
						<div class="form-register__input">
							<label class="form__label" for="register-name">Имя:</label>
							<input
								class="form__input"
								type="text"
								id="register-name"
								name="name"
							/>
						</div>
						<div class="form-register__input">
							<label class="form__label" for="register-surname">Фамилия:</label>
							<input
								class="form__input"
								type="text"
								id="register-surname"
								name="surname"
							/>
						</div>
						<div class="form-register__input">
							<label class="form__label" for="register-patronymic"
								>Отчество:</label
							>
							<input
								class="form__input"
								type="text"
								id="register-patronymic"
								name="patronymic"
							/>
						</div>

						<div class="form-register__input">
							<label class="form__label" for="register-email">Email:</label>
							<input
								class="form__input"
								type="email"
								id="register-email"
								name="email"
							/>
						</div>
						<div class="form-register__input">
							<label class="form__label" for="register-phone">Телефон:</label>
							<input
								class="form__input-reg-phone form__input"
								type="tel"
								id="register-phone"
								name="phone"
							/>
						</div>
						<div class="form-register__input">
							<label class="form__label" for="register-address">Адрес:</label>
							<input
								class="form__input"
								type="text"
								id="register-address"
								name="address"
							/>
						</div>
						<div class="form-register__input">
							<label class="form__label" for="register-bDate"
								>Дата рождения:</label
							>
							<input
								class="form__input"
								type="date"
								id="register-bDate"
								name="bDate"
							/>
						</div>
						<div class="form-register__input">
							<label class="form__label" for="register-gender">Пол:</label>
							<select class="form__input" id="register-gender" name="gender">
								<option value="M">Мужской</option>
								<option value="F">Женский</option>
							</select>
						</div>
						<div class="form-register__input">
							<label class="form__label" for="register-password">Пароль:</label>
							<input
								class="form__input"
								type="password"
								id="register-password"
								name="password"
							/>
						</div>
						<div class="form-register__input">
							<label class="form__label" for="register-password-confirm"
								>Подтвердите пароль:</label
							>
							<input
								class="form__input"
								type="password"
								id="register-password-confirm"
								name="passwordConfirm"
							/>
						</div>
						<button class="form__submit" id="register-submit">
							Зарегистрироваться
						</button>
					</div>
				</form>
			</div>
		</div>
		<script type="module" src="/src/js/main.js"></script>
		<script type="module" src="/src/js/dropDown.js"></script>
		<script type="module" src="/src/js/burger.js"></script>
		<script type="module" src="/src/js/popup.js"></script>
	</body>
</html>
