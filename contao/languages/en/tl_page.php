<?php

declare(strict_types=1);

/*
 * This file is part of the Contao News Navigation extension.
 *
 * (c) inspiredminds
 *
 * @license LGPL-3.0-or-later
 */

use Contao\System;

System::loadLanguageFile('tl_module');

$GLOBALS['TL_LANG']['tl_page']['newsmenu_legend'] = 'News submenu';
$GLOBALS['TL_LANG']['tl_page']['addNewsMenuItems'] = ['Add news articles to submenu', 'Enables news articles in the submenu for this page in the navigation.'];
$GLOBALS['TL_LANG']['tl_page']['newsMenuNumberOfItems'] = &$GLOBALS['TL_LANG']['tl_module']['numberOfItems'];
$GLOBALS['TL_LANG']['tl_page']['newsMenuSkipFirst'] = &$GLOBALS['TL_LANG']['tl_module']['skipFirst'];
$GLOBALS['TL_LANG']['tl_page']['newsMenuArchives'] = &$GLOBALS['TL_LANG']['tl_module']['news_archives'];
$GLOBALS['TL_LANG']['tl_page']['newsMenuFeatured'] = &$GLOBALS['TL_LANG']['tl_module']['news_featured'];
$GLOBALS['TL_LANG']['tl_page']['newsMenuOrder'] = &$GLOBALS['TL_LANG']['tl_module']['news_order'];
