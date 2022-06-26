<?php

declare(strict_types=1);

namespace Partigen\View;

class ViewNoteModel
{
    private const X_SPACE_PX = 22 + 10;
    private const INIT_LEFT_MARGIN_PX = 40;

    private const Y_SPACE_PX = 6; // space betweeen notes
    private const INIT_TOP_MARGIN_PX = 55; // init on bottom line

    private const MAX_PAGE_WIDTH = 730; // px

    // <div> class name
    private const NOTECLASS = 'note';
    private const SPLITCLASS = 'split';
    private const NOTESPLITCLASS = 'notesplit';

    private const NOTE_TEMPLATE = " <div class=\"%s\" style=\"%s\"></div>\n";

    public function convert(array $data): string
    {
        $index = $data['index'];
        $highs = $data['highs'];

        $data = $this->generateClassData($highs);

        $noteHtml = '';
        foreach ($data as $high => $class) {
            // noteHtml need to be after to display correctly
            $noteHtml = $this->createClassHtml($index, $high, $class) . $noteHtml;
        }

        return $noteHtml;
    }

    private function generateClassData(array $highs): array
    {
        $data = [];
        foreach ($highs as $note) {
            $direction = $note > 0 ? 1 : -1;
            $currentPos = $note - $direction;

            // note outside lines
            if ($currentPos < 0 || $currentPos > 8) {
                $data[$note] = 0 === $note % 2 ? self::NOTESPLITCLASS : self::NOTECLASS;
            } else {
                // inside 5 lines
                $data[$note] = self::NOTECLASS;
            }

            if (0 === $note) {
                $data[$note] = self::NOTECLASS;
                continue;
            }
            
            // intermediate lines
            while (abs($currentPos) > 0) {
                // only display intermediates lines onto or under scope's lines
                if ($currentPos < 0 || $currentPos > 8) {
                    if (0 === $currentPos % 2) {
                        $data[$currentPos] = self::SPLITCLASS;
                    }
                }
                $currentPos -= $direction;
            }
        }

        return $data;
    }

    private function createClassHtml(int $index, int $baseHigh, string $class): string
    {
        $top = self::INIT_TOP_MARGIN_PX - ($baseHigh * self::Y_SPACE_PX);
        $left = self::INIT_LEFT_MARGIN_PX + ($index * self::X_SPACE_PX);

        if ($left > self::MAX_PAGE_WIDTH) {
            return '';
        }

        /**
         * @desc bug display! keep it
         */
        if (self::SPLITCLASS === $class) {
            $top += ($baseHigh < 0) ? -1 : 1;
        }

        $style = "left: $left".'px; ';
        $style .= "top: $top".'px; ';

        return sprintf(self::NOTE_TEMPLATE, $class, $style);
    }
}
