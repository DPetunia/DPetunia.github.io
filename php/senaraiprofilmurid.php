<?php
    // Check if the request method is POST
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        echo "Invalid request method. Please use POST.";
        echo "<meta http-equiv='refresh' content='0;url=index.php'>";
        exit;
    }
    
    // Include the database connection file
    include('db/conection.php');

    // Sanitize and assign POST variables
    $userCat = htmlspecialchars($_POST['userCat']);
    $userName = htmlspecialchars($_POST['userName']);
    $id = htmlspecialchars($_POST['id']);

    // Specify the desired class order
    $classOrder = "'1A - Siddiq', '1B - Amanah', '2A - Abu Bakar', '2B - Umar', '3A - Iman', '3B - Islam', '4A - Firdaus', '4B - Naim', '5A - Sabar', '5B - Ikhlas', '6A - Ibnu Sinar', '6B - Ibnu Rushd'";

    // Fetch distinct classes from the database in the specified order
    $classQuery = "SELECT DISTINCT class FROM student ORDER BY FIELD(class, $classOrder)";
    $classResult = $conn->query($classQuery);


    // Fetch student data from the database
    $studentQuery = "SELECT * FROM student";
    if (!empty($_POST['searchClass'])) {
        $searchClass = htmlspecialchars($_POST['searchClass']);
        $studentQuery .= " WHERE class = '$searchClass'";
    }
    $studentQuery .= " ORDER BY FIELD(class, $classOrder)";
    $student = $conn->query($studentQuery);

    // Fetch admin data from the database
    $accQuery = "SELECT * FROM acc WHERE UserCat IN ('student')";
    if (!empty($searchAcc)) {
        $accQuery .= " WHERE UserName LIKE '%$searchAcc%'";
    }
    $acc = $conn->query($accQuery);
