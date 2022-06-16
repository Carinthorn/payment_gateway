<?php
require_once dirname(__FILE__) . '/omise-php/lib/Omise.php';
define('OMISE_API_VERSION', '2019-05-29');
define('OMISE_PUBLIC_KEY', 'pkey_test_5qdm3u89k7hwufspgzk');
define('OMISE_PRIVATE_KEY', 'skey_test_5qbdu63c24tbsqskek4');


$charge = OmiseCharge::create(array(
    'amount' => $_POST['total'],
    'currency' => 'thb',
    'card' => $_POST["omiseToken"]
));

echo ($charge['status']);
echo('<pre>');
print_r($charge);
echo('</pre>');
?>

<html>
   <h1>Thank you for your payment. We will send your email</h1>
</html>



