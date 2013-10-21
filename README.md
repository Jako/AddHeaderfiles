AddHeaderfiles
================================================================================

Adds CSS or JS in a document (at the end of the head or the end of the body)
for the MODX Revolution content management framework

Features:
--------------------------------------------------------------------------------
AddHeaderfiles is an elegant tool for MODX Revolution. With this tool the MODX
*regClient* functions are used to insert javascript and css styles at the
appropriate positions of the current page. Since those functions don't insert
the same filename twice, the snippet could be called everywhere in the template,
document or in chunks to collect all needed javascripts and css styles together.

Installation:
--------------------------------------------------------------------------------
MODX Package Management

Parameters:
--------------------------------------------------------------------------------

Name         | Description                                                                                                                                            | Default
------------ | ------------------------------------------------------------------------------------------------------------------------------------------------------ | -------
addcode      | External filenames(s) or chunkname(s) separated by &sep. The external files can have a position setting or media type separated by &sepmed, see note 1 | -
sep          | Separator for files/chunknames                                                                                                                         | ;
sepmed       | Seperator for media type or script position                                                                                                            | &#124;
mediadefault | Media default for css files                                                                                                                            | screen, tv, projection

Examples:
--------------------------------------------------------------------------------

### Direct call:

```
[[!AddHeaderfiles?
&addcode=`/assets/js/jquery.js;
/assets/js/colorbox.js|end;/assets/css/colorbox.css;
/assets/css/test.css|print`
]]
```

shows:

```html
...
    <script type="text/javascript" src="/assets/js/jquery.js"></script>
    <link rel="stylesheet" type="text/css" href="/assets/css/colorbox.css" media="screen, tv, projection" />
    <link rel="stylesheet" type="text/css" href="/assets/css/test.css" media="print" />
</head>
...
    <script type="text/javascript" src="/assets/js/colorbox.js"></script>
</body>
```

### Chunk call:

Fill a chunk (i.e. 'headerColorbox') by:

```
/assets/js/jquery.js;
/assets/js/colorbox.js|end;/assets/css/colorbox.css
```

and call it like this:

```
[[!AddHeaderfiles?
&addcode=`headerColorbox`]]
```

Parts of the addcode parameterchain could point to chunks too (recursive). The
parts of the chunks that are not pointing to other chunks or to files/uri should
contain the complete `<style>...</style>` or `<script>...</script>` code.

```
[[!AddHeaderfiles?
&addcode=`headerColorbox;
/assets/css/test.css|print`]]
```

Notes:
--------------------------------------------------------------------------------
1. If you want to insert external files with url parameters *directly* in the
snippet call, some chars have to be masked. `?` has to be masked as `!q!`. `=`
has to be masked as `!eq!`. `&` has to be masked as `!and!`. These characters
don't have to be masked in chunks.
