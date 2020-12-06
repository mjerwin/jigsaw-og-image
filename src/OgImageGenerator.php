<?php

namespace MJErwin\JigsawOgImage;

use Illuminate\Support\Collection;
use Illuminate\View\View;
use Spatie\Browsershot\Browsershot;
use TightenCo\Jigsaw\Collection\CollectionItem;
use TightenCo\Jigsaw\File\Filesystem;
use TightenCo\Jigsaw\Jigsaw;
use TightenCo\Jigsaw\Parsers\FrontMatterParser;
use TightenCo\Jigsaw\View\BladeCompiler;
use TightenCo\Jigsaw\View\ViewRenderer;

class OgImageGenerator
{
    /** @var Jigsaw */
    protected $jigsaw;

    protected $view;

    /** @var CollectionItem */
    protected $item;

    /**
     * OgImageGenerator constructor.
     * @param Jigsaw $jigsaw
     */
    public function __construct(Jigsaw $jigsaw)
    {
        $this->jigsaw = $jigsaw;
    }

    public function setView($view)
    {
        $this->view = $view;

        return $this;
    }

    /**
     * @param CollectionItem $item
     */
    public function setItem(CollectionItem $item)
    {
        $this->item = $item;

        return $this;
    }

    public function save($filename)
    {
        /** @var ViewRenderer $view */
        $view = $this->jigsaw->app[ViewRenderer::class];

        // @todo Allow to be overriden in config
        // @todo Command to publish default template
        $html = $view->render($this->jigsaw->getSourcePath() . '/_og/default.blade.php', new Collection([
            'page' => $this->item,
        ]));

//        $this->jigsaw->getFilesystem()->put($this->jigsaw->getSourcePath().'/../test.html', $html);

        Browsershot::html($html)
            ->windowSize(800, 300)
            ->quality(100)
            ->save($filename);
    }
}