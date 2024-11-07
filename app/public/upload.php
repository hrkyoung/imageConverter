<?php

require_once '../vendor/autoload.php';
$loader = new \Twig\Loader\FilesystemLoader('../template/');
$twig = new \Twig\Environment($loader, [
    'cache' => false,
]);

$db = json_decode(file_get_contents('../db.json'), true);

$uploadSucess = null;

if(isset($_POST["submit"])) {
    $uploadDir = 'upload/';
    $ext = pathinfo($_FILES["image"]["name"], PATHINFO_EXTENSION);
    $uploadFile = hash('crc32', uniqid() . $_FILES["image"]["name"]) . '.' . $ext;

    $uploadSucess = move_uploaded_file($_FILES["image"]["tmp_name"], $uploadDir . $uploadFile);

    
    // Ready => ready for conversion'
    // Done
    // Failed
    // Email Sent!

    if($uploadSucess) {
        // add to data
        $db[] = [
            "date" => date('Y-m-d H:i'),
            "email" => $_POST['email'],
            "originalFilename" => $uploadFile,
            "convertedFile" => null,
            "status" => "Ready"
        ];

        file_put_contents('../db.json', json_encode($db));
    }
}


echo $twig->render('upload.twig', array(
    'pageTitle' => 'B&W Converter',
    'uploadSucess' => $uploadSucess
));