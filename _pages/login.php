<?php
$phpPost = filter_input_array(INPUT_POST);

define('HoorayWeb', TRUE);

include_once ("../p_settings.php");

if (!empty($phpPost['postlogin']))
{
    $body = 'grant_type=password&UserName=' . $phpPost['postlogin'] . '&Password=' . $phpPost['postsenha'];
    
    $ch = curl_init($endPoint['token']);

    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $body);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);

    $response = curl_exec($ch);

    $retornoToken = json_decode($response, TRUE);

    if (!empty($retornoToken['error']))
    {
        session_start();
        session_destroy();
        
        echo "!!" . $retornoToken['error_description'];
    }
    else
    {
        session_start();
        
        $_SESSION['bearer'] = $retornoToken['token_type'] . " " . $retornoToken['access_token'];
        $_SESSION['time'] = time();
        
        echo 'Efetuando login...';
    }
}
?>
<script type="text/javascript" async src="https://d335luupugsy2.cloudfront.net/js/loader-scripts/e88341a9-780f-4d0c-8ebc-b5d4463ef21f-loader.js"></script>