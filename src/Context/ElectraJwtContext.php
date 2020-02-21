<?php

namespace Electra\Jwt\Context;

use Electra\Jwt\Data\Token\Token;

class ElectraJwtContext
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
  public static function setToken(Token $token)
  {
    self::$token = $token;
  }

  /** @return string */
  public static function getSecret(): string
  {
    return self::$secret;
  }

  /** @param string $secret */
  public static function setSecret($secret)
  {
    self::$secret = $secret;
  }

}