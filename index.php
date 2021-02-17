<?php

require_once 'vendor/autoload.php';

use App\Database;
use App\Report;

// TODO change to sunday morning time check.
if (true) {
    $db = new Database();
    $users = $db->getUsers();

    foreach($users as $user) {
        $report = new Report($user);
        $report->generate();
    }
}
