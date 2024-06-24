<?php
session_start();
$log = 0;

// $is_authenticated = false;


if ($_POST) {
  $email = $_POST['loginEmail'];
  $password = $_POST['loginPassword'];
  $recaptcha_response = $_POST['g-recaptcha-response'];

  // Verify reCAPTCHA response
  $secret_key = '6LfOU_opAAAAAC__w4VZWvf_QbPO4eOzfhqO3bwt';
  $verify_response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret={$secret_key}&response={$recaptcha_response}&remoteip={$_SERVER['REMOTE_ADDR']}");

  $response_data = json_decode($verify_response, true);

  if ($response_data['success']) {
    // reCAPTCHA verification successful, proceed with email
    $db = mysqli_connect('localhost', 'root', 'root', 'bistrie_nogi');

    $query = "SELECT id_users,  email, password, role, name FROM users WHERE email = '$email' AND password = '$password'";
    $result = mysqli_query($db, $query);

    if (mysqli_num_rows($result) > 0) {
      $user = mysqli_fetch_assoc($result);
      $_SESSION['loginEmail'] = $email;
      $_SESSION['loginPassword'] = $password;
      $_SESSION['name'] = $user['name'];
      $_SESSION['id_users'] = $user['id_users'];
      $_SESSION['role'] = $user['role']; // Add this line to store the user's role
      $log = 1;
			$_SESSION['auth'] = isset($_SESSION['loginEmail']) && isset($_SESSION['loginPassword']);
      header ('Location: http://localhost:5173/src/pages/profile.php');
    } else {
      echo "<script>alert('Что-то не то. Давай попробуем еще')</script>";
    }
}
if ($log == 1) {
  exit;
}

}
?>