<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Tentukan path ffmpeg
    $ffmpegPath = 'C:/ffmpeg/bin/ffmpeg.exe'; // Ganti dengan path ffmpeg di server Anda

    // Tentukan direktori untuk menyimpan file sementara
    $uploadDir = 'uploads/';

    // Pastikan direktori upload ada atau buat jika belum ada
    if (!file_exists($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    // Handle file upload
    if (isset($_FILES['mp3File']) && $_FILES['mp3File']['error'] === UPLOAD_ERR_OK) {
        $mp3FileName = 'uploadfile.mp3';
        $mp3FilePath = $uploadDir . $mp3FileName;

        move_uploaded_file($_FILES['mp3File']['tmp_name'], $mp3FilePath);

        // Buat nama file output WAV
        $wavFileName = pathinfo($mp3FileName, PATHINFO_FILENAME) . '.wav';
        $wavFilePath = $uploadDir . $wavFileName;

        // Gunakan perintah ffmpeg untuk mengkonversi MP3 ke WAV
        $command = "$ffmpegPath -i $mp3FilePath -acodec pcm_s16le -ar 44100 $wavFilePath";
        shell_exec($command);

        // Hapus file MP3 sementara
        unlink($mp3FilePath);

        // Tampilkan link untuk mengunduh file WAV
        echo "Konversi selesai. <a href='$wavFilePath' download>Unduh WAV</a>";
    } else {
        echo "Terjadi kesalahan saat mengunggah file MP3.";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Convert MP3 to WAV</title>
</head>
<body>
    <h1>Convert MP3 to WAV</h1>
    <form action="" method="post" enctype="multipart/form-data">
        <label for="mp3File">Pilih file MP3:</label>
        <input type="file" name="mp3File" accept=".mp3" required>
        <button type="submit">Konversi</button>
    </form>
</body>
</html>
