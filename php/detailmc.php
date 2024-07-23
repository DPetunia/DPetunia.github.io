<?php
    // Include the database connection file
    include('db/conection.php');

    // Sanitize and assign POST variables
    $userCat = $_POST['userCat'];
    $userName = $_POST['userName'];
    $id = $_POST['id'];
                    
    $namaguru = $_POST['namaguru'];
    $class = $_POST['class'];
    $hari = $_POST['hari'];
    $bulan = $_POST['bulan'];
    $tahun = $_POST['tahun'];
    $namaPelajar = $_POST['namaPelajar'];
    $mykid = $_POST['mykid'];
    $kehadiran = $_POST['kehadiran'];
    $mcid = $_POST['mcid'];

    // Fetch the record from the mc table
    $query = "SELECT * FROM mc WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('i', $mcid);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
?>
<html>
    <head>
        <title>MADRASAH AN-NUR - PROFIL MURID</title>
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
            /* CSS styles for table container */
            .table-container {
                margin: 20px auto; /* Center the container horizontally */
                width: 80%;
                padding: 20px;
                border: 1px solid #ccc;
                border-radius: 8px;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                background-color: #f9f9f9;
                font-family:Calibri;
            }

            /* Center content inside the table */
            .table-container table {
                width: 100%;
                border-collapse: collapse;
                font-family:Calibri;
            }

            /* Center text within table cells */
            .table-container td {
                padding: 10px;
                text-align: left;
                font-family:Calibri;
            }

            /* Style for the header */
            .table-container h1 {
                font-size: 24px;
                color: #333;
                margin-bottom: 10px;
                text-align: center;
                font-family: comic sans ms;
            }
            .mc-image {
                max-width: 100%; /* Adjust as needed */
                max-height: 300px; /* Adjust height as needed */
                display: block;
                margin: auto; /* Center image horizontally */
                margin-top: 10px; /* Add top margin for spacing */
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

            /* Hover effect for print button */
            .table-container .print-btn:hover {
                background-color: goldenrod; /* Darker shade of gold on hover */
            }

            /* Style for print button */
            .table-container .print-btn {
                padding: 10px 20px;
                background-color: gold; /* Red color for print button */
                color: white;
                border: none;
                cursor: pointer;
                border-radius: 4px;
                transition: background-color 0.3s ease; /* Smooth transition */
                margin-left: 10px;
                font-family: Calibri;
            }

            @media print {
                @page {
                    size:  A3 portrait;
                }
                body {
                    width: 100%;
                    margin: 0;
                    padding: 0;
                    overflow: hidden;
                }
                .table-container {
                    width: 100%;
                    margin: 0;
                    padding: 0;
                    border: none;
                    box-shadow: none;
                }
                .navbar, .welcome-text, .table-container h2, .table-container table, .table-container button {
                    page-break-inside: avoid;
                }
                .navbar, .rightnav, .navhomebtn, .print-btn, .welcome-text , .hideprint{
                    display: none;
                }
                .table-container button {
                    display: block;
                    margin: 5px auto;
                    padding: 15px 20px;
                    font-size: 16px;
                    cursor: pointer;
                }
            }
            @media print and (min-width: 21cm) and (min-height: 29.7cm) {
            @page {
                size: A4 portrait;
            }
            body {
                font-size: larger;
            }
            .table-container table[border="1"] th,
            .table-container table[border="1"] td {
                padding-top: 10px;
                padding-bottom: 10px;
                padding-left: 5px;
                padding-right: 5px;
                font-size: larger;
            }
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
                <form name="form" method="post" action="showmc.php">
                    <input type="hidden" value="<?php echo $id ?>" name="id">
                    <input type="hidden" value="<?php echo $userCat ?>" name="userCat">
                    <input type="hidden" value="<?php echo $userName ?>" name="userName">

                    <input type="hidden" value="<?php echo $class ?>" name="class">
                    <input type="hidden" value="<?php echo $bulan ?>" name="bulan">
                    <input type="hidden" value="<?php echo $tahun ?>" name="tahun">
                    <button style="font-family: 'comic sans ms" type="submit" class="navhomebtn">BACK</button>
                </form>
            </div>
        </div>
        <br>
        <center>
        <div class="table-container">
            <table class="mctable">
            <h1>Rekod MC Murid</h1>
                <tr>
                    <td>Tarikh</td>
                    <td>:</td>
                    <td><?php echo htmlspecialchars($hari . "-" . $bulan . "-" . $tahun);?></td>
                    <td class="selang">Nama Guru</td>
                    <td>:</td>
                    <td><?php echo htmlspecialchars($namaguru);?></td>
                </tr>
                <tr>
                    <td>Nama Pelajar</td>
                    <td>:</td>
                    <td><?php echo htmlspecialchars($namaPelajar);?></td>
                    <td class="selang">No.Mykid</td>
                    <td>:</td>
                    <td><?php echo htmlspecialchars($mykid);?></td>
                </tr>
                <tr>
                    <td>Sebab Tidak Hadir</td>
                    <td>:</td>
                    <td><?php echo htmlspecialchars($kehadiran);?></td>
                </tr>
                <tr>
                    <td>Bukti</td>
                    <td>:</td>
                </tr>
                <tr>
                    <td colspan="6">
                        <?php
                        if (!empty($row['mc_image'])) {
                            echo "<img src='data:image/jpeg;base64," . base64_encode($row['mc_image']) . "' alt='MC Image' class='mc-image'>";
                        } else {
                            echo "No image";
                        }
                        ?>
                    </td>
                </tr>
                <tr>
                    <td colspan="6" class="hideprint">
                        <br>
                        <center><button type="button" class="print-btn" onclick="window.print()">Print</button></center>
                    </td>
                </tr>
            </table>
        </div>
        </center>
    </body>
    <br><br>
</html>
<?php
// Close the database connection
$conn->close();
?>
