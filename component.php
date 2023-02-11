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
$app = Factory::getApplication();
$wa  = $this->getWebAssetManager();

//// Color Theme
//$paramsColorName = $this->params->get('colorName', 'colors_standard');
//$assetColorName  = 'theme.' . $paramsColorName;
//$wa->registerAndUseStyle($assetColorName, 'media/templates/site/cassiopeia/css/global/' . $paramsColorName . '.css');

//// Use a font scheme if set in the template style options
//$paramsFontScheme = $this->params->get('useFontScheme', false);
//$fontStyles       = '';
//
//if ($paramsFontScheme) {
//	if (stripos($paramsFontScheme, 'https://') === 0) {
//		$this->getPreloadManager()->preconnect('https://fonts.googleapis.com/', ['crossorigin' => 'anonymous']);
//		$this->getPreloadManager()->preconnect('https://fonts.gstatic.com/', ['crossorigin' => 'anonymous']);
//		$this->getPreloadManager()->preload($paramsFontScheme, ['as' => 'style', 'crossorigin' => 'anonymous']);
//		$wa->registerAndUseStyle('fontscheme.current', $paramsFontScheme, [], ['media' => 'print', 'rel' => 'lazy-stylesheet', 'onload' => 'this.media=\'all\'', 'crossorigin' => 'anonymous']);
//
//		if (preg_match_all('/family=([^?:]*):/i', $paramsFontScheme, $matches) > 0) {
//			$fontStyles = '--cassiopeia-font-family-body: "' . str_replace('+', ' ', $matches[1][0]) . '", sans-serif;
//			--cassiopeia-font-family-headings: "' . str_replace('+', ' ', isset($matches[1][1]) ? $matches[1][1] : $matches[1][0]) . '", sans-serif;
//			--cassiopeia-font-weight-normal: 400;
//			--cassiopeia-font-weight-headings: 700;';
//		}
//	} else {
//		$wa->registerAndUseStyle('fontscheme.current', $paramsFontScheme, ['version' => 'auto'], ['media' => 'print', 'rel' => 'lazy-stylesheet', 'onload' => 'this.media=\'all\'']);
//		$this->getPreloadManager()->preload($wa->getAsset('style', 'fontscheme.current')->getUri() . '?' . $this->getMediaVersion(), ['as' => 'style']);
//	}
//}

// Enable assets
$wa = $this->getWebAssetManager();
$wa->usePreset('template.krtheme.site');
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
