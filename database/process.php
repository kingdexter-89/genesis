<?php

$host = "localhost";
$user = "root";
$password ="";
$database = "website";

$conn = mysqli_connect($host, $user, $password, $database);

if (!$conn){
        die(mysqli_connect_error());
}

?>

<?php

if (isset($_POST['submit'])) {
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];

    $form_data ="INSERT INTO student(fname,lname,email) VALUES ('$fname','$lname','$email')";
    
    mysqli_query($conn, $form_data);
    
    header("location: form.php");
}

$datas = "SELECT * FROM student";
$students = mysqli_query($conn, $datas);
?>