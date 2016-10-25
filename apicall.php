<?php
// Method: POST, PUT, GET etc
// Data: array("param" => "value") ==> index.php?param=value

function CallAPI($method, $url, $data = false)
{
        //echo $method;
        //echo $url;    
$curl = curl_init();

    switch ($method)
    {
        case "POST":
            curl_setopt($curl, CURLOPT_POST, 1);

            if ($data)
                curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
            break;
        case "PUT":
            curl_setopt($curl, CURLOPT_PUT, 1);
            break;
        default:
            if ($data)
                $url = sprintf("%s?%s", $url, http_build_query($data));
    }

    // Optional Authentication:
    curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
    curl_setopt($curl, CURLOPT_USERPWD, $userpass);

    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

    curl_setopt($curl, CURLOPT_HTTPHEADER, array(
        'aw-tenant-code:'$tenantcode,
    ));

curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false); //insecure connection allow


    $result = curl_exec($curl);
    echo curl_error($curl);

    curl_close($curl);
//$json = json_decode($result, true);
//print_r($json);

    return $result;
}

//header('Content-type: application/xml');
 //CallAPI("GET", "https://test/api/v1/mdm/devices/search");

?>

<?php
if (isset($_POST['number1']) && isset($_POST['number2'])) {
    $result = CallAPI(($_POST['number1']),($_POST['number2']));
?>
<html>
<body>

    <form action="" method="post">
    <p>METHOD:<input type="text" name="number1" value="GET" /></p>
    <p>URL:<input type="text" name="number2" value="https://url/api/v1$
    <p><input type="submit"/></p>

    <?php// if (isset($result)) { ?>
        <textarea id='myText'  rows="30" cols="120" value='<?php echo $result; $
        <?php// } ?> 

<?php 
/*libxml_use_internal_errors(true);
$myXMLData = $result;

$xml = simplexml_load_string($myXMLData);
if ($xml === false) {
    echo "Failed loading XML: ";
    foreach(libxml_get_errors() as $error) {
        echo "<br>", $error->message;
    }
} else {
    print_r($xml);
}
}*/
?>

</body>
</html>