<?php

require __DIR__.'/../vendor/autoload.php';
\Partigen\ImageCreator::generate($_GET, ['scopes' => 'G'])->display();
