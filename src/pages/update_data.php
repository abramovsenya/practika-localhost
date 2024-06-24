<?php

session_start();
$db = mysqli_connect('localhost', 'root', 'root', 'bistrie_nogi');

if (!$db) {
    die("Ошибка подключения к базе данных: ". mysqli_connect_error());
}

if (isset($_POST['updateBtn'])) {
    $id = $_POST['id']; // ID of the user to update
    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $patronymic = $_POST['patronymic'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $bDate = $_POST['bDate'];
    $gender = $_POST['gender'];
    $password = $_POST['password'];
    $role = $_POST['role'];

    $updateQuery = "UPDATE users SET ";
    $updateValues = array();

    if (!empty($name)) {
        $updateValues[] = "name = '$name'";
    }
    if (!empty($surname)) {
        $updateValues[] = "surname = '$surname'";
    }
    if (!empty($patronymic)) {
        $updateValues[] = "patronymic = '$patronymic'";
    }
    if (!empty($email)) {
        $updateValues[] = "email = '$email'";
    }
    if (!empty($phone)) {
        $updateValues[] = "phone = '$phone'";
    }
    if (!empty($address)) {
        $updateValues[] = "address = '$address'";
    }
    if (!empty($bDate)) {
        $updateValues[] = "bDate = '$bDate'";
    }
    if (!empty($gender)) {
        $updateValues[] = "gender = '$gender'";
    }
    if (!empty($password)) {
        $updateValues[] = "password = '$password'";
    }
    if (!empty($role)) {
        $updateValues[] = "role = '$role'";
    }

    if (!empty($updateValues)) {
        $updateQuery.= implode(', ', $updateValues);
        $updateQuery.= " WHERE id_users = '$id'";

        $result = mysqli_query($db, $updateQuery);
        if ($result) {
            echo "<script>alert('Данные успешно изменены');history.go(-1);</script>";
        } else {
            echo "<script>alert('Ошибка изменения данных');history.go(-1);</script>";
        }
    } else {
        echo "<script>alert('Нет данных для изменения');history.go(-1);</script>";
    }

  }

    // обновление курьера
    if (isset($_POST['couriers_updateBtn'])) {
    $id_couriers = $_POST['id_couriers']; // ID of the courier to update
    $couriers_name = $_POST['couriers_name'];
    $couriers_surname = $_POST['couriers_surname'];
    $couriers_patronymic = $_POST['couriers_patronymic'];
    $couriers_phone = $_POST['couriers_phone'];
    $couriers_rating = $_POST['couriers_rating'];
    $couriers_reviews = $_POST['couriers_reviews'];

    $updateQuery = "UPDATE couriers SET ";
    $updateValues = array();

    if (!empty($couriers_name)) {
        $updateValues[] = "name = '$couriers_name'";
    }
    if (!empty($couriers_surname)) {
        $updateValues[] = "surname = '$couriers_surname'";
    }
    if (!empty($couriers_patronymic)) {
        $updateValues[] = "patronymic = '$couriers_patronymic'";
    }
    if (!empty($couriers_phone)) {
        $updateValues[] = "phone = '$couriers_phone'";
    }
    if (!empty($couriers_rating)) {
        $updateValues[] = "rating = '$couriers_rating'";
    }
    if (!empty($couriers_reviews)) {
        $updateValues[] = "reviews = '$couriers_reviews'";
    }

    if (!empty($updateValues)) {
        $updateQuery.= implode(', ', $updateValues);
        $updateQuery.= " WHERE id_couriers = '$id_couriers'";

        $result = mysqli_query($db, $updateQuery);
        if ($result) {
            echo "<script>alert('Данные успешно изменены');history.go(-1);</script>";
        } else {
            echo "<script>alert('Ошибка изменения данных');history.go(-1);</script>";
        }
    } else {
        echo "<script>alert('Нет данных для изменения');history.go(-1);</script>";
    }
  }

  // обновление заказа
if (isset($_POST['orders_updateBtnL'])) {
  $id_orders = $_POST['update_id_orders']; // ID of the order to update
  $id_users = $_POST['update_id_users'];
  $order_date = $_POST['update_order_date'];
  $status = $_POST['update_status'];
  $total_cost = $_POST['update_total_cost'];
  $updateQuery = "UPDATE orders SET ";
  $updateValues = array();
  // Validate input
    if (!empty($id_orders)) {
        $updateValues[] = "id_orders = '$id_orders'";
    }
    if (!empty($id_users)) {
        $updateValues[] = "id_users = '$id_users'";
    }
    if (!empty($order_date)) {
        $updateValues[] = "order_date = '$order_date'";
    }
    if (!empty($status)) {
        $updateValues[] = "status = '$status'";
    }
    if (!empty($total_cost)) {
        $updateValues[] = "total_cost = '$total_cost'";
    }

  // Prepare update query
  if (!empty($updateValues)) {
        $updateQuery.= implode(', ', $updateValues);
        $updateQuery.= " WHERE id_orders = '$id_orders'";

        $result = mysqli_query($db, $updateQuery);
        if ($result) {
            echo "<script>alert('Данные успешно изменены');history.go(-1);</script>";
        } else {
            echo "<script>alert('Ошибка изменения данных');history.go(-1);</script>";
        }
    } else {
        echo "<script>alert('Нет данных для изменения');history.go(-1);</script>";
    }
}

// обновление доставки
if (isset($_POST['deliver_updateBtnL'])) {
  $update_id_deliveries = $_POST['update_id_deliveries'];
  $update_id_orders = $_POST['update_id_orders'];
  $update_id_couriers = $_POST['update_id_couriers'];
  $update_delivery_date = $_POST['update_delivery_date'];
  $update_delivery_status = $_POST['update_delivery_status'];

  // Validate input
  $updateValues = array();
  if (!empty($update_id_deliveries)) {
    $updateValues[] = "id_deliveries = '$update_id_deliveries'";
  }
  if (!empty($update_id_orders)) {
    $updateValues[] = "id_orders = '$update_id_orders'";
  }
  if (!empty($update_id_couriers)) {
    $updateValues[] = "id_couriers = '$update_id_couriers'";
  }
  if (!empty($update_delivery_date)) {
    $updateValues[] = "delivery_date = '$update_delivery_date'";
  }
  if (!empty($update_delivery_status)) {
    $updateValues[] = "status = '$update_delivery_status'";
  }

  // Prepare update query
  if (!empty($updateValues)) {
    $updateQuery = "UPDATE deliveries SET ";
    $updateQuery .= implode(', ', $updateValues);
    $updateQuery .= " WHERE id_deliveries = '$update_id_deliveries'";

    $result = mysqli_query($db, $updateQuery);
    if ($result) {
      echo "<script>alert('Данные успешно изменены');history.go(-1);</script>";
    } else {
      echo "<script>alert('Ошибка изменения данных');history.go(-1);</script>";
    }
  } else {
    echo "<script>alert('Нет данных для изменения');history.go(-1);</script>";
  }
}


?>
<!DOCTYPE html>
<html>
<head>
	<link rel='stylesheet' href='../scss/style.css'>
    <title>Изменить данные</title>
</head>
<body> 
  <div class="add-forms">
<div class="add-forms-part">
    <h2 class='form-add-title'>Обновить данные пользователя</h2>
    <form class='form-add' action="update_data.php" method="post" enctype="multipart/form-data">
        <label for="id">Id:</label><br>
        <input class='form-add-input' type="text" id="id" name="id" ><br>
        <label for="name">Имя:</label><br>
        <input class='form-add-input' type="text" id="name" name="name" ><br>
        <label for="surname">Фамилия:</label><br>
        <input class='form-add-input' type="text" id="surname" name="surname" ><br>
        <label for="patronymic">Отчество</label><br>
        <input class='form-add-input' type="text" id="patronymic" name="patronymic" ><br>
        <label for="email">Почта:</label><br>
        <input class='form-add-input' type="text" id="email" name="email" ><br>
        <!--  -->
        <label for="phone">Номер телефона:</label><br>
        <input class='form-add-input' type="phone" id="phone" name="phone" ><br>        
        <!--  -->
        <label for="bDate">Адрес:</label><br>
        <input class='form-add-input' type="text" id="bDate" name="bDate" ><br>
        <!--  -->
        <label for="address">Дата рождения:</label><br>
        <input class='form-add-input' type="date" id="address" name="address" ><br>
        <!--  -->
        <label for="gender">Пол:</label><br>
        <select class="form__input" id="gender" name="gender">
            <option value="M">Мужской</option>
            <option value="F">Женский</option>
        </select><br>
        <!--  -->
        <label for="password">Пароль:</label><br>
        <input class='form-add-input' type="text" id="password" name="password" ><br>
        <label for="role">Роль:</label><br>
        <input class='form-add-input' type="number" id="role" name="role" ><br>
        <input class='button' type="submit" name="updateBtn" value="Обновить">
    </form>
</div>
<div class="add-forms-part">
    <h2 class='form-add-title'>Обновить курьера</h2>
    <form class='form-add' action="update_data.php" method="post" enctype="multipart/form-data">
        <label for="id_couriers">Id:</label><br>
        <input class='form-add-input' type="text" id="id_couriers" name="id_couriers" ><br>

        <label for="couriers_name">Имя курьера:</label><br>
        <input class='form-add-input' type="text" id="couriers_name" name="couriers_name"><br>

        <label for="couriers_surname">Фамилия курьера:</label><br>
        <input class='form-add-input' type="text" id="couriers_surname" name="couriers_surname"><br>

        <label for="couriers_patronymic">Отчество курьера:</label><br>
        <input class='form-add-input' type="text" id="couriers_patronymic" name="couriers_patronymic"><br>

        <label for="couriers_phone">Телефон:</label><br>
        <input class='form-add-input' type="phone" id="couriers_phone" name="couriers_phone"><br>

        <label for="couriers_rating">Рейтинг курьера:</label><br>
        <input class='form-add-input' type="number" id="couriers_rating" name="couriers_rating"><br>

        <label for="couriers_reviews">Количество отзывов: </label><br>
        <input class='form-add-input' type="number" id="couriers_reviews" name="couriers_reviews"><br>

        <input class='button' type="submit" name="couriers_updateBtn" value="Обновить курьера">
    </form>
</div>
  <div class="add-forms-part">
  <h2 class='form-add-title'>Обновить заказ</h2>
  <form class='form-add' action="update_data.php" method="post" enctype="multipart/form-data">
    <label for="update_id_orders">Id заказа:</label><br>
    <input class='form-add-input' type="text" id="update_id_orders" name="update_id_orders"><br>

    <label for="update_id_users">id_users: </label><br>
    <input class='form-add-input' type="text" id="update_id_users" name="update_id_users"><br>

    <label for="update_order_date">Дата заказа:</label><br>
    <input class='form-add-input' type="date" id="update_order_date" name="update_order_date"><br>

    <label for="update_status">Статус заказа:  </label><br>
    <input class='form-add-input' type="text" id="update_status" name="update_status"><br>

    <label for="update_total_cost">Стоимость заказа</label><br>
    <input class='form-add-input' type="text" id="update_total_cost" name="update_total_cost"><br>

    <input class='button' type="submit" name="orders_updateBtnL" value="Обновить заказ">
  </form>
</div>
<div class="add-forms-part">
  <h2 class='form-add-title'>Изменить доставку</h2>
  <form class='form-add' action="update_data.php" method="post" enctype="multipart/form-data">
    <label for="update_id_deliveries ">id Доставки:</label><br>
    <input class='form-add-input' type="text" id="update_id_deliveries" name="update_id_deliveries"><br>

    <label for="update_id_orders">id заказа:</label><br>
    <input class='form-add-input' type="text" id="update_id_orders" name="update_id_orders"><br>

    <label for="update_id_couriers">id курьера:</label><br>
    <input class='form-add-input' type="text" id="update_id_couriers" name="update_id_couriers"><br>

    <label for="update_delivery_date">Дата доставки:</label><br>
    <input class='form-add-input' type="date" id="update_delivery_date" name="update_delivery_date"><br>

    <label for="update_delivery_status">Статус заказа:</label><br>
    <input class='form-add-input' type="text" id="update_delivery_status" name="update_delivery_status"><br>

    <input class='button'name="deliver_updateBtnL" type="submit" value="Добавить">
  </form>
</div>
  </div>
</body>
</html>