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
 * AddHeaderfiles; if not, write to the Free Software Foundation, Inc., 
 * 59 Temple Place, Suite 330, Boston, MA 02111-1307 USA
 *
 * @package addheaderfiles
 * @subpackage build
 *
 * snippets for AddHeaderfiles package
 */
$snippets = array();

$snippets[1] = $modx->newObject('modSnippet');
$snippets[1]->fromArray(array(
	'id' => 1,
	'name' => 'AddHeaderfiles',
	'description' => 'Adds CSS or JS in a document (at the end of the head or the end of the body).',
	'snippet' => getSnippetContent($sources['snippets'] . 'snippet.addheaderfiles.php'),
		), '', true, true);
$properties = include $sources['properties'] . 'properties.addheaderfiles.php';
$snippets[1]->setProperties($properties);
unset($properties);

return $snippets;