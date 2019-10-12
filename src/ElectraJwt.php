<?php

namespace Electra\Jwt;

use Electra\Jwt\Data\Token\Token;

class ElectraJwt
{
  /** @var Token | null */
  protected static $token;

  /** @return Token | null */
  public static function getToken(): ?Token
  {
    return self::$token;
  }

  /**
   * @param Token $token
   */
  public static function setToken($token)
  {
    self::$token = $token;
  }

}