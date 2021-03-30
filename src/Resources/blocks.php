<?php

function params() {
    return [
        'number' => 10, // number of notes
        'higher' => 10,
        'lower'  => 10
    ];
}

function random($min, $max) {
    return mt_rand($min, $max);
}

/**
 * Note
 */
$note = function($num, $class = 'notesplit') {
    $INIT_LEFT_MARGIN_PX = 40;
    $INIT_TOP_MARGIN_PX = 11;
    $X_SPACE_PX = 30;
    $Y_SPACE_PX = 15; //-15 to 60

    $x = $INIT_LEFT_MARGIN_PX + $X_SPACE_PX * $num;
    $level = random(-2, 8);
    $y = $INIT_TOP_MARGIN_PX + ($Y_SPACE_PX * $level / 2);

    $style = "margin-left: ".$x."px; margin-top: ".$y."px;";
    $note = '<div class="'.$class.'" style="'.$style.'"></div>';
    return $note;
};

/**
 * Notes
 */
$notes = function() use ($note) {
    $notes = '';
    $count = 0;
    
    for ($i=0; $i<params()['number']; $i++) {
        $notes .= $note($count++);
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
        $notes().
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
