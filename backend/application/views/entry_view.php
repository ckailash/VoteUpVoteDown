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



function vote(str,vote,ids,spa,t,spa1){
	httpObject = getHTTPObject();
	if (httpObject != null) {
		httpObject.open("GET", "<?=base_url();?>submit/vote/"+str+"/"+vote+"/"+ids, true);
		httpObject.send(null);
		httpObject.onreadystatechange = function(){
			

			if (httpObject.readyState==1)
			{
				document.getElementById(spa).innerHTML = "<img src='<?=base_url();?>images/loading.gif'>";
				document.getElementById(spa1).innerHTML = "<img src='<?=base_url();?>images/loading.gif'>";
			}
			else if(httpObject.readyState == 4){
				document.getElementById(spa).innerHTML = httpObject.responseText;
				if(httpObject.responseText=="Successfully Voted Up!"){
				t++;
				document.getElementById(spa1).innerHTML = ""+t+"";
				}else if(httpObject.responseText=="Successfully Voted Down!"){
				t--;
				document.getElementById(spa1).innerHTML = ""+t+"";
				}
			}
		};
	}
}

function flag(id,which){

	httpObject = getHTTPObject();
	if (httpObject != null) {
		httpObject.open("GET", "<?=base_url();?>submit/flag/"+id+"/", true);
		httpObject.send(null);
		httpObject.onreadystatechange = function(){

			if (httpObject.readyState==1)
			{
				document.getElementById(which).innerHTML = "<img src='<?=base_url();?>images/loading.gif'>";

			}
			else if(httpObject.readyState == 4){
				document.getElementById(which).innerHTML = httpObject.responseText;
			}
		};
	}
}



var httpObject = null;
-->
</script>




<div id="main">
<p>&nbsp;</p>

<?=$error?><br /><br />

<?php for($i=0;$i<count($results);$i++){
	  
	    $remoteconn=$_SERVER['REMOTE_ADDR']."agentcris".$results[$i]->link_id;
	    $uni=md5($remoteconn);?>
	  	<div id="maincontent">
		<b><a target="_blank" href="<?php echo $results[$i]->link_url;?>"><?php echo $results[$i]->link_title;?></a></b><br /><br />
		Domain : <?php echo $results[$i]->link_domain;?> &nbsp; Votes: <span id="vote<?php echo $i;?>"><?php echo $results[$i]->link_votes;?></span><br /><br />
		<?php if($results[$i]->link_content!="")echo $results[$i]->link_content; else echo "No Description Available!" ?><br /><br />
		<span class="vote" id="<?php echo $i;?>">
		Vote: <font color="green"> <a href="javascript:vote('<?php echo $uni; ?>',1,<?php echo $results[$i]->link_id;?>,<?php echo $i;?>,<?php echo $results[$i]->link_votes;?>,'vote<?php echo $i;?>');"> +1 </a></font> &nbsp; 
		<?php if($results[$i]->link_votes){?>
		<font color="red"> <a href="javascript:vote('<?php echo $uni; ?>',0,<?php echo $results[$i]->link_id;?>,<?php echo $i;?>,<?php echo $results[$i]->link_votes;?>,'vote<?php echo $i;?>');"> -1 </a></font>
		<?php } ?>
		</span>
		&nbsp;&nbsp;<span id="flag<?php echo $i;?>"><a href="javascript:flag(<?php echo $results[$i]->link_id;?>,'flag<?php echo $i;?>');">Flag link</a></span>
		<br /><br />
		
		
		
		<fb:comments title="Discussions" width="580px"></fb:comments>		
		
		</div>
	  <?php } ?>


</div>
