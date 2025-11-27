<?php
$db = require __DIR__ . '/db.php';
// test database! Important not to run tests on production or development databases
$db['dsn'] = 'pgsql:host=localhost;port=54322;dbname=postgres'; // работает для консольного подключения  -  миграции, тесты
//$db['dsn'] = 'pgsql:host=172.20.0.1;port=54322;dbname=postgress';

return $db;
