<?php
    include('db/conection.php');

    $userCat = $_POST['userCat'];
    $userName = $_POST['userName'];
    $id = $_POST['id'];

    $category = $_POST["category"];
    $class = $_POST["class"];
    $name = $_POST["name"];
    $studentid = $_POST["studentid"];
    $ic = $_POST["ic"];
    $nosb = $_POST["nosb"];
    $dob = $_POST["dob"];
    $age = $_POST["age"];
    $tempatlahir = $_POST["tempatlahir"];
    $gender = $_POST["gender"];
    $agama = $_POST["agama"];
    $race = $_POST["race"];
    $addrss = $_POST["addrss"];
    $namapenjaga = $_POST["namapenjaga"];
    $icpenjaga = $_POST["icpenjaga"];
    $pekerjaanpenjaga = $_POST["pekerjaanpenjaga"];
    $pincome = $_POST["pincome"];
    $phone = $_POST["phone"];
    $email = $_POST["email"];
    $hubungan = $_POST["hubungan"];
    $password = $_POST["password"];

    // Check if IdPelajar already exists
    $checkQuery = "SELECT * FROM acc WHERE UserId = '$studentid'";
    $checkResult = $conn->query($checkQuery);

    // Check if MyKidPelajar (ic) already exists
    $checkIcQuery = "SELECT * FROM student WHERE MyKidPelajar = '$ic'";
    $checkIcResult = $conn->query($checkIcQuery);

    if ($checkResult->num_rows > 0) {
        // IdPelajar exists, show duplication message and redirect
        echo "Data duplicated... redirect to page Senarai Pelajar";
        echo "<form id='redirectForm' method='post' action='senaraiprofilmurid.php'>
                <input type='hidden' name='userCat' value='$userCat'>
                <input type='hidden' name='userName' value='$userName'>
                <input type='hidden' name='id' value='$id'>
              </form>
              <script type='text/javascript'>
                setTimeout(function() {
                document.getElementById('redirectForm').submit();
                }, 2000);
              </script>";
        exit();
    } else {
        // IdPelajar does not exist, proceed with insertion
        $sql = "INSERT INTO acc (UserId, UserPass, UserCat) VALUES ('$studentid', '$password', '$category')";
        
        if ($conn->query($sql) === TRUE) {
            $sql = "INSERT INTO student (class, NamaPelajar, IdPelajar, MyKidPelajar, SuratBeranak, Alamat, TarikhLahir, TempatLahir, Umur, Jantina, Agama, Bangsa, NamaPenjaga, IcPenjaga, PhonePenjaga, PekerjaanPenjaga, PendapatanKeluarga, EmailPenjaga, Hubungan) 
                    VALUES ('$class', '$name', '$studentid', '$ic', '$nosb', '$addrss', '$dob', '$tempatlahir', '$age', '$gender', '$agama', '$race', '$namapenjaga', '$icpenjaga', '$phone', '$pekerjaanpenjaga', '$pincome', '$email', '$hubungan')";
            
            if ($conn->query($sql) === TRUE) {
                echo "New record created successfully... redirect to page senarai Pelajar";
                echo "<form id='redirectForm' method='post' action='senaraiprofilmurid.php'>
                        <input type='hidden' name='userCat' value='$userCat'>
                        <input type='hidden' name='userName' value='$userName'>
                        <input type='hidden' name='id' value='$id'>
                      </form>
                      <script type='text/javascript'>
                        setTimeout(function() {
                        document.getElementById('redirectForm').submit();
                        }, 2000);
                      </script>";
                exit();
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }

    $conn->close();
?>