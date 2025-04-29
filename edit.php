<?php
include 'koneksi.php';

$nama_tabel = "crud_" . substr("F1D02310128", -3); // Ganti dengan cara Anda mendapatkan 3 digit terakhir NIM

// Ambil Data Berdasarkan ID untuk Edit
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "SELECT * FROM $nama_tabel WHERE id=?";
    $stmt = $koneksi->prepare($query);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $data = $result->fetch_assoc();
    $stmt->close();

    if (!$data) {
        echo "Data tidak ditemukan.";
        exit;
    }
} else {
    echo "ID tidak valid.";
    exit;
}

// Proses Update Data
if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $nama_lengkap = $_POST['nama_lengkap'];
    $alamat_email = $_POST['alamat_email'];
    $tanggal_lahir = $_POST['tanggal_lahir'];
    $nomor_telepon = $_POST['nomor_telepon'];
    $program_studi = $_POST['program_studi'];

    $query = "UPDATE $nama_tabel SET nama_lengkap=?, alamat_email=?, tanggal_lahir=?, nomor_telepon=?, program_studi=? WHERE id=?";
    $stmt = $koneksi->prepare($query);
    $stmt->bind_param("sssssi", $nama_lengkap, $alamat_email, $tanggal_lahir, $nomor_telepon, $program_studi, $id);

    if ($stmt->execute()) {
        echo "<script>alert('Data berhasil diupdate.'); window.location.href='index.php';</script>";
    } else {
        echo "<script>alert('Gagal mengupdate data: " . $stmt->error . "');</script>";
    }
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data</title>
    <link rel="stylesheet" href="style.css"> </head>
<body>
    <h1>Edit Data Mahasiswa</h1>

    <form method="POST">
        <input type="hidden" name="id" value="<?php echo $data['id']; ?>">

        <label for="nama_lengkap">Nama Lengkap:</label>
        <input type="text" name="nama_lengkap" value="<?php echo $data['nama_lengkap']; ?>" required><br><br>

        <label for="alamat_email">Email:</label>
        <input type="email" name="alamat_email" value="<?php echo $data['alamat_email']; ?>" required><br><br>

        <label for="tanggal_lahir">Tanggal Lahir:</label>
        <input type="date" name="tanggal_lahir" value="<?php echo $data['tanggal_lahir']; ?>"><br><br>

        <label for="nomor_telepon">Nomor Telepon:</label>
        <input type="text" name="nomor_telepon" value="<?php echo $data['nomor_telepon']; ?>"><br><br>

        <label for="program_studi">Jurusan:</label>
        <input type="text" name="program_studi" value="<?php echo $data['program_studi']; ?>"><br><br>

        <input type="submit" name="update" value="Update">
        <a href="index.php">Batal</a>
    </form>
</body>
</html>

<?php
$koneksi->close();
?>