?>
<!DOCTYPE html>
<html>
    <head>
        <title>MADRASAH AN-NUR - PROFIL MURID</title>
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
            .table-container {
                margin: 20px auto;
                width: 80%;
                padding: 20px;
                border: 1px solid #ccc;
                border-radius: 8px;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                background-color: #f9f9f9;
                font-family: Calibri;
            }
            .table-container table {
                width: 100%;
                border-collapse: collapse;
                font-family: Calibri;
            }
            .table-container td {
                padding: 10px;
                text-align: left;
                font-family: Calibri;
            }
            .table-container tr:nth-child(even) {
                background-color: #f2f2f2;
                font-family: Calibri;
            }
            .table-container h2 {
                font-size: 24px;
                color: #333;
                margin-bottom: 10px;
                text-align: center;
                font-family: comic sans ms;
            }
            .table-container .resultButton {
                padding: 10px 20px;
                background-color: #4CAF50;
                color: white;
                border: none;
                cursor: pointer;
                border-radius: 4px;
                font-family: Calibri;
            }
            .table-container input[type="text"],
            .table-container input[type="email"],
            .table-container select,
            .table-container textarea {
                width: 100%;
                padding: 10px;
                margin: 5px 0;
                border: 1px solid #ccc;
                border-radius: 4px;
                box-sizing: border-box;
                font-family: Calibri;
            }
            /* Styles for select dropdown */
            select[name="searchClass"] {
            padding: 6px; /* Decrease padding */
            font-size: 14px; /* Decrease font size */
            border: 1px solid #ccc;
            border-radius: 4px;
            margin-right: 10px;
            height: 30px; /* Adjust height as needed */
            width: 150px; /* Adjust width as needed */
            font-family: Calibri;
            }

            /* Styles for button */
            button[type="submit"] {
            padding: 8px 16px;
            background-color: #007bff; /* Blue color, you can change this */
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-family: Calibri;
            }

            /* Hover effect for button */
            button[type="submit"]:hover {
            background-color: #0056b3; /* Darker shade of blue on hover */
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
                    <button style="font-family: 'Comic Sans MS'" type="submit" class="navhomebtn">HOME</button>
                </form>
            </div>
        </div>
        <br><br>
        <div class="table-container">
            <h2>Senarai Murid</h2>
            <form method="post" action="">
                <input type="hidden" value="<?php echo $id ?>" name="id">
                <input type="hidden" value="<?php echo $userCat ?>" name="userCat">
                <input type="hidden" value="<?php echo $userName ?>" name="userName">
                Cari Kelas: 
                <select name="searchClass">
                    <option value="">-- Semua Kelas --</option>
                    <?php while ($classRow = $classResult->fetch_assoc()): ?>
                        <option value="<?php echo htmlspecialchars($classRow['class']); ?>" <?php if (!empty($searchClass) && $searchClass == $classRow['class']) echo 'selected'; ?>>
                            <?php echo htmlspecialchars($classRow['class']); ?>
                        </option>
                    <?php endwhile; ?>
                </select>
                <button type="submit">Cari</button>
            </form>
            <br>
            <?php if ($student->num_rows > 0): ?>
            <table border="1">
                <tr>
                    <th >Bil</th>
                    <th >Kelas</th>
                    <th >Nama Pelajar</th>
                    <th >ID</th>
                    <th >No.MYKID</th>
                    <th >No.Surat Beranak</th>
                    <th >Password</th>
                    <th ></th>
                </tr>
                <?php
                $counter = 1;
                while ($row = $student->fetch_assoc()):
                ?>
                    <tr>
                        <td><center><?php echo $counter; ?></center></td>
                        <td><center><?php echo htmlspecialchars($row['class']); ?></center></td>
                        <td><center><?php echo htmlspecialchars($row['NamaPelajar']); ?></center></td>
                        <td><center><?php echo htmlspecialchars($row['IdPelajar']); ?></center></td>
                        <td><center><?php echo htmlspecialchars($row['MyKidPelajar']); ?></center></td>
                        <td><center><?php echo htmlspecialchars($row['SuratBeranak']); ?></center></td>
                        <td><center><?php echo htmlspecialchars($row['MyKidPelajar']); ?></center></td>
                        <td>
                            <center>
                                <form method="post" action="detailpelajar.php">
                                    <input type="hidden" value="<?php echo $id ?>" name="id">
                                    <input type="hidden" value="<?php echo $userCat ?>" name="userCat">
                                    <input type="hidden" value="<?php echo $userName ?>" name="userName">
                                    <input type="hidden" name="class" value="<?php echo htmlspecialchars($row['class']); ?>">
                                    <input type="hidden" name="NamaPelajar" value="<?php echo htmlspecialchars($row['NamaPelajar']); ?>">
                                    <input type="hidden" name="IdPelajar" value="<?php echo htmlspecialchars($row['IdPelajar']); ?>">
                                    <input type="hidden" name="MyKidPelajar" value="<?php echo htmlspecialchars($row['MyKidPelajar']); ?>">
                                    <input type="hidden" name="SuratBeranak" value="<?php echo htmlspecialchars($row['SuratBeranak']); ?>">
                                    <input type="hidden" name="Alamat" value="<?php echo htmlspecialchars($row['Alamat']); ?>">
                                    <input type="hidden" name="TarikhLahir" value="<?php echo htmlspecialchars($row['TarikhLahir']); ?>">
                                    <input type="hidden" name="TempatLahir" value="<?php echo htmlspecialchars($row['TempatLahir']); ?>">
                                    <input type="hidden" name="Umur" value="<?php echo htmlspecialchars($row['Umur']); ?>">
                                    <input type="hidden" name="Jantina" value="<?php echo htmlspecialchars($row['Jantina']); ?>">
                                    <input type="hidden" name="Agama" value="<?php echo htmlspecialchars($row['Agama']); ?>">
                                    <input type="hidden" name="Bangsa" value="<?php echo htmlspecialchars($row['Bangsa']); ?>">
                                    <input type="hidden" name="NamaPenjaga" value="<?php echo htmlspecialchars($row['NamaPenjaga']); ?>">
                                    <input type="hidden" name="IcPenjaga" value="<?php echo htmlspecialchars($row['IcPenjaga']); ?>">
                                    <input type="hidden" name="PhonePenjaga" value="<?php echo htmlspecialchars($row['PhonePenjaga']); ?>">
                                    <input type="hidden" name="PekerjaanPenjaga" value="<?php echo htmlspecialchars($row['PekerjaanPenjaga']); ?>">
                                    <input type="hidden" name="PendapatanKeluarga" value="<?php echo htmlspecialchars($row['PendapatanKeluarga']); ?>">
                                    <input type="hidden" name="EmailPenjaga" value="<?php echo htmlspecialchars($row['EmailPenjaga']); ?>">
                                    <input type="hidden" name="Hubungan" value="<?php echo htmlspecialchars($row['Hubungan']); ?>">
                                    <button type="submit">Detail</button>
                                </form>
                            </center>
                        </td>
                    </tr>
                <?php
                $counter++;
                endwhile;
                ?>
            </table>
            <?php else: ?>
                <p>Tiada murid ditemui dalam pangkalan data.</p>
            <?php endif; ?>
            <br>
            <?php
                if($userCat != "admin"){
            ?>
            <form method="post" action="add_student.php" style="text-align: center;">
                <input type="hidden" value="<?php echo $id ?>" name="id">
                <input type="hidden" value="<?php echo $userCat ?>" name="userCat">
                <input type="hidden" value="<?php echo $userName ?>" name="userName">
                <button type="submit">Tambah Pelajar</button>
                <br><br>
            </form>
            <?php
                }
            ?>
        </div>
        <br>
    </body>
</html>
