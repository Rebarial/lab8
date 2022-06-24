<?php

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../src/activeRecord/car.php';

use Twig\Environment;
use Twig\Loader\FilesystemLoader;
use activeRecord\car;


$view = new Environment(new FilesystemLoader(dirname(__DIR__) . "/src/templates"));

$car = new car();



$id_s = $_GET['id_s'];
$mark_s = $_GET['mark_s'];
$id_a = $_GET['id_a'];
$mark_a = $_GET['mark_a'];
$model_a = $_GET['model_a'];
$id_d = $_GET['id_d'];
if ($id_a != '' && $mark_a != '' && $model_a != ''){
    $car->setId($id_a);
    $car->setModel($model_a);
    $car->setMark($mark_a);
    $car->add();
}
if ($id_d != ''){
    $car->setId($id_d);
    $car->delete();
}
$db = array();
$b = $car->getAll();
foreach ($b as $b){
    $db[] = [$b->getId(), $b->getMark(), $b->getModel()];
}
if ($id_s != ''){
    $db = array();
    $b = $car->fById($id_s);
    foreach ($b as $b){
        $db[] = [$b->getId(), $b->getMark(), $b->getModel()];
    }
}

if ($mark_s != ''){
    $db = array();
    $b = $car->fByMark($mark_s);
    foreach ($b as $b){
        $db[] = [$b->getId(), $b->getMark(), $b->getModel()];
    }
}


echo $view->render('index.html.twig', ['data' => $db]);
