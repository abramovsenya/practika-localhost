<?php
$db = mysqli_connect('localhost', 'root', 'root', 'bistrie_nogi');

if (!$db) {
	die("Ошибка подключения к базе данных: " . mysqli_connect_error());
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="../scss/style.css" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Представления</title>
</head>

<body class="page">
	<div class="container views__container">
		<div class="views__block">
			<div class="views__text">
				<h2 class="admin_title">Какое представление вывести?</h2>
				<form method="post" class="views__text-request">
					<button type="submit" name="request1" class="views__text-request">1. Получить список всех заказов за определенный период:</button>
					<button type="submit" name="request2" class="views__text-request">2. Получить список всех заказов определенного клиента:</button>
					<button type="submit" name="request3" class="views__text-request">3. Получить список всех заказов, которые были доставлены определенным курьером:</button>
					<button type="submit" name="request4" class="views__text-request">4. Получить список заказов, которые еще не были доставлены:</button>
					<button type="submit" name="request5" class="views__text-request">5. Получить список всех заказов, у которых сумма доставки превышает заданное значение:</button>
					<button type="submit" name="request6" class="views__text-request">6. Получить список всех клиентов с указанием наполнения заказа, даты и времени:</button>
					<button type="submit" name="request7" class="views__text-request">7. Получить список курьеров с наибольшим количеством отзывов и с наибольшее  оценкой. </button>
					<button type="submit" name="request8" class="views__text-request">8.  Получить список всех товаров, которые были заказаны клиентами  определенной возрастной группы и определенного пола. </button>
					<button type="submit" name="request9" class="views__text-request">9. Получить список всех заказов, сделанных клиентами с определенным  почтовым индексом.</button>
					<button type="submit" name="request10" class="views__text-request">10. Получить список всех клиентов, у которых не было сделано ни одного заказа.</button>
				</form>
				<button onclick="redirectToPage()" class="exit-views exit">Выйти </button>
			</div>
			<div class="answer">
				<?php
				if (isset($_POST['request1'])) {
					$startDate = $_POST['startDate'];
					$endDate = $_POST['endDate'];
					$query1 = "SELECT * FROM Orders WHERE order_date BETWEEN '2022-01-01' AND '2024-12-31';";

					// Execute the query
					$result1 = mysqli_query($db, $query1);

					// Check if the query was successful
					if (!$result1) {
						die("Query failed: " . mysqli_error($db));
					}

					// Display the results
					echo "<h2 class='admin_title views_rez'>Результат:</h2>";
					echo "<ul class='rez-ul'>";
					while ($row = mysqli_fetch_assoc($result1)) {
						echo "<li class='popup__block-text'>";
						echo  "ID заказа: " . $row['id_orders'] . ", ID клиента: " . $row['id_users'] . ", Дата заказа: " . $row['order_date'] . ", Статус: " . $row['status'] . ", Общая стоимость: " . $row['total_cost'];
						echo "</li>";
					}
					echo "</ul>";
				} elseif (isset($_POST['request2'])) {
					$clientId = $_POST['clientId'];
					$query2 = "SELECT * FROM Orders WHERE id_users = 6;";

					// Execute the query
					$result2 = mysqli_query($db, $query2);

					// Check if the query was successful
					if (!$result2) {
						die("Query failed: " . mysqli_error($db));
					}

					// Display the results
					echo "<h2 class='admin_title views_rez'>Результат:</h2>";
					echo "<ul class='rez-ul'>";
					while ($row = mysqli_fetch_assoc($result2)) {
						echo "<li class='popup__block-text'>";
						echo  "ID заказа: " . $row['id_orders'] . ", ID клиента: " . $row['id_users'] . ", Дата заказа: " . $row['order_date'] . ", Статус: " . $row['status'] . ", Общая стоимость: " . $row['total_cost'];
						echo "</li>";
					}
					echo "</ul>";
				} elseif (isset($_POST['request3'])) {
					$courierId = $_POST['courierId'];
					$query3 = "SELECT o.id_orders, o.id_users, o.order_date, o.status, o.total_cost FROM orders o JOIN deliveries d ON o.id_orders = d.id_orders WHERE d.id_couriers = 1 AND d.status = 'Доставлен';";

					// Execute the query
					$result3 = mysqli_query($db, $query3);

					// Check if the query was successful
					if (!$result3) {
						die("Query failed: " . mysqli_error($db));
					}

					// Display the results
					echo "<h2 class='admin_title views_rez'>Результат:</h2>";
					echo "<ul class='rez-ul'>";
					while ($row = mysqli_fetch_assoc($result3)) {
						echo "<li class='popup__block-text'>";
						echo  "ID заказа: " . $row['id_orders'] . ", ID клиента: " . $row['id_users'] . ", Дата заказа: " . $row['order_date'] . ", Статус: " . $row['status'] . ", Общая стоимость: " . $row['total_cost'];
						echo "</li>";
					}
					echo "</ul>";
				} elseif (isset($_POST['request4'])) {
					$query4 = "SELECT o.id_orders, o.id_users, o.order_date, o.status, o.total_cost FROM orders o LEFT JOIN deliveries d ON o.id_orders = d.id_orders WHERE d.id_deliveries IS NULL OR d.status <> 'Доставлен';";

					// Execute the query
					$result4 = mysqli_query($db, $query4);

					// Check if the query was successful
					if (!$result4) {
						die("Query failed: " . mysqli_error($db));
					}

					// Display the results
					echo "<h2 class='admin_title views_rez'>Результат:</h2>";
					echo "<ul class='rez-ul'>";
					while ($row = mysqli_fetch_assoc($result4)) {
						echo "<li class='popup__block-text'>";
						echo  "ID заказа: " . $row['id_orders'] . ", ID клиента: " . $row['id_users'] . ", Дата заказа: " . $row['order_date'] . ", Статус: " . $row['status'] . ", Общая стоимость: " . $row['total_cost'];
						echo "</li>";
					}
					echo "</ul>";
				} elseif (isset($_POST['request5'])) {
					$deliveryCost = $_POST['deliveryCost'];
					$query5 = "SELECT id_orders, id_users, order_date, status, total_cost FROM orders WHERE total_cost > 1500.00;";

					// Execute the query
					$result5 = mysqli_query($db, $query5);

					// Check if the query was successful
					if (!$result5) {
						die("Query failed: " . mysqli_error($db));
					}

					// Display the results
					echo "<h2 class='admin_title views_rez'>Результат:</h2>";
					echo "<ul class='rez-ul'>";
					while ($row = mysqli_fetch_assoc($result5)) {
						echo "<li class='popup__block-text'>";
						echo  "ID заказа: " . $row['id_orders'] . ", ID клиента: " . $row['id_users'] . ", Дата заказа: " . $row['order_date'] . ", Статус: " . $row['status'] . ", Общая стоимость: " . $row['total_cost'];
						echo "</li>";
					}
					echo "</ul>";
				} elseif (isset($_POST['request6'])) {
					$query6 = "SELECT `u`.`name`, `u`.`surname`, `u`.`patronymic`, `u`.`email`, `u`.`phone`, `u`.`address`, `u`.`bDate`, `u`.`gender`, `o`.`id_orders`, `o`.`order_date`, `o`.`status`, `o`.`total_cost`
					FROM `users` `u`
					JOIN `orders` `o` ON `u`.`id_users` = `o`.`id_users`";

					// Execute the query
					$result6 = mysqli_query($db, $query6);

					// Check if the query was successful
					if (!$result6) {
						die("Query failed: " . mysqli_error($db));
					}

					// Display the results
					echo "<h2 class='admin_title views_rez'>Результат:</h2>";
					echo "<ul class='rez-ul'>";
					while ($row = mysqli_fetch_assoc($result6)) {
						echo "<li class='popup__block-text'>";
						echo "Имя: " . $row['name'] . ", Фамилия: " . $row['surname'] . ", Отчество: " . $row['patronymic'] . ", Email: " . $row['email'] . ", Телефон: " . $row['phone'] . ", Адрес: " . $row['address'] . ", Дата рождения: " . $row['bDate'] . ", Пол: " . $row['gender'] . ", ID заказа: " . $row['id_orders'] . ", Дата заказа: " . $row['order_date'] . ", Статус: " . $row['status'] . ", Общая стоимость: " . $row['total_cost'];
						echo "</li>";
					}
					echo "</ul>";
				} elseif (isset($_POST['request7'])) {
					$query7 = "SELECT c.*, COUNT(d.id_deliveries) AS num_deliveries, SUM(o.total_cost) AS total_cost
					FROM couriers c
					LEFT JOIN deliveries d ON c.id_couriers = d.id_couriers
					LEFT JOIN orders o ON d.id_orders = o.id_orders
					GROUP BY c.id_couriers
					ORDER BY num_deliveries DESC, total_cost DESC
					LIMIT 1;";

					// Execute the query
					$result7 = mysqli_query($db, $query7);

					// Check if the query was successful
					if (!$result7) {
						die("Query failed: " . mysqli_error($db));
					}

					// Display the results
					echo "<h2 class='admin_title views_rez'>Результат:</h2>";
					echo "<ul class='rez-ul'>";
					while ($row = mysqli_fetch_assoc($result7)) {
						echo "<li class='popup__block-text'>";
						echo "Имя: " . $row['name'] . ", Фамилия: " . $row['surname'] . ", Отчество: " . $row['patronymic'] . ", Телефон: " . $row['phone'] . ", Рейтинг: " . $row['rating'] . ", Отзывы: " . $row['reviews'];
						echo "</li>";
					}
					echo "</ul>";
				} elseif (isset($_POST['request8'])) {
					$ageGroup = $_POST['ageGroup'];
					$gender = $_POST['gender'];
					$query8 = "SELECT o.*, u.*
					FROM orders o
					JOIN users u ON o.id_users = u.id_users
					WHERE u.gender = 'M' AND u.bDate <= DATE_SUB(CURDATE(), INTERVAL 25 YEAR);";

					// Execute the query
					$result8 = mysqli_query($db, $query8);

					// Check if the query was successful
					if (!$result8) {
						die("Query failed: " . mysqli_error($db));
					}

					// Display the results
					echo "<h2 class='admin_title views_rez'>Результат:</h2>";
					echo "<ul class='rez-ul'>";
					while ($row = mysqli_fetch_assoc($result8)) {
						echo "<li class='popup__block-text'>";
						echo "Имя: " . $row['name'] . ", Фамилия: " . $row['surname'] . ", Отчество: " . $row['patronymic'] . ", Email: " . $row['email'] . ", Телефон: " . $row['phone'] . ", Адрес: " . $row['address'] . ", Дата рождения: " . $row['bDate'] . ", Пол: " . $row['gender'] . ", ID заказа: " . $row['id_orders'] . ", Дата заказа: " . $row['order_date'] . ", Статус: " . $row['status'] . ", Общая стоимость: " . $row['total_cost'];
						echo "</li>";
					}
					echo "</ul>";
				} elseif (isset($_POST['request9'])) {
					$postalCode = $_POST['postalCode'];
					$query9 = "SELECT o.* FROM orders o JOIN users u ON o.id_users = u.id_users WHERE u.address LIKE '%р-н%';";

					// Execute the query
					$result9 = mysqli_query($db, $query9);

					// Check if the query was successful
					if (!$result9) {
						die("Query failed: " . mysqli_error($db));
					}

					// Display the results
					echo "<h2 class='admin_title views_rez'>Результат:</h2>";
					echo "<ul class='rez-ul'>";
					while ($row = mysqli_fetch_assoc($result9)) {
						echo "<li class='popup__block-text'>";
						echo  "ID заказа: " . $row['id_orders'] . ", ID клиента: " . $row['id_users'] . ", Дата заказа: " . $row['order_date'] . ", Статус: " . $row['status'] . ", Общая стоимость: " . $row['total_cost'];
						echo "</li>";
					}
					echo "</ul>";
				} elseif (isset($_POST['request10'])) {
					$query10 = "SELECT u.name, u.surname FROM users u LEFT JOIN orders o ON u.id_users = o.id_users WHERE o.id_orders IS NULL;";

					// Execute the query
					$result10 = mysqli_query($db, $query10);

					// Check if the query was successful
					if (!$result10) {
						die("Query failed: " . mysqli_error($db));
					}

					// Display the results
					echo "<h2 class='admin_title views_rez'>Результат:</h2>";
					echo "<ul class='rez-ul'>";
					while ($row = mysqli_fetch_assoc($result10)) {
						echo "<li class='popup__block-text'>";
						echo "Имя: " . $row['name'] . ", Фамилия: " . $row['surname'] . ", Отчество: " . $row['patronymic'] . ", Email: " . $row['email'] . ", Телефон: " . $row['phone'] . ", Адрес: " . $row['address'] . ", Дата рождения: " . $row['bDate'] . ", Пол: " . $row['gender'];
						echo "</li>";
					}
					echo "</ul>";
				}
				?>
			</div>
		</div>
	</div>
<script>
function redirectToPage() {
    // Здесь вы указываете адрес страницы, на которую хотите перейти
    window.location.href = "http://localhost:5173/src/pages/profile.php";
}
</script>
</body>

</html>