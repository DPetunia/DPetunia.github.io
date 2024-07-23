<?php
    // Check if the request method is POST
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        echo "Invalid request method. Please use POST.";
        echo "<meta http-equiv='refresh' content='0;url=index.php'>";
        exit;
    }
    
    include('db/conection.php');

    $userCat = $_POST['userCat'];
    $userName = $_POST['userName'];
    $id = $_POST['id'];

    $category = $_POST["category"];
    $password = $_POST["password"];
    $name = $_POST["name"];
    $staffid = $_POST["staffid"];
    $ic = $_POST["ic"];
    $dob = $_POST["dob"];
    $age = $_POST["age"];
    $gender = $_POST["gender"];
    $sob = $_POST["sob"];
    $phone = $_POST["phone"];
    $email = $_POST["email"];
    $race = $_POST["race"];
    $addrss = $_POST["addrss"];

    // Check if UserId already exists
    $checkQuery = "SELECT * FROM acc WHERE UserId = '$staffid'";
    $checkResult = $conn->query($checkQuery);

    if ($checkResult->num_rows > 0) {
        // UserId exists, show duplication message and redirect
        echo "Data duplicated... redirecting to Senarai Staff page...";
        echo "<form id='redirectForm' method='post' action='senaraiprofilstaff.php'>
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
        // UserId does not exist, proceed with insertion
        $sqlAcc = "INSERT INTO acc (UserId, UserPass, UserCat) VALUES ('$staffid', '$password', '$category')";

        if ($conn->query($sqlAcc) === TRUE) {
            if ($category == 'admin') {
                $sqlAdmin = "INSERT INTO admn (UserName, UserId, UserIc, UserDOB, UserAge, UserGender, UserSOB, UserPhone, UserEmail, UserRace, UserAdd) 
                        VALUES ('$name', '$staffid', '$ic', '$dob', '$age', '$gender', '$sob', '$phone', '$email', '$race', '$addrss')";

                if ($conn->query($sqlAdmin) === TRUE) {
                    echo "New record created successfully... redirecting to Senarai Staff page...";
                } else {
                    echo "Error inserting into admn: " . $sqlAdmin . "<br>" . $conn->error;
                }
            } elseif ($category == 'staff') {
                $sqlStaff = "INSERT INTO staff (UserName, UserId, UserIc, UserDOB, UserAge, UserGender, UserSOB, UserPhone, UserEmail, UserRace, UserAdd) 
                        VALUES ('$name', '$staffid', '$ic', '$dob', '$age', '$gender', '$sob', '$phone', '$email', '$race', '$addrss')";

                if ($conn->query($sqlStaff) === TRUE) {
                    echo "New record created successfully... redirecting to Senarai Staff page...";
                } else {
                    echo "Error inserting into staff: " . $sqlStaff . "<br>" . $conn->error;
                }
            }

            echo "<form id='redirectForm' method='post' action='senaraiprofilstaff.php'>
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
            echo "Error inserting into acc: " . $sqlAcc . "<br>" . $conn->error;
        }
    }

    $conn->close();
?>
