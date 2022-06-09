<?php

namespace tests\Partigen;

use Partigen\ImageCreator;

require __DIR__.'/../vendor/autoload.php';

ImageCreator::generate(['ext' => 'png', 'format' => 'A4'])->display();