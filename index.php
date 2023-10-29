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
$home     = false;
$menu     = $app->getMenu();
if ($menu->getActive() === $menu->getDefault()) {
	$home = true;
}

$this->setMetaData('viewport', 'width=device-width, initial-scale=1');

$wa = $this->getWebAssetManager();
$wa->usePreset('template.krtheme.site');

$color = $this->params->get('colors', 'colors_default');
$asset = 'theme.' . $color;
$wa->registerAndUseStyle($asset, 'media/templates/site/krtheme/css/global/' . $color . '.css');
$wa->getAsset('style', 'fontawesome')->setAttribute('rel', 'lazy-stylesheet');
?>

<!DOCTYPE html>
<html class="no-js" lang="<?php echo $this->language; ?>" dir="<?php echo $this->direction; ?>">
<head>
	<jdoc:include type="metas"/>
	<jdoc:include type="styles"/>
	<jdoc:include type="scripts"/>
</head>

<body>
<div class="off-canvas-wrapper">
	<div id="offCanvasLeft" class="off-canvas-absolute position-left is-closed" data-off-canvas data-transition="pull">
		<!-- Off Canvas Menu -->
		<div class="left-off-canvas-menu">
			<button class="close-button" aria-label="Close menu" type="button" data-close>
				<i class="fas fa-long-arrow-left" aria-hidden="true"></i>
			</button>
			<jdoc:include type="modules" name="menu-mobile"/>
		</div>
	</div>
	<div id="kr-properties-sortby-off-canvas" class="off-canvas-absolute position-left kr-offcanvas kr-sortby"
	     data-off-canvas data-transition="overlap"></div>
	<div id="kr-properties-filters-off-canvas" class="off-canvas-absolute position-right kr-offcanvas kr-filters"
	     data-off-canvas data-transition="overlap"></div>
	<div id="kr-properties-search-off-canvas" class="off-canvas-absolute position-top kr-offcanvas"
	     data-off-canvas data-transition="overlap" data-force-to="top">
	</div>

	<div class="off-canvas-content" data-off-canvas-content>
		<div id="kr-overlay"></div>
		<nav class="nav-section">
			<!-- hamburger and logo for small / medium -->
			<div class="hide-for-large">
				<div class="title-bar">
					<!-- top bar hamburger for off canvas left menu link and logo-->
					<div class="title-bar-left">
						<button type="button" class="menu-icon" aria-label="Toggle menu" data-toggle="offCanvasLeft">
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
			</div>

			<div id="header" class="show-for-large">
				<div class="row">
					<div class="large-3 columns topbar-left">
						<a href="/" title="<?php echo $sitename; ?>">
							<img src="<?php echo $logo; ?>" class="logo" alt="<?php echo $sitename; ?>">
						</a>
					</div>
					<div class="large-9 columns topbar-right">
						<jdoc:include type="modules" name="topbar-right" style="html5"/>
					</div>
				</div>
			</div>
		</nav>

		<?php if ($home): ?>
			<div id="hero" class="home">
				<?php if ($this->countModules('hero-slider')): ?>
					<jdoc:include type="modules" name="hero-slider" style="html5"/>
				<?php endif; ?>
				<?php if ($this->countModules('hero-search', true)): ?>
					<jdoc:include type="modules" name="hero-search" style="html5"/>
				<?php endif; ?>
			</div>
		<?php else: ?>
			<?php if ($this->countModules('hero-search', true)): ?>
				<div class="show-for-large">
					<div data-sticky-container>
						<div data-sticky data-margin-top="0" data-top-anchor="header:bottom" data-check-every="-1">
							<div id="hero" class="subpage">
								<jdoc:include type="modules" name="hero-search" style="html5"/>
							</div>
						</div>
					</div>
				</div>
			<?php endif; ?>
		<?php endif; ?>

		<!--main section-->
		<section id="main">
			<div class="row">
				<div class="small-12 columns">
					<jdoc:include type="message"/>
				</div>
			</div>

			<?php if ($home && $this->countModules('above-content', true)): ?>
				<div class="row">
					<div class="small-12 columns">
						<div class="modules-above">
							<jdoc:include type="modules" name="above-content" style="html5"/>
						</div>
					</div>
				</div>
			<?php endif; ?>

			<!--main content-->
			<div class="main-content">
				<div class="row">
					<?php if ($this->countModules('sidebar-left', true) &&
						$this->countModules('sidebar-right', true)): ?>
						<div id="sidebar-left" class="small-12 medium-4 columns">
							<jdoc:include type="modules" name="sidebar-left" style="html5"/>
						</div>
						<div class="article small-12 medium-8 columns">
							<jdoc:include type="component"/>
							<div style="clear:both;"></div>
							<?php if ($this->countModules('under-content', true)): ?>
								<jdoc:include type="modules" name="under-content" style="html5"/>
							<?php endif; ?>
						</div

						<div id="sidebar-right" class="medium-4 columns">
							<jdoc:include type="modules" name="sidebar-right" style="html5"/>
						</div>
					<?php elseif ($this->countModules('sidebar-left', true)): ?>
						<div id="sidebar-left" class="small-12 medium-4 columns">
							<jdoc:include type="modules" name="sidebar-left" style="html5"/>
						</div>
						<div class="article small-12 medium-8 columns">
							<jdoc:include type="component"/>
							<div style="clear:both;"></div>
							<?php if ($this->countModules('under-content', true)): ?>
								<jdoc:include type="modules" name="under-content" style="html5"/>
							<?php endif; ?>
						</div>
					<?php elseif ($this->countModules('sidebar-right', true)): ?>
						<div class="article small-12 medium-8 columns">
							<jdoc:include type="component"/>
							<div style="clear:both;"></div>
							<?php if ($this->countModules('under-content', true)): ?>
								<jdoc:include type="modules" name="under-content" style="html5"/>
							<?php endif; ?>
						</div>
						<div id="sidebar-right" class="small-12 text-center medium-4 medium-text-left columns">
							<jdoc:include type="modules" name="sidebar-right" style="html5"/>
						</div>
					<?php else: ?>
						<div class="article small-12 columns">
							<jdoc:include type="component"/>
							<div style="clear:both;"></div>
							<?php if ($this->countModules('under-content', true)): ?>
								<jdoc:include type="modules" name="under-content" style="html5"/>
							<?php endif; ?>
						</div>
					<?php endif; ?>
				</div>
			</div>
			<!--//main content-->

			<?php if ($this->countModules('below-left', true) || $this->countModules('below-right', true)): ?>
				<div class="row hide-for-small modules-below double">
					<div class="medium-8 columns below left">
						<jdoc:include type="modules" name="below-left" style="html5"/>
					</div>
					<div class="medium-4 columns below right">
						<jdoc:include type="modules" name="below-right" style="html5"/>
					</div>
				</div>
			<?php endif; ?>

			<?php if ($this->countModules('below-content', true)): ?>
				<div class="modules-below">
					<jdoc:include type="modules" name="below-content" style="html5"/>
				</div>
			<?php endif; ?>
		</section>
	</div>
	<!--//main-->

	<section id="footer">
		<div class="top">
			<div class="row">
				<div class="small-12 columns">
					<?php if ($this->countModules('above-bottom', true)): ?>
						<jdoc:include type="modules" name="above-bottom" style="none"/>
					<?php endif; ?>
				</div>
			</div>
		</div>

		<div class="middle" data-equalizer data-equalize-on="medium">
			<div class="row text-center medium-text-left">
				<div class="hide-for-small medium-4 columns border" data-equalizer-watch>
					<?php if ($this->countModules('bottom-left', true)): ?>
						<jdoc:include type="modules" name="bottom-left" style="html5"/>
					<?php endif; ?>
				</div>
				<div class="hide-for-small medium-4 columns border" data-equalizer-watch>
					<?php if ($this->countModules('bottom-mid', true)): ?>
						<jdoc:include type="modules" name="bottom-mid" style="html5"/>
					<?php endif; ?>
				</div>
				<div class="small-12 text-center medium-4 medium-text-left columns border" data-equalizer-watch>
					<?php if ($this->countModules('bottom-right', true)): ?>
						<jdoc:include type="modules" name="bottom-right" style="html5"/>
					<?php endif; ?>
				</div>
			</div>
		</div>

		<div class="bottom">
			<div class="row">
				<div class="small-12 text-center large-6 large-text-left columns">
					<?php if ($this->countModules('footer-right', true)): ?>
						<jdoc:include type="modules" name="footer-right" style="html5"/>
					<?php endif; ?>
				</div>
				<div class="copyright small-12 text-center large-6 large-text-right columns">
					<?php if ($this->countModules('footer-left', true)): ?>
						<jdoc:include type="modules" name="footer-left" style="html5"/>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</section>
	<!--//footer-->
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
<script src='https://js.stripe.com/v3/' defer></script>
</body>
</html>