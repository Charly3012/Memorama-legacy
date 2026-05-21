<?php

/**
 * Created by PhpStorm.
 * User: Andre
 * Date: 07/02/2016
 * Time: 06:29 PM
 */
require_once __DIR__ . '/DataBaseManager.php';
require_once __DIR__ . '/Session.php';
require_once __DIR__ . '/interfaces/DatabaseInterface.php';
require_once __DIR__ . '/interfaces/SessionInterface.php';
require_once __DIR__ . '/adapters/DatabaseAdapter.php';
require_once __DIR__ . '/adapters/SessionAdapter.php';
require_once __DIR__ . '/services/AuthService.php';


$username = $_POST["username"];
$password = $_POST["password"];


$db = new DatabaseAdapter();
$session = new SessionAdapter();
$authService = new AuthService($db, $session);

$response = $authService->login($username, $password);
echo json_encode($response);