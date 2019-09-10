<?php

use Electra\Jwt\Event\GenerateJwt\ElectraGenerateJwtPayload;
use Electra\Jwt\Event\ElectraJwtEvents;
use Electra\Jwt\Event\ParseJwt\ElectraParseJwtPayload;

// Autoloader
$appDir = __DIR__ . '/..';
$loader = include_once $appDir . '/vendor/autoload.php';

// Define secret
$secret = 'i-love-rich';

// Create payload for generate task
$generatePayload = ElectraGenerateJwtPayload::create();

// Set jwt claims
$generatePayload->jwtPayload = [
  'uid' => 123,         // User ID
  'iat' => 1568062168,  // Issued at
  'exp' => 1569062168   // Expiry
];

// Set secret
$generatePayload->secret = $secret;

// Run generate jwt event
$generateResponse = ElectraJwtEvents::generateJwt($generatePayload);

// Get jwt token from response
$jwt = $generateResponse->jwt;

echo PHP_EOL;
echo "JWT Generated: " . PHP_EOL;
echo PHP_EOL;
echo $jwt . PHP_EOL;
echo PHP_EOL;

// Create parse jwt payload
$parsePayload = ElectraParseJwtPayload::create();

// Set jwt token and secret
$parsePayload->jwt = $jwt;
$parsePayload->secret = $secret;

// Run parse jwt event
$parsedToken = ElectraJwtEvents::parseJwt($parsePayload);

// Dump response
var_dump($parsedToken);