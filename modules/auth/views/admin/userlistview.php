<style>.form { padding: 20px 20px 10px; background: #E0F4F8; width: 580px; overflow: hidden; }</style>
<h2><?php print $header?></h2>
<br/><br/>
<div id="form">
<center>Enter the userids here (comma separated):<form action="<?=base_url();?>auth/admin/userlist" method="post"><textarea name="words" rows="5" cols="50"><?php echo $value;?></textarea><br /><input type="submit" name="submit" value="Submit" /></form></center>
</div>


