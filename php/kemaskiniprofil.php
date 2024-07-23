<?php
    // Include the database connection file
    include('db/conection.php');

    $userCat = $_POST['userCat'];
    $userName = $_POST['userName'];
    $id = $_POST['id'];

    // Fetch student data from the database
    $sql = "SELECT * FROM student WHERE IdPelajar = '$id'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Fetch data
        $row = $result->fetch_assoc();
        $class = $row['class'];
        $NamaPelajar = $row['NamaPelajar'];
        $IdPelajar = $row['IdPelajar'];
        $MyKidPelajar = $row['MyKidPelajar'];
        $SuratBeranak = $row['SuratBeranak'];
        $TarikhLahir = $row['TarikhLahir'];
        $Umur = $row['Umur'];
        $TempatLahir = $row['TempatLahir'];
        $Jantina = $row['Jantina'];
        $Agama = $row['Agama'];
        $Bangsa = $row['Bangsa'];
        $Alamat = $row['Alamat'];
        $NamaPenjaga = $row['NamaPenjaga'];
        $IcPenjaga = $row['IcPenjaga'];
        $PekerjaanPenjaga = $row['PekerjaanPenjaga'];
        $PendapatanKeluarga = $row['PendapatanKeluarga'];
        $PhonePenjaga = $row['PhonePenjaga'];
        $EmailPenjaga = $row['EmailPenjaga'];
        $Hubungan = $row['Hubungan'];
        $GambarPelajar = $row['GambarPelajar'];
    } else {
        echo "No student found with ID: $studentid";
        exit();
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <title>MADRASAH AN-NUR - KEMASKINI PROFIL PELAJAR</title>
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
            /* CSS styles for DP image */
            .dp-image {
                width: 150px; /* Adjust width as needed */
                height: 150px; /* Adjust height as needed */
                object-fit: cover; /* Ensure the image covers the entire area */
                border: 2px solid #ccc; /* Optional: Add a border around the image */
                box-shadow: 0 0 10px rgba(0,0,0,0.1); /* Optional: Add a shadow for a lifted effect */
                margin-bottom: 20px; /* Optional: Add some space below the image */
            }

            /* CSS styles for table container */
            .table-container {
                margin-top: 20px;
                width: 80%;
                padding: 20px;
                border: 1px solid #ccc;
                border-radius: 8px;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                background-color: #f9f9f9;
                margin-left: auto;
                margin-right: auto;
                font-family: Calibri;
            }

            /* Center content inside the table */
            .table-container table {
                width: 100%;
                border-collapse: collapse;
                font-family: Calibri;
            }

            /* Center text within table cells */
            .table-container td {
                padding: 10px;
                text-align: left;
                font-family: Calibri;
            }

            Style for the table rows
            .table-container tr:nth-child(even) {
                background-color: #f2f2f2;
                font-family: Calibri;
            }

            /* Style for the header */
            .table-container h1 {
                font-size: 24px;
                color: #333;
                margin-bottom: 10px;
                text-align: center;
                font-family: Calibri;
            }

            /* Style for the buttons */
            .table-container .resultButton {
                padding: 10px 20px;
                background-color: #4CAF50;
                color: white;
                border: none;
                cursor: pointer;
                border-radius: 4px;
                font-family: Calibri;
            }

            /* Style for input fields */
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

            .table-container h1 {
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

            .required {
                color: red; /* Change color to red */
                font-weight: bold; /* Optional: Make it bold */
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
                    <button type="submit" class="navhomebtn">HOME</button>
                </form>
            </div>
        </div>
        <br><br>
        <div class="table-container">
            <form name="form" method="post" action="updateprofil.php" enctype="multipart/form-data">
                <input type="hidden" value="<?php echo $id ?>" name="id">
                <input type="hidden" value="<?php echo $userCat ?>" name="userCat">
                <input type="hidden" value="<?php echo $userName ?>" name="userName">
                
                <center>
                    <table id="indextable">
                        <tr>
                            <td colspan="6">
                                <br>
                                    <h1>
                                        <u>MAKLUMAT PELAJAR</u>
                                    </h1>
                                <br>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="6">
                                <center>
                                    <?php
                                        if (!empty($row['GambarPelajar'])) {
                                            echo "<img  id='previewImage' src='data:image/jpeg;base64," . base64_encode($GambarPelajar) . "' alt='DP Image' class='dp-image'>";
                                        } else {
                                    ?>
                                            <img  id="previewImage" src="src/defaultDp.png" alt='DP Image' class='dp-image'>
                                    <?php
                                        }
                                    ?>
                                    <br>
                                    <label for="gambar">Change Image Size 1MB Only:</label>
                                    <input type="file" name="gambar" id="gambar" accept="image/*" onchange="previewFile(this)" >          
                                </center>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                KELAS <span class="required">*</span>
                            </td>
                            <td>
                                : 
                            </td>
                            <td>
                                <select name="class" required>
                                    <option value="">Select Class</option>
                                    <option value="1A - Siddiq" <?php if ($class == '1A - Siddiq') echo 'selected'; ?>>1A - Siddiq</option>
                                    <option value="1B - Amanah" <?php if ($class == '1B - Amanah') echo 'selected'; ?>>1B - Amanah</option>
                                    <option value="2A - Abu Bakar" <?php if ($class == '2A - Abu Bakar') echo 'selected'; ?>>2A - Abu Bakar</option>
                                    <option value="2B - Umar" <?php if ($class == '2B - Umar') echo 'selected'; ?>>2B - Umar</option>
                                    <option value="3A - Iman" <?php if ($class == '3A - Iman') echo 'selected'; ?>>3A - Iman</option>
                                    <option value="3B - Islam" <?php if ($class == '3B - Islam') echo 'selected'; ?>>3B - Islam</option>
                                    <option value="4A - Firdaus" <?php if ($class == '4A - Firdaus') echo 'selected'; ?>>4A - Firdaus</option>
                                    <option value="4B - Naim" <?php if ($class == '4B - Naim') echo 'selected'; ?>>4B - Naim</option>
                                    <option value="5A - Sabar" <?php if ($class == '5A - Sabar') echo 'selected'; ?>>5A - Sabar</option>
                                    <option value="5B - Ikhlas" <?php if ($class == '5B - Ikhlas') echo 'selected'; ?>>5B - Ikhlas</option>
                                    <option value="6A - Ibnu Sinar" <?php if ($class == '6A - Ibnu Sinar') echo 'selected'; ?>>6A - Ibnu Sinar</option>
                                    <option value="6B - Ibnu Rushd" <?php if ($class == '6B - Ibnu Rushd') echo 'selected'; ?>>6B - Ibnu Rushd</option>
                                </select>
                            </td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>
                                NAMA PELAJAR <span class="required">*</span>
                            </td>
                            <td>
                                : 
                            </td>
                            <td>
                                <input type="text" name="name" required placeholder="Student Name" value="<?php echo $NamaPelajar;?>">
                            </td>
                            <td>
                                ID 
                            </td>
                            <td>
                                : 
                            </td>
                            <td>
                                <input type="text" name="studentid" required placeholder="Student ID" value="<?php echo $IdPelajar;?>" readonly>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                NO.MYKID
                            </td>
                            <td>
                                : 
                            </td>
                            <td>
                                <input type="text" name="ic" pattern="[0-9]{12}" required placeholder="010203040506" value="<?php echo $MyKidPelajar;?>" readonly>
                            </td>
                            <td>
                                NO.SURAT BERANAK <span class="required">*</span>
                            </td>
                            <td>
                                : 
                            </td>
                            <td>
                                <input type="text" name="nosb" required placeholder="No.Surat Beranak" value="<?php echo $SuratBeranak;?>">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                TARIKH LAHIR
                            </td>
                            <td>
                                : 
                            </td>
                            <td>
                                <input type="text" name="dob" value="<?php echo $TarikhLahir;?>" required readonly>
                            </td>
                            <td>
                                UMUR
                            </td>
                            <td>
                                : 
                            </td>
                            <td>
                                <input type="text" name="age" value="<?php echo $Umur;?>" required readonly>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                TEMPAT LAHIR <span class="required">*</span>
                            </td>
                            <td>
                                : 
                            </td>
                            <td>
                                <input type="text" name="tempatlahir" value="<?php echo $TempatLahir;?>">
                            </td>
                            <td>
                                JANTINA
                            </td>
                            <td>
                                : 
                            </td>
                            <td>
                                <input type="text" name="gender" value="<?php echo $Jantina;?>" required readonly>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                AGAMA <span class="required">*</span>
                            </td>
                            <td>
                                : 
                            </td>
                            <td>
                                <input type="text" name="agama" required placeholder="ISLAM" value="<?php echo $Agama;?>">
                            </td>
                            <td>
                                BANGSA <span class="required">*</span>
                            </td>
                            <td>
                                : 
                            </td>
                            <td>
                                <select name="Bangsa" required>
                                    <option value="" <?php if ($Bangsa == '') echo 'selected'; ?>>Select Race</option>
                                    <option value="Melayu" <?php if ($Bangsa == 'Melayu') echo 'selected'; ?>>Melayu</option>
                                    <option value="China" <?php if ($Bangsa == 'China') echo 'selected'; ?>>China</option>
                                    <option value="India" <?php if ($Bangsa == 'India') echo 'selected'; ?>>India</option>
                                    <option value="lain-lain" <?php if ($Bangsa == 'lain-lain') echo 'selected'; ?>>lain-lain</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                ALAMAT <span class="required">*</span>
                            </td>
                            <td>
                                : 
                            </td>
                            <td colspan="4">
                                <textarea name="addrss" placeholder="address" required style="width: 400px; height: 113px;"><?php echo $Alamat;?></textarea>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="6">
                                <br>
                                    <h1>
                                        <u>MAKLUMAT PENJAGA</u>
                                    </h1>
                                <br>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                NAMA PENJAGA <span class="required">*</span>
                            </td>
                            <td>
                                : 
                            </td>
                            <td>
                                <input type="text" name="namapenjaga" required placeholder="Parent Name" value="<?php echo $NamaPenjaga;?>">
                            </td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>
                                NO.K/P <span class="required">*</span>
                            </td>
                            <td>
                                : 
                            </td>
                            <td>
                                <input type="text" name="icpenjaga" pattern="[0-9]{12}" required placeholder="010203040506" value="<?php echo $IcPenjaga;?>">
                            </td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>
                                PEKERJAAN <span class="required">*</span>
                            </td>
                            <td>
                                : 
                            </td>
                            <td>
                                <input type="text" name="pekerjaanpenjaga" required placeholder="Pekerjaan Penjaga" value="<?php echo $PekerjaanPenjaga;?>">
                            </td>
                            <td>
                                PENDAPATAN KELUARGA <span class="required">*</span>
                            </td>
                            <td>
                                : 
                            </td>
                            <td>
                                <select name="PendapatanKeluarga" required>
                                    <option value="" <?php if ($PendapatanKeluarga == '') echo 'selected'; ?>>Select Parent Income</option>
                                    <option value="RM 0 - RM 1000" <?php if ($PendapatanKeluarga == 'RM 0 - RM 1000') echo 'selected'; ?>>RM 0 - RM 1000</option>
                                    <option value="RM 1001 - RM 1500" <?php if ($PendapatanKeluarga == 'RM 1001 - RM 1500') echo 'selected'; ?>>RM 1001 - RM 1500</option>
                                    <option value="RM 1501 - RM 2000" <?php if ($PendapatanKeluarga == 'RM 1501 - RM 2000') echo 'selected'; ?>>RM 1501 - RM 2000</option>
                                    <option value="RM 2001 - RM 2500" <?php if ($PendapatanKeluarga == 'RM 2001 - RM 2500') echo 'selected'; ?>>RM 2001 - RM 2500</option>
                                    <option value="RM 2501 - RM 3000" <?php if ($PendapatanKeluarga == 'RM 2501 - RM 3000') echo 'selected'; ?>>RM 2501 - RM 3000</option>
                                    <option value="RM 3001 - RM 3500" <?php if ($PendapatanKeluarga == 'RM 3001 - RM 3500') echo 'selected'; ?>>RM 3001 - RM 3500</option>
                                    <option value="RM 5501 - RM 4000" <?php if ($PendapatanKeluarga == 'RM 5501 - RM 4000') echo 'selected'; ?>>RM 5501 - RM 4000</option>
                                    <option value="RM 4001 - RM 4500" <?php if ($PendapatanKeluarga == 'RM 4001 - RM 4500') echo 'selected'; ?>>RM 4001 - RM 4500</option>
                                    <option value="RM 4501 - RM5000" <?php if ($PendapatanKeluarga == 'RM 4501 - RM5000') echo 'selected'; ?>>RM 4501 - RM5000</option>
                                    <option value="> RM 5001" <?php if ($PendapatanKeluarga == '> RM 5001') echo 'selected'; ?>> &gt; RM 5001</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                NO.TELEFON <span class="required">*</span>
                            </td>
                            <td>
                                : 
                            </td>
                            <td>
                                <input type="text" name="phone" pattern="[0-9]{10,11}" required placeholder="0123456789" title="Phone number should be 10 or 11 digits" value="<?php echo $PhonePenjaga;?>">
                            </td>
                            <td>
                                EMAIL <span class="required">*</span>
                            </td>
                            <td>
                                : 
                            </td>
                            <td>
                                <input type="email" name="email" required placeholder="user@domain" value="<?php echo $EmailPenjaga;?>">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                HUBUNGAN DENGAN PELAJAR <span class="required">*</span>
                            </td>
                            <td>
                                : 
                            </td>
                            <td>
                                <input type="text" name="hubungan" required placeholder="Ibu" value="<?php echo $Hubungan;?>">
                            </td>
                        </tr>
                        <tr>
                            <td colspan="6">
                                <br><br>
                                <center><button type="submit" class="resultButton">Kemaskini</button></center>
                                <br><br>
                            </td>
                        </tr>
                    </table>
                </center>
            </form>
        </div>
        <br><br>
        <script>
        function previewFile(input) {
            if (input.files.length > 0) {
                const fileSize = input.files[0].size; // in bytes
                const maxSize = 1024 * 1024; // 1MB in bytes

                if (fileSize > maxSize) {
                    alert("File size exceeds the limit of 1MB. Please choose a smaller file.");
                    input.value = ''; // Clear the input field
                }
                else{
                    const preview = document.getElementById('previewImage');
                    const file = input.files[0];
                    const reader = new FileReader();

                    reader.onloadend = function () {
                        preview.src = reader.result;
                    }

                    if (file) {
                        reader.readAsDataURL(file);
                        const fileName = file.name; // Get the filename
                        alert("You have inserted " + fileName + ". Please submit the form after selecting the image."); // Alert message with filename
                    } else {
                        preview.src = 'src/defaultDp.png'; // Default image if no file selected
                    }
                }
            }
        }
        </script>
    </body>
</html>