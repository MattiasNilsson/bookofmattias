<?php
/**
 * Created by PhpStorm.
 * User: Henrik
 * Date: 03-07-2015
 * Time: 10:12
 */

require_once('vendor/autoload.php');
$app = new \Slim\Slim();
$app->response->headers->set('Content-Type', 'application/json');

// Load the Slots class
require_once('slot.class.php');
$objSlot = new Slot;

$app->get('/spin', function () {
    global $objSlot;
    echo json_encode($objSlot->getSpin());
});

$app->get('/bank', function () {
    global $objSlot;
    echo json_encode($objSlot->getBank());
});

$app->run();