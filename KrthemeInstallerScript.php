<?php
/**
 * @package    Know Reservations
 * @subpackage Template
 * @copyright  2023 Highland Vision. All rights reserved.
 * @license    See the file "LICENSE.txt" for the full license governing this code.
 * @author     Hazel Wilson <hazel@highlandvision.com>
 */

defined('_JEXEC') || exit;

use Joomla\CMS\Installer\InstallerScript;

/**
 * Krtheme installer script
 *
 * @since 4.3.0
 */
class KrthemeInstallerScript extends InstallerScript
{
	protected $deleteFiles = [
		'/media/templates/krtheme/scss/_properties-grid.scss',
		'/media/templates/krtheme/scss/_properties-property.scss',
	];
	protected $extension = 'krtheme';

	/**
	 * Update template
	 *
	 * @param $adapter
	 *
	 * @since  4.3.0
	 * @return bool
	 */
	public function update($adapter): bool
	{
		$this->removeFiles();

		return true;
	}
}