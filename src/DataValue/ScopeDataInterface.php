<?php

namespace Partigen\DataValue;

interface ScopeDataInterface
{
    public function getName(): string;

    // upper displayable note
    public function getMaxNote(): string;

     // used to display note
    public function getBaseline(): string;

    // max note when other scope is upper it
    // min note when other scope is under it
    //cross

    // lower displayable note
    public function getMinNote(): string;
}