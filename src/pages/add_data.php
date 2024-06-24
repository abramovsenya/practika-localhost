<?php

session_start();
$db = mysqli_connect('localhost', 'root', 'root', 'bistrie_nogi');

// Проверяем, есть ли ошибки подключения
if ($db == false) {
    echo 'Ошибка подключения';
    exit;
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Добавление нового пользователя
    if (isset($_POST['name']) && isset($_POST['surname']) && isset($_POST['patronymic']) && isset($_POST['email']) && isset($_POST['phone']) && isset($_POST['address']) && isset($_POST['bDate']) && isset($_POST['gender']) && isset($_POST['password']) && isset($_POST['role'])) {

        // Даем значение для данных
        $name = $db->real_escape_string($_POST['name']);
        $surname = $db->real_escape_string($_POST['surname']);
        $patronymic = $db->real_escape_string($_POST['patronymic']);
        $email = $db->real_escape_string($_POST['email']);
        $phone = $db->real_escape_string($_POST['phone']);
				$address = $db->real_escape_string($_POST['address']);
				$bDate = $db->real_escape_string($_POST['bDate']);
				$gender = $db->real_escape_string($_POST['gender']);
        $password = $db->real_escape_string($_POST['password']);
        $role = intval($_POST['role']);

        // Проверка на заполнение всех полей
        if (!empty($name) && !empty($surname) && !empty($patronymic) && !empty($email) &&  !empty($phone) && !empty($address) &&  !empty($bDate) && !empty($gender) && !empty($password)) {

            // Проверка на существующую почту
            $check_sql = "SELECT * FROM users WHERE email='$email'";
            $check_result = $db->query($check_sql);

            if ($check_result->num_rows > 0) {
                echo 'Пользователь с таким email уже существует';
            } else {
                // Проверка на существующего пользователя с таким phone
                $check_sql_phone = "SELECT * FROM users WHERE phone='$phone'";
                $check_result_phone = $db->query($check_sql_phone);

                if ($check_result_phone->num_rows > 0) {
                    echo 'Пользователь с таким Телефоном уже существует';
                } else {
                    // Проверка на правильное заполнение почты
                    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                        echo 'Неправильный формат электронной почты';
                        exit;
                    } else {
                        $insert_sql = "INSERT INTO users (surname, name, patronymic, email, phone, address, bDate, gender, password, role) VALUES (?,?,?,?,?,?,?,?,?,?)";
                        $stmt = $db->prepare($insert_sql);
                        $stmt->bind_param("sssssssssi", $name, $surname, $patronymic, $email, $phone, $address, $bDate, $gender, $password, $role);

                        if ($stmt->execute()) {
                            echo 'Данные пользователя успешно добавлены';
														header('location:http://localhost:5173/src/pages/add_data.php');
                        } else {
                            echo 'Ошибка добавления данных пользователя: '. $db->error;
                        }
                    }
                }
            }
        } else {
            echo 'Пожалуйста, заполните все поля формы для пользователя.';
        }
    }

		// добавление нового курьера
    if (isset($_POST['name']) && isset($_POST['surname']) && isset($_POST['patronymic']) && isset($_POST['phone']) && isset($_POST['rating']) && isset($_POST['reviews'])) {

        // Даем значение для данных
        $name = $db->real_escape_string($_POST['name']);
        $surname = $db->real_escape_string($_POST['surname']);
        $patronymic = $db->real_escape_string($_POST['patronymic']);
        $phone = $db->real_escape_string($_POST['phone']);
        $rating = $db->real_escape_string($_POST['rating']);
        $reviews = $db->real_escape_string($_POST['reviews']);

        // Проверка на заполнение всех полей
        if (!empty($name) && !empty($surname) && !empty($patronymic) && !empty($phone) && !empty($rating) && !empty($reviews)) {

            // Проверка на существующего курьера с таким телефоном
            $check_sql_phone = "SELECT * FROM couriers WHERE phone='$phone'";
            $check_result_phone = $db->query($check_sql_phone);

            if ($check_result_phone->num_rows > 0) {
                echo 'Курьер с таким Телефоном уже существует';
            } else {
                $insert_sql = "INSERT INTO couriers (name, surname, patronymic, phone, rating, reviews) VALUES (?,?,?,?,?,?)";
                $stmt = $db->prepare($insert_sql);
                $stmt->bind_param("ssssii", $name, $surname, $patronymic, $phone, $rating, $reviews);

                if ($stmt->execute()) {
                    echo 'Данные курьера успешно добавлены';
                    header('location:http://localhost:5173/src/pages/add_data.php');
                } else {
                    echo 'Ошибка добавления данных курьера: '. $db->error;
                }
            }
        } else {
            echo 'Пожалуйста, заполните все поля формы для курьера.';
        }
    }


		// добавление заказа
    if (isset($_POST['id_users']) && isset($_POST['order_date']) && isset($_POST['status']) && isset($_POST['total_cost'])) {

        // Даем значение для данных
        $id_users = $db->real_escape_string($_POST['id_users']);
        $order_date = $db->real_escape_string($_POST['order_date']);
        $status = $db->real_escape_string($_POST['status']);
        $total_cost = $db->real_escape_string($_POST['total_cost']);

        // Проверка на заполнение всех полей
        if (!empty($id_users) && !empty($order_date) && !empty($status) && !empty($total_cost)) {

            
                $insert_sql = "INSERT INTO orders (id_users, order_date, status, total_cost) VALUES (?,?,?,?)";
                $stmt = $db->prepare($insert_sql);
                $stmt->bind_param("isss", $id_users, $order_date, $status, $total_cost);

                if ($stmt->execute()) {
                    echo 'Данные заказа успешно добавлены';
                    header('location:http://localhost:5173/src/pages/add_data.php');
                } else {
                    echo 'Ошибка добавления данных заказа: '. $db->error;
                }
            }
        } else {
            echo 'Пожалуйста, заполните все поля формы для заказа.';
        }

