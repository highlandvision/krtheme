<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_menu
 *
 * @copyright   Copyright (C) 2005 - 2017 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

use Joomla\CMS\Helper\ModuleHelper;

defined('_JEXEC') or die;

$id = '';

$tagId = $params->get('tag_id', '');
if ($tagId) {
	$id = ' id="' . $tagId . '"';
}
?>

<ul<?php echo $id; ?> class="nav mod-menu <?php echo $class_sfx; ?>">
	<?php
	foreach ($list as $i => $item) {
		$itemParams = $item->getParams();
		$class      = 'item-' . $item->id;
		if ($item->id == $default_id) {
			$class .= ' default';
		}

		if (($item->id == $active_id) or ($item->type == 'alias' && $itemParams->get('aliasoptions') == $active_id)) {
			$class .= ' current';
		}

		if (in_array($item->id, $path)) {
			$class .= ' active';
		}
		elseif ($item->type == 'alias') {
			$aliasToId = $itemParams->get('aliasoptions');

			if (count($path) > 0 && $aliasToId == $path[count($path) - 1]) {
				$class .= ' active';
			}
			elseif (in_array($aliasToId, $path)) {
				$class .= ' alias-parent-active';
			}
		}

		if ($item->type == 'separator') {
			$class .= ' divider';
		}

		echo '<li class="' . $class . '">';

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
		if ($item->deeper) {
			echo '<ul class="menu nested vertical">';
		}
		elseif ($item->shallower) {
			echo '</li>';
			echo str_repeat('</ul></li>', $item->level_diff);
		}
		else {
			echo '</li>';
		}
	}
	?>
</ul>