<?php

return [
    'class' => 'yii\db\Connection',
    'dsn' => 'pgsql:host=172.20.0.1;port=54322;dbname=postgres',
   // 'dsn' => 'pgsql:host=localhost;port=54322;dbname=postgres', // для генерации миграции
    'username' => 'postgres',
    'password' => 'postgres',
    'charset' => 'utf8',
    'enableSchemaCache' => true,
    'enableQueryCache' => true,
    'queryCacheDuration' => 60,
    // Schema cache options (for production environment)
    //'enableSchemaCache' => true,
    //'schemaCacheDuration' => 60,
    //'schemaCache' => 'cache',
];
