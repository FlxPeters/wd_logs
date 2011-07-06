<?php if (!defined('TL_ROOT')) die('You cannot access this file directly!');

/**
 * Contao Open Source CMS
 * Copyright (C) 2005-2011 Leo Feyer
 *
 * Formerly known as TYPOlight Open Source CMS.
 *
 * This program is free software: you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public
 * License as published by the Free Software Foundation, either
 * version 3 of the License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU
 * Lesser General Public License for more details.
 *
 * You should have received a copy of the GNU Lesser General Public
 * License along with this program. If not, please visit the Free
 * Software Foundation website at <http://www.gnu.org/licenses/>.
 *
 * PHP version 5
 * @copyright  Felix Peters 2011
 * @author     Felix Peters - Wichteldesign
 * @package    wd
 * @license    LGPL
 * @filesource
 */


/**
 * Class ModuleLogs
 *
 * @copyright  Felix Peters 2011
 * @author     Felix Peters - Wichteldesign
 * @package    Controller
 */
class ModuleLogs extends BackendModule
{

	/**
	 * Template
	 * @var string
	 */
	protected $strTemplate = 'mod_logs';


	/**
	 * Generate module
	 */
	protected function compile()
	{
		$this->Template->errorHeadline = "Error-Log";

		$arrErrorLogRaw = array();

		if(file_exists(TL_ROOT . '/system/logs/error.log')){
			$errorLogFile = fopen(TL_ROOT . '/system/logs/error.log','r');
			$i = 0;
			while(!feof($errorLogFile))
			{
				$arrErrorLogRaw[] = fgets($errorLogFile,1024);				
			}			
			fclose($errorLogFile);

			$arrErrorLogRaw = array_slice($arrErrorLogRaw, -26, 25);

			foreach($arrErrorLogRaw as $k => $strLog){
				$strDate = trim(substr($strLog, 1 , 20));			
				$strDay = substr($strDate,0,11);
				
				if(strpos($strLog, 'PHP Fatal error')){
					$arrErrorLog[$strDay][$k]['class'] = 'tl_red';
				}
				
				$arrErrorLog[$strDay][$k]['text'] = substr($strLog, 22);
				$arrErrorLog[$strDay][$k]['datim'] = substr($strDate, 0 , 20);
			}
			$this->Template->errorLog = $arrErrorLog;
		}



	}
}

?>