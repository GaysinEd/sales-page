<?php
$db = require __DIR__ . '/db.php';
// test.php database! Important not to run tests on production or development databases
$db['dsn'] = 'mysql:host=localhost;dbname=yii2basic_test';

return $db;
