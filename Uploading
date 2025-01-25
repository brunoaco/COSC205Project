<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['resume'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $work_area = $_POST['work_area'];
    $file = $_FILES['resume'];
    $uploadDir = 'uploads/';

    if ($file['error'] !== UPLOAD_ERR_OK) {
        die('Error uploading file.');
    }

    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    $filePath = $uploadDir . basename($file['name']);
    if (move_uploaded_file($file['tmp_name'], $filePath)) {
        echo "File uploaded successfully!<br>";
        echo "Name: $name<br>";
        echo "Email: $email<br>";
        echo "Address: $address<br>";
        echo "Work Area: $work_area<br>";
        echo "Resume saved at: $filePath";
    } else {
        echo 'Failed to upload file.';
    }
} else {
    echo 'No file uploaded.';
}
?>
