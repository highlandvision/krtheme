<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_menu
 * @copyright   Copyright (C) 2005 - 2014 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

/** @noinspection PhpUnhandledExceptionInspection */

defined('_JEXEC') or die;

use HighlandVision\KR\Framework\KrMethods;
use HighlandVision\KR\Media;
use HighlandVision\KR\Site;
use Joomla\CMS\HTML\HTMLHelper;

$Itemid   = Site::getComponentItemId('com_knowres', 'property');
$plink    = KrMethods::route('index.php?option=com_knowres&view=property&Itemid=' . $Itemid . '&id='
	. (int) $property_id);
$image    = Media\Images::getPropertyImageName($property_id);
$KRparams = KrMethods::getParams();

$class = $item->anchor_css ? 'class="' . $item->anchor_css . '" ' : '';
$title = $item->anchor_title ? 'title="' . $item->anchor_title . '" ' : '';

if ($item->menu_image)
{
	$item->params->get('menu_text', 1)
		? $linktype = '<img src="' . $item->menu_image . '" alt="' . $item->title . '" />
			<span class="image-title">' . $item->title . '</span> '
		: $linktype = '<img src="' . $item->menu_image . '" alt="' . $item->title . '" />';
}
else
{
	$linktype = $item->title;
}
?>

</ul></div>
<div class="show-for-large large-6 columns clearfix megaright">
	<a href="<?php echo $plink; ?>" title="<?php echo strip_tags($headline); ?>">
		<?php echo $linktype; ?><br>
		<?php echo HTMLHelper::_('image', Media\Images::getImagePath($property_id, 'solo', $image), $headline,
			['width' => $KRparams->get('max_property_width'), 'height' => $KRparams->get('max_property_height')]
		); ?>
		<figcaption><?php echo $headline; ?></figcaption>
	</a>
</div>