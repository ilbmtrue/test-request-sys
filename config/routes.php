<?php

return array(
    'request/edit/([0-9]+)' => 'request/edit/$1',
    'requests/filter' => 'request/IndexFilter/$1', 
    'requests' => 'request/index', 
    'addRequest' => 'request/add',
    'login' => 'user/login',
    'logout' => 'user/logout',
    'success' => 'site/success',
    'index.php' => 'site/index',
    'dbfill.php' => 'dbfill.php', // заполнение базы
    '' => 'site/index',
);
