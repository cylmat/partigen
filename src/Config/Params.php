<?php

declare(strict_types=1);

namespace Partigen\Config;

use Partigen\Bridge\Html2Pdf;
use Partigen\DataValue\ScopeG;
use Partigen\Exceptions\ParamException;

final class Params
{
    /** @var mixed[] */
    private array $allowedParams = [
        'format' => [
            Html2Pdf::FORMAT_A4
        ],
        'image_ext' => [
            'png'
        ],
        'scopes' => '/^[GF](,[GF])*$/',
        'higher_note' => '/^([CDEFGAB][0-8]|-?[1-2]?\d)$/',
        'lower_note' => '/^([CDEFGAB][0-8]|-?[1-2]?\d)$/',
        'paired' => '/^1$/',
    ];

    /** @var string[] */
    private array $regexErrorMsg = [
        'scopes' => "Values '%s' must be one of G,F or both",
        'higher_note' => "Value '%s' must be a note (B8 max) or a difference with scope line (20 max)",
        'lower_note' => "Value '%s' must be a note (B8 max) or a difference with scope line (20 max)",
        'paired' => "Value '%s' must be set to 1",
    ];

    /** @var mixed[] */
    private array $default = [
        'format' => 'A4',
        'image_ext' => 'png',
        'scopes' => ScopeG::NAME,
        'higher_note' => null,
        'lower_note' => null,
        'paired' => null,
    ];

    private array $customerParams = [];

    public function __construct()
    {
        $this->initDefault();
    }

    public function initDefault(array $defaultCustomConfig = []): void
    {
        // key validation is made in validates() itself
        foreach ($defaultCustomConfig as $key => $param) {
            $this->default[$key] = $param;
        }

        $this->customerParams = $this->default;
    }

    public function getAllowedParams(): array
    {
        return $this->allowedParams;
    }

    public function getDefaultValues(): array
    {
        return $this->default;
    }

    /**
     * @throws \Throwable
     */
    public function validates(array $customerParams): self
    {
        // settings
        foreach ($customerParams as $key => $param) {
            $this->customerParams[$key] = $param;
        }

        foreach ($this->customerParams as $key => $param) {
            // allowed keys
            if (!\in_array($key, $allowedKeys = \array_keys($this->allowedParams))) {
                throw new ParamException(\sprintf('Key "%s" not allowed in values ["%s"]', $key, join('", "', $allowedKeys)));
            }

            // check each regexp or allowed values
            switch (\gettype($allowedValues = $this->allowedParams[$key])) :
                case 'array':
                    if (!\in_array($param, $this->allowedParams[$key])) {
                        throw new ParamException(\sprintf(
                            '"%s" value "%s" not allowed in values ["%s"]',
                            $key,
                            $param,
                            join('", "', $allowedValues)
                        ));
                    }
                    break;
                // regexp
                case 'string':
                    if (\is_numeric($param)) {
                        $param = "$param";
                    }
                    if (null === $param) {
                        break;
                    }

                    if (!\preg_match($allowedValues, $param)) {
                        throw new ParamException(\sprintf(
                            $this->regexErrorMsg[$key],
                            $this->customerParams[$key]
                        ));
                    }
                    break;
            endswitch;
        }

        // min - max
        if (
            ($lower = (int)$this->customerParams['lower_note'])
            && ($higher = (int)$this->customerParams['higher_note'])
            && ($lower > $higher)
        ) {
            throw new ParamException("lower_note note can't be higher than higher_note");
        }

        return $this;
    }

    public function getFormat(): string
    {
        return $this->customerParams['format'];
    }

    public function getImageExt(): string
    {
        return $this->customerParams['image_ext'];
    }

    public function getScopes(): array
    {
        return \explode(',', $this->customerParams['scopes']);
    }

    /** @return string|int */
    public function getHigherNote()
    {
        $note = $this->customerParams['higher_note'] ?? 'B8';
        return \is_numeric($note) ? (int)$note : $note;
    }

    /** @return string|int */
    public function getLowerNote()
    {
        $note = $this->customerParams['lower_note'] ?? 'C0';
        return \is_numeric($note) ? (int)$note : $note;
    }

    /** @return bool */
    public function isPaired(): bool
    {
        return (bool)($this->customerParams['paired'] ?? false);
    }
}
