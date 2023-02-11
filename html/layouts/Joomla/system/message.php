<?php
/**
 * @package     Joomla.Site
 * @subpackage  Layout
 *
 * @copyright   Copyright (C) 2005 - 2014 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

$msgList = $displayData['msgList'];
?>

<?php if (is_array($msgList) && !empty($msgList)) : ?>
	<?php foreach ($msgList as $type => $msgs) : ?>
		<?php
		if (!$type || $type == "message")
			$type = "success";
		elseif ($type == "error")
			$type = "alert";
		elseif ($type == "notice" || $type == "warning")
			$type = "warning";
		?>

		<?php if (!empty($msgs)) : ?>
		<div class="callout <?php echo $type; ?>" data-closable>
			<button class="close-button" data-close aria-label="Close modal" type="button">
				<span aria-hidden="true">&times;</span>
			</button>
			<?php foreach ($msgs as $msg) : ?>
				<p><?php echo $msg; ?></p>
			<?php endforeach; ?>
		</div>
		<?php endif; ?>
	<?php endforeach; ?>
<?php endif; ?>