<script type="text/javascript">
<!--


// Get the HTTP Object
function getHTTPObject(){
	if (window.ActiveXObject) return new ActiveXObject("Microsoft.XMLHTTP");
	else if (window.XMLHttpRequest) return new XMLHttpRequest();
	else {
		alert("Your browser does not support AJAX.");
		return null;
	}
}

// Function to display output
function setOutput1(){
	if (httpObject.readyState==1)
	{
		document.getElementById("vote").innerHTML = "<center><img src='<?=base_url();?>images/loading.gif'></center>";
	}
	else if(httpObject.readyState == 4){
		document.getElementById('vote').innerHTML = httpObject.responseText;
	}
}



function vote(str,vote,ids){
	httpObject = getHTTPObject();
	if (httpObject != null) {
		httpObject.open("GET", "<?=base_url();?>submit/vote/"+str+"/"+vote+"/"+ids, true);
		httpObject.send(null);
		httpObject.onreadystatechange = setOutput1;
	}
}



var httpObject = null;
-->
</script>


<?php
  $remoteconn=$_SERVER['REMOTE_ADDR']."agentcris".$ids;
  $uni=md5($remoteconn);
?>
<div id="main">
<p>&nbsp;</p>
<center>
  <h2>Thank you for the submission!</h2><br />

<div align="left">
  <a href="<?php echo base_url()."entry/index/".$ids;?>"><?php echo $title?></a><br /><br />
  <?php echo $description; ?><br /><br />

  Successfully Voted Up!
</div>
</center>  

</div>
