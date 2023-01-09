<?php 

// koneksi
$host = 'localhost';
$username ='root';
$password = '';
$db = 'project_monitoring';
$koneksi_db = mysqli_connect($host, $username, $password, $db);

echo $koneksi_db ? "<script>console.log('Koneksi berhasil')</script>" : mysqli_connect_error();

// function query

function query($query) {
    global $koneksi_db;
    $result = mysqli_query($koneksi_db, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }

    return $rows;
}

// function tambah

function tambah($data){
    global $koneksi_db;
    $project_name = htmlspecialchars($data['project_name']);
    $client = htmlspecialchars($data['client']);
    $leader = htmlspecialchars($data['leader']);
    $leader_email = htmlspecialchars($data['leader_email']);
    $leader_photo = upload();
    $start_date = htmlspecialchars($data['start_date']);
    $end_date = htmlspecialchars($data['end_date']);
    $progress = htmlspecialchars($data['progress']);

    // $query = 'INSERT INTO project VALUES ("", "'.$project_name.'", "'.$client.'", "'.$leader.'", "'.$leader_email.'", "'.$start_date.'", "'.$end_date.'", "'.$progress.'", "'.$leader_photo.'")';

    $query = "INSERT INTO project VALUES ('', '$project_name', '$client', '$leader', '$leader_email',  '$leader_photo' ,'$start_date', '$end_date', '$progress')";

    mysqli_query($koneksi_db, $query);

    return mysqli_affected_rows($koneksi_db);
}

// function upload

function upload()
{

    $nama_file = $_FILES['leader_photo']['name'];
    $ukuran_file = $_FILES['leader_photo']['size'];
    $error = $_FILES['leader_photo']['error'];
    $tmp_name = $_FILES['leader_photo']['tmp_name'];

    // cek bahwa file yang diupload tidak kosong
    if ($error === 4) {
        echo "  <script>
                    alert('leader_photo yang diupload kosong !');
                    document.location.href = 'index.php';
                </script>";
        die;
    }

    $ekstensi_leader_photo_valid = ['jpg', 'jpeg', 'png'];
    $ekstensi_leader_photo = explode('.', $nama_file);
    $ekstensi_leader_photo = strtolower(end($ekstensi_leader_photo));

    // cek bahwa ekstensi file sesuai dengan yang ditentukan
    if (!in_array($ekstensi_leader_photo, $ekstensi_leader_photo_valid)) {
        echo "  <script>
                    alert('leader_photo yang diupload bukan leader_photo !');
                    document.location.href = 'index.php';
                </script>";
        die;
    }
    

    // cek bahwa ukuran file tidak lebih dari ukuran yang diinginkan
    if ($ukuran_file > 5000000) {
        echo "  <script>
                    alert('leader_photo yang diupload terlalu besar ukurannya !');
                    document.location.href = 'index.php';
                </script>";
        die;
    }


    // Membuat Nama File Baru menjadi random
    $nama_file_baru = uniqid();
    $nama_file_baru .= '.';
    $nama_file_baru .= $ekstensi_leader_photo;

    // Mengirim file yang diupload ke tempat yang diinginkan
    move_uploaded_file($tmp_name, '../assets/img/' . $nama_file_baru);

    return $nama_file_baru;
}

// function hapus

function hapus($id){
    global $koneksi_db;
    mysqli_query($koneksi_db, "DELETE FROM project WHERE id = $id");
    return mysqli_affected_rows($koneksi_db);
}


// function ubah

function ubah($data){
    global $koneksi_db;
    $id = $data['id'];
    $project_name = htmlspecialchars($data['project_name']);
    $client = htmlspecialchars($data['client']);
    $leader = htmlspecialchars($data['leader']);
    $leader_email = htmlspecialchars($data['leader_email']);
    $start_date = htmlspecialchars($data['start_date']);
    $end_date = htmlspecialchars($data['end_date']);
    $progress = htmlspecialchars($data['progress']);
    $leader_photo_lama = htmlspecialchars($data['leader_photo_lama']);

    // cek apakah user pilih gambar baru atau tidak
    if($_FILES['leader_photo']['error'] === 4){
        $leader_photo = $leader_photo_lama;
    }else{
        $leader_photo = upload();
    }

    $query = "UPDATE project SET
                project_name = '$project_name',
                client = '$client',
                leader = '$leader',
                leader_email = '$leader_email',
                start_date = '$start_date',
                end_date = '$end_date',
                progress = '$progress',
                leader_photo = '$leader_photo'
            WHERE id = $id
            ";

    mysqli_query($koneksi_db, $query);

    return mysqli_affected_rows($koneksi_db);
}

// function cari

function cari($keyword){
    $query = " SELECT 
                    project.*, DATE_FORMAT(start_date, '%k:%i,%d %M %Y') as start_date_formatted, DATE_FORMAT(end_date, '%k:%i,%d %M %Y') as end_date_formatted 
                FROM project
                WHERE 
                    project_name LIKE '%$keyword%' OR
                    client LIKE '%$keyword%' OR
                    leader LIKE '%$keyword%' OR
                    leader_email LIKE '%$keyword%' OR
                    start_date LIKE '%$keyword%' OR
                    end_date LIKE '%$keyword%' OR
                    progress LIKE '%$keyword%'
                ORDER BY 
                    end_date ASC
            ";
    return query($query);
}

?>