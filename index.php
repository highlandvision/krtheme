<?php
/**
 * @package    Know Reservations
 * @subpackage Site Template
 * @copyright  2021 Highland Vision. All rights reserved.
 * @license    See the file "LICENSE.txt" for the full license governing this code.
 * @author     Hazel Wilson <hazel@highlandvision.com>
 */
/** @noinspection PhpUnhandledExceptionInspection */

defined('_JEXEC') or die ();

use Joomla\CMS\Factory;

/** @var Joomla\CMS\Document\HtmlDocument $this */
$app = Factory::getApplication();

$logo     = $this->params->get('logo');
$sitename = htmlspecialchars($app->get('sitename'), ENT_QUOTES, 'UTF-8');
$homepage = false;
/** @noinspection PhpPossiblePolymorphicInvocationInspection */
$menu = $app->getMenu();
if ($menu->getActive() === $menu->getDefault()) {
	$homepage = true;
}

$live = true;
if (str_contains($_SERVER['SERVER_NAME'], '.test')) {
	$live = false;
}

$this->setMetaData('viewport', 'width=device-width, initial-scale=1');
$color = $this->params->get('colors', 'colors_default');
$asset = 'theme.' . $color;
$wa = $this->getWebAssetManager();
$wa->usePreset('template.krtheme.site');
$wa->registerAndUseStyle($asset, $color . '.css');
$wa->getAsset('style', 'fontawesome')->setAttribute('rel', 'lazy-stylesheet');
?>

<!DOCTYPE html>
<html class="no-js" lang="<?php echo $this->language; ?>" dir="<?php echo $this->direction; ?>">
<head>
	<script src='https://js.stripe.com/v3/' defer></script>
	<jdoc:include type="metas"/>
	<jdoc:include type="styles"/>
	<jdoc:include type="scripts"/>
</head>

<body>
<div class="off-canvas-wrapper">
	<div class="off-canvas position-left kr-offcanvas" id="kr-offcanvas-left-menu" data-off-canvas
	     data-transition="overlap">
		<button class="close-button" aria-label="Close menu" type="button" data-close>
			<i class='fa-solid fa-close' aria-hidden="true"></i>
		</button>
		<jdoc:include type="modules" name="menu-mobile"/>
	</div>
	<div class="off-canvas position-left kr-offcanvas kr-sortby" id="kr-offcanvas-properties-sortby"
	     data-off-canvas data-transition="overlap">
	</div>
	<div class="off-canvas position-right kr-offcanvas kr-filters" id="kr-offcanvas-properties-filter"
	     data-off-canvas data-transition="overlap">
	</div>

	<!--	Main content -->
	<div class="off-canvas-content" data-off-canvas-content>
