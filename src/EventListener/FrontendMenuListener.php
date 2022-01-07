<?php

declare(strict_types=1);

/*
 * This file is part of the Contao News Navigation extension.
 *
 * (c) inspiredminds
 *
 * @license LGPL-3.0-or-later
 */

namespace InspiredMinds\ContaoNewsNavigation\EventListener;

use Contao\CoreBundle\Event\FrontendMenuEvent;
use Contao\Input;
use Contao\News;
use Contao\StringUtil;
use InspiredMinds\ContaoNewsNavigation\NewsItemsHelper;
use Terminal42\ServiceAnnotationBundle\Annotation\ServiceTag;

/**
 * @ServiceTag("kernel.event_listener")
 */
class FrontendMenuListener
{
    private $helper;

    public function __construct(NewsItemsHelper $helper)
    {
        $this->helper = $helper;
    }

    public function __invoke(FrontendMenuEvent $event): void
    {
        $tree = $event->getTree();
        $extras = $tree->getExtras();

        if (!$extras['addNewsMenuItems']) {
            return;
        }

        $archives = array_map('intval', StringUtil::deserialize($extras['newsMenuArchives']));
        $articles = $this->helper->fetchNewsItems($archives, $extras['newsMenuOrder'], $extras['newsMenuFeatured'], (int) $extras['newsMenuNumberOfItems'], (int) $extras['newsMenuSkipFirst']);

        if (empty($articles)) {
            return;
        }

        $factory = $event->getFactory();

        foreach ($articles as $news) {
            $item = $factory->createItem($news->headline);

            $href = News::generateNewsUrl($news);
            $item->setUri($href);

            $extra = $news->row();
            $extra['isActive'] = Input::get('auto_item', false, true) === $news->alias;
            $extra['class'] = $extra['isActive'] ? 'active' : '';
            $extra['title'] = StringUtil::specialchars($news->headline, true);
            $extra['link'] = $href;
            $extra['newsModel'] = $news;

            foreach ($extra as $k => $v) {
                $item->setExtra($k, $v);
            }

            $tree->addChild($item);
        }

        $tree->setDisplayChildren(true);
    }
}
