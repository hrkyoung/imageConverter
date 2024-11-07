<?php

require_once '../vendor/autoload.php';
$loader = new \Twig\Loader\FilesystemLoader('../template/');
$twig = new \Twig\Environment($loader, [
    'cache' => false,
]);

$db = json_decode(file_get_contents('../db.json'), true);

foreach ($db as $key => $value) {
    $db[$key]['originalFilename'] = 'upload/' . $value['originalFilename'];

    if ($value['convertedFile'] !== null) {

    $db[$key]['convertedFile'] = 'upload/' . $value['convertedFile'];
    } 

}

echo $twig->render('history.twig', array(
    'pageTitle' => 'B&W Converter',
    'db' => $db
));