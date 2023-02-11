<?php
/**
 * @package    Know Reservations
 * @subpackage Plugin
 * @copyright  2017 Highland Vision. All rights reserved.
 * @license    See the file "LICENSE.txt" for the full license governing this code.
 * @author     Hazel Wilson <hazel@highlandvision.com>
 */

defined('_JEXEC') or die;
?>

<div class="row collapse">
	<div class="small-12 medium-3 columns">
		<h3>Search by<br><span class="font-secondary">Feature</span></h3>
	</div>
	<div class="small-12 medium-9 columns">
		<ul class="nav menu<?php echo $class_sfx; ?>"
			<?php
			$tag = '';
			if ( $params->get( 'tag_id' ) != NULL ) {
				$tag = $params->get( 'tag_id' ) . '';
				echo ' id="' . $tag . '"';
			}
			?>>

			<?php
			foreach ( $list as $i => &$item ) :
				$class = 'item-' . $item->id;
				if ( $item->id == $active_id ) {
					$class .= ' current';
				}

				if ( in_array( $item->id, $path ) ) {
					$class .= ' active';
				} elseif ( $item->type == 'alias' ) {
					$aliasToId = $item->params->get( 'aliasoptions' );
					if ( count( $path ) > 0 && $aliasToId == $path[count( $path ) - 1] ) {
						$class .= ' active';
					} elseif ( in_array( $aliasToId, $path ) ) {
						$class .= ' alias-parent-active';
					}
				}

				if ( $item->type == 'separator' ) {
					$class .= ' divider';
				}

				echo '<li class=' . $class . '>';

				switch ( $item->type ) :
					case 'separator':
					case 'url':
					case 'component':
					case 'heading':
						require JModuleHelper::getLayoutPath( 'mod_menu', 'default_' . $item->type );
						break;

					default:
						require JModuleHelper::getLayoutPath( 'mod_menu', 'default_url' );
						break;
				endswitch;

				if ( $item->deeper ) {
					// This item item is deeper.
					echo '<ul class="dropdown nav-child unstyled small">';
				}
				elseif ( $item->shallower ) {
					// This item is shallower
					echo '</li>';
					echo str_repeat( '</ul></li>', $item->level_diff );
				}
				else {
					// This item is on the same level.
					echo '</li>';
				}
			endforeach;
			?>
		</ul>
	</div>
</div>