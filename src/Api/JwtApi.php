<?php

namespace Electra\Jwt\Api;


use Electra\Jwt\Data\Token\Token;

class JwtApi
{
  /**
   * @param array $payload
   * @param string $secret
   * @param array $header
   * @return string
   */
  public static function generateJwt(
    array $header,
    array $payload,
    string $secret
  ): string
  {
    $encodedHeader = self::base64UrlEncode(json_encode($header));
    $encodedPayload = self::base64UrlEncode(json_encode($payload));
    $signature = self::sign($encodedHeader, $encodedPayload, $secret);
    $encodedSignature = self::base64UrlEncode($signature);

    return $encodedHeader . '.' . $encodedPayload . '.' . $encodedSignature;
  }

  /**
   * @param string $jwt
   * @return Token
   */
  public static function parseJwt(string $jwt): ?Token
  {
    [$encodedHeader, $encodedPayload, $encodedSignature] = explode('.', $jwt);

    if (!$encodedHeader || !$encodedPayload || !$encodedSignature)
    {
      return null;
    }

    $decodedHeader = null;
    $decodedPayload = null;
    $decodedSignature = null;

    try
    {
      $decodedHeader = json_decode(self::base64UrlDecode($encodedHeader), true);
      $decodedPayload = json_decode(self::base64UrlDecode($encodedPayload), true);
      $decodedSignature = self::base64UrlDecode($encodedSignature);
    }
    catch (\Exception $e)
    {}

    if (!$decodedHeader || !$decodedPayload || !$decodedSignature)
    {
      return null;
    }

    $token = new Token();
    $token->header = $decodedHeader;
    $token->payload = $decodedPayload;
    $token->signature = $decodedSignature;

    return $token;
  }

  /**
   * @param string $input
   * @return string
   */
  public static function base64UrlEncode(string $input): string
  {
    return str_replace('=', '', strtr(base64_encode($input), '+/', '-_'));
  }

  /**
   * @param string $input
   * @return string
   */
  public static function base64UrlDecode(string $input): string
  {
    $remainder = strlen($input) % 4;

    if ($remainder)
    {
      $padlen = 4 - $remainder;
      $input .= str_repeat('=', $padlen);
    }

    return base64_decode(strtr($input, '-_', '+/'));
  }

  /**
   * @param string $encodedHeader
   * @param string $encodedPayload
   * @param string $secret
   * @return string
   */
  public static function sign(
    string $encodedHeader,
    string $encodedPayload,
    string $secret
  ): string
  {
    return hash_hmac('sha256', $encodedHeader . "." . $encodedPayload, $secret, true);
  }

  /**
   * @param Token $token
   * @param string $secret
   * @return bool
   */
  public static function verifySignature(Token $token, string $secret): bool
  {
    $encodedHeader = self::base64UrlEncode(json_encode($token->header));
    $encodedPayload = self::base64UrlEncode(json_encode($token->payload));
    $signature = self::sign($encodedHeader, $encodedPayload, $secret);

    return ($signature == $token->signature);
  }
}