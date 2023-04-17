<?php
	include('session.php');
?>




<p>Create User</p>
<form action="create_user.php" method="post">
  <label for="University">University:</label>
  <input type="text" id="university" name="university" required>

  <input type="submit" value="Create University">
</form>