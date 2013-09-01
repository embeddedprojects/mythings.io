<script src="[WEBROOT]/js/bootstrap-datepicker.js"></script>    
<form method="post" action="">
	<table width="100%">
		<tr><td><label>Date of purchase:</label></td><td><input type="text" name="dateofpurchase" value="[DATEOFPURCHASE]" style="width:500px" id="dp1"></td></tr>
<!--		<tr><td><label>Thing image:</label></td><td><input type="file" name="image" ></td></tr>-->
	</table>

<br><bR>
    <input name="submit" class="btn btn-default btn-block btn-primary" type="submit" value="Save new date of purchase for this thing!">
    <a href="[BACK]" class="btn btn-default btn-block" type="button">Back, don't edit date of purchase for this thing</a>

    </form>
<script type="text/javascript">
		$(function(){
			$('#dp1').datepicker({
				format: 'yyyy-mm-dd'
			});
		});
</script>

