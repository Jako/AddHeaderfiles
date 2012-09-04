AddHeaderfiles
================================================================================

Adds CSS or JS in a document (at the end of the head or the end of the body)
for the MODX Revolution content management framework

Features
--------------------------------------------------------------------------------
AddHeaderfiles is an elegant tool for MODX Revolution. With this tool the MODX 
regClient functions are used to insert javascript and css styles at the 
appropriate positions of the current page. Since those functions don't insert 
the same filename twice, the snippet could be called everywhere in the template,
document or in chunks to collect all needed javascripts and css styles together.

Installation
--------------------------------------------------------------------------------
MODX Package Management

Parameters
--------------------------------------------------------------------------------
The following parameters could be set in snippet call

addcode      - External filenames(s) or chunkname(s) separated by `sep`
               these external files can have a position setting or media 
               type separated by `sepmed`
sep          - Separator for files/chunknames (default ';')
sepmed       - Seperator for media type or script position (default '|')
mediadefault - Media default for css files (default 'screen, tv, projection')
 
Examples:
--------------------------------------------------------------------------------

Direct call:
[[!AddHeaderfiles?addcode=`/assets/js/jquery.js;/assets/js/colorbox.js|end;/assets/css/colorbox.css;/assets/css/test.css|print`]]
shows:
<script type="text/javascript" src="/assets/js/jquery.js"></script>
<link rel="stylesheet" type="text/css" href="/assets/css/colorbox.css" media="screen, tv, projection" />
<link rel="stylesheet" type="text/css" href="/assets/css/test.css" media="print" />
</head>
...
<script type="text/javascript" src="/assets/js/colorbox.js"></script>
</body>

Chunk call:
Fill a chunk (i.e. 'headerColorbox') like this:
/assets/js/jquery.js;/assets/js/colorbox.js|end;/assets/css/colorbox.css
[[!AddHeaderfiles?addcode=`headerColorbox`]]

--------------------

Parts of the addcode parameterchain could point to chunks (recursive).
The parts of the cunks that are not pointing to other chunks ot to files/uri 
should contain the complete <style>...</style> or <script>...</script> code.
[[!AddHeaderfiles?addcode=`headerColorbox;/assets/css/test.css|print`]]

--------------------

If you want to insert external files with url parameters directly in snippet 
call, some chars have to be masked:
 * '?' has to be masked as '!q!'
 * '=' has to be masked as '!eq!'
 * '&' has to be masked as '!and!'

This chars don't have to be masked in chunks.
