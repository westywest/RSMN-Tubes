<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css">
    <link rel="stylesheet" href="../assets/style_admin.css">
    <title>Berita | Admin Panel</title>
</head>
<body>
    <?php
        session_start();
        if(isset($_SESSION['status']) != "login"){
            header("location:/RSMN");
        }
        if(isset($_POST['logout'])){
            session_destroy();
            header("location:/RSMN/rsmn/user-login.php");
        }
        if(isset($_POST['home'])){
            header("location:/RSMN");
        }
        include("../../koneksi/config.php");
        if(isset($_POST['submit'])){
            $full_name = $_POST['full_name'];
            $spesialis = $_POST['spesialis'];
            $keluhan = $_POST['keluhan'];
            
            
            $sql   = "INSERT INTO registrasipasien (id, full_name, spesialis, keluhan, time_register) VALUES (null, '$full_name', '$spesialis', '$keluhan', CURRENT_TIMESTAMP());";
            $datas = $con->query($sql);

            if(mysqli_affected_rows($con) > 0){
                header("Location:pendaftaran.php");
            }else{
                $_SESSION['error'] = "Pendaftaran gagal!";
            }
        }
        
    ?>

    <div class="container-fluid">
        <div class="row">
            <div class="d-flex flex-column flex-shrink-0 p-3 sidebar" style="width: 260px;">
                <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto link-dark text-decoration-none">
                    <span class="fs-4">Halaman Pasien</span>
                </a>
                <hr>
                <ul class="nav nav-pills flex-column mb-auto">
                    <li class="nav-item">
                        <a href="/RSMN/rsmn/pasien/dashboard.php" class="nav-link link-dark" aria-current="page">
                            <svg class="bi pe-none me-2" width="16" height="16"><use xlink:href="#home"></use></svg>
                            Dashboard
                        </a>
                    </li>
                    <li>
                        <a href="#"  class="nav-link active">
                            <svg class="bi pe-none me-2" width="16" height="16"><use xlink:href="#speedometer2"></use></svg>
                            Pendaftaran Pelayanan
                        </a>
                    </li>
                    <li>
                        <a href="#" class="nav-link link-dark">
                            <svg class="bi pe-none me-2" width="16" height="16"><use xlink:href="#table"></use></svg>
                            Layanan Anda
                        </a>
                    </li>
                    <li>
                        <a href="#" class="nav-link link-dark">
                            <svg class="bi pe-none me-2" width="16" height="16"><use xlink:href="#grid"></use></svg>
                            History Layanan
                        </a>
                    </li>
                </ul>
                <hr>
                <div class="dropdown">
                    <a href="#" class="d-flex align-items-center link-dark text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fa-solid fa-user"></i>
                        <strong style="text-transform:uppercase; margin-left: 9px;"><?php echo($_SESSION['username']) ?></strong>
                    </a>
                    <ul class="dropdown-menu text-small shadow" data-popper-placement="top-start" style="position: absolute; inset: auto auto 0px 0px; margin: 0px; transform: translate3d(0px, -33.6px, 0px);">
                        <li>
                            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                                <button class="dropdown-item" type="submit" name="home">Home</button>
                                <button class="dropdown-item" type="submit" name="logout">Logout</button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 py-4">
            <div class="container-fluid">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.php">Pendaftaran</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Menambahkan Data</li>
                    </ol>
                </nav>
                <h1 class="h2">Menambahkan Data</h1>
                <p>Anda sedang menambahkan data baru.</p>

                <div class="card">
                    <div class="card-body">
                    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
                            <div class="mb-3">
                                <label for="title" class="form-label">Nama Lengkap</label>
                                <input type="text" class="form-control" id="full_name" name="full_name" placeholder="Nama Lengkap" required>
                            </div>
                            <div class="mb-3">
                                <label for="spesialis" class="form-label">Pilih Dokter Spesialisasi</label>
                                <select class="form-select" aria-label="Default select example" name="spealis" required>
                                    <option>--Pilih Dokter--</option>
                                    <?php
                                        $query = mysqli_query($con, "SELECT * FROM dokter") or die (mysqli_error($con));
                                        while($data = mysqli_fetch_array($query)){
                                            echo "<option value=$data[id]>$data[full_name] - (Spesialis $data[spesialis])</option>";
                                        }
                                    ?>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="content" class="form-label">Keluhan Pasien</label>
                                <textarea class="form-control" id="content" name="content" rows="3"></textarea>
                            </div>
                            <p style="color:red; font-size: 12px;"><?php if(isset($_SESSION['error'])){ echo($_SESSION['error']);} ?></p>
                            <button class="btn btn-primary my-3" type="submit" name="submit" style="color: white;">Daftar</button>
                        </form>
                    </div>
                </div>
                <footer class="pt-5 d-flex justify-content-between">
                    <span>Copyright © 2023 <a href="#">RSMN.</a></span>
                    <ul class="nav m-0">
                        <li class="nav-item">
                            <a class="nav-link text-secondary"href="#">Hubungi Kami</a>
                        </li>
                    </ul>
                </footer>
            </div>
        </main>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/fontawesome.min.css"></script>
    
</body>
</html>