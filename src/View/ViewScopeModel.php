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

        $paired = $data['paired'] ? 'paired ' : '';
        $scopeHtml = '<div class="scope ' . $paired . strtolower($data['type']) . '-scope' . '">' . "\n" ;
        $scopeHtml .= $this->notes($data['notes'], $data['type']);
        $scopeHtml .= $lines5 . '</div>'."\n";

        return $scopeHtml;
    }

    private function notes(array $notesData, string $scopeType): string
    {
        $notesHtml = '';
        foreach ($notesData as $index => $noteData) {
            $notesHtml .= $this->viewNote->convert([
                'index' => $index, // x
                'high' => $noteData['high'], // y
                'scope' => $scopeType, // min-max
            ]);
        }

        return '<div class="notes">'."\n".$notesHtml.'</div>'."\n";
    }
}
