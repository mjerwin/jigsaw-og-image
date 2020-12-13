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

        $jigsaw->setConfig('getOgTag', function (PageVariable $page) use ($jigsaw) {
            $type = $page->_meta->collectionName;

            if ($type !== 'posts') {
                return null;
            }

            $item_key = basename($page->getPath());

            $filename = sprintf('%s-%s.jpg', $type, $item_key);

            $url = sprintf('%s/assets/images/og/%s', $page->baseUrl, $filename);

            return vsprintf('<meta property="og:image" content="%s" />
                        <meta name="twitter:image" content="%s">', [
                $url, $url,
            ]);
        });
    }
}