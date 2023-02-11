<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_menu
 *
 * @copyright   Copyright (C) 2005 - 2018 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

$wa = $app->getDocument()->getWebAssetManager();
$wa->useScript('com_knowres.site-modules');
$wa->usePreset('template.krtheme.site');

$id = '';
$tagId = $params->get('tag_id', '');
if ($tagId)
{
	$id = ' id="' . $tagId . '"';
}
?>

<ul class="nav menu dropdown<?php echo $class_sfx; ?>"<?php echo $id; ?> data-dropdown-menu>
	<?php foreach ($list as $i => &$item)
	{
		$class = 'item-' . $item->id;
		$itemParams = $item->getParams();

		if ($item->id == $default_id)
		{
			$class .= ' default';
		}

		if (($item->id == $active_id) OR ($item->type == 'alias' AND $itemParams->get('aliasoptions') == $active_id))
		{
			$class .= ' current';
		}

		if (in_array($item->id, $path))
		{
			$class .= ' active';
		}
		elseif ($item->type == 'alias')
		{
			$aliasToId = $itemParams->get('aliasoptions');

			if (count($path) > 0 && $aliasToId == $path[count($path) - 1])
			{
				$class .= ' active';
			}
			elseif (in_array($aliasToId, $path))
			{
				$class .= ' alias-parent-active';
			}
		}

		if ($item->type == 'separator')
		{
			$class .= ' divider';
		}

		echo '<li class="' . $class . '">';

		// Render the menu item.
		switch ($item->type) :
			case 'separator':
			case 'component':
			case 'heading':
			case 'url':
				require JModuleHelper::getLayoutPath('mod_menu', 'default_' . $item->type);
				break;

			default:
				require JModuleHelper::getLayoutPath('mod_menu', 'default_url');
				break;
		endswitch;

		// The next item is deeper.
		if ($item->deeper)
		{
			echo '<ul class="menu ' . $item->anchor_css . '">';
		}
		elseif ($item->shallower)
		{
			// The next item is shallower.
			echo '</li>';
			echo str_repeat('</ul></li>', $item->level_diff);
		}
		else
		{
			// The next item is on the same level.
			echo '</li>';
		}
	}
	?>
</ul>