<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_articles_categories
 *
 * @copyright   Copyright (C) 2005 - 2014 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

require_once JPATH_SITE . '/components/com_content/helpers/route.php';

/**
 * Helper for mod_articles_categories
 *
 * @package     Joomla.Site
 * @subpackage  mod_articles_categories
 *
 * @since       1.5.0
 */
abstract class ModArticlesCategoriesHelperext
{
	/**
	 * Get list of articles
	 *
	 * @param   JRegistry  &$params  module parameters
	 *
	 * @return array
	 */
	public static function getList(&$params)
	{
		$options = array();
		$options['countItems'] = $params->get('numitems', 0);

		$categories = JCategories::getInstance('Content', $options);
        //var_dump($params->get('parent', 'root'));
        $parents = $params->get('parents', '');

        //var_dump($parents);

        //exit();

        if(!empty($parents)){
            if(!is_array($parents)){
                $parents = (array)$parents;
            }

//            echo '<pre>';
//            print_r($parents);
//            echo '</pre>';

            //exit();
            $globalitems = array();
            foreach($parents as $parent){
                //var_dump($parent);
                $category = $categories->get($parent);

                //var_dump($category);

                if ($category != null)
                {
                    $items = $category->getChildren();

                    if ($params->get('count', 0) > 0 && count($items) > $params->get('count', 0))
                    {
                        $items = array_slice($items, 0, $params->get('count', 0));
                        //var_dump($globalitems);
                    }

                    $globalitems = array_merge($globalitems,$items);
                }
            }//end loop
            return $globalitems;
        }

	}
}
