<?php

require_once 'vendor/autoload.php';

use App\Database;
use App\Report;

if (date('w') == 5 && $_GET['key'] == 'last') {
    $db = new Database();
    $users = $db->getUsers();

    $report = new Report($users);
    $report->generate();
}
