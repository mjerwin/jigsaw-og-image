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

class GenerateOgImage
{
    public function handle(Jigsaw $jigsaw)
    {
        /** @var BladeHandler $bh */
        $bh = $jigsaw->app[BladeHandler::class];

        /** @var Filesystem $fs */
        $fs = $jigsaw->getFilesystem();

        $img_dir = $jigsaw->getDestinationPath() . '/assets/images/og';

        $fs->makeDirectory(
            $img_dir,
            0755,
            true
        );

        $fs->copyDirectory($jigsaw->getDestinationPath() . '/../og_cache', $img_dir);

        $fs->makeDirectory($jigsaw->getConfig()['view.compiled'], 0755, true);

        foreach ($jigsaw->getCollections() as $type => $collection) {
            /** @var PageVariable $collection */
            foreach ($collection as $item_key => $item) {
                /** @var CollectionItem $item */

                $filename = sprintf('%s/%s-%s.jpg', $img_dir, $type, $item_key);

                if ($fs->exists($filename)) {
                    continue;
                }

                $generator = new OgImageGenerator($jigsaw);
                $generator->setView('basic');
                $generator->setItem($item);
                $generator->save($filename);
            }
        }
    }
}