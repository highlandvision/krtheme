<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_menu
 * @copyright   Copyright (C) 2005 - 2018 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

use Joomla\CMS\Helper\ModuleHelper;

$wa = $app->getDocument()->getWebAssetManager();
$wa->getRegistry()->addExtensionRegistryFile('com_knowres');
$wa->useScript('com_knowres.site-modules');

$id    = '';
$tagId = $params->get('tag_id', '');
if ($tagId) {
	$id = ' id="' . $tagId . '"';
}
?>

<ul<?php echo $id; ?> class="nav dropdown menu" data-dropdown-menu data-disable-hover="true" data-click-open="true">
	<?php foreach ($list as $i => $item) {
		$class   = [];
		$class[] = 'item-' . $item->id;

		if ($item->id == $default_id) {
			$class[] = 'default';
		}

		if (($item->id == $active_id) || ($item->type == 'alias' && $item->params->get('aliasoptions') == $active_id)) {
			$class[] = 'current';
		}

		if (in_array($item->id, $path)) {
			$class[] = 'active';
		} elseif ($item->type == 'alias') {
			$aliasToId = $item->params->get('aliasoptions');

			if (count($path) > 0 && $aliasToId == $path[count($path) - 1]) {
				$class[] = 'active';
			}
			elseif (in_array($aliasToId, $path)) {
				$class[] = 'alias-parent-active';
			}
		}

		if ($item->type == 'separator') {
			$class[] = 'divider';
		}

		if (count($class)) {
			echo '<li class="' . implode(' ', $class) . '">';
		}

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

		if ($item->deeper) {
			echo '<ul class="menu ' . $item->anchor_css . '">';
		} elseif ($item->shallower) {
			echo '</li>';
			echo str_repeat('</ul></li>', $item->level_diff);
		} else {
			echo '</li>';
		}
	}
	?>
</ul>