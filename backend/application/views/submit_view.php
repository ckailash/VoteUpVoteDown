
<div id="main">
<p>&nbsp;</p>
<center>
  <h2>Submit New URLs</h2><br />
</center>

<center>
<?php if ( !$user_id ): ?>
Please login via Facebook to submit new URLs! Use the connect button on the right hand side corner of your screen to login!
<?php else: ?>
<?=$urlerror?>
<form action="<?=base_url();?>submit" method="post">
<table>
<tr><td height="35 px" width="40%">Enter URL:</td><td width="60%"><input type="text" name="URL" value="" size="50" /></td></tr>
<tr><td height="35 px" colspan="2"><center><input type="submit" name="s" value="Submit" /></center></td></tr>
</table>
</form>
</center>
<?php endif; ?>
</div>
