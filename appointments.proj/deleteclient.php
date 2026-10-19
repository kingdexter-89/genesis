<?php
if ($_SERVER["REQUEST_METHOD"] !== "POST"){
          http_response_code(405);
          exit("Method not allowed");}

$id = filter_input(INPUT_POST, "id", FILTER_VALIDATE_INT);
if (!$id)$ {exit("Invalid client ID");}
$conn = new mysqli("localhost", "root","","hospital");
          if ($conn->connect_error) {
                    die("Database connection failed");}
$stmt = $conn->prepare("DELETE FROM Clients WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();

$stmt->close();
$conn->close();

header("Location: advanced.php");
exit;
?>