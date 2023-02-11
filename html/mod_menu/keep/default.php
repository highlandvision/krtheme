<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_menu
 *
 * @copyright   Copyright (C) 2005 - 2013 Open Source Matters, Inc. All rights reserved.
 * @license     http://www.gnu.org/licenses/gpl-3.0.html GNU/GPL
 */

defined( '_JEXEC' ) or die;

// Note. It is important to remove spaces between elements.

// Set bolean to distinuish between topbar and of canvas
$topbar = true;
if ( $class_sfx == " off-canvas-list" ) {
	$topbar = false;
}
?>

<?php // The menu class is deprecated. Use nav instead. ?>
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
		if ( ( $item->id == $active_id ) OR ( $item->type == 'alias' AND $item->params->get( 'aliasoptions' ) == $active_id ) ) {
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

//		if ( $item->deeper ) {
//			$class .= ' deeper';
//		}

		if ( $item->parent ) {
//			$class .= ' parent has-dropdown';
			$class .= ' has-dropdown';
		}

		if ( !empty( $class ) ) {
			$class = ' class="' . trim( $class ) . '"';
		}

		echo '<li' . $class . '>';

		// Check for mega parameters
		$menu_params      = $item->getParams();
		$mega        = $menu_params->get( 'knowresmega_thisismega', 0 );
		$property_id = $menu_params->get( 'knowresmega_property_id', 0 );
		$headline    = $menu_params->get( 'knowresmega_headline', '' );

		if ($topbar && $mega && $property_id ) {
			require JModuleHelper::getLayoutPath( 'mod_menu', 'default_mega' );
		} else {
			// Render the menu item.
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
		}


		// The next item is deeper.
		if ( $item->deeper ) {
			if ( $topbar && $mega && !$property_id ) {
				echo '<ul class="dropdown small knowresmega"><li>';
				echo '<div class="small-12 large-6 columns megaleft"><ul>';
			} else {
				echo '<ul class="dropdown small">';
			}
		} elseif ( $item->shallower ) {
			// The next item is shallower.
			echo '</li>';
			echo str_repeat( '</ul></li class="has-dropdown">', $item->level_diff );
		} else {
			// The next item is on the same level.
			echo '</li>';
		}
	endforeach;
	?>
</ul>