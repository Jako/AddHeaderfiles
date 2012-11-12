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
 * Properties for the AddHeaderfiles snippet.
 */
$properties = array(
	array(
		'name' => 'addcode',
		'desc' => 'prop_addheaderfiles.addcode',
		'type' => 'textfield',
		'options' => '',
		'value' => '',
		'lexicon' => 'addheaderfiles:properties',
	),
	array(
		'name' => 'sep',
		'desc' => 'prop_addheaderfiles.sep',
		'type' => 'textfield',
		'options' => '',
		'value' => ';',
		'lexicon' => 'addheaderfiles:properties',
	),
	array(
		'name' => 'sepmed',
		'desc' => 'prop_addheaderfiles.sepmed',
		'type' => 'textfield',
		'options' => '',
		'value' => '|',
		'lexicon' => 'addheaderfiles:properties',
	),
	array(
		'name' => 'mediadefault',
		'desc' => 'prop_addheaderfiles.mediadefault',
		'type' => 'textfield',
		'options' => '',
		'value' => 'screen, tv, projection',
		'lexicon' => 'addheaderfiles:properties',
	)
);

return $properties;