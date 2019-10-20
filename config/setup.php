<?php

require_once 'application/lib/CreateDb.php';
use application\lib\CreateDb;

$createBase = new CreateDb();
$createBase->dropDb();
$createBase->createDb();
