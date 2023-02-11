<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_menu
 *
 * @copyright   Copyright (C) 2005 - 2017 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

$id    = '';
$tagId = $params->get('tag_id', '');
if ($tagId)
{
	$id = ' id="' . $tagId . '"';
}
$class = 'nav menu dropdown';
if ($class_sfx)
{
	$class = $class . ' ' . $class_sfx;
}
?>

<ul class="<?php echo $class; ?>" <?php echo $id; ?> data-dropdown-menu>
	<?php foreach ($list as $i => &$item)
	{
		$class   = [];
		$class[] = 'item-' . $item->id;

		if ($item->id == $default_id)
		{
			$class[] = 'default';
		}

		if (($item->id == $active_id) OR ($item->type == 'alias' AND $item->params->get('aliasoptions') == $active_id))
		{
			$class[] = 'current';
		}

		if (in_array($item->id, $path))
		{
			$class[] .= ' active';
		}
		else if ($item->type == 'alias')
		{
			$aliasToId = $item->params->get('aliasoptions');

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

		echo '<li class="' . implode(' ', $class) . '">';

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
			echo '<ul class="menu vertical">';
		}
		else if ($item->shallower)
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