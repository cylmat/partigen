<?php

$line = function($class = 'line') {
    $line = '<div class="'.$class.'"></div>';
    return $line;
};

$lines = function() use ($line) {
    $lines=[]; 
    foreach(range(0, 5) as $l) {
        $lines[] = $line();
    }
    return join('', $lines);
};

$block = function($class) use ($lines) {
    $block = '<div class="'.$class.'">'.
        $lines().
    '</div>';
    return $block;
};

$blocks = function($class = "block") use ($block) {
    $blocks = '<div class="'.$class.'">'.
        $block('sol').
        $block('fa').
    '</div>';
    return $blocks;
};
