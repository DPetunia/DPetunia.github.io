<?php
    // Include the database connection file
    include('db/conection.php');

    // Check if all POST variables are set
    if (!isset($_POST['userCat'], $_POST['userName'], $_POST['id'], $_POST['from'])) {
        die("Missing POST data");
    }

    // Sanitize and assign POST variables
    $userCat = $_POST['userCat'];
    $userName = $_POST['userName'];
    $id = $_POST['id'];
    $from = $_POST['from'];

    // Initialize variables for deletion
    $IdtoDelete = null;
    $newnama = null;
    $newmykid = null;
    $newusercat = null;

    // Determine which table and fields to use based on $from
    if ($from === "student") {
        $IdtoDelete = $_POST['IdPelajar'];

        // Get $newnama and $newmykid from student table
        $sql = "SELECT NamaPelajar, MyKidPelajar FROM student WHERE IdPelajar = ?";
        $stmt = $conn->prepare($sql);

        if ($stmt === false) {
            die("Prepare failed: " . $conn->error);
        }

        $stmt->bind_param("s", $IdtoDelete);
        $stmt->execute();
        $stmt->bind_result($newnama, $newmykid);
        $stmt->fetch();
        $stmt->close();

    } else if ($from === "staff") {
        $IdtoDelete = $_POST['UserId'];

        // Get $newusercat from acc table
        $sql = "SELECT UserCat FROM acc WHERE UserId = ?";
        $stmt = $conn->prepare($sql);

        if ($stmt === false) {
            die("Prepare failed: " . $conn->error);
        }

        $stmt->bind_param("s", $IdtoDelete);
        $stmt->execute();
        $stmt->bind_result($newusercat);
        $stmt->fetch();
        $stmt->close();

        // Depending on $newusercat, get $newnama from staff or admn table
        if ($newusercat === "staff") {
            $sql = "SELECT UserName FROM staff WHERE UserId = ?";
        } else if ($newusercat === "admin") {
            $sql = "SELECT UserName FROM admn WHERE UserId = ?";
        }

        if (isset($sql)) {
            $stmt = $conn->prepare($sql);

            if ($stmt === false) {
                die("Prepare failed: " . $conn->error);
            }

            $stmt->bind_param("s", $IdtoDelete);
            $stmt->execute();
            $stmt->bind_result($newnama);
            $stmt->fetch();
            $stmt->close();
        }
    }

    // Delete from acc table
    $sql = "DELETE FROM acc WHERE UserId = ?";
    $stmt = $conn->prepare($sql);

    if ($stmt === false) {
        die("Prepare failed: " . $conn->error);
    }

    $stmt->bind_param("s", $IdtoDelete);
    $stmt->execute();
    $stmt->close();

    // Delete additional related records based on $from
    if ($from === "student") {
        // Delete from student table
        $sql = "DELETE FROM student WHERE IdPelajar = ?";
        $stmt = $conn->prepare($sql);

        if ($stmt === false) {
            die("Prepare failed: " . $conn->error);
        }

        $stmt->bind_param("s", $IdtoDelete);
        $stmt->execute();
        $stmt->close();

        // Delete from att table if $newmykid exists
        if ($newmykid) {
            $sql = "DELETE FROM att WHERE MyKidPelajar = ?";
            $stmt = $conn->prepare($sql);

            if ($stmt === false) {
                die("Prepare failed: " . $conn->error);
            }

            $stmt->bind_param("s", $newmykid);
            $stmt->execute();
            $stmt->close();

            // Delete from mc table if $newmykid exists
            $sql = "DELETE FROM mc WHERE mykid = ?";
            $stmt = $conn->prepare($sql);

            if ($stmt === false) {
                die("Prepare failed: " . $conn->error);
            }

            $stmt->bind_param("s", $newmykid);
            $stmt->execute();
            $stmt->close();
        }

    } else if ($from === "staff") {
        // Delete from staff or admn table based on $newusercat
        if ($newusercat === "admin") {
            $sql = "DELETE FROM admn WHERE UserId = ?";
        } else if ($newusercat === "staff") {
            $sql = "DELETE FROM staff WHERE UserId = ?";
        }

        if (isset($sql)) {
            $stmt = $conn->prepare($sql);

            if ($stmt === false) {
                die("Prepare failed: " . $conn->error);
            }

            $stmt->bind_param("s", $IdtoDelete);
            $stmt->execute();
            $stmt->close();
        }
    }

    // Prepare redirection form
    echo $newnama . " (ID: " . $IdtoDelete . ") data from " . $from . " successfully deleted. Redirecting...";

    // Redirect after a short delay
    echo '
        <form id="redirectForm" method="post" action="' . ($from === "student" ? 'senaraiprofilmurid.php' : 'senaraiprofilstaff.php') . '">
            <input type="hidden" name="id" value="' . $id . '">
            <input type="hidden" name="userCat" value="' . $userCat . '">
            <input type="hidden" name="userName" value="' . $userName . '">
        </form>
        <script type="text/javascript">
            setTimeout(function() {
                document.getElementById("redirectForm").submit();
            }, 2000); // 2000 milliseconds = 2 seconds
        </script>
    ';

    // Close the database connection
    $conn->close();
?>