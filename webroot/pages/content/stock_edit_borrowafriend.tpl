<script src="[WEBROOT]/js/bootstrap-datepicker.js"></script>    
<form method="post" action="">
	<table width="100%">
		<tr><td><label>Name of friend:</label></td><td><input type="text" name="borrowafriendname" value="[BORROWAFRIENDNAME]" style="width:500px"></td></tr>
		<tr><td><label>Date of borrow:</label></td><td><input type="text" name="borrowafrienddate" value="[BORROWAFRIENDDATE]" style="width:500px" id="dp1"></td></tr>
<!--		<tr><td><label>Thing image:</label></td><td><input type="file" name="image" ></td></tr>-->
	</table>

<br><bR>
    <button class="btn btn-default btn-block btn-primary" type="submit">Borrow now this thing a friend!</button>
    <a href="index.php?module=stock&action=edit&id=[ID]&plugin=borrowafriend&back=true" class="btn btn-success btn-block btn-primary" type="button">Get thing back from friend!</button>
    <a href="[BACK]" class="btn btn-default btn-block" type="button">Back, don't edit date of purchase for this thing</a>

    </form>
<script type="text/javascript">
		$(function(){
			$('#dp1').datepicker({
				format: 'yyyy-mm-dd'
			});
		});
</script>

