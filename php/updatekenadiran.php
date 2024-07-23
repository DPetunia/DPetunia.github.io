<?php
// Include the database connection file
include('db/conection.php');

// Get the posted data
$id = $_POST['id'];
$userCat = $_POST['userCat'];
$userName = $_POST['userName'];
$class = $_POST['class'];
$hari = $_POST['hari'];
$bulan = $_POST['bulan'];
$tahun = $_POST['tahun'];
$tarikh = $_POST['tarikh'];
$kehadiranArray = $_POST['kehadiran'];

// Fetch students from the database for the specified class
$studentQuery = "SELECT NamaPelajar, MyKidPelajar FROM student WHERE class = '$class'";
$studentResult = $conn->query($studentQuery);

// Create an associative array to store student data
$studentData = [];
while ($studentRow = $studentResult->fetch_assoc()) {
    $studentData[$studentRow['MyKidPelajar']] = $studentRow['NamaPelajar'];
}

// Iterate through the attendance data
foreach ($studentData as $mykid => $NamaPelajar) {
    $kehadiran = array_shift($kehadiranArray);

    // Check if the record already exists
    $checkQuery = "SELECT * FROM att WHERE hari='$hari' AND bulan='$bulan' AND tahun='$tahun' AND class='$class' AND NamaGuru='$userName' AND MyKidPelajar='$mykid'";
    $checkResult = $conn->query($checkQuery);

    if ($checkResult->num_rows > 0) {
        // Record exists, update it
        $updateQuery = "UPDATE att SET kehadiran='$kehadiran' WHERE hari='$hari' AND bulan='$bulan' AND tahun='$tahun' AND class='$class' AND NamaGuru='$userName' AND MyKidPelajar='$mykid'";
        $conn->query($updateQuery);
    } else {
        // Record doesn't exist, insert it
        $insertQuery = "INSERT INTO att (hari, bulan, tahun, class, NamaGuru, NamaPelajar, MyKidPelajar, kehadiran) VALUES ('$hari', '$bulan', '$tahun', '$class', '$userName', '$NamaPelajar', '$mykid', '$kehadiran')";
        $conn->query($insertQuery);
    }
}

// Check if the query was successful
if ($conn->affected_rows > 0) {
    echo "Attendance has been updated... redirect to Kehadiran Murid page...";
    echo "<form id='redirectForm' method='post' action='updatekenadirankelas.php'>
            <input type='hidden' name='userCat' value='$userCat'>
            <input type='hidden' name='userName' value='$userName'>
            <input type='hidden' name='id' value='$id'>
            <input type='hidden' name='hari' value='$hari'>
            <input type='hidden' name='userName' value='$userName'>
            <input type='hidden' name='bulan' value='$bulan'>
            <input type='hidden' name='tahun' value='$tahun'>
            <input type='hidden' name='class' value='$class'>
            <input type='hidden' name='tarikh' value='$tarikh'>
          </form>
          <script type='text/javascript'>
            setTimeout(function() {
                document.getElementById('redirectForm').submit();
            }, 2000);
          </script>";
} else {
    echo "Attendance has been updated... redirect to Kehadiran Murid page...";
    echo "<form id='redirectForm' method='post' action='updatekenadirankelas.php'>
            <input type='hidden' name='userCat' value='$userCat'>
            <input type='hidden' name='userName' value='$userName'>
            <input type='hidden' name='id' value='$id'>
            <input type='hidden' name='hari' value='$hari'>
            <input type='hidden' name='userName' value='$userName'>
            <input type='hidden' name='bulan' value='$bulan'>
            <input type='hidden' name='tahun' value='$tahun'>
            <input type='hidden' name='class' value='$class'>
            <input type='hidden' name='tarikh' value='$tarikh'>
          </form>
          <script type='text/javascript'>
            setTimeout(function() {
                document.getElementById('redirectForm').submit();
            }, 2000);
          </script>";
}

// Close the database connection
$conn->close();
?>
