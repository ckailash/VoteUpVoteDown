<style>.form { padding: 20px 20px 10px; background: #E0F4F8; width: 580px; overflow: hidden; }</style>
<h2><?php print $header?></h2>
<br/><br/>
<div id="form">
<script type="text/javascript">
function selectchange(selectname,id,currentstatus){
var newstatus=document.getElementById(selectname).value;
var url="<?=base_url();?>auth/admin/flaggedlinks/flagstatus/"+id+"/"+currentstatus+"/"+newstatus;
//alert(url);
window.location.href=url;
}

</script>
<table><tr><td width="5%" height="35px">Sr</td><td width="80%">Link</td><td width="15%">Flag Status</td></tr>
<?php 
$selectarray=array("approved","flagged","disabled","penabled");
$selectlabels=array("Approved","Flagged","Disabled","Permanently Enabled");
for($i=0;$i<count($results);$i++){

$sele="<select name=flag".$i." id=flag".$i." onchange='javascript:selectchange(\"flag".$i."\",".$results[$i]->link_id.",\"".$results[$i]->link_flag."\")'>";
for($j=0;$j<count($selectarray);$j++){
if($results[$i]->link_flag==$selectarray[$j])
$sele.="<option value=".$selectarray[$j]." selected=selected>".$selectlabels[$j]."</option>";
else
$sele.="<option value=".$selectarray[$j].">".$selectlabels[$j]."</option>";
}
$sele.="</select>";
echo "<tr><td height=35px>".($i+1)."</td><td><a href='".base_url()."entry/index/".$results[$i]->link_id."'>".$results[$i]->link_url."</a></td><td>".$sele."</td></tr>";
}
?>
</table>
</div>

<?php echo $this->pagination->create_links();?>
