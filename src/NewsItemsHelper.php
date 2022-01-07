<?php

declare(strict_types=1);

/*
 * This file is part of the Contao News Navigation extension.
 *
 * (c) inspiredminds
 *
 * @license LGPL-3.0-or-later
 */

namespace InspiredMinds\ContaoNewsNavigation;

use Contao\ModuleNewsList;
use Contao\NewsModel;

class NewsItemsHelper extends ModuleNewsList
{
    public function __construct()
    {
        // noop
    }

    /**
     * @return array<NewsModel>
     */
    public function fetchNewsItems(array $archives, string $order, ?string $featured = null, int $limit = 0, int $offset = 0): array
    {
        $this->news_order = $order;
        $this->news_featured = $featured;
        $fetchFeatured = null;

        if ('featured' === $this->news_featured) {
            $fetchFeatured = true;
        } elseif ('unfeatured' === $this->news_featured) {
            $fetchFeatured = false;
        }

        $collection = parent::fetchItems($archives, $fetchFeatured, $limit, $offset);

        if (null === $collection) {
            return [];
        }

        return $collection->getModels();
    }
}
