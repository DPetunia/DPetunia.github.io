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
            /* CSS styles for table container */
            .table-container {
                margin: 20px auto; /* Center the container horizontally */
                width: 80%;
                padding: 20px;
                border: 1px solid #ccc;
                border-radius: 8px;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                background-color: #f9f9f9;
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

            /* Style for the header */
            .table-container h1 {
                font-size: 24px;
                color: #333;
                margin-bottom: 10px;
                text-align: center;
                font-family: comic sans ms;
            }

            /* Style for the buttons */
            .table-container .resultButton {
                padding: 10px 20px;
                background-color: #007bff;
                color: white;
                border: none;
                cursor: pointer;
                border-radius: 4px;
                transition: background-color 0.3s ease; /* Smooth transition */
                font-family: Calibri;
            }

            /* Hover effect for buttons */
            .table-container .resultButton:hover {
                background-color: #0056b3; /* Darker shade of blue on hover */
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

            .welcome-text {
                margin-left: 135px; 
            }
        </style>
	</head>
	<body>
        <?php
            // Include the database connection file
            include('db/conection.php');

            // Sanitize and assign POST variables
            $userCat = $_POST['userCat'];
            $userName = $_POST['userName'];
            $id = $_POST['id'];
            $class = $_POST["class"];
            $name = $_POST["name"];
            $studentid = $_POST["studentid"];
            $ic = $_POST["ic"];
            $nosb = $_POST["nosb"];
            $tempatlahir = $_POST["tempatlahir"];
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

            function IctoAnything($ic)
            {
                if($ic%2==0)
                {
                    $gender="Perempuan";
                }
                else
                {
                    $gender="Lelaki";
                }
                $year=substr($ic,0,2);
                if($year >=0 && $year <=23)
                {
                    $year+=2000;
                }
                else{
                    $year+=1900;
                }
                $age=date("Y")-$year;
                $month=substr($ic,2,2);
                $day=substr($ic,4,2);
                $DOB="$day-$month-$year";
                $from =substr($ic, 6, 2);
                if ($from==1||$from==21||$from==22||$from==23||$from==24) 
                {
                    $negeri="Johor";
                }
                elseif ($from==2||$from==25||$from==26||$from==27) 
                {
                    $negeri="Kedah";
                }
                elseif ($from==3||$from==28||$from==29) 
                {
                    $negeri="Kelantan";
                } 
                elseif ($from==4||$from==30) 
                {
                    $negeri="Melaka";
                } 
                elseif ($from==5||$from==31||$from==59) 
                {
                    $negeri="Negeri Sembilan";
                } 
                elseif ($from==6||$from==32||$from==33) 
                {
                    $negeri="Pahang";
                } 
                elseif ($from==7||$from==34||$from==35) 
                {
                    $negeri="Pulau Pinang";
                } 
                elseif ($from==8||$from==36||$from==37||$from==38||$from==39) 
                {
                    $negeri="Perak";
                } 
                elseif ($from==9||$from==40) 
                {
                    $negeri="Perlis";
                } 
                elseif ($from==10||$from==41||$from==42||$from==43||$from==44) 
                {
                    $negeri="Selangor";
                } 
                elseif ($from==11||$from==45||$from==46) {
                    $negeri="Terengganu";
                } 
                elseif ($from==12||$from==47||$from==48||$from==49) 
                {
                    $negeri="Sabah";
                } 
                elseif ($from==13||$from==50||$from==51||$from==52||$from==53) 
                {
                    $negeri="Sarawak";
                } 
                elseif ($from==14||$from==54||$from==55||$from==56||$from==57) 
                {
                    $negeri="Kuala Lumpur";
                } 
                elseif ($from==15||$from==58) 
                {
                    $negeri="Labuan";
                } 
                elseif ($from==16) 
                {
                    $negeri="Putrajaya";
                } 
                else 
                {
                    $negeri="Negeri Tidak Diketahui";
                }
                return [$gender,$negeri,$DOB,$age];
            }
            $result=IctoAnything($ic);
            $gender=$result[0];
            $negeri=$result[1];
            $DOB=$result[2];
            $age=$result[3];
        ?>
        <br><br>
		<form name="form" method="post" action="addstudentdb.php">
            <input type="hidden" value="<?php echo $id ?>" name="id">
            <input type="hidden" value="<?php echo $userCat ?>" name="userCat">
            <input type="hidden" value="<?php echo $userName ?>" name="userName">
            <input type="hidden" value="student" name="category">
            <center>
            <div class="table-container">
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
                        <td>
                            KELAS
                        </td>
                        <td>
                            : 
                        </td>
                        <td>
                            <select name="class" required>
                                <option value="">Select Class</option>
                                <option value="1A - Siddiq" <?php if ($class == 'Siddiq') echo 'selected'; ?>>1A - Siddiq</option>
                                <option value="1B - Amanah" <?php if ($class == 'Amanah') echo 'selected'; ?>>1B - Amanah</option>
                                <option value="2A - Abu Bakar" <?php if ($class == 'Abu Bakar') echo 'selected'; ?>>2A - Abu Bakar</option>
                                <option value="2B - Umar" <?php if ($class == 'Umar') echo 'selected'; ?>>2B - Umar</option>
                                <option value="3A - Iman" <?php if ($class == 'Iman') echo 'selected'; ?>>3A - Iman</option>
                                <option value="3B - Islam" <?php if ($class == 'Islam') echo 'selected'; ?>>3B - Islam</option>
                                <option value="4A - Firdaus" <?php if ($class == 'Firdaus') echo 'selected'; ?>>4A - Firdaus</option>
                                <option value="4B - Naim" <?php if ($class == 'Naim') echo 'selected'; ?>>4B - Naim</option>
                                <option value="5A - Sabar" <?php if ($class == 'Sabar') echo 'selected'; ?>>5A - Sabar</option>
                                <option value="5B - Ikhlas" <?php if ($class == 'Ikhlas') echo 'selected'; ?>>5B - Ikhlas</option>
                                <option value="6A - Ibnu Sinar" <?php if ($class == 'Ibnu Sinar') echo 'selected'; ?>>6A - Ibnu Sinar</option>
                                <option value="6B - Ibnu Rushd" <?php if ($class == 'Ibnu Rushd') echo 'selected'; ?>>6B - Ibnu Rushd</option>
                            </select>
                        </td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>
                            NAMA PELAJAR
                        </td>
                        <td>
                            : 
                        </td>
                        <td>
                            <input type="text" name="name" required placeholder="Student Name" value="<?php echo $name;?>">
                        </td>
                        <td>
                            ID 
                        </td>
                        <td>
                            : 
                        </td>
                        <td>
                            <input type="text" name="studentid" required placeholder="Student ID" value="<?php echo $studentid;?>" readonly>
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
                            <input type="text" name="ic" pattern="[0-9]{12}" required placeholder="010203040506" value="<?php echo $ic;?>" readonly>
                        </td>
                        <td>
                            NO.SURAT BERANAK
                        </td>
                        <td>
                            : 
                        </td>
                        <td>
                            <input type="text" name="nosb" required placeholder="No.Surat Beranak" value="<?php echo $nosb;?>">
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
                            <input type="text" name="dob" value="<?php echo $DOB;?>" required readonly>
                        </td>
                        <td>
                            UMUR
                        </td>
                        <td>
                            : 
                        </td>
                        <td>
                            <input type="text" name="age" value="<?php echo $age;?>" required readonly>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            TEMPAT LAHIR
                        </td>
                        <td>
                            : 
                        </td>
                        <td>
                            <input type="text" name="tempatlahir" value="<?php echo $tempatlahir;?>" required>
                        </td>
                        <td>
                            JANTINA
                        </td>
                        <td>
                            : 
                        </td>
                        <td>
                            <input type="text" name="gender" value="<?php echo $gender;?>" required readonly>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            AGAMA
                        </td>
                        <td>
                            : 
                        </td>
                        <td>
                            <input type="text" name="agama" required placeholder="ISLAM" value="<?php echo $agama;?>">
                        </td>
                        <td>
                            BANGSA
                        </td>
                        <td>
                            : 
                        </td>
                        <td>
                            <select name="race" required>
                                <option value="" <?php if ($race == '') echo 'selected'; ?>>Select Race</option>
                                <option value="Melayu" <?php if ($race == 'Melayu') echo 'selected'; ?>>Melayu</option>
                                <option value="China" <?php if ($race == 'China') echo 'selected'; ?>>China</option>
                                <option value="India" <?php if ($race == 'India') echo 'selected'; ?>>India</option>
                                <option value="lain-lain" <?php if ($race == 'lain-lain') echo 'selected'; ?>>lain-lain</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            ALAMAT
                        </td>
                        <td>
                            : 
                        </td>
                        <td colspan="4">
                            <textarea name="addrss" placeholder="address" required style="width: 400px; height: 113px;"><?php echo $addrss;?></textarea>
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
                            NAMA PENJAGA
                        </td>
                        <td>
                            : 
                        </td>
                        <td>
                            <input type="text" name="namapenjaga" required placeholder="Parent Name" value="<?php echo $namapenjaga;?>">
                        </td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>
                            NO.K/P
                        </td>
                        <td>
                            : 
                        </td>
                        <td>
                            <input type="text" name="icpenjaga" pattern="[0-9]{12}" required placeholder="010203040506" value="<?php echo $icpenjaga;?>">
                        </td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td >
                            PEKERJAAN
                        </td>
                        <td>
                            : 
                        </td>
                        <td>
                            <input type="text" name="pekerjaanpenjaga" required placeholder="Pekerjaan Penjaga" value="<?php echo $pekerjaanpenjaga;?>">
                        </td>
                        <td >
                            PENDAPATAN KELUARGA
                        </td>
                        <td>
                            : 
                        </td>
                        <td>
                            <select name="pincome" required>
                                <option style="font-family: 'Verdana'" value="" <?php if ($pincome == '') echo 'selected'; ?>>Select Parent Income</option>
                                <option value="RM 0 - RM 1000" <?php if ($pincome == 'RM 0 - RM 1000') echo 'selected'; ?>>RM 0 - RM 1000</option>
                                <option value="RM 1001 - RM 1500" <?php if ($pincome == 'RM 1001 - RM 1500') echo 'selected'; ?>>RM 1001 - RM 1500</option>
                                <option value="RM 1501 - RM 2000" <?php if ($pincome == 'RM 1501 - RM 2000') echo 'selected'; ?>>RM 1501 - RM 2000</option>
                                <option value="RM 2001 - RM 2500" <?php if ($pincome == 'RM 2001 - RM 2500') echo 'selected'; ?>>RM 2001 - RM 2500</option>
                                <option value="RM 2501 - RM 3000" <?php if ($pincome == 'RM 2501 - RM 3000') echo 'selected'; ?>>RM 2501 - RM 3000</option>
                                <option value="RM 3001 - RM 3500" <?php if ($pincome == 'RM 3001 - RM 3500') echo 'selected'; ?>>RM 3001 - RM 3500</option>
                                <option value="RM 5501 - RM 4000" <?php if ($pincome == 'RM 5501 - RM 4000') echo 'selected'; ?>>RM 5501 - RM 4000</option>
                                <option value="RM 4001 - RM 4500" <?php if ($pincome == 'RM 4001 - RM 4500') echo 'selected'; ?>>RM 4001 - RM 4500</option>
                                <option value="RM 4501 - RM5000" <?php if ($pincome == 'RM 4501 - RM5000') echo 'selected'; ?>>RM 4501 - RM5000</option>
                                <option value="> RM 5001" <?php if ($pincome == '> RM 5001') echo 'selected'; ?>> &gt; RM 5001</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td >
                            NO.TELEFON
                        </td>
                        <td>
                            : 
                        </td>
                        <td>
                            <input type="text" name="phone" required placeholder="012-3456789" value="<?php echo $phone;?>">
                        </td>
                        <td >
                            EMAIL
                        </td>
                        <td>
                            : 
                        </td>
                        <td>
                            <input type="email" name="email" required placeholder="user@domain" value="<?php echo $email;?>">
                        </td>
                    </tr>
                    <tr>
                        <td >
                            HUBUNGAN DENGAN PELAJAR
                        </td>
                        <td>
                            : 
                        </td>
                        <td>
                            <input type="text" name="hubungan" required placeholder="Ibu" value="<?php echo $hubungan;?>">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <br><br>
                            PASSWORD 
                        </td>
                        <td>
                            : 
                        </td>
                        <td>
                            <input type="text" name="password" placeholder="Password" value="<?php echo $ic?>" readonly>
                        </td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td colspan="6">
                            <br>
                            <center><button type="submit" class="resultButton">Pasti</button></center>
                            <br>
                        </td>
                    </tr>
                </table>
            </div>  
            </center>
        </form>
        <br><br>
	</body>
</html>