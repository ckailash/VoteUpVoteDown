<style>.form { padding: 20px 20px 10px; background: #E0F4F8; width: 580px; overflow: hidden; }</style>
<h2><?php print $header?></h2>
<br/><br/>
<div id="form">
<form action="<?=base_url();?>auth/admin/userlist" method="post">
<table width="80%"><tr><td width="40%" height="50px" align="justify">Enter the filter keywords for title here(comma separated):</td><td width="60%"><textarea name="words" rows="5" cols="50"><?php echo $value;?></textarea></td></tr><tr><td height="50px" align="justify">Enter the filter keywords for description here(comma separated):</td><td><textarea name="words1" rows="5" cols="50"><?php echo $value1;?></textarea></td></tr><tr><td colspan="2" height=25px><center><input type="submit" name="submit" value="Submit" /></center></td></tr></table>
</form>
</div>