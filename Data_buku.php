<!DOCTYPE html>
    <html>
    <head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
        <title>Table</title>
        <style>
            table, th, td {
                border: 1px solid black;
                border-collapse: collapse;
            }
        </style>
    </head>
    <body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="home.php">Navbar</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="home.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="index.php">Login</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Dropdown
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href="#">Action</a></li>
            <li><a class="dropdown-item" href="#">Another action</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="#">Something else here</a></li>
          </ul>
        </li>
        <li class="nav-item">
          <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
        </li>
      </ul>
      <form class="d-flex">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success" type="submit">Search</button>
      </form>
    </div>
  </div>
</nav>
        <center>
            <img src="banner-buku.webp" width="100%" height="auto">
                    <form method="post" action="index.php">
                    <select name="urutan">
                        <option>Urutkan Berdasarkan
                        <option value="no_asc">No (naik) 
                        <option value="no_desc">No (turun) 
                        <option value="title_asc">Title (A - Z) 
                        <option value="title_desc">Title (Z - A) 
                        <option value="genre_asc">Genre (A - Z) 
                        <option value="genre_desc">Genre (Z - A) 
                        <option value="year_asc">Year (naik) 
                        <option value="year_desc">Year (turun) 
                        <option value="author_asc">Author (A - Z)
                        <option value="author_desc">Author (Z - A)
                        <option value="nationality_asc">Nationality (A - Z) 
                        <option value="nationality_desc">Nationality (Z - A)
                        <option value="sold_asc">Sold (naik)
                        <option value="sold_desc">Sold (turun)
                </select>
            <input type="submit" name="tombol_urutan" value="Urutkan" class="btn btn-info btn-sm">
            </form>
            <br>
            <form method="post" action="search.php">
                <input name="cari" placeholder="kata kunci...">
                <input type="submit" name="tombol_cari" value="cari!!!" class="btn btn-warning btn-sm">   
            </form>
            <br>
            <table class="table table-striped table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th>NO</th>
                        <th>TITLE</th>
                        <th>GENRE</th>
                        <th>PUBLISHED YEAR</th>
                        <th>AUTHOR</th>
                        <th>AUTHOR NATIONALITY</th>
                        <th>SOLD (MILLION EXEMPLAR)</th>
                        <th>ACTION</th>
                    </tr>
                </thead>
                <tbody>
                
                <?php
                include 'koneksi.php'; 

                if (!isset($koneksi)) {
                    die("Koneksi gagal: variabel \$koneksi tidak terdefinisi.");
                }

                // Inisialisasi query default
                $kueri = "SELECT * FROM buku";

                if(isset($_POST['tombol_urutan'])) {
                    $urutan = $_POST["urutan"];
                    $kueri = match($urutan) {
                        "no_asc" => "SELECT * FROM buku ORDER BY no ASC",
                        "no_desc" => "SELECT * FROM buku ORDER BY no DESC",
                        "title_asc" => "SELECT * FROM buku ORDER BY title ASC",
                        "title_desc" => "SELECT * FROM buku ORDER BY title DESC",
                        "genre_asc" => "SELECT * FROM buku ORDER BY genre ASC",
                        "genre_desc" => "SELECT * FROM buku ORDER BY genre DESC",
                        "year_asc" => "SELECT * FROM buku ORDER BY year ASC",
                        "year_desc" => "SELECT * FROM buku ORDER BY year DESC",
                        "author_asc" => "SELECT * FROM buku ORDER BY author ASC",
                        "author_desc" => "SELECT * FROM buku ORDER BY author DESC",
                        "nationality_asc" => "SELECT * FROM buku ORDER BY nationality ASC",
                        "nationality_desc" => "SELECT * FROM buku ORDER BY nationality DESC",
                        "sold_asc" => "SELECT * FROM buku ORDER BY sold ASC",
                        "sold_desc" => "SELECT * FROM buku ORDER BY sold DESC",
                        default => "SELECT * FROM buku"
                    };
                } else if(isset($_POST['tombol_cari'])) {
                    $cari = mysqli_real_escape_string($koneksi, $_POST['cari']); // Mencegah SQL injection
                    $kueri = "SELECT * FROM buku WHERE 
                              no = '$cari' OR
                              title LIKE '%$cari%' OR
                              genre LIKE '%$cari%' OR
                              year = '$cari' OR
                              author LIKE '%$cari%' OR
                              nationality LIKE '%$cari%' OR
                              sold = '$cari'";
                }

                // Eksekusi query
                $go = mysqli_query($koneksi, $kueri);

                // Periksa apakah query berhasil
                if (!$go) {
                    die("Query error: " . mysqli_error($koneksi));
                }

                // Tampilkan data
                if (mysqli_num_rows($go) > 0) {
                    while($kolom = mysqli_fetch_array($go)) {
                        echo '<tr>';
                        echo '<td>' . htmlspecialchars($kolom['no']) . '</td>';
                        echo '<td>' . htmlspecialchars($kolom['title']) . '</td>';
                        echo '<td>' . htmlspecialchars($kolom['genre']) . '</td>';
                        echo '<td>' . htmlspecialchars($kolom['year']) . '</td>';
                        echo '<td>' . htmlspecialchars($kolom['author']) . '</td>';
                        echo '<td>' . htmlspecialchars($kolom['nationality']) . '</td>';
                        echo '<td>' . htmlspecialchars($kolom['sold']) . '</td>';
                        echo '<td><a href="update.php?kunci=' . htmlspecialchars($kolom['no']) . '">update</a></td>';
                        echo '</tr>';
                    }
                } else {
                    echo '<tr><td colspan="8">Tidak ada data yang ditemukan</td></tr>';
                }
                ?>
            </table>
        </center>
    </body>
    </html>