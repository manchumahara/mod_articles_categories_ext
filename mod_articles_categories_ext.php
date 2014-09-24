<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_articles_categories_ext
 *
 * @copyright   Copyright (C) 2005 - 2014 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;
//error_reporting(E_ALL);
//ini_set('display_errors', '1');

// Include the helper functions only once
require_once __DIR__ . '/helper.php';



$cacheid = md5(serialize($module->module));

$cacheparams = new stdClass;
$cacheparams->cachemode = 'id';
$cacheparams->class = 'ModArticlesCategoriesHelperext';
$cacheparams->method = 'getList';
$cacheparams->methodparams = $params;
$cacheparams->modeparams = $cacheid;

$list = JModuleHelper::moduleCache($module, $params, $cacheparams);

//var_dump($list);

if (!empty($list))
{
	$moduleclass_sfx = htmlspecialchars($params->get('moduleclass_sfx'));
	$startLevel = reset($list)->getParent()->level;
	require JModuleHelper::getLayoutPath('mod_articles_categories_ext', $params->get('layout', 'default'));
}
