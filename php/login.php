<!DOCTYPE html>
<html>
    <head>
        <title>Login - Student Attendance Data System</title>
    </head>
    <body>
        <?php
            include('db/conection.php');
            $id = $_POST["id"];
            $password = $_POST["password"];
            // Prepare and execute the SQL query
            $stmt = $conn->prepare("SELECT * FROM acc WHERE UserId=? AND UserPass=?");
            $stmt->bind_param("ss", $id, $password);
            $stmt->execute();
            $result = $stmt->get_result();

            // Check if a record was found
            if ($result->num_rows == 1) {
                $row = $result->fetch_assoc();
                $userCat = $row["UserCat"];
                echo "<form id='redirectForm' action='dashboard.php' method='post'>
                        <input type='hidden' name='id' value='$id'>
                        <input type='hidden' name='userCat' value='$userCat'>
                      </form>";
                // Automatically submit the form
                echo "<script type='text/javascript'>
                document.getElementById('redirectForm').submit();
                </script>";
            } else {
                echo "Invalid login credentials. Redirecting you to the Login page...";
                echo "<meta http-equiv='refresh' content='3;url=index.php'>";
            }

            // Close statement and connection
            $stmt->close();
            $conn->close();
        ?>
    </body>
</html>