// добавление новой доставки    

    // Добавление новой доставки
    if (isset($_POST['id_orders']) && isset($_POST['id_couriers']) && isset($_POST['delivery_date']) && isset($_POST['d_status'])) {

        // Даем значение для данных
        $id_orders = $db->real_escape_string($_POST['id_orders']);
        $id_couriers = $db->real_escape_string($_POST['id_couriers']);
        $delivery_date = $db->real_escape_string($_POST['delivery_date']);
        $d_status = $db->real_escape_string($_POST['d_status']);

        // Проверка на заполнение всех полей
        if (!empty($id_orders) &&!empty($id_couriers) &&!empty($delivery_date) &&!empty($d_status)) {

            // Проверка на существующую доставку с таким id_orders
            $check_sql_id_orders = "SELECT * FROM deliveries WHERE id_orders='$id_orders'";
            $check_result_id_orders = $db->query($check_sql_id_orders);

            if ($check_result_id_orders->num_rows > 0) {
                echo 'Доставка с таким id_orders уже существует';
            } else {
                $insert_sql = "INSERT INTO deliveries (id_orders, id_couriers, delivery_date, status) VALUES (?,?,?,?)";
                $stmt = $db->prepare($insert_sql);
                $stmt->bind_param("iiss", $id_orders, $id_couriers, $delivery_date, $d_status);

                if ($stmt->execute()) {
                    echo 'Данные доставки успешно добавлены';
                    header('location:http://localhost:5173/src/pages/add_data.php');
                } else {
                    echo 'Ошибка добавления данных доставки: '. $db->error;
                }
            }
        } else {
            echo 'Пожалуйста, заполните все поля формы для доставки.';
        }
    }	
		if (isset($_POST['add_delivery'])) {
  $id_orders = $_POST['add_id_orders'];
  $id_couriers = $_POST['add_id_couriers'];
  $delivery_date = $_POST['add_delivery_date'];
  $d_status = $_POST['add_d_status'];

  // Validate input
  if (!is_numeric($id_orders) || $id_orders < 1) {
    echo "<script>alert('Invalid order ID');history.go(-1);</script>";
    exit;
  }
  if (!is_numeric($id_couriers) || $id_couriers < 1) {
    echo "<script>alert('Invalid courier ID');history.go(-1);</script>";
    exit;
  }
  if (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $delivery_date)) {
    echo "<script>alert('Invalid date format');history.go(-1);</script>";
    exit;
  }
  if (empty($d_status) || strlen($d_status) > 50) {
    echo "<script>alert('Invalid status');history.go(-1);</script>";
    exit;
  }

  // Prepare insert query
  $insertQuery = "INSERT INTO deliveries (id_orders, id_couriers, delivery_date, d_status) VALUES (?,?,?,?)";
  $stmt = mysqli_prepare($db, $insertQuery);
  if ($stmt) {
    mysqli_stmt_bind_param($stmt, 'iiss', $id_orders, $id_couriers, $delivery_date, $d_status);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_affected_rows($stmt);
    if ($result > 0) {
      echo "<script>alert('Доставка добавлена успешно');history.go(-1);</script>";
    } else {
      echo "<script>alert('Ошибка добавления доставки');history.go(-1);</script>";
    }
  } else {
    echo "<script>alert('Ошибка подготовки запроса');history.go(-1);</script>";
  }
}
	}
// Закрываем подключение к базе данных
$db->close();
?>



