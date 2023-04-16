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

$uri = $_SERVER['REQUEST_URI'];
echo "URI: ".$uri."<br>"; // Outputs: URI
 
$protocol = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
echo "Protocol: ".$protocol."<br>";
$url = $protocol . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
echo "URL: ".$url."<br>"; // Outputs: Full URL
 
$query = $_SERVER['QUERY_STRING'];
echo $query; // Outputs: Query String

$filename = basename($url).PHP_EOL;
echo "Filename: ".$filename."<br>";

$ext = dirname($url);
echo "Extension: ".$ext."<br>";
?>

</body>
</html>
