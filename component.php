<?php
/**
 * @package    Know Reservations
 * @subpackage Site template
 * @copyright  2022 Highland Visionb. All rights reserved.
 * @license    See the file "LICENSE.txt" for the full license governing this code.
 * @author     Hazel Wilson <hazel@highlandvision.com>
 */

defined('_JEXEC') or die;

use Joomla\CMS\Factory;

/** @var Joomla\CMS\Document\HtmlDocument $this */
/** @noinspection PhpUnhandledExceptionInspection */
$app = Factory::getApplication();

$wa  = $this->getWebAssetManager();
$wa->usePreset('template.krtheme.site');

$color = $this->params->get('colors', 'colors_default');
$asset  = 'theme.' . $color;
$wa->registerAndUseStyle($asset, 'media/templates/site/krtheme/css/global/' . $color . '.css');
$wa->getAsset('style', 'fontawesome')->setAttribute('rel', 'lazy-stylesheet');
?>

<!DOCTYPE html>
<html lang="<?php echo $this->language; ?>">
<head>
	<jdoc:include type="metas" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<jdoc:include type="styles" />
	<jdoc:include type="scripts" />
</head>
<body class="<?php echo $this->direction === 'rtl' ? 'rtl' : ''; ?>">
<jdoc:include type="message" />
<jdoc:include type="component" />
</body>
</html>