<!--		<div id="kr-overlay"></div>-->
		<nav class="nav-section">
			<!-- hamburger and logo for small / medium -->
			<div class="title-bar hide-for-large">
				<!-- top bar hamburger for off canvas left menu link and logo-->
				<div class="title-bar-left">
					<button type="button" class="menu-icon" aria-label="Toggle menu"
					        data-toggle="kr-offcanvas-left-menu">
					</button>
					<button type="button" class="search-icon hide-for-large" aria-label="Toggle search"
					        data-toggle="kr-offcanvas-top-search">
					</button>
				</div>
				<div class="title-bar-title text-right">
					<div class="logo-image">
						<a href="/" title="<?php echo $sitename; ?>">
							<img src="<?php echo $logo; ?>" class="responsive logo" alt="<?php echo $sitename; ?>">
						</a>
					</div>
				</div>
			</div>
			<div id="userbar" class="show-for-large">
				<jdoc:include type="modules" name="userbar" style="html5"/>
			</div>
			<div id="topbar" class="show-for-large">
				<div class="large-3 cell topbar-left">
					<a href="/" title="<?php echo $sitename; ?>">
						<img src="<?php echo $logo; ?>" class="logo" alt="<?php echo $sitename; ?>">
					</a>
				</div>
				<div class="large-8 cell topbar-right">
					<jdoc:include type="modules" name="topbar-right" style="html5"/>
				</div>
				<div class="large-1 cell topbar-autosearch">
					<jdoc:include type="modules" name="autosearch"/>
				</div>
			</div>
		</nav>

		<?php if ($this->countModules('hero-sticky', true)): ?>
			<div id="kr-hero" class="top">
				<div class="off-canvas position-top" id="kr-offcanvas-top-search" data-off-canvas
				     data-options="inCanvasOn:large;" data-transition="overlap" data-content-scroll="false">
					<div data-sticky-container>
						<div data-sticky data-sticky-on="small" data-margin-top="0" data-top-anchor="topbar:bottom"
						     data-check-every="-1">
								<jdoc:include type="modules" name="hero-sticky" style="html5"/>
						</div>
					</div>
				</div>
			</div>
		<?php elseif ($this->countModules('hero-slider', true)): ?>
			<div id="kr-hero" class="slider">
				<jdoc:include type="modules" name="hero-slider" style="xhtml"/>
				<?php if ($this->countModules('hero-search', true)): ?>
					<jdoc:include type="modules" name="hero-search" style="html5"/>
				<?php endif; ?>
			</div>
		<?php endif; ?>

		<!--main section-->
		<section id="main" class="grid-container">
			<div class="grid-x grid-margin-x">
				<div class="small-12 cell">
					<jdoc:include type="message"/>
				</div>

				<?php if ($this->countModules('breadcrumbs', true)): ?>
					<div class="show-for-medium medium-12 cell">
						<div class="modules-above">
							<jdoc:include type="modules" name="breadcrumbs" style="none"/>
						</div>
					</div>
				<?php endif; ?>

				<?php if ($homepage && $this->countModules('above-content', true)): ?>
					<div class="small-12 cell">
						<div class="modules-above">
							<jdoc:include type="modules" name="above-content" style="html5"/>
						</div>
					</div>
				<?php endif; ?>

				<!--main content-->
				<?php if ($this->countModules('sidebar-left', true) && $this->countModules('sidebar-right', true)): ?>
					<div id="sidebar-left" class="small-12 medium-4 cell">
						<jdoc:include type="modules" name="sidebar-left" style="html5"/>
					</div>
					<div class="article small-12 medium-8 large-9 cell">
						<jdoc:include type="component"/>
						<div style="clear:both;"></div>
						<?php if ($this->countModules('under-content', true)): ?>
							<jdoc:include type="modules" name="under-content" style="html5"/>
						<?php endif; ?>
					</div
					<div id="sidebar-right" class="small-12 medium-4 large-3 cell">
						<jdoc:include type="modules" name="sidebar-right" style="html5"/>
					</div>
				<?php elseif ($this->countModules('sidebar-left', true)): ?>
					<div id="sidebar-left" class="small-12 medium-4 large-3 collapse cell">
						<jdoc:include type="modules" name="sidebar-left" style="html5"/>
					</div>
					<div class="article small-12 medium-8 cell">
						<jdoc:include type="component"/>
						<div style="clear:both;"></div>
						<?php if ($this->countModules('under-content', true)): ?>
							<jdoc:include type="modules" name="under-content" style="html5"/>
						<?php endif; ?>
					</div>
				<?php elseif ($this->countModules('sidebar-right')): ?>
					<div class="article small-12 medium-8 large-9 cell">
						<jdoc:include type="component"/>
						<div style="clear:both;"></div>
						<?php if ($this->countModules('under-content', true)): ?>
							<jdoc:include type="modules" name="under-content" style="html5"/>
						<?php endif; ?>
					</div>
					<div id="sidebar-right" class="small-12 medium-4 large-3 cell text-center">
						<jdoc:include type="modules" name="sidebar-right" style="html5"/>
					</div>
				<?php else: ?>
					<div class="article small-12 cell">
						<jdoc:include type="component"/>
						<div style="clear:both;"></div>
						<?php if ($this->countModules('under-content', true)): ?>
							<jdoc:include type="modules" name="under-content" style="html5"/>
						<?php endif; ?>
					</div>
				<?php endif; ?>

				<!--modules below content-->
				<?php if ($this->countModules('below-left', true) || $this->countModules('below-right', true)): ?>
					<div class="grid-x grid-margin-x show-for-medium modules-below double">
						<div class="medium-8 cell below left">
							<jdoc:include type="modules" name="below-left" style="html5"/>
						</div>
						<div class="medium-4 cell below right">
							<jdoc:include type="modules" name="below-right" style="html5"/>
						</div>
					</div>
				<?php endif; ?>

				<?php if ($this->countModules('below-content', true)): ?>
					<div class="modules-below">
						<jdoc:include type="modules" name="below-content" style="html5"/>
					</div>
				<?php endif; ?>
			</div>
		</section>
		<!--//end main-->

		<!--//footer-->
		<section id="footer">
			<div class="top">
				<?php if ($this->countModules('above-bottom')): ?>
					<jdoc:include type="modules" name="above-bottom" style="html5"/>
				<?php endif; ?>
			</div>
			<div class="middle" data-equalizer data-equalize-on="large">
				<div class="grid-container">
					<div class="grid-x grid-margin-x text-center large-text-left">
						<div class="small-12 large-4 cell border" data-equalizer-watch>
							<?php if ($this->countModules('bottom-left', true)): ?>
								<jdoc:include type="modules" name="bottom-left" style="html5"/>
							<?php endif; ?>
						</div>
						<div class="small-12 large-4 cell border" data-equalizer-watch>
							<?php if ($this->countModules('bottom-mid', true)): ?>
								<jdoc:include type="modules" name="bottom-mid" style="html5"/>
							<?php endif; ?>
						</div>
						<div class="small-12 text-center large-4 large-text-left cell border" data-equalizer-watch>
							<?php if ($this->countModules('bottom-right', true)): ?>
								<jdoc:include type="modules" name="bottom-right" style="html5"/>
							<?php endif; ?>
						</div>
					</div>
				</div>
			</div>

			<div class="bottom">
				<div class="grid-container">
					<div class="grid-x grid-margin-x">
						<div class="small-12 text-center large-6 large-text-left cell">
							<?php if ($this->countModules('footer-right', true)): ?>
								<jdoc:include type="modules" name="footer-right" style="html5"/>
							<?php endif; ?>
						</div>
						<div class="copyright small-12 text-center large-6 large-text-right cell">
							<?php if ($this->countModules('footer-left', true)): ?>
								<jdoc:include type="modules" name="footer-left" style="html5"/>
							<?php endif; ?>
						</div>
					</div>
				</div>
			</div>
		</section>
		<!--//end footer-->
		<div id="kr-overlay"></div>
	</div>

	<jdoc:include type="modules" name="debug" style="none"/>

	<div id="kr-lang" data-krlang="<?php echo $this->language; ?>"></div>

	<div id="KrAjaxModalError" class="reveal tiny" data-reveal>
		<button class="close-button" aria-label="Close" data-close type="button">
			<span>&times;</span>
		</button>
		<div class="kr-ajax-modal-error-message"></div>
	</div>

	<script>
        document.addEventListener('DOMContentLoaded', function () {
            [].slice.call(document.head.querySelectorAll('link[rel="lazy-stylesheet"]')).forEach(function ($link) {
                $link.rel = "stylesheet";
            });
        });
	</script>
</div>
</body>
</html>