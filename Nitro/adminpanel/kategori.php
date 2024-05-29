<?php
    require "session.php";
    require "../connection/koneksi.php";

    $queryKategori = mysqli_query($con, "SELECT * FROM kategori");
    $jumlahKategori = mysqli_num_rows($queryKategori);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kategori | Admin</title>
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../fontawesome/css/fontawesome.min.css">
    <link rel="stylesheet" href="../css/style2.css">
</head>

<style>
    .no-decor{
        text-decoration: none;
    }
</style>

<body>
    <?php require "navbar.php"; ?>
    <div class="container mt-5">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">
                    <a href="../adminpanel/index.php" class="no-decor text-muted">
                        <i class="fas fa-home"></i> Home
                    </a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                    <i class="fas fa-book"></i> Kategori
                </li>
            </ol>
        </nav>

        <div class="my-5 col-12 col-md-6">
            <h4>Tambah Data</h4>

            <form action="" method="post">
                <div>
                    <label for="kategori">Kategori</label>
                    <input type="text" id="kategori" name="kategori" placeholder="Input Kategori" class="form-control">
                </div>
                <div class="mt-2">
                    <button class="btn btn-primary" type="submit" name="simpan">Submit</button>
                </div>
            </form>

            <?php
                if(isset($_POST['simpan'])){
                    $kategori = htmlspecialchars($_POST['kategori']);

                    $queryExist = mysqli_query($con, "SELECT nama FROM kategori WHERE nama='$kategori'");
                    $jumlahKategoriBaru = mysqli_num_rows($queryExist);
                    
                    if($jumlahKategoriBaru > 0){
                        ?>
                            <div class="alert alert-danger mt-2" role="alert">
                                Data tersebut sudah ada!
                            </div>
                        <?php
                    }
                    else{
                        $querySimpan = mysqli_query($con, "INSERT INTO kategori (nama) VALUES('$kategori')");
                        if($querySimpan){
                            ?>
                            <div class="alert alert-success mt-3" role="alert">
                                Data berhasil disimpan!
                            </div>
                            <meta http-equiv="refresh" content="1; url=kategori.php" />
                            <?php
                        }
                        else{
                            echo mysqli_error($con);
                        }
                    }
                }
            ?>

            
        </div>

        <div class="mt-3">
            <h2>List Kategori</h2>

            <div class="table-responsive mt-4">
                <table class="table">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Nama</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            if($jumlahKategori == 0){
                        ?>
                                <tr>
                                    <td colspan=3 class="text-center">Tidak Tersedia</td>
                                </tr>
                        <?php
                            }
                            else{
                                $jumlah = 1;
                                while($data = mysqli_fetch_array($queryKategori)){
                        ?>
                                    <tr>
                                        <td><?php echo $jumlah; ?></td>
                                        <td><?php echo $data['nama']; ?></td>
                                        <td> 
                                            <a href="detail.php?p=<?php echo $data['id']; ?>" class="btn btn-info"><i class="fas fa-search"></i></a>
                                        </td>
                                    </tr>
                        <?php   
                                $jumlah++;
                                }
                            }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>        

    </div>
    
    <?php require "../userpanel/footer.php"; ?>
    <script src="../bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../fontawesome/js/all.min.js"></script>
</body>
</html>