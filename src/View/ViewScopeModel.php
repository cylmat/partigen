<?php

declare(strict_types=1);

namespace Partigen\View;

class ViewScopeModel implements ViewModelInterface
{
    private const LINE_NUMBERS = 5; // number of displayed lines for each scope
    private const MAX_OUTSCOPE_VERTICAL_PX = 480; // number of "added" notes px to display scope
    private static $totalOutscopeVerticalPx = 0;

    private const LINE_TEMPLATE = '<div class="line"></div>' . "\n";
    private const SCOPE_TEMPLATE = "<div class=\"scope %s-scope\" style=\"%s\">\n";
    private const NOTES_TEMPLATE = "<div class=\"notes\">\n%s</div>\n";

    private ViewNoteModel $viewNote;

    public function __construct(ViewNoteModel $viewNote)
    {
        $this->viewNote = $viewNote;
    }

    public function convert(array $data): string
    {
        $lines5 = '';
        for ($l = 0; $l < self::LINE_NUMBERS; $l++) {
            $lines5 .= self::LINE_TEMPLATE;
        }

        $style = $this->getOutscopeNotesStyle($data['notes']);
        $scopeHtml = sprintf(self::SCOPE_TEMPLATE, strtolower($data['name']), $style);
        $scopeHtml .= $this->notes($data['notes']);
        $scopeHtml .= $lines5 . '</div>' . "\n";

        if ($this->isOutofpage()) {
            return '';
        }
        return $scopeHtml;
    }

    private function notes(array $notesData): string
    {
        $notesHtml = '';
        foreach ($notesData as $index => $noteColumnData) {
            $notesHtml .= $this->viewNote->convert([
                'index' => $index, // x
                'highs' => $noteColumnData['highs'], // y
            ]);
        }

        return sprintf(self::NOTES_TEMPLATE, $notesHtml);
    }

    /**
     * @param mixed[] $dataNotes
     */
    private function getOutscopeNotesStyle(array $dataNotes): string
    {
        $max = (int)\array_reduce($dataNotes, function ($carry, $item) {
            return ($note = $item['highs'][0]) > $carry ? $note : $carry;
        }, 0);
        $min = (int)\array_reduce($dataNotes, function ($carry, $item) {
            return ($note = $item['highs'][0]) < $carry ? $note : $carry;
        }, 0);

        // Add a margin (px) for scopes
        // if notes upper top line or notes under bottom line
        $marginTop = $marginBottom = 0;
        if (($top = max($min, $max)) > 10) {
            $marginTop = (abs($top) - 10) * 5;
        }
        if (($bottom = min($min, $max)) < 0) {
            $marginBottom = abs($bottom) * 4;
        }

        // total of added margin pixels
        self::$totalOutscopeVerticalPx += $marginTop + $marginBottom;

        return "margin-top: {$marginTop}px; margin-bottom: {$marginBottom}px;";
    }

    private function isOutofpage(): bool
    {
        return self::$totalOutscopeVerticalPx >= self::MAX_OUTSCOPE_VERTICAL_PX;
    }
}
