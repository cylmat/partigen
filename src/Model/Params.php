<?php

declare(strict_types=1);

namespace Partigen\Model;

use Partigen\Bridge\Html2Pdf;
use Partigen\DataValue\ScopeF;
use Partigen\DataValue\ScopeG;
use Partigen\Exceptions\ParamException;

final class Params
{ 
    private array $allowedParams = [
        'format' => [
            Html2Pdf::FORMAT_A4,
            Html2Pdf::FORMAT_A5
        ],
        'image_ext' => [
            'png'
        ],
        'scope' => [
            ScopeG::NAME,
            ScopeF::NAME,
        ],
        'higher_note' => '/^[ABCDEFG]\d|-?\d?\d$/',
        'lower_note' => '/^[ABCDEFG]\d|-?\d?\d$/',
        'chord_freq' => '/^\d?\d?\d$/',
    ];

    private array $defaults = [
        'format' => 'A4',
        'scope' => ScopeG::NAME,
        'image_ext' => 'png',
        'higher_note' => null,
        'lower_note' => null,
        'chord_freq' => 0,
    ];

    private array $customerParams = [];
    
    public function getAllowedParams(): array
    {
        return $this->allowedParams;
    }
    
    public function getDefaultValues(): array
    {
        return $this->defaults;
    }

    /**
     * @throws \Throwable
     */
    public function validates(array &$customerParams): void
    {
        foreach ($customerParams as $key => $param) {
            if (!\in_array($key, $allowedKeys = \array_keys($this->allowedParams))) {
                throw new ParamException(\sprintf('Key "%s" not allowed in values ["%s"]', $key, join('", "', $allowedKeys)));
            }

            switch (\gettype($allowedValues = $this->allowedParams[$key])):
                case 'array':
                    if (!\in_array($param, $this->allowedParams[$key])) {
                        throw new ParamException(\sprintf('"%s" value "%s" not allowed in values ["%s"]', 
                            ucfirst($key), 
                            $param, 
                            join('", "', $allowedValues)
                        ));
                    }
                    break;
                case 'string':
                    if (!\preg_match($allowedValues, $customerParams[$key])) {
                        throw new ParamException(\sprintf('"%s" value doesn`t match "%s"', 
                            $customerParams[$key],
                            $allowedValues
                        ));
                    }
                    break;
            endswitch;
        }

        foreach ($this->defaults as $key => $default) {
            if (!isset($customerParams[$key])) {
                $customerParams[$key] = $default;
            }
        }

        $this->customerParams = $customerParams;
    }

    public function getFormat(): string
    {
        return $this->customerParams['format'];
    }

    public function getImageExt(): string
    {
        return $this->customerParams['image_ext'];
    }

    public function getScope(): string
    {
        return $this->customerParams['scope'];
    }

    /** @return string|int|null */
    public function getHigherNote()
    {
        $note = $this->customerParams['higher_note'];
        return \is_numeric($note) ? (int)$note : $note;
    }

    /** @return string|int|null */
    public function getLowerNote()
    {
        $note = $this->customerParams['lower_note'];
        return \is_numeric($note) ? (int)$note : $note;
    }

    public function getChordFreq(): int
    {
        return (int)$this->customerParams['chord_freq'];
    }
}
