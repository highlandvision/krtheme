<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_menu
 * @copyright   Copyright (C) 2005 - 2017 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

use Joomla\CMS\Helper\ModuleHelper;

$id    = '';
$tagId = $params->get('tag_id', '');
if ($tagId)
{
	$id = ' id="' . $tagId . '"';
}
$class = 'dropdown menu';
if ($class_sfx)
{
	$class = $class . ' ' . $class_sfx;
}
?>

<ul class="<?php echo $class; ?>" <?php echo $id; ?> data-dropdown-menu>
	<?php foreach ($list as $i => $item)
	{
		$itemParams = $item->getParams();
		$class      = [];
		$class[]    = 'item-' . $item->id;

		if ($item->id == $default_id)
		{
			$class[] = 'default';
		}
		if (($item->id == $active_id) || ($item->type == 'alias' && $itemParams->get('aliasoptions') == $active_id))
		{
			$class[] = 'current';
		}
		if (in_array($item->id, $path))
		{
			$class[] .= ' active';
		}
		else if ($item->type == 'alias')
		{
			$aliasToId = $itemParams->get('aliasoptions');
			if (count($path) > 0 && $aliasToId == $path[count($path) - 1])
			{
				$class[] = 'active';
			}
			else if (in_array($aliasToId, $path))
			{
				$class[] = 'alias-parent-active';
			}
		}
		if ($item->type == 'separator')
		{
			$class[] = 'divider';
		}
		if ($item->deeper)
		{
			$class[] = 'is-dropdown-submenu-parent';
		}

		echo '<li class="' . implode(' ', $class) . '">';

		// Render the menu item.
		switch ($item->type) :
			case 'separator':
			case 'component':
			case 'heading':
			case 'url':
				require ModuleHelper::getLayoutPath('mod_menu', 'default_' . $item->type);
				break;
			default:
				require ModuleHelper::getLayoutPath('mod_menu', 'default_url');
				break;
		endswitch;

		// The next item is deeper.
		if ($item->deeper)
		{
			echo '<ul class="menu">';
		}
		else if ($item->shallower)
		{
			echo '</li>';
			echo str_repeat('</ul></li>', $item->level_diff);
		}
		else
		{
			echo '</li>';
		}
	}
	?>
</ul>