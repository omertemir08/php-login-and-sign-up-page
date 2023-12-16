<?php

$host = "sql300.infinityfree.com";
$dbname = "if0_35623713_login_db";
$username = "if0_35623713";
$password = "ALznSvzCgGkuQjO";
$conn = new mysqli($host, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $email = $_POST['email'] ?? '';
    $password2 = $_POST['password2'] ?? '';


    $stmt = $conn->prepare("SELECT * FROM user WHERE email = ? AND password2 = ?");
    $stmt->bind_param("ss", $email, $password2);

   
    $stmt->execute();

   
    $result = $stmt->get_result();

  
    if ($result->num_rows > 0) {
        header("Location: signup-success.html");
        // giriş onayanıyor yönlenirme yapın
    } else {
        echo "Login failed. Invalid email or password.";
    }

    $stmt->close();
}

$conn->close();

?>

<!DOCTYPE html>
<html>
<head>
    <title>Giriş</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
</head>
<body>
    
    <h1>Giriş</h1>
    
    <form method="post" action="">
        <label for="email">Email</label>
        <input name="email" id="email" value="<?= htmlspecialchars($_POST["email"] ?? "") ?>">
        
        <label for="password">Şifre</label>
        <input type="password" name="password2" id="password2">
        
        <button>Giriş</button>
    </form>
    
</body>
</html>
