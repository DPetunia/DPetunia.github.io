<?php
// Include the database connection file
include('db/conection.php');

$userCat = $_POST['userCat'];
$userName = $_POST['userName'];
$id = $_POST['id'];
$hari = $_POST['hari'];
if($hari=="01"){
    $hari="1";
}
else if($hari=="02"){
    $hari="2";
}
else if($hari=="03"){
    $hari="3";
}
else if($hari=="04"){
    $hari="4";
}
else if($hari=="05"){
    $hari="5";
}
else if($hari=="06"){
    $hari="6";
}
else if($hari=="07"){
    $hari="7";
}
else if($hari=="08"){
    $hari="8";
}
else if($hari=="09"){
    $hari="9";
}
$bulan = $_POST['bulan'];
$tahun = $_POST['tahun'];
$class = $_POST['class'];
$tarikh = $hari . " - " . $bulan . " - " . $tahun;
if($hari<=9){
    $newhari="0".$hari;
}
else{
    $newhari=$hari;
}

// Fetch students from the database for the specified class
$studentQuery = "SELECT NamaPelajar, MyKidPelajar FROM student WHERE class = '$class'";
$studentResult = $conn->query($studentQuery);

// Fetch existing attendance records from the att table
$attendanceQuery = "SELECT NamaPelajar, MyKidPelajar, kehadiran FROM att WHERE hari='$hari' AND bulan='$bulan' AND tahun='$tahun' AND class='$class' AND NamaGuru='$userName'";
$attendanceResult = $conn->query($attendanceQuery);

