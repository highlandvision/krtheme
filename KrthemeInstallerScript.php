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
 * @since 5.0.0
 */
class KrthemeInstallerScript extends InstallerScript
{
	protected $deleteFiles = [
//		Add deleted files here
	];
	protected $deleteFolders = [
//		Add deleted folders here
	];
	protected $extension = 'krtheme';

	/**
	 * Update template
	 *
	 * @param $adapter
	 *
	 * @since  5.0.0
	 * @return bool
	 */
	public function update($adapter): bool
	{
		$this->removeFiles();

		return true;
	}
}