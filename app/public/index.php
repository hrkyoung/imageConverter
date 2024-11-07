<?php

require_once '../vendor/autoload.php';
$loader = new \Twig\Loader\FilesystemLoader('../template/');
$twig = new \Twig\Environment($loader, [
    'cache' => false,
]);


echo $twig->render('index.twig', array(
    'pageTitle' => 'B&W Converter'
));