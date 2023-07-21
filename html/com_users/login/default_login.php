<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_users
 * @copyright   Copyright (C) 2005 - 2014 Open Source Matters, Inc. All rights reserved.
 * @license     http://www.gnu.org/licenses/gpl-3.0.html GNU/GPL
 */

defined('_JEXEC') or die;

use HighlandVision\KR\Framework\KrMethods;
use Joomla\CMS\Component\ComponentHelper;
use Joomla\CMS\Factory;
use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Router\Route;
use Joomla\Component\Users\Site\View\Login\HtmlView;

/** @var HtmlView $cookieLogin */

/** @var Joomla\CMS\WebAsset\WebAssetManager $wa */
$wa = $this->document->getWebAssetManager();
$wa->useScript('keepalive')
    ->useScript('form.validate');

$usersConfig = ComponentHelper::getParams('com_users');
Factory::getLanguage()->load('com_knowres', JPATH_SITE . '/components/com_knowres');
?>

<div class="com-users-login login">
	<div class="row">
		<div class="small-12 medium-6 large-4 columns">
			<h1><?php echo KrMethods::plain('COM_KNOWRES_GUEST_LOGIN'); ?></h1>

			<?php if ($this->params->get('show_page_heading')) : ?>
				<div class="page-header">
					<h1>
						<?php echo $this->escape($this->params->get('page_heading')); ?>
					</h1>
				</div>
			<?php endif; ?>

			<?php if (($this->params->get('logindescription_show') == 1
				&& str_replace(' ', '', $this->params->get('login_description', '')) != '')
					|| $this->params->get('login_image') != '') : ?>
				<div class="com-users-login__description login-description">
			<?php endif; ?>

			<?php if ($this->params->get('logindescription_show') == 1) : ?>
				<?php echo $this->params->get('login_description'); ?>
			<?php endif; ?>

			<?php if ($this->params->get('login_image') != '') : ?>
				<?php echo HTMLHelper::_('image', $this->params->get('login_image'),
					empty($this->params->get('login_image_alt'))
					&& empty($this->params->get('login_image_alt_empty'))
						? false : $this->params->get('login_image_alt'),
					['class' => 'com-users-login__image login-image']); ?>
			<?php endif; ?>

			<?php if (($this->params->get('logindescription_show') == 1
					&& str_replace(' ', '', $this->params->get('login_description', '')) != '')
						|| $this->params->get('login_image') != '') : ?>
				</div>
			<?php endif; ?>
			<br>
			<form action="<?php echo Route::_('index.php?option=com_users&task=user.login'); ?>" method="post"
			      class="com-users-login__form form-validate" id="com-users-login__form">
				<fieldset>
					<?php echo $this->form->renderFieldset('credentials', ['class' => 'com-users-login__input']); ?>

					<?php if (JPluginHelper::isEnabled('system', 'remember')) : ?>
						<div class="com-users-login__remember">
							<div class="form-check">
								<input class="form-check-input" id="remember" type="checkbox"
								       name="remember" value="yes">
								<label class="form-check-label" for="remember">
									<?php echo Text::_('COM_USERS_LOGIN_REMEMBER_ME'); ?>
								</label>
							</div>
						</div>
					<?php endif; ?>

					<?php foreach ($this->extraButtons as $button) : ?>
						<?php
						$dataAttributeKeys = array_filter(array_keys($button), function ($key)
						{
							return str_starts_with($key, 'data-');
						});
						?>

						<div class="com-users-login__submit control-group">
							<button type="button" class="button secondary expanded <?php echo $button['class'] ?? '' ?>"
								<?php foreach ($dataAttributeKeys as $key) : ?>
									<?php echo $key ?>="<?php echo $button[$key] ?>"
								<?php endforeach; ?>
								<?php if ($button['onclick']) : ?>
									onclick="<?php echo $button['onclick'] ?>"
								<?php endif; ?>
								title="<?php echo Text::_($button['label']) ?>"
								id="<?php echo $button['id'] ?>"
								>
								<?php if (!empty($button['icon'])) : ?>
									<span class="<?php echo $button['icon'] ?>"></span>
								<?php elseif (!empty($button['image'])) : ?>
									<?php echo HTMLHelper::_('image', $button['image'],
										Text::_($button['tooltip'] ?? ''), [
											'class' => 'icon',
										], true) ?>
<!--								--><?php //elseif (!empty($button['svg'])) : ?>
<!--									--><?php //echo $button['svg']; ?>
								<?php endif; ?>
								<?php echo Text::_($button['label']) ?>
								</button>
						</div>
					<?php endforeach; ?>

					<div class="com-users-login__submit control-group">
						<div class="controls">
							<button class="submit button expanded">
								<?php echo Text::_('JLOGIN'); ?>
							</button>
						</div>
					</div>

					<?php $return = $this->form->getValue('return', '', $this->params->get('login_redirect_url',
						$this->params->get('login_redirect_menuitem', ''))); ?>
					<input type="hidden" name="return" value="<?php echo base64_encode($return); ?>">
					<?php echo HTMLHelper::_('form.token'); ?>
				</fieldset>
			</form>

			<div class="com-users-login__options list-group">
				<a class="com-users-login__reset list-group-item"
				   href="<?php echo Route::_('index.php?option=com_users&view=reset'); ?>">
					<?php echo Text::_('COM_USERS_LOGIN_RESET'); ?>
				</a><br>
				<a class="com-users-login__remind list-group-item"
				   href="<?php echo Route::_('index.php?option=com_users&view=remind'); ?>">
					<?php echo Text::_('COM_USERS_LOGIN_REMIND'); ?>
				</a><br>
				<?php if ($usersConfig->get('allowUserRegistration')) : ?>
					<a class="com-users-login__register list-group-item"
					   href="<?php echo Route::_('index.php?option=com_users&view=registration'); ?>">
						<?php echo Text::_('COM_USERS_LOGIN_REGISTER'); ?>
					</a>
				<?php endif; ?>
			</div>
		</div>
	</div>
</div>