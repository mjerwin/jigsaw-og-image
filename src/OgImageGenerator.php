<?php

namespace MJErwin\JigsawOgImage;

use Illuminate\View\View;
use Spatie\Browsershot\Browsershot;
use TightenCo\Jigsaw\File\Filesystem;
use TightenCo\Jigsaw\View\BladeCompiler;

class OgImageGenerator
{
    protected $view;

    public function setView($view)
    {
        $this->view = $view;

        return $this;
    }

    public function save($filename)
    {
        $fs = new Filesystem();

        $compiler = new BladeCompiler($fs, cwd() . '/cache');
        $blade = $fs->get(__DIR__ . '/../_layouts/basic.blade.php');
        $html = $compiler->compileString($blade);

        Browsershot::html($html)
            ->windowSize(800, 600)
            ->quality(100)
            ->save($filename);
    }
}