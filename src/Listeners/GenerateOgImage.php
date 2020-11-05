<?php

namespace MJErwin\JigsawOgImage\Listeners;

use Illuminate\Support\Facades\File;
use MJErwin\JigsawOgImage\OgImageGenerator;
use TightenCo\Jigsaw\Collection\CollectionItem;
use TightenCo\Jigsaw\File\Filesystem;
use TightenCo\Jigsaw\Jigsaw;
use TightenCo\Jigsaw\PageVariable;

class GenerateOgImage
{
    public function handle(Jigsaw $jigsaw)
    {
        /** @var Filesystem $fs */
        $fs = $jigsaw->getFilesystem();

        $img_dir = $jigsaw->getDestinationPath() . '/assets/images/og';

        $fs->makeDirectory(
            $img_dir,
            0755,
            true
        );

        $fs->makeDirectory($jigsaw->getConfig()['view.compiled'], 0755, true);

        foreach($jigsaw->getCollections() as $type => $collection)
        {
            /** @var PageVariable $collection */
            foreach($collection as $item_key => $item)
            {
                /** @var CollectionItem $item */

                $filename = sprintf('%s/%s-%s.jpg',$img_dir, $type, $item_key);

                $generator = new OgImageGenerator();
                $generator->setView('basic');
                $generator->save($filename);
            }
        }
    }
}