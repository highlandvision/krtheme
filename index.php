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
if ($menu->getActive() === $menu->getDefault())
{
	$home = true;
}

$wa  = $this->getWebAssetManager();
$wa->usePreset('template.krbstheme.site');
$wa->getAsset('style', 'fontawesome')->setAttribute('rel', 'lazy-stylesheet');
?>

<!DOCTYPE html>
<html class="no-js" lang="<?php echo $this->language; ?>" dir="<?php echo $this->direction; ?>">
<head>
	<jdoc:include type="metas" />
	<jdoc:include type="styles" />
	<jdoc:include type="scripts" />
</head>

<body>
<div class="off-canvas-wrapper">
	<div id="offCanvasLeft" class="off-canvas-absolute position-left is-closed" data-off-canvas data-transition="pull">
		<!-- Off Canvas Menu -->
		<div class="left-off-canvas-menu">
			<button class="close-button" aria-label="Close menu" type="button" data-close>
				<i class="fas fa-long-arrow-left" aria-hidden="true"></i>
			</button>
			<jdoc:include type="modules" name="menu-mobile" />
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
						<a href="/index.php" style="color:#fefefe;" title="<?php echo $sitename; ?>">
							<?php echo $sitename; ?>
						</a>
					</div>
				</div>
			</div>

			<div id="header" class="collapse show-for-large">
				<div id="toprow" class="empty">
				</div>
				<div class="row expanded">
 				    <div id="bottomrow">
						<div class="large-2 columns">
							<div class="top-bar-left">
								<div class="logo-image">
									<a href="/index.php" title="<?php echo $sitename; ?>">
										<img src="/images/logo.png" class="logo" alt="<?php echo $sitename; ?>" width="137"
										     height="75">
									</a>
								</div>
							</div>
						</div>
						<div class="large-8 columns">
							<div class="top-bar-center">
								<jdoc:include type="modules" name="menu" style="none" />
							</div>
						</div>
						<div class="large-2 columns">
							<div class="top-bar-right">
								<jdoc:include type="modules" name="autosearch" style="none" />
							</div>
						</div>
					</div>
				</div>
			</div>
		</nav>

		<?php if ($this->countModules('hero-slider', true)): ?>
			<div id="hero" class="home">
				<div class="show-for-large">
					<jdoc:include type="modules" name="hero-slider" style="html5" />
				</div>
				<?php if ($this->countModules('hero-spot', true)): ?>
					<div class="spot">
						<jdoc:include type="modules" name="hero-spot" style="html5" />
					</div>
				<?php endif; ?>
				<?php if ($this->countModules('hero-search', true)): ?>
					<div class="search">
						<jdoc:include type="modules" name="hero-search" style="html5" />
					</div>
				<?php endif; ?>
			</div>
		<?php endif; ?>

		<?php if ($this->countModules('breadcrumbs', true)) : ?>
			<div class="row">
				<div class="medium-12 columns end">
					<jdoc:include type="modules" name="breadcrumbs" style="html5" />
				</div>
			</div>
		<?php endif; ?>

		<div class="row">
			<div class="small-12 columns">
				<jdoc:include type="message" />
			</div>
		</div>

		<!--main section-->
		<section id="main">
			<?php if ($home && $this->countModules('above-content', true)): ?>
				<div class="row">
					<div class="small-12 columns">
						<div class="modules-above">
							<jdoc:include type="modules" name="above-content" style="html5" />
						</div>
					</div>
				</div>
			<?php endif; ?>

			<!--main content-->
			<div class="main-content">
				<div class="row">
					<?php if ($this->countModules('sidebar-left', true) && $this->countModules('sidebar-right', true)): ?>
						<?php echo " hello there both!"; ?>
						<div id="sidebar-left" class="small-12 medium-4 columns">
							<jdoc:include type="modules" name="sidebar-left" style="html5" />
						</div>
						<div class="article small-12 medium-8 columns">
							<jdoc:include type="component" />

							<?php if ($this->countModules('under-content', true)): ?>
								<jdoc:include type="modules" name="under-content" style="html5" />
							<?php endif; ?>
						</div

						<div id="sidebar-right" class="medium-4 columns">
							<jdoc:include type="modules" name="sidebar-right" style="html5" />
						</div>
					<?php elseif ($this->countModules('sidebar-left', true)): ?>
						<?php echo "hello there left!"; ?>
						<div id="sidebar-left" class="small-12 medium-4 columns">
							<jdoc:include type="modules" name="sidebar-left" style="html5" />
						</div>
						<div class="article small-12 medium-8 columns">
							<jdoc:include type="component" />

							<?php if ($this->countModules('under-content', true)): ?>
								<jdoc:include type="modules" name="under-content" style="html5" />
							<?php endif; ?>
						</div>
					<?php elseif ($this->countModules('sidebar-right', true)): ?>
						<div class="article small-12 medium-8 columns">
							<jdoc:include type="component" />

							<?php if ($this->countModules('under-content', true)): ?>
								<jdoc:include type="modules" name="under-content" style="html5" />
							<?php endif; ?>
						</div>
						<div id="sidebar-right" class="small-12 text-center medium-4 medium-text-left columns">
							<jdoc:include type="modules" name="sidebar-right" style="html5" />
						</div>
					<?php else: ?>
						<div class="article small-12 columns">
							<jdoc:include type="component" />

							<?php if ($this->countModules('under-content', true)): ?>
								<jdoc:include type="modules" name="below-content" style="html5" />
							<?php endif; ?>
						</div>
					<?php endif; ?>
				</div>
			</div>
			<!--//main content-->

			<?php if ($this->countModules('below-left', true) || $this->countModules('below-right', true)): ?>
				<div class="row hide-for-small modules-below double">
					<div class="medium-8 columns below left">
						<jdoc:include type="modules" name="below-left" style="html5" />
					</div>
					<div class="medium-4 columns below right">
						<jdoc:include type="modules" name="below-right" style="html5" />
					</div>
				</div>
			<?php endif; ?>

			<?php if ($this->countModules('below-content', true)): ?>
				<div class="modules-below">
					<jdoc:include type="modules" name="below-left" style="html5" />
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
						<jdoc:include type="modules" name="above-bottom" style="none" />
					<?php endif; ?>
				</div>
			</div>
		</div>

		<div class="middle" data-equalizer data-equalize-on="medium">
			<div class="row text-center medium-text-left">
				<div class="hide-for-small medium-4 columns border" data-equalizer-watch>
					<?php if ($this->countModules('bottom-left', true)): ?>
						<jdoc:include type="modules" name="bottom-left" style="html5" />
					<?php endif; ?>
				</div>
				<div class="hide-for-small medium-4 columns border" data-equalizer-watch>
					<?php if ($this->countModules('bottom-mid', true)): ?>
						<jdoc:include type="modules" name="bottom-mid" style="html5" />
					<?php endif; ?>
				</div>
				<div class="small-12 text-center medium-4 medium-text-left columns border" data-equalizer-watch>
					<?php if ($this->countModules('bottom-right', true)): ?>
						<jdoc:include type="modules" name="bottom-right" style="html5" />
					<?php endif; ?>
				</div>
			</div>
		</div>

		<div class="bottom">
			<div class="row">
				<div class="copyright small-12 small-text-center medium-6 medium-text-left columns">
					<?php if ($this->countModules('footer-left', true)): ?>
						<jdoc:include type="modules" name="footer-left" style="html5" />
					<?php endif; ?>
				</div>
				<div class="small-12 small-text-center medium-6 medium-text-left columns">
					<?php if ($this->countModules('footer-right', true)): ?>
						<jdoc:include type="modules" name="footer-right" style="html5" />
					<?php endif; ?>
				</div>
			</div>
		</div>
	</section>
	<!--//footer-->
</div>

<jdoc:include type="modules" name="debug" style="none" />

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