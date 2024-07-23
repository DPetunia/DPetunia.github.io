<?php
    // Include the database connection file
    include('db/conection.php');

    // Check if the form is submitted
    if (isset($_POST['submit'])) {

        // Check if an image file was uploaded
        if (isset($_FILES['mc_image']) && $_FILES['mc_image']['error'] === UPLOAD_ERR_OK) {
            // Get the uploaded file details
            $image = $_FILES['mc_image'];
            $mc_image = file_get_contents($image['tmp_name']);
            $imageName = $image['name'];

            // Retrieve other form data
            $id = $_POST['id'];
            $userCat = $_POST['userCat'];
            $userName = $_POST['userName'];
            $class = $_POST['class'];
            $hari = $_POST['hari'];
            $bulan = $_POST['bulan'];
            $tahun = $_POST['tahun'];
            $tarikh = $_POST['tarikh'];
            $namaPelajar = $_POST['namaPelajar'];
            $mykid = $_POST['mykid'];
            $kehadiran = $_POST['kehadiran'];
            $sebab = $_POST['sebab'];

            if (strtolower($sebab) == "lain-lain") {
                $newkehadiran = "TH";
            } else {
                $newkehadiran = $sebab;
            }

            // Check if data exists
            $checkQuery = "SELECT * FROM mc WHERE namaPelajar = ? AND mykid = ? AND hari = ? AND bulan = ? AND tahun = ? AND namaguru = ? AND class = ?";
            $stmt = $conn->prepare($checkQuery);
            $stmt->bind_param('sssssss', $namaPelajar, $mykid, $hari, $bulan, $tahun, $userName, $class);
            $stmt->execute();
            $result = $stmt->get_result();

            if (!$result) {
                // Query failed, handle the error
                echo "Error: " . $conn->error;
            } else {
                // Check if any rows are returned
                if ($result->num_rows > 0) {
                    // Data exists, update the record
                    $updateQuery = "UPDATE mc SET hari = ?, bulan = ?, tahun = ?, kehadiran = ?, sebab = ?, mc_image = ? WHERE namaPelajar = ? AND mykid = ?";
                    $stmt = $conn->prepare($updateQuery);
                    $stmt->bind_param('ssssssss', $hari, $bulan, $tahun, $newkehadiran, $sebab, $mc_image, $namaPelajar, $mykid);

                    if ($stmt->execute() === TRUE) {
                        $updateQuery = "UPDATE att SET kehadiran = ? WHERE namaPelajar = ? AND MyKidPelajar = ? AND hari = ? AND bulan = ? AND tahun = ? AND NamaGuru = ?";
                        $stmt = $conn->prepare($updateQuery);
                        $stmt->bind_param('sssssss', $newkehadiran, $namaPelajar, $mykid, $hari, $bulan, $tahun, $userName);

                        if ($stmt->execute() === TRUE) {
                            echo "Record updated successfully... redirect to page Rekod MC Murid....";
                            echo "<form id='redirectForm' method='post' action='studentmc.php'>
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
                            echo "Error updating record: " . $conn->error;
                        }
                    } else {
                        echo "Error updating record: " . $conn->error;
                    }
                } else {
                    // Data does not exist, insert a new record
                    $insertQuery = "INSERT INTO mc (namaguru, class, hari, bulan, tahun, namaPelajar, mykid, kehadiran, sebab, mc_image) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
                    $stmt = $conn->prepare($insertQuery);
                    $stmt->bind_param('ssssssssss', $userName, $class, $hari, $bulan, $tahun, $namaPelajar, $mykid, $newkehadiran, $sebab, $mc_image);

                    if ($stmt->execute() === TRUE) {
                        $updateQuery = "UPDATE att SET kehadiran = ? WHERE namaPelajar = ? AND MyKidPelajar = ? AND hari = ? AND bulan = ? AND tahun = ? AND NamaGuru = ?";
                        $stmt = $conn->prepare($updateQuery);
                        $stmt->bind_param('sssssss', $newkehadiran, $namaPelajar, $mykid, $hari, $bulan, $tahun, $userName);

                        if ($stmt->execute() === TRUE) {
                            echo "New record inserted successfully... redirect to page Rekod MC Murid....";
                            echo "<form id='redirectForm' method='post' action='studentmc.php'>
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
                            echo "Error updating record: " . $conn->error;
                        }
                    } else {
                        echo "Error inserting record: " . $conn->error;
                    }
                }
            }

            $conn->close();
        } else {
            // File upload failed; display a proper error message
            $errorMessage = "File upload failed with error code: " . $_FILES['image']['error'];
            echo "<script>alert('$errorMessage'); window.history.back();</script>";
            exit;
        }
    } else {
        // Form submission error; display a generic error message
        $errorMessage = "Form submission error.";
        echo "<script>alert('$errorMessage'); window.history.back();</script>";
        exit;
    }
?>