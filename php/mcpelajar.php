<?php
    // Include the database connection file
    include('db/conection.php');

    $userCat = $_POST['userCat'];
    $userName = $_POST['userName'];
    $id = $_POST['id'];
    // Specify the desired class order
    $classOrder = "'1A - Siddiq', '1B - Amanah', '2A - Abu Bakar', '2B - Umar', '3A - Iman', '3B - Islam', '4A - Firdaus', '4B - Naim', '5A - Sabar', '5B - Ikhlas', '6A - Ibnu Sinar', '6B - Ibnu Rushd'";

    // Fetch distinct classes from the database in the specified order
    $classQuery = "SELECT DISTINCT class FROM mc ORDER BY FIELD(class, $classOrder)";
    $classResult = $conn->query($classQuery);
    
    $bulanQuery = "SELECT DISTINCT bulan FROM mc";
    $bulanResult = $conn->query($bulanQuery);
    
    $tahunQuery = "SELECT DISTINCT tahun FROM mc";
    $tahunResult = $conn->query($tahunQuery);
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Show Kehadiran</title>
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
                /* Styling for the table container */
                .table-container {
                    margin: 20px auto;  /* Centering the container horizontally */
                    padding: 20px;
                    background-color: #f8f9fa;
                    border-radius: 10px;
                    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                    width: fit-content; /* Adjust width to content size */
                    text-align: center; /* Centering text */
                    font-family: Calibri;
                }

                /* Center form and its contents */
                .center-content {
                    display: flex;
                    justify-content: center;
                    align-items: center;
                    flex-direction: column; /* Stack children vertically */
                }

                /* Styling for the table */
                .tablekehadiran {
                    border-collapse: separate;
                    border-spacing: 0;
                    font-family: Arial, sans-serif;
                    margin: 0 auto; /* Centering the table */
                    font-family: Calibri;
                }

                /* Styling for the table cells */
                .tablekehadiran th, .tablekehadiran td {
                    padding: 12px;
                    text-align: left;
                    border: none;
                }

                /* Styling for the table headers */
                .tablekehadiran th {
                    background-color: #4CAF50;
                    color: white;
                }

                /* Styling for the form select inputs */
                .tablekehadiran select {
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
                    font-family: Calibri;
                }

                .resultButton:hover {
                    background-color: #0056b3;
                }

                .welcome-text {
                    text-align: center; 
                    font-family: comic sans ms;
                }
                 /* Styling for the form input */
                 .input-field {
                    padding: 8px;
                    border-radius: 4px;
                    border: 1px solid #ccc;
                    font-size: 16px;
                    width: 100%; /* Adjust width as needed */
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
                <?php
                    if($userCat == "admin"){
                ?>
                <form name="form" method="post" action="analisakehadiran.php">
                    <input type="hidden" value="<?php echo $id ?>" name="id">
                    <input type="hidden" value="<?php echo $userCat ?>" name="userCat">
                    <input type="hidden" value="<?php echo $userName ?>" name="userName">
                    <button style="font-family: 'comic sans ms" type="submit" class="navhomebtn">BACK</button>
                </form>
                <?php
                    }
                    else{
                ?>
                <form name="form" method="post" action="choose.php">
                    <input type="hidden" value="<?php echo $id ?>" name="id">
                    <input type="hidden" value="<?php echo $userCat ?>" name="userCat">
                    <input type="hidden" value="<?php echo $userName ?>" name="userName">
                    <button style="font-family: 'comic sans ms" type="submit" class="navhomebtn">BACK</button>
                </form>
                <?php
                    }
                ?>
            </div>
        </div>
        <br><br>
        <div class="welcome-text">
        Selamat Datang : <?php echo $userName;?> ( <?php echo $userCat?> )
                </div>
        <br>
        <form method="post" action="showmc.php">
            <center>
            <div class="table-container">
                <input type="hidden" value="<?php echo $id ?>" name="id">
                <input type="hidden" value="<?php echo $userCat ?>" name="userCat">
                <input type="hidden" value="<?php echo $userName ?>" name="userName">
                <table class="tablekehadiran">
                <h2>Rekod MC Murid</h2>
                    <tr>
                        <td>Kelas</td>
                        <td>:</td>
                        <td>
                            <select name="class" required>
                                <?php if ($classResult->num_rows > 0): ?>
                                    <option value="">-- Pilih Kelas --</option>
                                    <?php while ($classRow = $classResult->fetch_assoc()): ?>
                                        <option value="<?php echo htmlspecialchars($classRow['class']); ?>">
                                            <?php echo htmlspecialchars($classRow['class']); ?>
                                        </option>
                                    <?php endwhile; ?>
                                <?php else: ?>
                                    <option value="">-- Tiada data Kehadiran dalam database --</option>
                                <?php endif; ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>Bulan</td>
                        <td>:</td>
                        <td>
                            <select name="bulan" required>
                                <?php if ($bulanResult->num_rows > 0): ?>
                                    <option value="">-- Pilih Bulan --</option>
                                    <?php while ($bulanRow = $bulanResult->fetch_assoc()): ?>
                                        <option value="<?php echo htmlspecialchars($bulanRow['bulan']); ?>">
                                            <?php echo htmlspecialchars($bulanRow['bulan']); ?>
                                        </option>
                                    <?php endwhile; ?>
                                <?php else: ?>
                                    <option value="">-- Tiada data Kehadiran dalam database --</option>
                                <?php endif; ?>
                            </select>
                        </td>
                        <td>Tahun</td>
                        <td>:</td>
                        <td>
                            <select name="tahun" required>
                                <?php if ($tahunResult->num_rows > 0): ?>
                                    <option value="">-- Pilih Tahun --</option>
                                    <?php while ($tahunRow = $tahunResult->fetch_assoc()): ?>
                                        <option value="<?php echo htmlspecialchars($tahunRow['tahun']); ?>">
                                            <?php echo htmlspecialchars($tahunRow['tahun']); ?>
                                        </option>
                                    <?php endwhile; ?>
                                <?php else: ?>
                                    <option value="">-- Tiada data Kehadiran dalam database --</option>
                                <?php endif; ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="6">
                            <center><button type="submit" class="resultButton">Seterusnya</button></center>
                        </td>
                    </tr>
                </table>
            </div>
            </center>
        </form>
    </body>
</html>