<!DOCTYPE html>
<html>
<head>
	<link rel='stylesheet' href='../scss/style.css'>
    <title>Добавить данные</title>
</head>
<body>
<div class="add-forms">
	<div class="add-forms-part">
		<h2 class='form-add-title'>Добавить пользователя</h2>
		<form class='form-add' action="add_data.php" method="post" enctype="multipart/form-data">
    	<label for="name">Имя:</label><br>
    	<input class='form-add-input' type="text" id="name" name="name" required><br>
    	<label for="surname">Фамилия:</label><br>
    	<input class='form-add-input' type="text" id="surname" name="surname" required><br>
			<label for="patronymic">Отчество</label><br>
    	<input class='form-add-input' type="text" id="patronymic" name="patronymic" required><br>
    	<label for="email">Почта:</label><br>
    	<input class='form-add-input' type="text" id="email" name="email" required><br>
			<!--  -->
			<label for="phone">Номер телефона:</label><br>
    	<input class='form-add-input' type="phone" id="phone" name="phone" required><br>		
			<!--  -->
			<label for="bDate">Адрес:</label><br>
    	<input class='form-add-input' type="text" id="bDate" name="bDate" required><br>
			<!--  -->
			<label for="address">Дата рождения:</label><br>
    	<input class='form-add-input' type="date" id="address" name="address" required><br>
			<!--  -->
			<label for="gender">Пол:</label><br>
			<select class="form__input" id="gender" name="gender">
				<option value="M">Мужской</option>
				<option value="F">Женский</option>
			</select><br>
			<!--  -->
    	<label for="password">Пароль:</label><br>
    	<input class='form-add-input' type="text" id="password" name="password" required><br>
    	<label for="role">Роль:</label><br>
    	<input class='form-add-input' type="number" id="role" name="role" required><br>
    	<input class='button' type="submit" value="Добавить">
		</form>
	</div>
<!--  -->
	<div class="add-forms-part">
		<h2 class='form-add-title'>Добавить курьера</h2>
		<form class='form-add' action="add_data.php" method="post" enctype="multipart/form-data">

    <label for="name">Имя курьера:</label><br>
    <input class='form-add-input' type="text" id="name" name="name" required><br>

    <label for="surname">Фамилия курьера:</label><br>
    <input class='form-add-input' type="text" id="surname" name="surname" required><br>

    <label for="patronymic">Отчество курьера:</label><br>
    <input class='form-add-input' type="text" id="patronymic" name="patronymic" required><br>

    <label for="phone">Телефон:</label><br>
    <input class='form-add-input' type="phone" id="phone" name="phone" required><br>

		<label for="rating">Рейтинг курьера:</label><br>
    <input class='form-add-input' type="number" id="rating" name="rating" required><br>

		<label for="reviews">Количество отзывов: </label><br>
    <input class='form-add-input' type="number" id="reviews" name="reviews" required><br>

    <input class='button' type="submit" value="Добавить курьера">
		</form>
	</div>
<!--  -->
	<div class="add-forms-part">
		<h2 class='form-add-title'>Добавить заказ</h2>
		<form class='form-add' action="add_data.php" method="post" enctype="multipart/form-data">

			<label for="id_users">id_users: </label><br>
    	<input class='form-add-input' type="text" id="id_users" name="id_users" required><br>

			<label for="order_date">Дата заказа: </label><br>
    	<input class='form-add-input' type="date" id="order_date" name="order_date" required><br>

			<label for="status">Статус заказа:  </label><br>
    	<input class='form-add-input' type="text" id="status" name="status" required><br>

			<label for="total_cost">Стоимость заказа</label><br>
    	<input class='form-add-input' type="text" id="total_cost" name="total_cost" required><br>

    	<input class='button' type="submit" value="Добавить заказ">
		</form>
	</div>
<!--  -->
	<div class="add-forms-part">
		<h2	h2 class='form-add-title'>Добавить доставку</h2>
		<form class='form-add' action="add_data.php" method="post" enctype="multipart/form-data">

    	<label for="id_orders">id заказа:</label><br>
    	<input class='form-add-input' type="text" id="id_orders" name="id_orders" required><br>

			<label for="id_couriers">id курьера:</label><br>
    	<input class='form-add-input' type="text" id="id_couriers" name="id_couriers" required><br>

			<label for="delivery_date">Дата доставки:</label><br>
    	<input class='form-add-input' type="date" id="delivery_date" name="delivery_date" required><br>

			<label for="d_status">Статус заказа:</label><br>
    	<input class='form-add-input' type="text" id="d_status" name="d_status" required><br>

    	<input class='button' type="submit" value="Добавить">
		</form>
	</div>
</div>
</body>
</html>