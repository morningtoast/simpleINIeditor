<?
	include_once("class_inimgr.php");
	$ini = new iniManager();
	if ($ini->save()) { $response = "Changes saved"; }
	$ini->load();
?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>Simple INI Editor</title>
        <meta name="description" content="Simple front for editing an INI file">
        <meta name="viewport" content="width=device-width">
		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.5.1/jquery.min.js" /></script>
		<script src="./js/mustache.js"></script>
		<script src="./js/inimgr.js"></script>
		<script>
			iniManager.loaded = <?= $ini->json; ?>
		</script>
		<style>
			fieldset { margin:10px 0; }
		</style>
    </head>
    <body>
		<h4><em><?= $response; ?></em></h4>
		<h1>INI File Editor</h1>
		<p>
			<a href="https://github.com/morningtoast/simpleINIeditor">Project on github</a>
		</p>
		<ul>
			<li>To remove a group, clear the group name</li>
			<li>To remove a pair, clear the key name</li>
		</ul>
		<form method="post" action="<?= $_SERVER["PHP_SELF"]; ?>">
			<div id="list"></div>
			<p>
				<button type="button" class="action-newgroup">+ Add new group</button>
			</p>
			<hr />
			<p>
				<input type="submit" value="Save changes" />
			</p>
		</form>
		
		
		<script id="tmpl-group" type="text/x-jquery-tmpl">
			<fieldset id="group-{{hash}}" class="group">
				<legend>
					<input type="text" name="inimgr[{{hash}}][group]" size="25" placeholder="Group name" value="{{group}}" />
				</legend>
				<dl class="pair-list">{{items}}</dl>
				<p>
					<button type="button" data-id="{{hash}}" class="action-newpair">+ Add new pair</button>
				</p>
			</fieldset>		
		</script>
		<script id="tmpl-item" type="text/x-jquery-tmpl">
			<dt>
				<input type="text" name="inimgr[{{hash}}][key][]" size="20" placeholder="Key" value="{{key}}" /> =
				<input type="text" name="inimgr[{{hash}}][value][]" size="30" placeholder="Value" value="{{value}}" />
			</dt>
		</script>
    </body>
</html>