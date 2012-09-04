<?php
/**
 * AddHeaderfiles
 *
 * Copyright 2008-2012 by Thomas Jakobi <thomas.jakobi@partout.info>
 *
 * AddHeaderfiles is free software; you can redistribute it and/or modify it 
 * under the terms of the GNU General Public License as published by the Free 
 * Software Foundation; either version 2 of the License, or (at your option) any 
 * later version.
 *
 * AddHeaderfiles is distributed in the hope that it will be useful, but 
 * WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or
 * FITNESS FOR A PARTICULAR PURPOSE. See the GNU General Public License for more
 * details.
 *
 * You should have received a copy of the GNU General Public License along with
 * Rowboat; if not, write to the Free Software Foundation, Inc., 59 Temple
 * Place, Suite 330, Boston, MA 02111-1307 USA
 *
 * @package addheaderfiles
 * @subpackage snippet
 * 
 * @author      Thomas Jakobi (thomas.jakobi@partout.info)
 * @copyright   Copyright 2008-2012, Thomas Jakobi
 * @version     0.5r
 * 
 * @internal    parameter: 
 *              addcode - Name(s) of external file(s) or chunkname(s) separated by `sep`. External files can have a position setting or media type separated by `sepmed`
 *              sep - Separator for files/chunknames in `addcode` - ;
 *              sepmed - Seperator for media type or script position in `addcode - |
 *              mediadefault - Media default for css files - screen, tv, projection
 */

// Check Parameters and set them to default values
$sep = $modx->getOption('sep', $scriptProperties, ';');
$sepmed = $modx->getOption('sepmed', $scriptProperties, '|');
$addcode = $modx->getOption('addcode', $scriptProperties, '');
$mediadefault = $modx->getOption('mediadefault', $scriptProperties, 'screen, tv, projection');

if (!function_exists('AddHeaderfiles')) {

	function AddHeaderfiles($addcode, $sep, $sepmed, $mediadefault) {
		global $modx;

		if ((strpos(strtolower($addcode), '<script') !== false) || (strpos(strtolower($addcode), '<style') !== false)) {
			return $addcode;
		} else {
			$parts = explode($sep, $addcode);
		}
		foreach ($parts as $part) {
			// unmask masked url parameters
			$part = str_replace(array('!q!', '!eq!', '!and!'), array('?', '=', '&'), $part);
			$part = explode($sepmed, trim($part), 2);
			$chunk = $modx->getChunk($part[0]);
			if ($chunk) {
				// part of the parameterchain is a chunkname
				$part[0] = AddHeaderfiles($chunk, $sep, $sepmed, $mediadefault);
				if (strpos(strtolower($part[0]), '<style') !== false) {
					$modx->regClientStartupHTMLBlock($part[0]);
				} else {
					if (isset($part[1]) && $part[1] == 'end') {
						$modx->regClientScript($part[0], true);
					} else {
						$modx->regClientStartupScript($part[0], true);
					}
				}
			} else {
				// otherwhise it is treated as a filename
				if (substr($part[0], -4) == '.css') {
					$media = isset($part[1]) ? $part[1] : $mediadefault;
					$modx->regClientStartupHTMLBlock('<link rel="stylesheet" type="text/css" href="' . $part[0] . '" media="' . $media . '" />');
				} else {
					if (isset($part[1]) && $part[1] == 'end') {
						$modx->regClientScript($part[0]);
					} else {
						$modx->regClientStartupScript($part[0]);
					}
				}
			}
		}
	}

}

if ($addcode != '') {
	$addcode = AddHeaderfiles($addcode, $sep, $sepmed, $mediadefault);
	if (strpos(strtolower($addcode), '<style') !== false) {
		$modx->regClientCSS($addcode);
	} else {
		$modx->regClientStartupScript($addcode, true);
	}
}
return '';
?>