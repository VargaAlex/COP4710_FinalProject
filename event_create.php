<?php
	include('session.php');
?>

<h2>Create Event</h2>
<?php echo $error; ?> <br /><br />
<form action = "" method = "post">
<label>RSO name  :</label><input type = "text" name = "name" /><br /><br />
<label>Description  :</label><input type = "text" cols="51" rows="5" style="width:510px; height:100px;" name = "info"/><br/><br />
<input type = "submit" value = " Submit "/><br />
</form>