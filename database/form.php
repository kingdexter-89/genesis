<!DOCTYPE html>
<html lang="en">
<head>
          <meta charset="UTF-8">
          <meta name="viewport" content="width=device-width, initial-scale=1.0">
          <title>Document</title>
</head>
<body>
        <form action="process.php" method="post">
                    <label for="fname">First name:</label>
                    <input type="text" name="fname" required><br>

                    <label for="lname">Last name:</label>
                    <input type="text" name="lname" required><br>

                    <label for="email">Email:</label>
                    <input type="email" name="email" required><br>

                    <input type="submit" name="submit" value="Submit">
        </form>

        <h3>Registered Users:</h3>
        <table border="1">
            <thead>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>Action</th>
            </thead>
            <tbody>
                <?php
                    foreach($students as $student){?>
                    <tr>
                        <td><?php echo $student['fname']; ?></td>
                        <td><?php echo $student['lname']; ?></td>
                        <td><?php echo $student['email']; ?></td>
                        <td>
                            <button>view</button>
                            <button>edit</button>
                            <button>delete</button>
                        </td>
                    </tr>
                <?php } ?>        
            </tbody>
        </table>
</body>
</html>