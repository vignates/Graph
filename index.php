<?php
ini_set('display_erors',1);
include_once 'config.php';
include_once 'style.php';
$db = new DB_Class();
$result = mysql_query("select benchmarks.phone_id, phone_name, quadrant from benchmarks left join phone on benchmarks.phone_id= phone.phone_id where quadrant <> 0 order by quadrant asc");
$data = array();
$n_rows = mysql_num_rows($result);
for($i = 0; $i < $n_rows; $i++){
 $data[] = mysql_fetch_row($result, MYSQL_NUM);
 }

?>
<div class="hero-unit span8">
	<form method="POST" action="display.php" name='display'>
		<table class="table table-bordered table-condensed">
		<?php for($i=0;$i<count($data);$i++)
		{
			echo '<tr><td><label>'.$data[$i][1].'</label></td>';
		 ?>
		<td>
		<input type="checkbox" id="check_list<?php echo $data[$i][0]; ?>" name="check_list[]" value="<?php echo $data[$i][2];?>"  onchange = "change('<?php echo $data[$i][0];?>','<?php echo $data[$i][1];?>')">
		<input type="hidden" id="phone_name<?php echo $data[$i][0]; ?>" name="phone_name[]" value="">
		</td></tr>
		<?php }?>
		</table>
		<input type="submit" class="btn btn-primary btn-large" value="Display Graph"/><br/>
	</form> 
	</div>
</div>
<script type = "text/javascript">
function change(id,name) {
//alert(id+' '+name);
check=document.getElementById("check_list"+id).checked;
//alert(check);
 if (check) {
document.getElementById("phone_name"+id).value = name;
}
else {
document.getElementById("phone_name"+id).value = "";
}
}
</script>
</body>
</html>