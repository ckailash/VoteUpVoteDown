
<div id="main">
<p>&nbsp;</p>

<center>
<?php if ( !$user_id ): ?>
Please login via Facebook to submit new URLs! Use the connect button on the right hand side corner of your screen to login!
<?php else: ?>
You seem to be logged in already. You will be redirected soon.
<?php header("Location:".base_url()."dump/index/".base64_encode($this->session->userdata('url')));?>
<?php endif; ?>

</center>
</div>
