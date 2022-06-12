<?php

declare(strict_types=1);

namespace Partigen\View;

class ViewScopeModel implements ViewModelInterface
{
    private const LINE_NUMBERS = 5;

    private const LINE_TEMPLATE = '<div class="line"></div>'."\n";
    private const SCOPE_TEMPLATE = "<div class=\"scope %s-scope %s\">\n"; 
    private const NOTES_TEMPLATE = "<div class=\"notes\">\n%s</div>\n";

    private ViewNoteModel $viewNote;

    public function __construct(ViewNoteModel $viewNote)
    {
        $this->viewNote = $viewNote;
    }

    public function convert(array $data): string
    {
        $lines5 = '';
        for ($l=0; $l<self::LINE_NUMBERS; $l++) {
            $lines5 .= self::LINE_TEMPLATE;
        }

        $paired = $data['paired'] ? 'paired ' : '';
        $scopeHtml = sprintf(self::SCOPE_TEMPLATE, strtolower($data['name']), $paired);
        $scopeHtml .= $this->notes($data['notes']);
        $scopeHtml .= $lines5 . '</div>'."\n";

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
}
