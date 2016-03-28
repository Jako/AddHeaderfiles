<?php
/**
 * AddHeaderfiles
 *
 * Copyright 2008-2015 by Thomas Jakobi <thomas.jakobi@partout.info>
 *
 * @package addheaderfiles
 * @subpackage snippet
 *
 * @author      Thomas Jakobi (thomas.jakobi@partout.info)
 * @version     1.0.0
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

    function AddHeaderfiles($addcode, $sep, $sepmed, $mediadefault)
    {
        global $modx;

        if ((strpos(strtolower($addcode), '<script') !== FALSE) || (strpos(strtolower($addcode), '<style') !== FALSE) || (strpos(strtolower($addcode), '<!--') !== FALSE)) {
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
                $conditional = (strpos(strtolower($part[0]), '<!--') !== FALSE);
                $style = (strpos(strtolower($part[0]), '<style') !== FALSE);
                $startup = !(isset($part[1]) && $part[1] == 'end');
                switch (TRUE) {
                    case ($conditional):
                        $modx->regClientStartupHTMLBlock($part[0], TRUE);
                        break;
                    case ($style):
                        $modx->regClientCSS($part[0], TRUE);
                        break;
                    case ($startup):
                        $modx->regClientStartupScript($part[0], FALSE);
                        break;
                    default:
                        $modx->regClientScript($part[0], FALSE);
                        break;
                }
            } else {
                // otherwhise it is treated as a filename
                $style = ((substr(trim($part[0]), -4) == '.css') || (strpos($part[0], '/css?') !== FALSE));
                $startup = !(isset($part[1]) && $part[1] == 'end' || $style);
                switch (TRUE) {
                    case ($style):
                        $modx->regClientStartupHTMLBlock('<link rel="stylesheet" type="text/css" href="' . $part[0] . '" media="' . (isset($part[1]) ? $part[1] : $mediadefault) . '" />');
                        break;
                    case($startup):
                        $modx->regClientStartupScript($part[0]);
                        break;
                    default:
                        $modx->regClientScript($part[0]);
                        break;
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