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
    <title>Convert MP3 to Wav</title>
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
        }

        .navbar {
            background-color: #274845;
            height: 25vh;
            margin-bottom: 2vh;
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
            background-color: #2C716B;
            height: 20vh;
            width: 40vw;
            margin: 10px;
            border: 5px solid #D0B770;
            border-radius: 10px;
            display: flex;
            justify-content: center;
            align-items: center;
            box-sizing: border-box;
            position: relative;
        }

        .column:hover {
            background-color: #274845;
        }

        .column h2 {
            font-size: 2.5em;
            color: white;
            text-align: center;
        }

        .input-content {
            position: relative;
            width: 70%;
            color: transparent;
            overflow: hidden;
        }

        .input-content::before {
            color: #ffffff;
            white-space: nowrap;
            cursor: pointer;
            text-align: center;
        }

        .input-content input[type="file"] {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            opacity: 0;
            cursor: pointer;
        }

        .input-content .file-name {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            text-align: center;
            width: 100%;
            color: #ffffff;
            font-size: 2em;
        }

        #konversiBtn {
            display: none;
            /* Sembunyikan tombol konversi secara default */
            background-color: #D0B770;
            /* Warna latar belakang */
            color: #ffffff;
            /* Warna teks */
            padding: 10px 20px;
            /* Padding tombol */
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1.5em;
            margin-top: 10px;
            /* Margin atas agar berjarak dari input */
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
    <h1 class="text-center">Convert MP3 to WAV</h1>
    <form action="convertWav.php" method="post" enctype="multipart/form-data">
        <div class="content-row text-center">
            <label class="column btn input-content">
                <input type="file" name="mp3File" accept=".mp3" style="display: none;" onchange="updateFileName(this)">
                <span class="file-name">Input File Here</span>
            </label>
            <button type="submit" id="konversiBtn">Konversi</button>
        </div>
    </form>
    <script type="text/javascript" src="js/jquery.js"></script>
    <script type="text/javascript" src="js/bootstrap.js"></script>

    <script>
        function updateFileName(input) {
            var fileName = input.files[0].name;
            var fileDisplay = input.parentElement.querySelector('.file-name');
            var konversiBtn = document.getElementById('konversiBtn');

            fileDisplay.textContent = fileName;

            // Tampilkan tombol konversi jika file sudah diinput
            konversiBtn.style.display = 'block';
        }
    </script>
</body>

</html>