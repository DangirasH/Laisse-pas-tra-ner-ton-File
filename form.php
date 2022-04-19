<?php

if ($_SERVER['REQUEST_METHOD'] === "POST") {

    $uploadDir = 'public/uploads/';
    $uploadFile = $uploadDir . basename($_FILES['avatar']['name']);
    $extension = pathinfo($_FILES['avatar']['name'], PATHINFO_EXTENSION);
    $authorizedExtensions = ['jpg', 'jpeg', 'png', 'webp'];
    $maxFileSize = 1000000;

    if ((!in_array($extension, $authorizedExtensions))) {
        $errors[] = "Veuillez sélectionner une image de type jpg, png, gif ou webp !";
    }

    if (file_exists($_FILES['avatar']['tmp_name']) && filesize($_FILES['avatar']['tmp_name']) > $maxFileSize) {
        $errors[] = "Votre fichier doit faire moins de 1M !";
    }

    if (!isset($errors)) {
        $newFile = $uploadDir . uniqid('avatar', true) . '.' . $extension;
        move_uploaded_file($_FILES['avatar']['tmp_name'], $newFile);
    }
    echo "<img src=" . $uploadFile . " width = 600px height = 600px/>";
}
?>

<!doctype html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <title>LAISSE PAS TRAINER TON FILE</title>
</head>

<body>
    
    <form method="post" enctype="multipart/form-data">
        <label for="imageUpload">Upload a profile image</label>
        <input type="file" name="avatar" id="imageUpload" />
        <button name="send">Send</button>
    </form>


</body>

</html>