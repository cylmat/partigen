<?php

require 'defined.php';

function params() {
    return [
        'number' => 24, // number of notes
        'higher' => NOTES['A3'], //upper line: -2
        'lower'  => NOTES['F3'] //lower line: 8
    ];
}

function random($min, $max) {
    $random_array = [];
    foreach (range(0, mt_rand(300, 500)) as $r) {
        $random_array[] = random_int($min, $max);
    }
    return $random_array[array_rand($random_array)];
}

/**
 * Note
 */
$note = function($num, $scopeName) {
    // init
    $INIT_LEFT_MARGIN_PX = 40;
    $INIT_TOP_MARGIN_PX = 11;
    $X_SPACE_PX = 30;
    $Y_SPACE_PX = 15; //-15 to 60

    // X
    $x = $INIT_LEFT_MARGIN_PX + $X_SPACE_PX * $num;

    // Y
    $higher = params()['higher'];
    $lower = params()['lower'];
    $level = random($higher, $lower);
    $y = $INIT_TOP_MARGIN_PX + ($Y_SPACE_PX * $level / 2);

    // for up and down OUT lines
    switch($scopeName) {
        case 'sol': 
            $class = 'notesplit'; 
            $y += $Y_SPACE_PX * 3; //init on G line
            break;
        case 'fa': //already on F line
            $class = 'split'; 
            break;
        default: 
            $class = 'note';
    }

    // return note html
    $style = "margin-left: ".$x."px; margin-top: ".$y."px;";
    $note = '<div class="'.$class.'" style="'.$style.'"></div>';
    return $note;
};

/**
 * Notes
 */
$notes = function($scopeName) use ($note) {
    $notes = '';
    $count = 0;
    
    for ($i=0; $i<params()['number']; $i++) {
        $notes .= $note($count++, $scopeName);
    }

    return $notes;
};

/**
 * Line
 */
$line = function($class = 'line') use ($note) {
    $line = '<div class="'.$class.'"></div>';
    return $line;
};

/**
 * Lines
 */
$lines = function() use ($line) {
    $lines=[]; 
    foreach(range(0, 5) as $l) {
        $lines[] = $line();
    }
    return join('', $lines);
};

/**
 * Scope
 */
$scope = function($class) use ($lines, $notes) {
    $scope = '<div class="'.$class.'">'.
        $notes($class).
        $lines().
    '</div>';

    return $scope;
};

/**
 * Block
 */
$block = function($class = "block") use ($scope) {
    $block = '<div class="'.$class.'">'.
        $scope('sol').
        $scope('fa').
    '</div>';
    return $block;
};
