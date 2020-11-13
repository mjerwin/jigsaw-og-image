<?php

namespace MJErwin\JigsawOgImage\Listeners;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\File;
use Illuminate\View\Factory;
use MJErwin\JigsawOgImage\OgImageGenerator;
use Symfony\Component\Finder\SplFileInfo;
use TightenCo\Jigsaw\Collection\CollectionItem;
use TightenCo\Jigsaw\File\Filesystem;
use TightenCo\Jigsaw\Handlers\BladeHandler;
use TightenCo\Jigsaw\Jigsaw;
use TightenCo\Jigsaw\PageVariable;
use TightenCo\Jigsaw\Parsers\FrontMatterParser;
use TightenCo\Jigsaw\View\ViewRenderer;

class CopyOgImages
{
    public function handle(Jigsaw $jigsaw)
    {
        /** @var Filesystem $fs */
        $fs = $jigsaw->getFilesystem();

        $img_dir = $jigsaw->getDestinationPath() . '/assets/images/og';

        $fs->copyDirectory($img_dir, $jigsaw->getDestinationPath() . '/../og_cache');
    }
}