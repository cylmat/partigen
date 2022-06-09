<?php

declare(strict_types=1);

namespace Partigen\View;

class ViewScopeModel implements ViewModelInterface
{
    private ViewNoteModel $viewNote;

    public function __construct(ViewNoteModel $viewNote)
    {
        $this->viewNote = $viewNote;
    }

    public function convert(array $data): string
    {
        $lines5 = '';
        for ($l=0; $l<5; $l++) {
            $lines5 .= '<div class="line"></div>'."\n";
        }

        $scopeHtml = '';
        foreach ($data as $notesData) {
            $notesData = $this->notes($notesData);
            $scopeHtml .= '<div class="scope-' . $data['type'] . '">'.'</div>'."\n";
        }

        return $scopeHtml;
    }

    private function notes(array $notesData): string
    {
        $notesHtml = '';
        foreach ($notesData as $noteData) {
            $notesHtml .= $this->viewNote->convert($noteData);
        }

        return '<div class="notes">'.$notesHtml.'</div>'."\n";
    }
}
