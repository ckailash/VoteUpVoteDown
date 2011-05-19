<div id="main">
<p>&nbsp;</p>
<center><h2>Contact Us</h2></center>
<div id="maincontent">
<div class="maincontent"><br /><br />
<center><?= form_error('name') ?>
<?= form_error('email') ?>
<?= form_error('recaptcha_response_field') ?></center>
<form action="<?=base_url();?>contact" method="post">
<table>
<tr><td width="40%" height="35px">Name:</td><td width="60%"><input name="name" value="<?php echo set_value('name');?>" type="text" /></td></tr>
<tr><td height="35px">Email:</td><td><input name="email" value="<?php echo set_value('email');?>" type="text" /></td></tr>
<tr><td height="35px">Message:</td><td><textarea name="message" rows="10" cols="35"></textarea></td></tr>
<tr><td>Captcha:</td><td><?=$recaptcha?></td></tr>
<tr><td height="35px" colspan="2"><center><input name="sub" value="Submit" type="submit" /></center></td></tr>
</table>

</form>

</div>
</div>
</div>
