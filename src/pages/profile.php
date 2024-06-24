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

// Determine if the user is authenticated

// Check if the user is logged in and has an administrator role
if (isset($_SESSION['id_users']) && $_SESSION['role'] == 1) {
  // Display the administrator button
  // echo '<button class="admin-button">Админ панель</button>';
}

// Display user data if authenticated
if (isset($_SESSION['id_users'])) {
  $user_data = $_SESSION;
}

// var_dump($_SESSION);
?>


<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<link rel="stylesheet" href="../scss/style.css" />
		<title>Профиль</title>
	</head>
	<body class="page">
		<header class="header">
			<div class="container header__inner">
				<nav class="header__nav">
					<a href="../../index.php" class="logo"
						><img
							class="logo__image"
							src="/src/images/icons/logo.svg"
							alt="headerLogo"
						/>
					</a>
					<ul class="header__menu">
						<li class="header__menu-item">
							<a class="header__menu-link" href="./profile.php"
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
							<a class="dropdown-menu-list-link" href="/src/pages/profile.html">
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
							<form  method='post' action='./profile.php' >	
								<button name="logout" class="dropdown-menu-list-link" 
								><img src="/src/images/icons/logout.svg" alt="icon" />Выход 
								</button>
							</form>
						</li>
					</ul>
				</div>
			</div>
		</header>
			<section class="profile">
					<div class="profile__content container">
							<h2 class="profile__title">Заказы</h2>
							<?php
							// Check if the user is logged in
							if (isset($_SESSION['id_users'])) {
									// Query to get the orders for the current user
									$queryS = "SELECT o.id_orders, o.order_date, o.total_cost, d.delivery_date, d.status
																							FROM orders o
																							LEFT JOIN deliveries d ON o.id_orders = d.id_orders
																							WHERE o.id_users =" . $_SESSION['id_users'] . "";
									$resultSS = mysqli_query($db, $queryS);
									if (mysqli_num_rows($resultSS) > 0) {
											echo '<div class="profile__show">';
											while ($row = mysqli_fetch_assoc($resultSS)) {
													echo '<h2 class="profile__title-buy">Заказ #' . $row['id_orders'] . '</h2>';
													echo '<p>Дата заказа: ' . $row['order_date'] . '</p>';
													echo '<p>Стоимость: ' . $row['total_cost'] . ' руб.</p>';
													echo '<p>Дата доставки: ' . $row['delivery_date'] . '</p>';
													echo '<p>Статус доставки: ' . $row['status'] . '</p>';
													echo '<hr>';
											}
											echo '</div>';
									} else {
											echo '<div class="profile__show">';
											echo '<h2 class="profile__title-buy">Заказы не найдены</h2>';
											echo '</div>';
									}
							}
							
							if (isset($user_data) && $user_data['role'] == 1) {
									?>
									<button class="admin-button dropdown-menu-list-link" onClick="adminAppear">админка</button>
							<?php } ?>
							<div class="admin-pannel none">
          			<a href='/src/pages/add_data.php' class='button admin-pannel-btn'>Добавить данные</a>
          			<a href='/src/pages/update_data.php' class='button admin-pannel-btn'>Изменить данные</a>
          			<a href='/src/pages/delete.php' class='button admin-pannel-btn'>Удалить данные</a>
								<a href='/src/pages/views.php' class='button admin-pannel-btn'>Посмотреть представление</a>
								<a href='/src/pages/alldb.php' class='button admin-pannel-btn'> Все таблицы</a>
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
		<script>function adminAppear() {
  const adminElement = document.querySelector('.admin-pannel');

  adminElement.classList.toggle('none');
}
document.querySelector('.admin-button').addEventListener('click', adminAppear);
</script>
		<script type="module" src="/src/js/main.js"></script>
		<script type="module" src="/src/js/dropDown.js"></script>
		<script type="module" src="/src/js/burger.js"></script>
	</body>
</html>
