<?php

declare(strict_types=1);

namespace Partigen\View;

use Partigen\Model\Block\ScopeBlock;

class ViewNoteModel
{
    private const X_SPACE_PX = 30;
    private const INIT_LEFT_MARGIN_PX = 40;

    private const Y_SPACE_PX = 16; // space betweeen lines
    private const INIT_TOP_MARGIN_PX = 25 + (3 * self::Y_SPACE_PX); // init on bottom line

    // <div> class name
    private const BASECLASS = 'note';
    private const LINECLASS = 'split';
    private const OUTCLASS = 'notesplit';

    public function convert(array $data): string
    {
        $index = $data['index'];
        $high = $data['high'];
        $this->scope = $data['scope'];

        $noteHtml = $this->createDiv($index, $high, self::BASECLASS);

        $current = $high;
        while (abs($current - $high) > 0) {
            $noteHtml .= $this->createDiv($index, $high-2, self::OUTCLASS);
        }

        return $noteHtml;
    }

    private function createDiv(int $index, int $high, string $class): string
    {
        $top = $this->setBaseline($this->scope);
        $left = (self::INIT_LEFT_MARGIN_PX + self::X_SPACE_PX * $index);
        $top += (self::INIT_TOP_MARGIN_PX - (int)(self::Y_SPACE_PX/2) * $high);

        $style = '';
        $style .= "left: $left" . 'px; ';
        $style .= "top: $top"  . 'px; ';

        $noteHtml = ' <div class="'.$class.'" style="'.$style.'"></div>'."\n";

        return $noteHtml;
    }

    private function setBaseline(string $scope): int
    {
        switch ($scope) {
            case ScopeBlock::G:
                $top = -self::Y_SPACE_PX;
                break;
            case ScopeBlock::F:
                $top = -3 * self::Y_SPACE_PX;
                break;
        }

        return $top;
    }
}
