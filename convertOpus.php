<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Tentukan path ffmpeg
    $ffmpegPath = 'C:/ffmpeg/bin/ffmpeg.exe'; // Sesuaikan dengan path ffmpeg di komputer Anda

    // Tentukan direktori untuk menyimpan file sementara
    $uploadDir = 'uploads/';

    // Pastikan direktori upload ada atau buat jika belum ada
    if (!file_exists($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    // Handle file upload
    if (isset($_FILES['mp3File']) && $_FILES['mp3File']['error'] === UPLOAD_ERR_OK) {
        // Ubah nama file menjadi 'uploadfile'
        $mp3FileName = 'uploadfile.mp3';
        $mp3FilePath = $uploadDir . $mp3FileName;

        move_uploaded_file($_FILES['mp3File']['tmp_name'], $mp3FilePath);

        // Buat nama file output Opus
        $opusFileName = pathinfo($mp3FileName, PATHINFO_FILENAME) . '.opus';
        $opusFilePath = $uploadDir . $opusFileName;

        // Gunakan perintah ffmpeg untuk mengkonversi MP3 ke Opus
        $command = "\"$ffmpegPath\" -i $mp3FilePath -c:a libopus -b:a 128k $opusFilePath";
        shell_exec($command);

        // Hapus file MP3 sementara
        unlink($mp3FilePath);

        // Tampilkan link untuk mengunduh file Opus
        // echo "Konversi selesai. <a href='$opusFilePath' download>Unduh Opus</a>";
    } else {
        echo '<script>alert("Terjadi kesalahan saat mengunggah file MP3.")</script>';
        header("Location: mp3toOpus.php");
        exit();
    }
} else {
    // Redirect ke halaman formulir jika mencoba mengakses convert.php secara langsung
    header("Location: mp3toOpus.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Convert MP3 to Opus</title>
    <link rel="icon" type="image/x-icon" href="assets/logo.png">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inria+Serif:wght@400;700&display=swap');

        body {
            font-family: 'Inria Serif', serif;
        }

        h1 {
            font-weight: bolder;
            font-size: 4em;
            margin-bottom: 7vh;
        }

        .navbar {
            background-color: #274845;
            height: 25vh;
            margin-bottom: 10vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .navbar-brand {
            color: white;
            font-size: 4em;
            text-align: center;
            margin: 0;
        }

        .navbar-brand span {
            color: #D0B770;
            font-weight: bold;
        }

        .navbar-brand img {
            width: 10%;
            display: inline;
            margin: 0 auto;
        }

        .content-row {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin: 10px;
        }

        .column {
            background-color: #D0B770;
            height: 10vh;
            width: 30vw;
            margin: 10px;
            border-radius: 10px;
            display: flex;
            justify-content: center;
            align-items: center;
            box-sizing: border-box;
            position: relative;
        }
        .column:hover {
            background-color: #a38e55;
        }

        .column h2 {
            font-size: 3em;
            color: white;
            text-align: center;
        }

        .text-hitam{
            color: black;
            opacity: 50%;
            font-size: 1.5em;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg">
        <a class="navbar-brand btn" href="index.php">
            <img src="assets/logo.png" alt="Logo">
            <span>DIA</span>Convert
        </a>
    </nav>
    <h1 class="text-center">Convert Selesai</h1>
    <h1 class="text-center">Silahkan Download File Dibawah</h1>
    <div class="content-row text-center">
        <?php
        echo "<a class='column btn' href='$opusFilePath' download='output.opus'><h2>Download File</h2></a>";
        ?>
    </div>
    <div class="content-row text-center">
        <a class="text-hitam" href="mp3toOpus.php">Convert Other File</a>
    </div>
    <script type="text/javascript" src="js/jquery.js"></script>
    <script type="text/javascript" src="js/bootstrap.js"></script>
</body>

</html>
