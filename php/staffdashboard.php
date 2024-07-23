<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="css/styles1.css">
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
    <link rel="icon" href="../src/logo.png">
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
    </style>
</head>
<body>
    <br><br>
    <center>
    <table class="tblbuttondashbord">
        <tr>
            <td>
                <form name="form" method="post" action="senaraiprofilmurid.php">
                    <input type="hidden" value="<?php echo $id?>" name="id">
                    <input type="hidden" value="<?php echo $userCat?>" name="userCat">
                    <input type="hidden" value="<?php echo $userName?>" name="userName">
                    <button  style="font-family: 'comic sans ms" type="submit" class="buttondashbord">
                        <img src="src/profil_murid.png" alt="Profil Murid Image">
                        Profil Murid
                    </button>
                </form>
            </td>
            <td>
                <form name="form" method="post" action="selectstudentkehadiran.php">
                    <input type="hidden" value="<?php echo $id?>" name="id">
                    <input type="hidden" value="<?php echo $userCat?>" name="userCat">
                    <input type="hidden" value="<?php echo $userName?>" name="userName">
                    <button  style="font-family: 'comic sans ms" type="submit" class="buttondashbord">
                        <img src="src/kehadiran.png" alt="Kehadiran Murid Image">
                        Kehadiran Murid
                    </button>
                </form>
            </td>
            <td>
                <form name="form" method="post" action="choose.php">
                    <input type="hidden" value="<?php echo $id?>" name="id">
                    <input type="hidden" value="<?php echo $userCat?>" name="userCat">
                    <input type="hidden" value="<?php echo $userName?>" name="userName">
                    <button  style="font-family: 'comic sans ms" type="submit" class="buttondashbord">
                        <img src="src/th.png" alt="Pelajar Tidak Hadir Image">
                        Rekod Murid TH
                    </button>
                </form>
            </td>
        </tr>
    </table>
</center>