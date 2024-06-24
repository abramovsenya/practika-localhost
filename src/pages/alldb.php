<?php
// Подключение к базе данных
$db = mysqli_connect('localhost', 'root', 'root', 'bistrie_nogi');

if (!$db) {
  die("Ошибка подключения к базе данных: " . mysqli_connect_error());
}

// Query couriers table
$couriersView = "SELECT * FROM couriers";
$couriersView_result = mysqli_query($db, $couriersView);

// Query deliveries table
$deliveriesView = "SELECT * FROM deliveries";
$deliveriesView_result = mysqli_query($db, $deliveriesView);

// Query orders table
$ordersView = "SELECT * FROM orders";
$ordersView_result = mysqli_query($db, $ordersView);

// Query users table
$usersView = "SELECT * FROM users";
$usersView_result = mysqli_query($db, $usersView);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="/src/scss/style.css" />
  <title>База данных</title>
</head>
<body>
  <div class="container">
    <h2 class="admin_title">Курьеры</h2>
    <div class="responsive-table">
      <table>
        <tr>
          <th class="popup__block-text">ID</th>
          <th class="popup__block-text">Имя</th>
          <th class="popup__block-text">Фамилия</th>
          <th class="popup__block-text">Отчество</th>
          <th class="popup__block-text">Телефон</th>
          <th class="popup__block-text">Рейтинг</th>
          <th class="popup__block-text">Отзывы</th>
        </tr>
        <?php while ($row = mysqli_fetch_assoc($couriersView_result)) { ?>
          <tr>
            <td class="popup__block-text"><?= $row['id_couriers'] ?></td>
            <td class="popup__block-text"><?= $row['name'] ?></td>
            <td class="popup__block-text"><?= $row['surname'] ?></td>
            <td class="popup__block-text"><?= $row['patronymic'] ?></td>
            <td class="popup__block-text"><?= $row['phone'] ?></td>
            <td class="popup__block-text"><?= $row['rating'] ?></td>
            <td class="popup__block-text"><?= $row['reviews'] ?></td>
          </tr>
        <?php } ?>
      </table>
    </div>

    <h2 class="admin_title">Доставки</h2>
    <div class="responsive-table">
      <table>
        <tr>
          <th class="popup__block-text">ID</th>
          <th class="popup__block-text">ID заказа</th>
          <th class="popup__block-text">ID курьера</th>
          <th class="popup__block-text">Дата доставки</th>
          <th class="popup__block-text">Статус</th>
        </tr>
        <?php while ($row = mysqli_fetch_assoc($deliveriesView_result)) { ?>
          <tr>
            <td class="popup__block-text"><?= $row['id_deliveries'] ?></td>
            <td class="popup__block-text"><?= $row['id_orders'] ?></td>
            <td class="popup__block-text"><?= $row['id_couriers'] ?></td>
            <td class="popup__block-text"><?= $row['delivery_date'] ?></td>
            <td class="popup__block-text"><?= $row['status'] ?></td>
          </tr>
        <?php } ?>
      </table>
    </div>

    <h2 class="admin_title">Заказы</h2>
    <div class="responsive-table">
      <table>
        <tr>
          <th class="popup__block-text">ID</th>
          <th class="popup__block-text">ID пользователя</th>
          <th class="popup__block-text">Дата заказа</th>
          <th class="popup__block-text">Статус</th>
          <th class="popup__block-text">Стоимость</th>
        </tr>
        <?php while ($row = mysqli_fetch_assoc($ordersView_result)) { ?>
          <tr>
            <td class="popup__block-text"><?= $row['id_orders'] ?></td>
            <td class="popup__block-text"><?= $row['id_users'] ?></td>
            <td class="popup__block-text"><?= $row['order_date'] ?></td>
            <td class="popup__block-text"><?= $row['status'] ?></td>
            <td class="popup__block-text"><?= $row['total_cost'] ?></td>
          </tr>
        <?php } ?>
      </table>
    </div>

    <h2 class="admin_title">Пользователи</h2>
    <div class="responsive-table">
      <table>
        <tr>
          <th class="popup__block-text">ID</th>
          <th class="popup__block-text">Имя</th>
          <th class="popup__block-text">Фамилия</th>
          <th class="popup__block-text">Отчество</th>
          <th class="popup__block-text">Email</th>
          <th class="popup__block-text">Телефон</th>
          <th class="popup__block-text">Адрес</th>
          <th class="popup__block-text">Дата рождения</th>
          <th class="popup__block-text">Пол</th>
          <th class="popup__block-text">Пароль</th>
          <th class="popup__block-text">Роль</th>
        </tr>
        <?php while ($row = mysqli_fetch_assoc($usersView_result)) { ?>
          <tr>
            <td class="popup__block-text"><?= $row['id_users'] ?></td>
            <td class="popup__block-text"><?= $row['name'] ?></td>
            <td class="popup__block-text"><?= $row['surname'] ?></td>
            <td class="popup__block-text"><?= $row['patronymic'] ?></td>
            <td class="popup__block-text"><?= $row['email'] ?></td>
            <td class="popup__block-text"><?= $row['phone'] ?></td>
            <td class="popup__block-text"><?= $row['address'] ?></td>
            <td class="popup__block-text"><?= $row['bDate'] ?></td>
            <td class="popup__block-text"><?= $row['gender'] ?></td>
            <td class="popup__block-text"><?= $row['password'] ?></td>
            <td class="popup__block-text"><?= $row['role'] ?></td>
          </tr>
        <?php } ?>
      </table>
    </div>

    <button class="exit view_exit" onclick="history.back()">Вернуться назад</button>
  </div>

</body>
</html>
