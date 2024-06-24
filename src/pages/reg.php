<?php
session_start();
$db = mysqli_connect('localhost','root', 'root', 'bistrie_nogi' );



if ($_SERVER['REQUEST_METHOD'] == 'POST') {
$name = $_POST['name'];
$surname = $_POST['surname'];
$patronymic = $_POST['patronymic'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$address = $_POST['address'];
$bDate = $_POST['bDate'];
$gender = $_POST['gender'];
$password = $_POST['password'];
$passwordConfirm = $_POST['passwordConfirm'];

$_SESSION ['name'] = $name;

if ($db == false){
    echo 'Ошибка подключения';
    exit;
}

$UserMail = mysqli_query ($db, "SELECT email from users where email = '$email' ");

if (empty($name) || empty($surname) || empty($patronymic) || empty($email) || empty($phone) || empty($address) || empty($bDate) || empty($gender) || empty($password) || empty($passwordConfirm)) {
    echo 'Заполните все поля';
    exit;
}
// $phone = preg_replace('/\D/', '', $phone);
// Проверка на правильное заполнение почты
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo 'Неправильный формат электронной почты';
    exit;
}

// Проверка на запрещенные символы в пароле
if (preg_match('/[\'",\*,\[\],\{\}]/', $password)) {
    echo "<p>Недопустимые символы в пароле</p>";
    exit;
}

if (mysqli_num_rows ($UserMail) > 0){ 
    echo "Такая почта уже занята";
    exit; 
} 


if ($password == $passwordConfirm && strlen ($password) > 6 ){ 

    $sqlInsert = "INSERT INTO users SET name = '$name', surname = '$surname', patronymic = '$patronymic', email = '$email', phone = '$phone', address = '$address', bDate = '$bDate', gender = '$gender', password = '$password', role ='0' "; 

    $result = mysqli_query($db, $sqlInsert);
    header ('Location:http://localhost:5173/src/pages/profile.php');
}
else{
    echo "Пароль меньше 6 символов или не совпадают.";
}
}

else{ 
    echo 'Не правильно заполнены поля'; 
    exit; 
} 
?>