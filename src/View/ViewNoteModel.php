<?php

declare(strict_types=1);

namespace Partigen\View;

class ViewNoteModel
{
    private const X_SPACE_PX = 30;
    private const INIT_LEFT_MARGIN_PX = 40;

    private const Y_SPACE_PX = 15; // space betweeen lines
    private const INIT_TOP_MARGIN_PX = 11 + (3*self::Y_SPACE_PX); // init on bottom line

    // Outlines intervales
    private const TOP_LINE = 8;
    private const BOTTOM_LINE = 0;

    // Class name
    private const BASECLASS = 'note';
    private const LINECLASS = 'split';
    private const OUTCLASS = 'notesplit';

    public function convert(int $high): string
    {
        $noteHtml .= '<div class="">n'.'</div>'."\n";

        return $noteHtml;
    }
}
