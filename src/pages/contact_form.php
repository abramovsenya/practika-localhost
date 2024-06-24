<?php
// Подключение к базе данных
$db = mysqli_connect('localhost','root', 'root', 'bistrie_nogi' );

if (!$db) {
    die("Ошибка подключения к базе данных: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Получение данных из формы
    $contact_name = $_POST['contact_name'];
    $contact_surname = $_POST['contact_surname'];
    $contact_social = $_POST['contact_social'];
    $contact_phone = $_POST['contact_phone'];
    $contact_email = $_POST['contact_email'];

    // Подготовка SQL запроса для добавления данных в таблицу helps
    $sql = "INSERT INTO helps (contact_name, contact_surname, contact_social, contact_phone, contact_email) 
            VALUES ('$contact_name', '$contact_surname', '$contact_social', '$contact_phone', '$contact_email')";

    // Выполнение SQL запроса
    if (mysqli_query($db, $sql)) {
        echo "Данные успешно добавлены в базу данных.";
    } else {
        echo "Ошибка: " . $sql . "<br>" . mysqli_error($db);
    }
		
    // Закрытие соединения с базой данных
    mysqli_close($db);
}
?>
