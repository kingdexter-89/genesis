<?php

$host = "localhost";
$user = "root";
$password ="";
$database = "hospital";

$conn = mysqli_connect($host, $user, $password, $database);

if (!$conn){
          die("Database connection failed: " .
          mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
          $name = $_POST['name'] ?? "";
          $email = $_POST['email'] ?? "";
          $phone = $_POST['phone'] ?? "";
          $service = trim($_POST['service'] ?? "");
          $attendant = trim($_POST['attendant'] ?? "");
          $ward = trim($_POST['ward'] ?? "");
          $time = $_POST['time'] ?? "";

          $sql = "INSERT INTO clients
          (name, email, phone, service, attendant, ward, time)
          VALUES (?, ?, ?, ?, ?, ?, ?)";

          $stmt = mysqli_prepare($conn, $sql);

          if (!$stmt) {
                    die("SQL preparation failed " . mysqli_error($conn));
          }

          mysqli_stmt_bind_param(
                    $stmt,
                    "sssssss",
                    $name, 
                    $email,
                    $phone,
                    $service,
                    $attendant,
                    $ward,
                    $time 
          );

          if (mysqli_stmt_execute($stmt)){
                    mysqli_stmt_close($stmt);
                    mysqli_close($conn);

                    header("Location: index2.html");
                    exit;
          }
else{echo "Error saving client: " .mysqli_stmt_error($stmt);}

mysqli_stmt_close($stmt);
}

mysqli_close($conn);
?>