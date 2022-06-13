<?php

declare(strict_types=1);

namespace Partigen\Model;

use Partigen\Bridge\Html2Pdf;
use Partigen\DataValue\ScopeF;
use Partigen\DataValue\ScopeG;

final class Params
{ 
    private array $allowedParams = [
        'format' => Html2Pdf::FORMATS,
        'scope' => [
            ScopeG::NAME,
            ScopeF::NAME,
        ],
    ];

    private array $defaults = [
        'format' => 'A4',
        'scope' => ScopeG::NAME,
    ];

    /**
     * @throws \Throwable
     */
    public function validates(array &$creationParams): void
    {
        foreach ($creationParams as $key => $param) {
            if (!\in_array($key, $allowedKeys = \array_keys($this->allowedParams))) {
                throw new \OutOfBoundsException(\sprintf('Key "%s" not allowed in values ["%s"]', $key, join('", "', $allowedKeys)));
            }

            if (!\in_array($param, $allowedValues = $this->allowedParams[$key])) {
                throw new \OutOfBoundsException(\sprintf('Value "%s" not allowed in values ["%s"]', $param, join('", "', $allowedValues)));
            }
        }

        foreach ($this->defaults as $key => $default) {
            if (!isset($creationParams[$key])) {
                $creationParams[$key] = $default;
            }
        }
    }
}
