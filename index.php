<?php
    $folderPath = 'uploads'; // Ganti dengan path folder Anda

    // Membaca daftar file dalam folder
    $files = scandir($folderPath);
    
    // Menghapus setiap file
    foreach ($files as $file) {
        // Hindari menghapus "." dan ".."
        if ($file !== "." && $file !== "..") {
            $filePath = $folderPath . '/' . $file;
    
            // Hapus file
            if (is_file($filePath)) {
                unlink($filePath);
                // echo 'File ' . $file . ' berhasil dihapus.<br>';
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DIAConvert - Audio Converter</title>
    <link rel="icon" type="image/x-icon" href="assets/logo.png">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inria+Serif:wght@400;700&display=swap');

        body {
            font-family: 'Inria Serif', serif;
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
            /* Hapus margin agar teks di tengah */
        }

        .navbar-brand span {
            color: #D0B770;
            font-weight: bold;
        }

        .navbar-brand img {
            width: 5%;
            display: inline;
            margin: 0 auto;
        }

        .content-row {
            display: flex;
            flex-direction: row;
            /* Menetapkan orientasi flexbox menjadi baris (default) */
            justify-content: space-around;
            margin: 10px;
        }

        .column {
            background-color: #274845;
            height: 25vh;
            width: 40vw;
            margin: 10px;
            border: 5px solid #D0B770;
            border-radius: 10px;
            display: flex;
            justify-content: center;
            align-items: center;
            box-sizing: border-box;
        }
        .column:hover{
            background-color: #2C716B;
        }
        .column h2 {
            font-size: 2.5em;
            /* Ubah ukuran teks sesuai keinginan Anda */
            color: white;
            text-align: center;
            /* Menengahkan teks secara horizontal */
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
    <div class="content-row text-center">
        <a class="column btn" href="mp3toWav.php">
            <h2>Mp3 to Wav</h2>
        </a>
        <a class="column btn" href="wavtoMp3.php">
            <h2>Wav to Mp3</h2>
        </a>
    </div>

    <div class="content-row text-center">
        <a class="column btn" href="mp3toOpus.php">
            <h2>Mp3 to Opus</h2>
        </a>
        <a class="column btn" href="opustoMp3.php">
            <h2>Opus to Mp3</h2>
        </a>
    </div>
    <script type="text/javascript" src="js/jquery.js"></script>
    <script type="text/javascript" src="js/bootstrap.js"></script>
</body>

</html>