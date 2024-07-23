<?php
// Include the database connection file
include('db/conection.php');

// Get POST data
$id = $_POST['id'];
$userCat = $_POST['userCat'];
$userName = $_POST['userName'];

$class = $_POST['class'];
$NamaPelajar = $_POST['name'];
$studentid = $_POST['studentid'];
$MyKidPelajar = $_POST['ic'];
$SuratBeranak = $_POST['nosb'];
$TarikhLahir = $_POST['dob'];
$Umur = $_POST['age'];
$TempatLahir = $_POST['tempatlahir'];
$Jantina = $_POST['gender'];
$Agama = $_POST['agama'];
$Bangsa = $_POST['Bangsa'];
$Alamat = $_POST['addrss'];
$NamaPenjaga = $_POST['namapenjaga'];
$IcPenjaga = $_POST['icpenjaga'];
$PekerjaanPenjaga = $_POST['pekerjaanpenjaga'];
$PendapatanKeluarga = $_POST['PendapatanKeluarga'];
$PhonePenjaga = $_POST['phone'];
$EmailPenjaga = $_POST['email'];
$Hubungan = $_POST['hubungan'];

// Check if an image file was uploaded
if (isset($_FILES['gambar']) && $_FILES['gambar']['error'] === UPLOAD_ERR_OK) {
    // Get the uploaded file details
    $image = $_FILES['gambar'];
    $GambarPelajar = file_get_contents($image['tmp_name']);
    $imageName = $image['name'];

    // SQL to update student data
    $sql = "UPDATE student SET 
    class = ?, 
    NamaPelajar = ?, 
    IdPelajar = ?,
    MyKidPelajar = ?,
    SuratBeranak = ?, 
    TarikhLahir = ?,
    Umur = ?,
    TempatLahir = ?, 
    Jantina = ?, 
    Agama = ?, 
    Bangsa = ?, 
    Alamat = ?, 
    NamaPenjaga = ?, 
    IcPenjaga = ?, 
    PekerjaanPenjaga = ?, 
    PendapatanKeluarga = ?, 
    PhonePenjaga = ?, 
    EmailPenjaga = ?, 
    Hubungan = ?,
    GambarPelajar = ?
  WHERE IdPelajar = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssssssssssssssssss", 
                      $class, $NamaPelajar, $studentid, $MyKidPelajar, $SuratBeranak, 
                      $TarikhLahir, $Umur, $TempatLahir, $Jantina, $Agama, 
                      $Bangsa, $Alamat, $NamaPenjaga, $IcPenjaga, $PekerjaanPenjaga, 
                      $PendapatanKeluarga, $PhonePenjaga, $EmailPenjaga, $Hubungan, 
                      $GambarPelajar, $studentid);

    if ($stmt->execute()) {
        echo "Your Detail updated successfully.... Image Updated...";
        echo "<form id='redirectForm' method='post' action='kemaskiniprofil.php'>
          <input type='hidden' name='userCat' value='$userCat'>
          <input type='hidden' name='userName' value='$userName'>
          <input type='hidden' name='id' value='$id'>
        </form>
            <script type='text/javascript'>
              setTimeout(function() {
              document.getElementById('redirectForm').submit();
              }, 2000);
            </script>";
    } else {
        echo "Error updating record: " . $stmt->error;
    }
    $stmt->close();
    exit();
} else {
    // SQL to update student data without image
    $sql = "UPDATE student SET 
    class = ?, 
    NamaPelajar = ?, 
    IdPelajar = ?,
    MyKidPelajar = ?,
    SuratBeranak = ?, 
    TarikhLahir = ?,
    Umur = ?,
    TempatLahir = ?, 
    Jantina = ?, 
    Agama = ?, 
    Bangsa = ?, 
    Alamat = ?, 
    NamaPenjaga = ?, 
    IcPenjaga = ?, 
    PekerjaanPenjaga = ?, 
    PendapatanKeluarga = ?, 
    PhonePenjaga = ?, 
    EmailPenjaga = ?, 
    Hubungan = ?
  WHERE IdPelajar = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssssssssssssssssss", 
                      $class, $NamaPelajar, $studentid, $MyKidPelajar, $SuratBeranak, 
                      $TarikhLahir, $Umur, $TempatLahir, $Jantina, $Agama, 
                      $Bangsa, $Alamat, $NamaPenjaga, $IcPenjaga, $PekerjaanPenjaga, 
                      $PendapatanKeluarga, $PhonePenjaga, $EmailPenjaga, $Hubungan, 
                      $studentid);

    if ($stmt->execute()) {
        echo "Your Detail updated successfully... No Image Updated...";
        echo "<form id='redirectForm' method='post' action='kemaskiniprofil.php'>
          <input type='hidden' name='userCat' value='$userCat'>
          <input type='hidden' name='userName' value='$userName'>
          <input type='hidden' name='id' value='$id'>
        </form>
            <script type='text/javascript'>
              setTimeout(function() {
              document.getElementById('redirectForm').submit();
              }, 2000);
            </script>";
    } else {
        echo "Error updating record: " . $stmt->error;
    }
    $stmt->close();
    exit();
}

$conn->close();
?>
