<?php

/**
 * All scopes
 */
$scopes = [];

/**
 * Note
 */
$note = function($x, $y, $class = 'note') {
    $style = "margin-left: ".$x."0px; margin-top: ".$y."0px;";
    $note = '<div class="'.$class.'" style="'.$style.'"></div>';
    return $note;
};

/**
 * Notes
 */
$notes = function() use (&$scopes, $note) {
    $notes = '';
    foreach ($scopes as $scope) {
        $left = 4 + $scopes[0]*2;
        $style = "margin-left: ".$left."0px; margin-top: ".$y."0px;";

        $notes = '<div class="'.$class.'" style="'.$style.'"></div>';
        $scopes[0]++;
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
$scope = function($class) use ($lines, &$scopes) {
    $scopes[] = []; //add a new scope

    $scope = '<div class="'.$class.'">'.
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
