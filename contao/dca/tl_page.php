<?php

declare(strict_types=1);

/*
 * This file is part of the Contao News Navigation extension.
 *
 * (c) inspiredminds
 *
 * @license LGPL-3.0-or-later
 */

use Contao\Controller;

Controller::loadDataContainer('tl_module');

$GLOBALS['TL_DCA']['tl_page']['fields']['addNewsMenuItems'] = [
    'exclude' => true,
    'inputType' => 'checkbox',
    'eval' => ['submitOnChange' => true],
    'sql' => ['type' => 'boolean', 'default' => false],
];

$GLOBALS['TL_DCA']['tl_page']['fields']['newsMenuNumberOfItems'] = $GLOBALS['TL_DCA']['tl_module']['fields']['numberOfItems'];
$GLOBALS['TL_DCA']['tl_page']['fields']['newsMenuSkipFirst'] = $GLOBALS['TL_DCA']['tl_module']['fields']['skipFirst'];
$GLOBALS['TL_DCA']['tl_page']['fields']['newsMenuArchives'] = $GLOBALS['TL_DCA']['tl_module']['fields']['news_archives'];
$GLOBALS['TL_DCA']['tl_page']['fields']['newsMenuFeatured'] = $GLOBALS['TL_DCA']['tl_module']['fields']['news_featured'];
$GLOBALS['TL_DCA']['tl_page']['fields']['newsMenuOrder'] = $GLOBALS['TL_DCA']['tl_module']['fields']['news_order'];

$GLOBALS['TL_DCA']['tl_page']['palettes']['__selector__'][] = 'addNewsMenuItems';
$GLOBALS['TL_DCA']['tl_page']['subpalettes']['addNewsMenuItems'] = 'newsMenuArchives,newsMenuFeatured,newsMenuOrder,newsMenuNumberOfItems,newsMenuSkipFirst';
