<?php
/**
 * @package    Know Reservations
 * @subpackage Site Error
 * @copyright  2018 Highland Vision. All rights reserved.
 * @license    See the file "LICENSE.txt" for the full license governing this code.
 * @author     Hazel Wilson <hazel@highlandvision.com>
 */

defined('_JEXEC') or die;

use Joomla\CMS\Factory;

if (!isset($this->error))
{
	$this->error = JError::raiseWarning(404, JText::_('JERROR_ALERTNOAUTHOR'));
	$this->debug = false;
}

//get language and direction
$doc             = Factory::getDocument();
$this->language  = $doc->language;
$this->direction = $doc->direction;

$title       = 'Sorry to interrupt but something is wrong....';
$description = 'Please try again as it may just be temporary<br>but if the problem persists then please contact us';
$notify      = 'Our technical team have been notified';
?>

<!DOCTYPE html>
<html class="no-js" lang="<?php echo $this->language; ?>">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<meta name="HandheldFriendly" content="True">
	<title>Error Page</title>
	<style>
		body {
			margin:      0;
			font-family: sans-serif;
		}
		.object {
			margin-top: 5%;
			text-align: center;
			color:      #666;
		}
	</style>
</head>

<body style="background-color:#e1e1e1;">
<div class="object">
	<div class="error">
		<h1><?php echo $title; ?></h1>
	</div>
	<img src="<?php echo $this->baseurl . "/templates/" . Factory::getApplication()
	                                                              ->getTemplate() . "/error.jpg"; ?>" width="360px">
	<div class="desc">
		<h2><?php echo $description; ?></h2>
	</div>
	<div class="desc">
		<h4><?php echo $notify; ?></h4>
	</div>
	<div>
		<a href="<?php echo $this->baseurl; ?>/index.php" title="<?php echo JText::_('HOME'); ?>">
			<?php echo JText::_('HOME'); ?>
		</a>
	</div>
</div>
</body>
</html>