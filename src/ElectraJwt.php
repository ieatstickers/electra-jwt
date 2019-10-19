<?php

namespace Electra\Jwt;

use Electra\Jwt\Data\Token\Token;

class ElectraJwt
{
  /** @var Token | null */
  protected static $token;
  /** @var string */
  protected static $secret;

  /** @return Token | null */
  public static function getToken(): ?Token
  {
    return self::$token;
  }

  /** @param Token $token */
  public static function setToken($token)
  {
    self::$token = $token;
  }

  /** @return string */
  public static function getSecret(): string
  {
    return self::$secret;
  }

  /** @param Token $secret */
  public static function setSecret($secret)
  {
    self::$secret = $secret;
  }

}