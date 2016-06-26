<?php

$db = parse_url(getenv('CLEARDB_DATABASE_URL'));

$container->setParameter('database_driver', 'pdo_mysql');
$container->setParameter('database_host', $db['host']);
$container->setParameter('database_port', $db['port']);
$container->setParameter('database_name', substr($db["path"], 1));
$container->setParameter('database_user', $db['user']);
$container->setParameter('database_password', $db['pass']);
$container->setParameter('secret', getenv('SECRET'));
$container->setParameter('locale', 'es');
$container->setParameter('mailer_transport', getenv('MAILER_TRANSPORT'));
$container->setParameter('mailer_host', null);
$container->setParameter('mailer_user', getenv('MAILER_USER'));
$container->setParameter('mailer_password', getenv('MAILER_PASSWORD'));

