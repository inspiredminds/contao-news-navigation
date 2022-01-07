<?php

declare(strict_types=1);

/*
 * This file is part of the Contao News Navigation extension.
 *
 * (c) inspiredminds
 *
 * @license LGPL-3.0-or-later
 */

namespace InspiredMinds\ContaoNewsNavigation\EventListener\DataContainer;

use Contao\CoreBundle\DataContainer\PaletteManipulator;
use Contao\CoreBundle\Routing\Page\PageRegistry;
use Contao\CoreBundle\ServiceAnnotation\Callback;
use Contao\DataContainer;
use Contao\PageModel;

/**
 * @Callback(table="tl_page", target="config.onload")
 */
class AdjustPagePalettesListener
{
    private $pageRegistry;

    public function __construct(PageRegistry $pageRegistry)
    {
        $this->pageRegistry = $pageRegistry;
    }

    public function __invoke(DataContainer $dc): void
    {
        if (!$dc->id) {
            return;
        }

        $page = PageModel::findById($dc->id);

        if ('root' === $page->type || !$this->pageRegistry->isRoutable($page)) {
            return;
        }

        PaletteManipulator::create()
            ->addLegend('newsmenu_legend', 'expert_legend')
            ->addField('addNewsMenuItems', 'newsmenu_legend', PaletteManipulator::POSITION_APPEND)
            ->applyToPalette($page->type, 'tl_page')
        ;
    }
}
