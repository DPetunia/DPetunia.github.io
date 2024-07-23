<?php
    // Include the database connection file
    include('db/conection.php');

    $userCat = $_POST['userCat'];
    $userName = $_POST['userName'];
    $id = $_POST['id'];
    $class = $_POST['class'];
    $bulan = $_POST['bulan'];
    $tahun = $_POST['tahun'];

    // Convert month name to integer if necessary
    if (!is_numeric($bulan)) {
        $newbulan = date('m', strtotime($bulan));
    } else {
        $newbulan = intval($bulan);
    }

    // Calculate the number of days in the given month and year
    $daysInMonth = cal_days_in_month(CAL_GREGORIAN, $newbulan, $tahun);

    // Fetch distinct attendance records for the specified class, month, and year
    $attQuery = "SELECT DISTINCT NamaPelajar, MyKidPelajar FROM att WHERE class='$class' AND bulan='$bulan' AND tahun='$tahun'";
    $attResult = $conn->query($attQuery);

    // Initialize totals
    $totalHadir = 0;
    $totalTidakHadir = 0;
    $totalTidakHadirBersebab = 0;

    // Array to store daily totals
    $dailyTotals = [];
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
            .welcome-text {
                text-align: center;
                font-family: comic sans ms;
            }
            .table-container {
                margin: 20px;
                width: 95%;
                padding: 20px;
                border: 1px solid #ccc;
                border-radius: 8px;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                background-color: #f9f9f9;
                overflow-x: auto; /* Enable horizontal scrolling if needed */
            }

            .table-container table[border="1"] {
                width: 100%;
                border-collapse: collapse; /* Merge table borders */6px;
            }

            .table-container table[border="1"] th,
            .table-container table[border="1"] td {
                padding-top: 8px;
                padding-bottom: 8px;
                padding-left: 3px;
                padding-right: 3px;
                text-align: center;
                border: 1px solid #ccc; /* Ensure borders within the table */
                vertical-align: middle; /* Center align text vertically */
                white-space: nowrap; /* Prevent cell content from wrapping */
                overflow: hidden; /* Hide overflow content */
                text-overflow: ellipsis; /* Show ellipsis (...) for overflow text */
                font-family: Calibri;
            }

            .table-container table[border="1"] th {
                background-color: #f2f2f2; /* Light grey background for headers */
            }

            .table-container table[border="1"] td {
                background-color: #fff; /* White background for table cells */
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

            .font-calibri {
                font-family: Calibri;
            }

           
        @media print {
            @page {
                size: A3 landscape;
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
                size: A4 landscape;
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
        </style>
    </head>
    <body>
        <div class="navbar">
            <img src="../src/logo.png" alt="Logo" class="logo">
            <div class="centered-image-container">
                <img src="../src/welcanalisakehadiran.png" class="centered-image" alt="Centered Image">
            </div>
            <div class="rightnav">
                <form name="form" method="post" action="showkehadiran.php">
                    <input type="hidden" name="id" value="<?php echo htmlspecialchars($id); ?>">
                    <input type="hidden" name="userCat" value="<?php echo htmlspecialchars($userCat); ?>">
                    <input type="hidden" name="userName" value="<?php echo htmlspecialchars($userName); ?>">
                    <button style="font-family: 'comic sans ms" type="submit" class="navhomebtn">BACK</button>
                </form>
            </div>
        </div>
        <br><br>
        <div class="welcome-text">
            Selamat Datang : <?php echo htmlspecialchars($userName); ?> ( <?php echo htmlspecialchars($userCat); ?> )
        </div>
        <br>
        <center>
        <div class="table-container">
            <h2>Analisa Kehadiran Bulanan</h2>
            <table class="mctable">
                <tr class="font-calibri">
                    <td>Kelas</td>
                    <td>:</td>
                    <td><?php echo htmlspecialchars($class); ?></td>
                </tr>
                <tr class="font-calibri">
                    <td>Bulan</td>
                    <td>:</td>
                    <td><?php echo htmlspecialchars($bulan); ?></td>
                    <td class="selang">Tahun</td>
                    <td>:</td>
                    <td><?php echo htmlspecialchars($tahun); ?></td>
                </tr>
            </table>
            <br>
            <table border="1">
                <tr class="font-calibri">
                    <td rowspan="2"><center>Nama Pelajar</center></td>
                    <td rowspan="2"><center>No.Mykid</center></td>
                    <td colspan="<?php echo $daysInMonth; ?>"><center>Tarikh</center></td>
                </tr>
                <tr class="font-calibri">
                    <?php for ($trh = 1; $trh <= $daysInMonth; $trh++) : ?>
                        <td><center><?php echo $trh; ?></center></td>
                    <?php endfor; ?>
                </tr>
                <?php if ($attResult->num_rows > 0) : ?>
                    <?php while ($row = $attResult->fetch_assoc()) : ?>
                        <?php 
                        $thCountQuery = "SELECT COUNT(*) as thCount FROM att WHERE class=? AND bulan=? AND tahun=? AND NamaPelajar=? AND MyKidPelajar=? AND kehadiran='TH'";
                        $stmt = $conn->prepare($thCountQuery);
                        $stmt->bind_param('sssss', $class, $bulan, $tahun, $row['NamaPelajar'], $row['MyKidPelajar']);
                        $stmt->execute();
                        $thCountResult = $stmt->get_result();
                        $thCountRow = $thCountResult->fetch_assoc();
                        $thCount = $thCountRow['thCount'];
                        $textColor = ($thCount >= 3) ? "style='color:red;'" : "";
                        ?>
                        <tr>
                            <td><center><span <?php echo $textColor; ?>><?php echo htmlspecialchars($row['NamaPelajar']); ?></span></center></td>
                            <td><center><span <?php echo $textColor; ?>><?php echo htmlspecialchars($row['MyKidPelajar']); ?></span></center></td>
                            <?php for ($trh = 1; $trh <= $daysInMonth; $trh++) : ?>
                                <?php
                                $KehadiranQuery = "SELECT kehadiran FROM att WHERE class=? AND bulan=? AND tahun=? AND NamaPelajar=? AND MyKidPelajar=? AND hari=?";
                                $stmt = $conn->prepare($KehadiranQuery);
                                $stmt->bind_param('sssssi', $class, $bulan, $tahun, $row['NamaPelajar'], $row['MyKidPelajar'], $trh);
                                $stmt->execute();
                                $kehadiranResult = $stmt->get_result();
                                if ($kehadiranRow = $kehadiranResult->fetch_assoc()) {
                                    $kehadiran = htmlspecialchars($kehadiranRow['kehadiran']);
                                    if ($kehadiran == "TH") {
                                        $totalTidakHadir++;
                                        echo "<td><center><span $textColor>" . $kehadiran . "</center></td>";
                                    } elseif ($kehadiran == "Hadir") {
                                        $totalHadir++;
                                        echo "<td><center>" . $kehadiran . "</center></td>";
                                    } else {
                                        $totalTidakHadirBersebab++;
                                        if($kehadiran == "Wakil Sekolah"){
                                            echo "<td><center>Wakil<br>Sekolah</center></td>";
                                        }
                                        else{
                                            echo "<td><center>" . $kehadiran . "</center></td>";
                                        }
                                    }
                                    if (!isset($dailyTotals[$trh])) {
                                        $dailyTotals[$trh] = 0;
                                    }
                                    $dailyTotals[$trh]++;
                                } else {
                                    echo "<td><center> - </center></td>";
                                }
                                ?>
                            <?php endfor; ?>
                        </tr>
                    <?php endwhile; ?>
                <?php else : ?>
                    <tr><td colspan="<?php echo $daysInMonth + 2; ?>"><center>No data available</center></td></tr>
                <?php endif; ?>
                <tr class="font-calibri">
                    <td colspan="2"><center>Total Kehadiran</center></td>
                    <?php for ($trh = 1; $trh <= $daysInMonth; $trh++) : ?>
                        <?php
                        $dailyAttendanceQuery = "SELECT COUNT(*) as total FROM att WHERE class=? AND bulan=? AND tahun=? AND hari=? AND kehadiran='Hadir'";
                        $stmt = $conn->prepare($dailyAttendanceQuery);
                        $stmt->bind_param('sssi', $class, $bulan, $tahun, $trh);
                        $stmt->execute();
                        $dailyAttendanceResult = $stmt->get_result();
                        $dailyAttendanceRow = $dailyAttendanceResult->fetch_assoc();
                        ?>
                        <td><center><?php echo htmlspecialchars($dailyAttendanceRow['total']) . " / " . $attResult->num_rows; ?></center></td>
                    <?php endfor; ?>
                </tr>
                <tr class="font-calibri">
                    <td colspan="2"><center>Peratusan Kehadiran</center></td>
                    <?php for ($trh = 1; $trh <= $daysInMonth; $trh++) : ?>
                        <?php
                        $dailyAttendanceQuery = "SELECT COUNT(*) as total FROM att WHERE class=? AND bulan=? AND tahun=? AND hari=? AND kehadiran='Hadir'";
                        $stmt = $conn->prepare($dailyAttendanceQuery);
                        $stmt->bind_param('sssi', $class, $bulan, $tahun, $trh);
                        $stmt->execute();
                        $dailyAttendanceResult = $stmt->get_result();
                        $dailyAttendanceRow = $dailyAttendanceResult->fetch_assoc();
                        $percentage = ($attResult->num_rows > 0) ? ($dailyAttendanceRow['total'] / $attResult->num_rows) * 100 : 0;
                        ?>
                        <td><center><?php echo round($percentage, 2); ?>%</center></td>
                    <?php endfor; ?>
                </tr>
            </table>
            <br><br>
            <table>
                <tr class="font-calibri">
                    <?php
                        if (($attResult->num_rows * $daysInMonth) == 0) {
                        ?>
                        <td>Peratusan Pelajar Hadir Bulan <?php echo htmlspecialchars($bulan); ?></td>
                        <td>:</td>
                        <td>0%</td>
                    </tr>
                    <tr>
                        <td>Peratusan Pelajar Tidak Hadir Bulan <?php echo htmlspecialchars($bulan); ?></td>
                        <td>:</td>
                        <td>0%</td>
                    </tr>
                    <tr>
                        <td>Peratusan Pelajar Tidak Hadir Bersebab Bulan <?php echo htmlspecialchars($bulan); ?></td>
                        <td>:</td>
                        <td>0%</td>
                    </tr>
                        <?php
                        } else {
                    ?>
                    <td>Peratusan Pelajar Hadir Bulan <?php echo htmlspecialchars($bulan); ?></td>
                    <td>:</td>
                    <td><?php echo round(($totalHadir / ($attResult->num_rows * $daysInMonth)) * 100, 2); ?>%</td>
                </tr>
                <tr class="font-calibri">
                    <td>Peratusan Pelajar Tidak Hadir Bulan <?php echo htmlspecialchars($bulan); ?></td>
                    <td>:</td>
                    <td><?php echo round(($totalTidakHadir / ($attResult->num_rows * $daysInMonth)) * 100, 2); ?>%</td>
                </tr>
                <tr class="font-calibri">
                    <td>Peratusan Pelajar Tidak Hadir Bersebab Bulan <?php echo htmlspecialchars($bulan); ?></td>
                    <td>:</td>
                    <td><?php echo round(($totalTidakHadirBersebab / ($attResult->num_rows * $daysInMonth)) * 100, 2); ?>%</td>
                </tr>
                <?php
                        }
                ?>
                <tr class="hideprint">
                    <td>
                        <br>
                        <center><button class="print-btn" onclick="window.print()">Print</button></center>
                    </td>
                </tr>
            </table>
        </div>
        </center>
    </body>
</html>

