<?php

/**
 * Created by PhpStorm.
 * User: Andre
 * Date: 07/02/2016
 * Time: 06:29 PM
 */
include "DataBaseManager.php";
require_once("Session.php");
require_once("interfaces/DatabaseInterface.php");
require_once("interfaces/SessionInterface.php");
require_once("adapters/DatabaseAdapter.php");
require_once("adapters/SessionAdapter.php");
require_once("services/AuthService.php");


$username = $_POST["username"];
$password = $_POST["password"];


$db = new DatabaseAdapter();
$session = new SessionAdapter();
$authService = new AuthService($db, $session);

$response = $authService->login($username, $password);
echo json_encode($response);