<?php
    // Include the database connection file
    include('db/conection.php');

    $userCat = $_POST['userCat'];
    $userName = $_POST['userName'];
    $id = $_POST['id'];
?>
<!DOCTYPE html>
<html>
    <head>
        <title>MADRASAH AN-NUR - PROFIL STAFF</title>
        <link rel="stylesheet" type="text/css" href="css/styles2.css">
        <link rel="icon" href="../src/logo.png">
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
        <style>
        /* Styles for the dashboard button table */
        .tblbuttondashbord {
            width: 50%;
            margin: 0 auto;
            border-collapse: collapse;
            text-align: center;
        }

        /* Table cells */
        .tblbuttondashbord td {
            padding: 20px;
            vertical-align: top;
        }

        /* Forms within table cells */
        .tblbuttondashbord form {
            display: inline-block;
            text-align: center;
        }

        /* Buttons within table cells */
        .tblbuttondashbord .buttondashbord {
            background-color: #70D5F5;
            color: white;
            border: none;
            padding: 20px; /* Increased padding for uniform size */
            border-radius: 5px;
            cursor: pointer;
            font-size: 1em;
            transition: background-color 0.3s;
            text-align: center;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            width: 200px; /* Set a fixed width */
            height: 150px; /* Set a fixed height */
        }

        /* Smaller images within the buttons */
        .tblbuttondashbord .buttondashbord img {
            width: 50px; /* Adjust the width to make the image smaller */
            height: 50px; /* Adjust the height to make the image smaller */
            margin-bottom: 10px;
            border-radius: 50%; /* Make images round, adjust if needed */
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        /* Hover effect for buttons */
        .tblbuttondashbord .buttondashbord:hover {
            background-color: #70aabc;
        }
        .welcome-text {
            text-align: center; 
            font-family: comic sans ms;
        }

                /* Navbar container */
                .navbar {
                display: flex;
                align-items: center; /* Vertically center items */
                padding: 10px 20px; /* Adjust padding as needed */
            }

            /* Logo image */
            .logo {
                margin-right: auto; /* Pushes logo to the left and separates it from centered and right items */
            }

            /* Centered image container */
            .centered-image-container {
                flex: 1; /* Take up remaining space to center the image */
                text-align: center; /* Center align the image horizontally */
            }

            .centered-image {
                max-width: 100%; /* Ensure image scales with container */
                height: auto; /* Maintain aspect ratio */
            }

            /* Right navigation */
            .rightnav {
                display: flex;
                align-items: center; /* Vertically center items */
            }

            .navhomebtn {
                /* Style your button here */
                padding: 10px 20px;
                font-size: 16px;
                cursor: pointer;
            }

    </style>
    </head>
    <body>
        <div class="navbar">
            <img src="../src/logo.png" alt="Logo" class="logo">
            <div class="centered-image-container">
                <img src="../src/welcanalisakehadiran.png" class="centered-image" alt="Centered Image">
             </div>
            <div class="rightnav">
                <form name="form" method="post" action="dashboard.php">
                    <input type="hidden" value="<?php echo $id?>" name="id">
                    <input type="hidden" value="<?php echo $userCat?>" name="userCat">
                    <button style="font-family: 'comic sans ms" type="submit" class="navhomebtn">HOME</button>
                </form>
            </div>
        </div>
        <br><br>
        <div class="welcome-text">
        Selamat Datang : <?php echo $userName;?> ( <?php echo $userCat?> )
        </div>
        <br><br>
        <center>
            <table class="tblbuttondashbord">
                <tr>
                    <td>
                        <form name="form" method="post" action="chooseanalisis.php">
                            <input type="hidden" value="<?php echo $id?>" name="id">
                            <input type="hidden" value="<?php echo $userCat?>" name="userCat">
                            <input type="hidden" value="<?php echo $userName?>" name="userName">
                            <button style="font-family: 'comic sans ms" type="submit" class="buttondashbord">
                                <img src="src/ana.png" alt="Profil Staff Image">
                                Analisa Kehadiran Murid
                            </button>
                        </form>
                    </td>
                    <td>
                        <form name="form" method="post" action="mcpelajar.php">
                            <input type="hidden" value="<?php echo $id?>" name="id">
                            <input type="hidden" value="<?php echo $userCat?>" name="userCat">
                            <input type="hidden" value="<?php echo $userName?>" name="userName">
                            <button style="font-family: 'comic sans ms" type="submit" class="buttondashbord">
                                <img src="src/mc.png" alt="Profil Staff Image">
                                MC Murid
                            </button>
                        </form>
                    </td>
                </tr>
            </table>
        </center>
    </body>
</html>