<?php
    // Check if the request method is POST
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        echo "Invalid request method. Please use POST.";
        echo "<meta http-equiv='refresh' content='0;url=index.php'>";
        exit;
    }
    
    // Include the database connection file
    include('db/conection.php');

    $userCat = $_POST['userCat'];
    $id = $_POST['id'];

    $userName = "";

    if ($userCat === 'admin') {
        $query = "SELECT UserName FROM admn WHERE UserId = ?";
    } elseif ($userCat === 'student') {
        $query = "SELECT NamaPelajar FROM student WHERE IdPelajar = ?";
    } elseif ($userCat === 'staff') {
        $query = "SELECT UserName FROM staff WHERE UserId = ?";
    } else {
        echo "Invalid user category.";
        exit;
    }

    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if ($userCat === 'student') {
            $userName = $row['NamaPelajar'];
        }
        else{
            $userName = $row['UserName'];
        }
    } else {
        echo "No user found with the given ID.";
    }

    $stmt->close();
    $conn->close();

?>
<!DOCTYPE html>
<html>
    <head>
        <title>MADRASAH AN-NUR - DASHBOARD</title>
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                var userCat = "<?php echo $userCat; ?>"; // Pass PHP variable to JavaScript
                var body = document.body;
                if (userCat === 'admin') {
                    body.classList.add('admin-background');
                } else if (userCat === 'staff') {
                    body.classList.add('staff-background');
                } else {
                    body.classList.add('default-background');
                }
            });
        </script>
        <link rel="stylesheet" type="text/css" href="css/styles1.css">
        <link rel="icon" href="../src/logo.png">
        <style>
            .welcome-text {
                margin-left: 20px; 
                font-family: comic sans ms;
            }
            
        </style>
    </head>
    <body>
        <div class="navbar">
            <img src="../src/logo.png">
            <a href="../php" class="rightnav">Logout</a>
        </div>
        <br>
        <div class="welcome-text">
        Selamat Datang : <?php echo $userName;?> ( <?php echo $userCat?> )
        </div>
        <br><br>
        <?php
            if($userCat == 'admin')
            {
                include('admindashboard.php');
            }
            elseif ($userCat === 'staff')
            {
                include('staffdashboard.php');
            }
            elseif ($userCat === 'student')
            {
                include('studentdashboard.php');
            }
        ?>
    </body>
</html>