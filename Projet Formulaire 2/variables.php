<?php

// Retrieving Variables Using the MySQL Client
$projetStatement = $mysqlClient->prepare('SELECT * FROM projet');
$projetStatement->execute();
$projet = $projetStatement->fetchAll();

