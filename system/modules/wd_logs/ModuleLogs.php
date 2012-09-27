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

        $strErrorFile = TL_ROOT . '/system/logs/error.log';
        $strMailFile = TL_ROOT . '/system/logs/email.log';

        $this->Template->errorHeadline = $GLOBALS['TL_LANG']['MSC']['errorLog'];
        $this->Template->emailHeadline = $GLOBALS['TL_LANG']['MSC']['emailLog'];

        $arrErrorLogRaw = $this->read_file($strErrorFile, 15);
        $arrEmailLogRaw = $this->read_file($strMailFile, 20);



        if (count($arrErrorLogRaw) > 0) {
            foreach ($arrErrorLogRaw as $k => $strLog) {
                $strDate = trim(substr($strLog, 1, 20));
                $strDay = substr($strDate, 0, 11);



                if (strpos($strLog, 'PHP Fatal error')) {
                    $arrErrorLog[$strDay][$k]['class'] = 'tl_red';
                }

                $arrErrorLog[$strDay][$k]['text'] = substr($strLog, 25);
                $arrErrorLog[$strDay][$k]['datim'] = substr($strDate, 0, 20);
            }
            $this->Template->errorLog = $arrErrorLog;
        }



        if (count($arrEmailLogRaw) > 0) {
            foreach ($arrEmailLogRaw as $k => $strLog) {
                $strDate = trim(substr($strLog, 1, 20));
                $strDay = substr($strDate, 0, 11);

                if (strpos($strLog, 'PHP Fatal error')) {
                    $arrEmailLog[$strDay][$k]['class'] = 'tl_red';
                }

                $arrEmailLog[$strDay][$k]['text'] = substr($strLog, 22);
                $arrEmailLog[$strDay][$k]['datim'] = substr($strDate, 0, 20);
            }
            $this->Template->emailLog = $arrEmailLog;
        }


        /*
        if (file_exists(TL_ROOT.'/system/logs/error.log')) {
            $errorLogFile = fopen(TL_ROOT.'/system/logs/error.log', 'r');
            $i = 0;
            while (!feof($errorLogFile)) {
                $arrErrorLogRaw[] = fgets($errorLogFile, 1024);
            }
            fclose($errorLogFile);

            $arrErrorLogRaw = array_reverse(array_slice($arrErrorLogRaw, -16, 15));

            foreach ($arrErrorLogRaw as $k => $strLog) {
                $strDate = trim(substr($strLog, 1, 20));
                $strDay = substr($strDate, 0, 11);

                if (strpos($strLog, 'PHP Fatal error')) {
                    $arrErrorLog[$strDay][$k]['class'] = 'tl_red';
                }

                $arrErrorLog[$strDay][$k]['text'] = substr($strLog, 22);
                $arrErrorLog[$strDay][$k]['datim'] = substr($strDate, 0, 20);
            }
            $this->Template->errorLog = $arrErrorLog;
        }

        if (file_exists(TL_ROOT.'/system/logs/email.log')) {
            $emailLogFile = fopen(TL_ROOT.'/system/logs/email.log', 'r');
            $i = 0;
            while (!feof($emailLogFile)) {
                $arrEmailLogRaw[] = fgets($emailLogFile, 1024);
            }
            fclose($emailLogFile);

            $arrEmailLogRaw = array_slice($arrEmailLogRaw, -16, 15);

            foreach ($arrEmailLogRaw as $k => $strLog) {
                $strDate = trim(substr($strLog, 1, 20));
                $strDay = substr($strDate, 0, 11);

                if (strpos($strLog, 'PHP Fatal error')) {
                    $arrEmailLog[$strDay][$k]['class'] = 'tl_red';
                }

                $arrEmailLog[$strDay][$k]['text'] = substr($strLog, 22);
                $arrEmailLog[$strDay][$k]['datim'] = substr($strDate, 0, 20);
            }
            $this->Template->emailLog = array_reverse($arrEmailLog);
        }

        */

    }

    /**
     * Reads the File
     * Based on http://tekkie.flashbit.net/php/tail-functionality-in-php#
     *
     * @param $file
     * @param $lines
     * @return array
     */

    private function read_file($file, $lines)
    {
        //global $fsize;
        $handle = fopen($file, "r");
        $linecounter = $lines;
        $pos = -2;
        $beginning = false;
        $text = array();
        while ($linecounter > 0) {
            $t = " ";
            while ($t != "\n") {
                if (fseek($handle, $pos, SEEK_END) == -1) {
                    $beginning = true;
                    break;
                }
                $t = fgetc($handle);
                $pos--;
            }
            $linecounter--;
            if ($beginning) {
                rewind($handle);
            }
            $text[$lines - $linecounter - 1] = fgets($handle);
            if ($beginning) break;
        }
        fclose($handle);
        return array_reverse($text);
    }
}

?>