<?php

namespace Partigen\DataValue;

interface ScopeDataInterface
{
    public function getName(): string;

    public function getPairedUpper(): ?string;

    public function getScopeLine(): string;

     // used to display note
    public function getBaseline(): string;

    public function getPairedLower(): ?string;
}
