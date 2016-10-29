<?php
// Method: POST, PUT, GET etc
// Data: array("param" => "value") ==> index.php?param=value

$crap = 10;

function CallAPI($method, $url, $env, $data = false)
{
	//echo $method;
	//echo $url;    

// copy file content into a string var
$json_file = file_get_contents('env.json');

$jfo = json_decode($json_file);
//var_dump($jfo);

$env_tenantcode = $jfo->awtenantcode;
//print_r($env_tenantcode);

$env_auth = $jfo->auth;
//echo $env_auth;

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
    curl_setopt($curl, CURLOPT_USERPWD, $env_auth);

    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

    curl_setopt($curl, CURLOPT_HTTPHEADER, array(
        $env_tenantcode,
        'content-type:application/json'
    ));

	curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false); //insecure connection allow

    $result = curl_exec($curl);
    echo curl_error($curl);

    curl_close($curl);

    return $result;
}