// Create an associative array to store existing attendance data
$attendanceData = [];
while ($attendanceRow = $attendanceResult->fetch_assoc()) {
    $attendanceData[$attendanceRow['MyKidPelajar']] = $attendanceRow['kehadiran'];
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>MADRASAH AN-NUR - KEHADIRAN PELAJAR</title>
    <link rel="stylesheet" type="text/css" href="css/styles2.css">
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
            /* Styling for the table */
            .updatekehadiran {
                width: 100%;
                border-collapse: collapse;
                margin: 20px 0;
                font-size: 18px;
                text-align: left;
                font-family: Calibri;
            }

            /* Styling for the table header */
            .updatekehadiran th, .updatekehadiran td {
                padding: 12px 15px;
                border: 1px solid #ddd;
                font-family: Calibri;
            }

            /* Styling for the table header */
            .updatekehadiran th {
                background-color: #f4f4f4;
                font-weight: bold;
                font-family: Calibri;
            }

            /* Center the text in the table cells */
            .updatekehadiran td {
                text-align: center;
                font-family: Calibri;
            }

            /* Styling for the select input */
            .updatekehadiran select {
                padding: 8px;
                border-radius: 4px;
                border: 1px solid #ccc;
                font-size: 16px;
                width: 100%;
                font-family: Calibri;
            }

            /* Styling for the input text */
            .updatekehadiran input[type="text"] {
                width: 100%;
                padding: 8px;
                border-radius: 4px;
                border: 1px solid #ccc;
                font-size: 16px;
                font-family: Calibri;
            }

            /* Styling for the submit button */
            .resultButton {
                background-color: #007bff;
                color: white;
                border: none;
                padding: 10px 20px;
                font-size: 16px;
                cursor: pointer;
                border-radius: 5px;
                transition: background-color 0.3s ease;
                margin-top: 20px;
                font-family: Calibri;
            }

            .resultButton:hover {
                background-color: #0056b3;
            }

            .center-content {
                display: flex;
                justify-content: center;
                align-items: center;
                flex-direction: column;
            }

            .table-container {
                margin: 20px auto;
                padding: 20px;
                background-color: #f8f9fa;
                border-radius: 10px;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                width: 90%;
                text-align: center;
                font-family: Calibri;
            }

            .welcome-text {
                text-align: center;
                font-family: comic sans ms;
            }

            .nyatakanSebabButton {
            padding: 10px 20px;
            background-color: #007bff;
            color: white;
            border: none;
            cursor: pointer;
            border-radius: 4px;
            transition: background-color 0.3s ease; /* Smooth transition */
            font-family: Calibri;
        }

        .nyatakanSebabButton:hover {
            background-color: #0056b3; /* Darker shade of blue on hover */
        }

        .table-container h2 {
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
        <form name="form" method="post" action="studentth.php">
            <input type="hidden" value="<?php echo $id ?>" name="id">
            <input type="hidden" value="<?php echo $userCat ?>" name="userCat">
            <input type="hidden" value="<?php echo $userName ?>" name="userName">
            <button type="submit" class="navhomebtn">BACK</button>
        </form>
    </div>
</div>
<br><br>
<div class="welcome-text">
Selamat Datang : <?php echo htmlspecialchars($userName);?> ( <?php echo htmlspecialchars($userCat);?> )
</div>
<br>
<div class="table-container">
<h2>MC Murid</h2>
    <table class="tablekehadiran">
        <tr>
            <td>Kelas</td>
            <td>:</td>
            <td><?php echo htmlspecialchars($class);?></td>
            <td>Nama Guru</td>
            <td>:</td>
            <td><?php echo htmlspecialchars($userName);?></td>
        </tr>
        <tr>
            <td>Tarikh</td>
            <td>:</td>
            <td><?php echo htmlspecialchars($tarikh);?></td>
        </tr>
    </table>
    <table class="updatekehadiran">
        <tr>
            <th>Bil</th>
            <th>Nama Pelajar</th>
            <th>No. Mykid</th>
            <th>Sebab Tidak Hadir</th>
            <th>Action</th>
        </tr>
        <?php
        $bil = 1;
        $hasAbsentStudent = false; // Flag to track if there are any absent students
        while ($studentRow = $studentResult->fetch_assoc()) {
            $NamaPelajar = $studentRow['NamaPelajar'];
            $mykid = $studentRow['MyKidPelajar'];
            $kehadiran = isset($attendanceData[$mykid]) ? $attendanceData[$mykid] : '';
            // Fetch existing MC records from the mc table
            $mcCheckQuery = "SELECT * FROM mc WHERE namaguru='$userName' AND class='$class' AND hari='$newhari' AND bulan='$bulan' AND tahun='$tahun' AND namaPelajar = '$NamaPelajar' AND mykid = '$mykid'";
            $mcCheckResult = $conn->query($mcCheckQuery);
            if ($kehadiran != 'Hadir') {
                $hasAbsentStudent = true;
                echo "<tr>";
                echo "<td><center>" . $bil++ . "</center></td>";
                echo "<td><center>".htmlspecialchars($NamaPelajar)."</center></td>";
                echo "<td><center>".htmlspecialchars($mykid)."</center></td>";
                echo "<td><center>".htmlspecialchars($kehadiran)."</center></td>";
                echo "<td><center>";
                // Check if the record exists in mc table
                if ($mcCheckResult->num_rows > 0) {
                    // Record exists, do not show the button
                    echo "Record exists";
                } else {
                    // Record does not exist, show the button
                    echo "<form method='post' action='sebabtidakhadir.php' style='display:inline;'>";
                    echo "<input type='hidden' value='$id' name='id'>";
                    echo "<input type='hidden' value='$userCat' name='userCat'>";
                    echo "<input type='hidden' value='$userName' name='userName'>";
                    echo "<input type='hidden' value='$class' name='class'>";
                    echo "<input type='hidden' value='$hari' name='hari'>";
                    echo "<input type='hidden' value='$bulan' name='bulan'>";
                    echo "<input type='hidden' value='$tahun' name='tahun'>";
                    echo "<input type='hidden' value='$tarikh' name='tarikh'>";
                    echo "<input type='hidden' name='namaPelajar' value='".htmlspecialchars($NamaPelajar)."'>";
                    echo "<input type='hidden' name='mykid' value='".htmlspecialchars($mykid)."'>";
                    echo "<input type='hidden' name='kehadiran' value='".htmlspecialchars($kehadiran)."'>";
                    echo "<button type='submit' class='nyatakanSebabButton'>Nyatakan Sebab</button>";
                    echo "</form>";
                }
                echo "</center></td>";
                echo "</tr>";
            }
        }

        if (!$hasAbsentStudent) {
            // No absent students, show the message
            echo "<tr><td colspan='5'>Tiada Pelajar Tidak Hadir</td></tr>";
        }
        ?>
    </table>
</div>
</body>
</html>
