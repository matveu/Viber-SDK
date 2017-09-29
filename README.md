Viber SDK
=============
Viber SDK for working with GMS-worldwide Api

Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
composer require matviichuk/viber-sdk
```

or add

```
"matviichuk/viber-sdk": "^1.0"
```

to the require section of your `composer.json` file.

Usage
------------

```
<?php

require 'vendor/autoload.php';

use matviichuk\ViberSdk\Config;
use matviichuk\ViberSdk\Client;
use matviichuk\ViberSdk\Api;
use matviichuk\ViberSdk\Sms;
use matviichuk\ViberSdk\Viber;
use matviichuk\ViberSdk\Parameter;
...

$config     = new Config();
$client     = new Client(['login' => 'Your login', 'password' => 'Your password']);
$api        = new Api($config, $client);
$sms        = new Sms();
$viber      = new Viber();
$parameter  = new Parameter();

1. Send message

Example for send message:

$viber->setTtl(60);                                                 // require for viber
$viber->setIosExpirityText('Text for ios when message expires');    // require for viber
$viber->setText('Text for viber');                                  // require for viber
$viber->setImgUrl('https://path-to-img.com');
$viber->setCaption('Click me');
$viber->setAction('https://clicked.org');

$sms->setText('Text for sms');                                      // require for sms
$sms->setAlphaName('Alpha name');                                   // require for sms
$sms->setTtl(60);                                                   // require for sms

$parameter->setPhoneNumber(380123456789);                           // require
$parameter->setIsPromotional(true);                                 // require
$parameter->setChannels(['viber', 'sms']);                          // require
$parameter->setChannelsOptions($sms, $viber);                       // require
$parameter->setExtraId('2j4h89932kjhs');
$parameter->setTag('Mailing list name');
$parameter->setCallbackUrl('https://send-dr-here.com');
$parameter->setStartTime('2017-12-12 10:10:10');
          
          
$response = $api->sendMessage($parameter);

- success
$response - array like this 
[
  "message_id" => "769911086"
]

- error
$response - array like this 
[
  "error_code" => 1146,
  "error_text" => "Viber expiry text is incorrect"
]

2. Get short detail report by message id

$response = $api->getShortDrByMessageId('769417569');       // array

3. Get short detail report by extra id

$response = $api->getShortDrByExtraId('2j4h89932kjhs');     // array

4. Get full detail report by message id

$response = $api->getFullDrByMessageId('769417569');        // array

5. Get full detail report by extra id

$response = $api->getFullDrByExtraId('2j4h89932kjhs');      // array

```