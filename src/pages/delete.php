<?php

session_start();
$db = mysqli_connect('localhost', 'root', 'root', 'bistrie_nogi');

if ($db == false) {
    echo 'Ошибка подключения';
    exit;
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST['id'])) {
        $id = intval($_POST['id']);

        // Delete a user
        $check_sql_user = "SELECT * FROM users WHERE id_users=$id";
        $check_result_user = $db->query($check_sql_user);

        if ($check_result_user->num_rows > 0) {
            $delete_sql_user = "DELETE FROM users WHERE id_users=$id";
            $delete_result_user = $db->query($delete_sql_user);

            if ($delete_result_user) {
                echo 'Пользователь успешно удален';
                header('location:http://localhost:5173/src/pages/delete.php');
            } else {
                echo 'Ошибка удаления пользователя: ' . $db->error;
            }
        } else {
            echo 'Пользователь не найден';
        }

        // Delete a courier
        $check_sql_courier = "SELECT * FROM couriers WHERE id_couriers=$id";
        $check_result_courier = $db->query($check_sql_courier);

        if ($check_result_courier->num_rows > 0) {
            $delete_sql_courier = "DELETE FROM couriers WHERE id_couriers=$id";
            $delete_result_courier = $db->query($delete_sql_courier);

            if ($delete_result_courier) {
                echo 'Курьер успешно удален';
                header('location:http://localhost:5173/src/pages/delete.php');
            } else {
                echo 'Ошибка удаления курьера: ' . $db->error;
            }
        } else {
            echo 'Курьер не найден';
        }

        // Delete an order
        $check_sql_order = "SELECT * FROM orders WHERE id_orders=$id";
        $check_result_order = $db->query($check_sql_order);

        if ($check_result_order->num_rows > 0) {
            $delete_sql_order = "DELETE FROM orders WHERE id_orders=$id";
            $delete_result_order = $db->query($delete_sql_order);

            if ($delete_result_order) {
                echo 'Заказ успешно удален';
                header('location:http://localhost:5173/src/pages/delete.php');
            } else {
                echo 'Ошибка удаления заказа: ' . $db->error;
            }
        } else {
            echo 'Заказ не найден';
        }

        // Delete a delivery
        $check_sql_delivery = "SELECT * FROM deliveries WHERE id_deliveries=$id";
        $check_result_delivery = $db->query($check_sql_delivery);

        if ($check_result_delivery->num_rows > 0) {
            $delete_sql_delivery = "DELETE FROM deliveries WHERE id_deliveries=$id";
            $delete_result_delivery = $db->query($delete_sql_delivery);

            if ($delete_result_delivery) {
                echo 'Доставка успешно удалена';
                header('location:http://localhost:5173/src/pages/delete.php');
            } else {
                echo 'Ошибка удаления доставки: ' . $db->error;
            }
        } else {
            echo 'Доставка не найдена';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/src/scss/style.css">
    <title>Удаление</title>
</head>
<body>
    <div class="add-forms-part">
        <h2 class='form-add-title'>Удалить пользователя</h2>
        <form class='form-add' action="delete.php" method="post">
            <label for="id">ID пользователя:</label><br>
            <input class='form-add-input' type="text" id="id" name="id" required><br>
            <input class='button' type="submit" value="Удалить">
        </form>
    </div>
    <div class="add-forms-part">
        <h2 class='form-add-title'>Удалить курьера</h2>
        <form class='form-add' action="delete.php" method="post">
            <label for="id">ID курьера:</label><br>
            <input class='form-add-input' type="text" id="id" name="id" required><br>
            <input class='button' type="submit" value="Удалить курьера">
        </form>
    </div>
    <div class="add-forms-part">
        <h2 class='form-add-title'>Удалить заказ</h2>
        <form class='form-add' action="delete.php" method="post">
            <label for="id">ID заказа:</label><br>
            <input class='form-add-input' type="text" id="id" name="id" required><br>
            <input class='button' type="submit" value="Удалить заказ">
        </form>
    </div>
    <div class="add-forms-part">
        <h2 class='form-add-title'>Удалить доставку</h2>
        <form class='form-add' action="delete.php" method="post">
            <label for="id">ID доставки:</label><br>
            <input class='form-add-input' type="text" id="id" name="id" required><br>
            <input class='button' type="submit" value="Удалить доставку">
        </form>
    </div>
</body>
</html>
