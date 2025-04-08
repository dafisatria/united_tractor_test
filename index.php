<?php
$server = "localhost";
$user = "root";
$password = "";
$database = "united_tractor_db";

$koneksi = mysqli_connect($server, $user, $password, $database);

if (!$koneksi) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

$queryProduk = "SELECT id, nama_produk FROM m_product";
$resultProduk = mysqli_query($koneksi, $queryProduk);
$querySales = "SELECT id, nama_sales FROM m_sales";
$resultSales = mysqli_query($koneksi, $querySales);

if (isset($_POST["simpan"])) {
    $tanggal = $_POST["tanggal"];
    $sales = $_POST["sales"];
    $nama = $_POST["nama"];
    $produk = $_POST["produk"];
    $whatsapp = $_POST["whatsapp"];
    $kota = $_POST["kota"];

    $queryLeads = "INSERT INTO t_leads (tanggal, id_sales, id_product, no_wa, nama_lead, kota)
              VALUES ('$tanggal', '$sales', '$produk', '$whatsapp', '$nama', '$kota')";

    $result = mysqli_query($koneksi, $queryLeads);

    if ($result) {
        echo "<script>alert('Data berhasil disimpan');</script>";
    } else {
        die("Error saat insert: " . mysqli_error($koneksi));
    }
}

?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
        rel="stylesheet" />
    <style>
        .form-container {
            margin: 40px auto;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            background-color: white;
        }

        .form-title {
            font-size: 1.5rem;
            margin-bottom: 25px;
            margin-top: 50px;
            font-weight: bold;
        }

        .btn-simpan {
            background-color: #4b4bff;
            color: white;
        }

        .btn-simpan:hover {
            background-color: #3737d6;
            color: white;
        }
    </style>
</head>

<body class="bg-light">
    <div class="container">
        <div class="form-title">Selamat Datang Di Tambah Leads</div>
        <div class="form-container">
            <form method="POST">
                <div class="row mb-3">
                    <div class="col-md-4">
                        <label for="tanggal" class="form-label">Tanggal</label>
                        <input type="date" class="form-control" id="tanggal" name="tanggal" />
                    </div>
                    <div class="col-md-4">
                        <label for="sales" class="form-label">Sales</label>
                        <select class="form-select" id="sales" name="sales">
                            <option selected disabled>--Pilih Sales--</option>
                            <?php while ($row = mysqli_fetch_assoc($resultSales)) : ?>
                                <option value="<?= $row['id'] ?>"><?= htmlspecialchars($row['nama_sales']) ?></option>
                            <?php endwhile; ?>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label for="nama" class="form-label">Nama Lead</label>
                        <input
                            type="text"
                            class="form-control"
                            id="nama"
                            name="nama"
                            placeholder="Nama Lead" />
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-4">
                        <label for="produk" class="form-label">Produk</label>
                        <select class="form-select" id="produk" name="produk">
                            <option selected disabled>--Pilih Produk--</option>
                            <?php while ($row = mysqli_fetch_assoc($resultProduk)) : ?>
                                <option value="<?= $row['id'] ?>"><?= htmlspecialchars($row['nama_produk']) ?></option>
                            <?php endwhile; ?>
                        </select>

                    </div>
                    <div class="col-md-4">
                        <label for="whatsapp" class="form-label">No. Whatsapp</label>
                        <input
                            type="text"
                            class="form-control"
                            id="whatsapp"
                            name="whatsapp"
                            placeholder="No. Whatsapp" />
                    </div>
                    <div class="col-md-4">
                        <label for="kota" class="form-label">Kota</label>
                        <input
                            type="text"
                            class="form-control"
                            id="kota"
                            name="kota"
                            placeholder="Asal Kota" />
                    </div>
                </div>
                <div class="d-flex justify-content-center gap-3">
                    <button type="submit" name="simpan" value="submit" class="btn btn-simpan px-4">Simpan</button>
                    <button type="reset" class="btn btn-outline-secondary px-4">
                        Cancel
                    </button>
                </div>
            </form>
        </div>
    </div>
</body>

</html>