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
		<meta http-equiv="X-UA-Compatible" content="IE=edge" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<link rel="stylesheet" href="../scss/style.css" />
		<script src="https://www.google.com/recaptcha/api.js" async defer></script>	
		<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/5.0.6/jquery.inputmask.min.js"></script>
		<title>Контакты</title>
	</head>
	<body class="page">
		<header class="header">
			<div class="container header__inner">
				<nav class="header__nav">
					<a href="/index.php" class="logo"
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
		<section class="geo">
			<div class="geo__content container">
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
						width="100%"
						height="400"
						frameborder="1"
						allowfullscreen="false"
						style="position: relative"
					></iframe>
				</div>

				<div class="geo__aside">
					<div class="geo__aside-point">
						<p class="geo__aside-point-title">Наш адрес:</p>
						<p class="geo__aside-point-text">г. Москва, ул. Главная, 52</p>
					</div>
					<div class="geo__aside-point">
						<p class="geo__aside-point-title">Контактные телефоны:</p>
						<p class="geo__aside-point-text">+7 (915) 386-56-28</p>
					</div>
					<div class="geo__aside-point">
						<p class="geo__aside-point-title">Электронная почта:</p>
						<p class="geo__aside-point-text">bistrie-nogi@mail.ru</p>
					</div>
					<div class="geo__aside-point">
						<p class="geo__aside-point-title">Режим работы:</p>
						<p class="geo__aside-point-text">
							Понедельник - Пятница: 10:00 - 18:00
						</p>
					</div>
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
		<div id="register-popup" class="popup popup_register">
			<div class="popup__content popup__content-reg">
				<div class="popup__content-title">
					<h2 class="popup__title">Регистрация</h2>
					<button type="reset" class="popup__block-close">✖</button>
				</div>

				<form
					method="post"
					action="/src/pages/reg.php"
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
		<script type="module" src="/src/js/popup.js"></script>
		<script type="module" src="/src/js/dropDown.js"></script>
		<script type="module" src="/src/js/burger.js"></script>
	</body>
</html>
