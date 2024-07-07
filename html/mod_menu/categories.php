<?php
/**
 * @package    Know Reservations
 * @subpackage Plugin
 * @copyright  2017 Highland Vision. All rights reserved.
 * @license    See the file "LICENSE.txt" for the full license governing this code.
 * @author     Hazel Wilson <hazel@highlandvision.com>
 */

defined('_JEXEC') or die;

use Joomla\CMS\Helper\ModuleHelper;

$tag_id = '';
if (!empty($params->get('tag_id')))
{
	$tag_id = 'id=' . $params->get('tag_id');
}
?>

<div class="row">
	<div class="small-12 medium-3 columns">
		<h2>Search by<br><span class="color-secondary">Feature</span></h2>
	</div>
	<div class="small-12 medium-9 columns">
		<ul class="nav menu<?php echo $class_sfx; ?>" <?php echo $tag_id; ?>>
		<?php
		foreach ($list as $i => $item) {
			$itemParams = $item->getParams();
			$class      = 'item-' . $item->id;
			if ($item->id == $active_id)
			{
				$class .= ' current';
			}

			if (in_array($item->id, $path)) {
				$class .= ' active';
			}
			else if ($item->type == 'alias')
			{
				$aliasToId = $itemParams->get('aliasoptions');
				if (count($path) > 0 && $aliasToId == $path[count($path) - 1])
				{
					$class .= ' active';
				}
				else if (in_array($aliasToId, $path))
				{
					$class .= ' alias-parent-active';
				}
			}

			if ($item->type == 'separator')
			{
				$class .= ' divider';
			}

			echo '<li class=' . $class . '>';
			switch ($item->type) :
				case 'separator':
				case 'url':
				case 'component':
				case 'heading':
					require ModuleHelper::getLayoutPath('mod_menu', 'default_' . $item->type);
					break;
				default:
					require ModuleHelper::getLayoutPath('mod_menu', 'default_url');
					break;
			endswitch;

			if ($item->deeper)
			{
				echo '<ul class="dropdown nav-child unstyled small">';
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
	</div>
</div>