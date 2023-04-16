<!DOCTYPE html>
<html>
<body>


<?php
echo "Welcome User #";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // collect value of input field
    $u_id = $_POST['u_id'];
    if (empty($u_id) || !preg_match("/^[0123456789]*$/",$u_id)) {
        include 'redirect_index.php';
    } else {
        echo $u_id;
    }
}
?>
<br>
<?php

?>

</body>
</html>
