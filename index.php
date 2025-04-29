    <?php
    include 'koneksi.php';

    if (isset($_POST['tambah'])) {
        $nama_lengkap = $_POST['nama_lengkap'];
        $alamat_email = $_POST['alamat_email'];
        $tanggal_lahir = $_POST['tanggal_lahir'];
        $nomor_telepon = $_POST['nomor_telepon'];
        $program_studi = $_POST['program_studi'];

        $nama_tabel = "crud_" . substr("F1D02310128", -3);

        $query = "INSERT INTO $nama_tabel (nama_lengkap, alamat_email, tanggal_lahir, nomor_telepon, program_studi) VALUES (?, ?, ?, ?, ?)";
        $stmt = $koneksi->prepare($query);
        $stmt->bind_param("sssss", $nama_lengkap, $alamat_email, $tanggal_lahir, $nomor_telepon, $program_studi);

        if ($stmt->execute()) {
            echo "<script>alert('Data berhasil ditambahkan.'); window.location.href='index.php';</script>";
        } else {
            echo "<script>alert('Gagal menambahkan data: " . $stmt->error . "');</script>";
        }
        $stmt->close();
    }

    if (isset($_GET['hapus'])) {
        $id = $_GET['hapus'];
        $nama_tabel = "crud_" . substr("F1D02310128", -3);

        $query = "DELETE FROM $nama_tabel WHERE id=?";
        $stmt = $koneksi->prepare($query);
        $stmt->bind_param("i", $id);

        if ($stmt->execute()) {
            echo "<script>alert('Data berhasil dihapus.'); window.location.href='index.php';</script>";
        } else {
            echo "<script>alert('Gagal menghapus data: " . $stmt->error . "');</script>";
        }
        $stmt->close();
    }

    $nama_tabel = "crud_" . substr("F1D02310128", -3);
    $result = $koneksi->query("SELECT * FROM $nama_tabel");
    ?>

    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>CRUD F1D02310128</title>
        <link rel="stylesheet" href="style.css">
        </head>
    <body>
        <h1>Data Mahasiswa</h1>
        <h2>Tambah Data Baru</h2>
        <form method="POST">
            <label for="nama_lengkap">Nama Lengkap:</label>
            <input type="text" name="nama_lengkap" id="nama_lengkap" required><br><br>
            <label for="alamat_email">Email:</label>
            <input type="email" name="alamat_email" id="alamat_email" required><br><br>
            <label for="tanggal_lahir">Tanggal Lahir:</label>
            <input type="date" name="tanggal_lahir" id="tanggal_lahir"><br><br>
            <label for="nomor_telepon">Nomor Telepon:</label>
            <input type="text" name="nomor_telepon" id="nomor_telepon"><br><br>
            <label for="program_studi">Program Studi:</label>
            <input type="text" name="program_studi" id="program_studi"><br><br>
            <input type="submit" name="tambah" value="Simpan">
            </form>
        <hr>
        <h2>Daftar Mahasiswa</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama Lengkap</th>
                    <th>Email</th>
                    <th>Tanggal Lahir</th>
                    <th>Nomor Telepon</th>
                    <th>Program Studi</th>
                    <th>Edit</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row['id'] . "</td>";
                        echo "<td>" . $row['nama_lengkap'] . "</td>";
                        echo "<td>" . $row['alamat_email'] . "</td>";
                        echo "<td>" . $row['tanggal_lahir'] . "</td>";
                        echo "<td>" . $row['nomor_telepon'] . "</td>";
                        echo "<td>" . $row['program_studi'] . "</td>";
                        echo "<td><a href='edit.php?id=" . $row['id'] . "'>Edit</a> | <a href='index.php?hapus=" . $row['id'] . "' onclick='return confirm(\"Apakah Anda yakin ingin menghapus data ini?\")'>Hapus</a></td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='7'>Tidak ada data.</td></tr>";
                }
                ?>
            </tbody>
            </table>
        <script>
            function confirmHapus() {
                return confirm("Apakah Anda yakin ingin menghapus data ini?");
            }
        </script>
    </body>
    </html>