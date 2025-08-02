<?php
session_start();
include 'includes/functions/functions.php';
include 'includes/functions/core.php';


$startInstance = new Core();

// access global variables
$routes = $startInstance->getRoutes();
$darkmode = $startInstance->getDarkmode();
$config = $startInstance->getConfig();

// render the page
$startInstance->renderPage();

/**
 * to run locally use
 * 
 * php -S localhost:8000
 * 
 * and open http://localhost:8000
 * 
 * enjoy your website
 * best, stefan from www.coden-lassen.de
 */