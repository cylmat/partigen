<?php

namespace spec\Partigen\App\View;

use Partigen\App\View\ImageView;
use Partigen\Model\Image;
use PhpSpec\ObjectBehavior;

class ImageViewSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(ImageView::class);
    }

    function it_can_render(Image $image)
    {
        $image->getFilepath()->willReturn(tempnam('/tmp', ''));
        $this->render($image)->shouldBeString();
    }
}
