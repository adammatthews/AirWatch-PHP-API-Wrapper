<?php include 'api.php';?>

<?php
//echo $crap;

if (isset($_POST['number1']) && isset($_POST['number2'])) {
  $result = CallAPI(($_POST['number1']),($_POST['number2']));
	//$result = CallAPI("GET","https://aw.am-emm.uk/api/v1/mdm/devices/search");
	//echo $result;
}
?>
<html>
<body>
    <form action="" method="post">
    <p>METHOD:<input type="text" name="number1" value="GET" /></p>
    <p>URL:<input type="text" name="number2" value="https://aw.am-emm.uk/api/v1/mdm/devices/search"/></p>
    <p><input type="submit"/></p>

    <?php if (isset($result)) { ?>
        <textarea id='myText'  rows="30" cols="120" value='<?php echo $result; ?>' />
        <?php } ?>

<?php
// libxml_use_internal_errors(true);
// $myXMLData = $result;
// 
// $xml = simplexml_load_string($myXMLData);
// if ($xml === false && isset($result)) {
//     echo "Failed loading XML: ";
//     foreach(libxml_get_errors() as $error) {
//         echo "<br>", $error->message;
//     }
// } else {
//     print_r($xml);
// }
print_r($result);
?>
</textarea>


</body>
</html>
