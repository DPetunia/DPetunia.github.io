<?php
    // Create the "acc" table if it doesn't exist
    $createTableSQL = "CREATE TABLE IF NOT EXISTS acc (
        id INT AUTO_INCREMENT PRIMARY KEY,
        UserId VARCHAR(255) NOT NULL,
        UserPass VARCHAR(255) NOT NULL,
        UserCat VARCHAR(255) NOT NULL
    )";
    if ($conn->query($createTableSQL) === false) {
        echo "Error creating 'acc' table: " . $conn->error;
    }

    // Create the "student" table if it doesn't exist
    $createTableSQL = "CREATE TABLE IF NOT EXISTS student (
        id INT AUTO_INCREMENT PRIMARY KEY,
        class VARCHAR(255) NOT NULL,
        NamaPelajar VARCHAR(255) NOT NULL,
        IdPelajar VARCHAR(255) NOT NULL,
        MyKidPelajar VARCHAR(12) NOT NULL,
        SuratBeranak VARCHAR(12) NOT NULL,
        Alamat VARCHAR(255) NOT NULL,
        TarikhLahir VARCHAR(255) NOT NULL,
        TempatLahir VARCHAR(255) NOT NULL,
        Umur VARCHAR(255) NOT NULL,
        Jantina VARCHAR(255) NOT NULL,
        Agama VARCHAR(255) NOT NULL,
        Bangsa VARCHAR(255) NOT NULL,
        NamaPenjaga VARCHAR(255) NOT NULL,
        IcPenjaga VARCHAR(255) NOT NULL,
        PhonePenjaga VARCHAR(255) NOT NULL,
        PekerjaanPenjaga VARCHAR(255) NOT NULL,
        PendapatanKeluarga VARCHAR(255) NOT NULL,
        EmailPenjaga VARCHAR(255) NOT NULL,
        Hubungan VARCHAR(255) NOT NULL
    )";
    if ($conn->query($createTableSQL) === false) {
        echo "Error creating 'student' table: " . $conn->error;
    }

    // Create the "staff" table if it doesn't exist
    $createTableSQL = "CREATE TABLE IF NOT EXISTS staff (
        id INT AUTO_INCREMENT PRIMARY KEY,
        UserName VARCHAR(255) NOT NULL,
        UserId VARCHAR(255) NOT NULL,
        UserIc VARCHAR(12) NOT NULL,
        UserDOB VARCHAR(255) NOT NULL,
        UserAge VARCHAR(255) NOT NULL,
        UserGender VARCHAR(6) NOT NULL,
        UserSOB VARCHAR(255) NOT NULL,
        UserPhone VARCHAR(255) NOT NULL,
        UserEmail VARCHAR(255) NOT NULL,
        UserRace VARCHAR(255) NOT NULL,
        UserAdd VARCHAR(255) NOT NULL
    )";
    if ($conn->query($createTableSQL) === false) {
        echo "Error creating 'staff' table: " . $conn->error;
    }

    // Create the "admn" table if it doesn't exist
    $createTableSQL = "CREATE TABLE IF NOT EXISTS admn (
        id INT AUTO_INCREMENT PRIMARY KEY,
        UserName VARCHAR(255) NOT NULL,
        UserId VARCHAR(255) NOT NULL,
        UserIc VARCHAR(12) NOT NULL,
        UserDOB VARCHAR(255) NOT NULL,
        UserAge VARCHAR(255) NOT NULL,
        UserGender VARCHAR(6) NOT NULL,
        UserSOB VARCHAR(255) NOT NULL,
        UserPhone VARCHAR(255) NOT NULL,
        UserEmail VARCHAR(255) NOT NULL,
        UserRace VARCHAR(255) NOT NULL,
        UserAdd VARCHAR(255) NOT NULL
    )";
    if ($conn->query($createTableSQL) === false) {
        echo "Error creating 'admn' table: " . $conn->error;
    }

    // Create the "att" table if it doesn't exist
    $createTableSQL = "CREATE TABLE IF NOT EXISTS att (
        id INT AUTO_INCREMENT PRIMARY KEY,
        class VARCHAR(255) NOT NULL,
        NamaPelajar VARCHAR(255) NOT NULL,
        MyKidPelajar VARCHAR(255) NOT NULL,
        kehadiran VARCHAR(255) NOT NULL,
        hari VARCHAR(255) NOT NULL,
        bulan VARCHAR(255) NOT NULL,
        tahun VARCHAR(255) NOT NULL,
        NamaGuru VARCHAR(255) NOT NULL
    )";
    if ($conn->query($createTableSQL) === false) {
        echo "Error creating 'att' table: " . $conn->error;
    }

    // Create the "att" table if it doesn't exist
    $createTableSQL = "CREATE TABLE IF NOT EXISTS mc (
            id INT AUTO_INCREMENT PRIMARY KEY,
            namaguru VARCHAR(225) NOT NULL,
            class VARCHAR(225) NOT NULL,
            hari VARCHAR(225) NOT NULL,
            bulan VARCHAR(225) NOT NULL,
            tahun VARCHAR(225) NOT NULL,
            namaPelajar VARCHAR(225) NOT NULL,
            mykid VARCHAR(225) NOT NULL,
            kehadiran VARCHAR(225) NOT NULL,
            sebab TEXT NOT NULL,
            mc_image LONGBLOB NOT NULL
    )";
    if ($conn->query($createTableSQL) === false) {
        echo "Error creating 'att' table: " . $conn->error;
    }

    // Insert administrator account if it doesn't exist
    $UserId = "admin";
    $UserPass = "admin";
    $UserCat = "admin";

    // Check if the admin account already exists
    $checkAdminSQL = "SELECT * FROM acc WHERE UserId=?";
    $stmt = $conn->prepare($checkAdminSQL);
    $stmt->bind_param("s", $UserId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 0) {
        // Insert admin account into acc table
        $insertAdminSQL = "INSERT INTO acc (UserId, UserPass, UserCat) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($insertAdminSQL);
        $stmt->bind_param("sss", $UserId, $UserPass, $UserCat);
        if ($stmt->execute() === false) {
            echo "Error inserting data into 'acc' table: " . $stmt->error;
        }
        
        // Variables for the admin account insertion into admn table
        $UserName = "Administrator";
        $UserEmail = "administrator@madrasahannur.com";
        $UserAdd = "Admin Madrasah Annur";
        $UserIc = "-";
        $UserDOB = "-";
        $UserAge = "-";
        $UserGender = "-";
        $UserSOB = "-";
        $UserPhone = "04-6380511";
        $UserRace = "-";

        // Insert admin account into admn table
        $insertAdminSQL = "INSERT INTO admn (UserName, UserId, UserIc, UserDOB, UserAge, UserGender, UserSOB, UserPhone, UserEmail, UserRace, UserAdd) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($insertAdminSQL);
        $stmt->bind_param("sssssssssss", $UserName, $UserId, $UserIc, $UserDOB, $UserAge, $UserGender, $UserSOB, $UserPhone, $UserEmail, $UserRace, $UserAdd);
        if ($stmt->execute() === false) {
            echo "Error inserting data into 'admn' table: " . $stmt->error;
        }
    }
?>
