<?php

namespace Electra\Jwt\Data\Token;

class Token
{
  /** @var array */
  public $header = [ 'alg', 'HS256', 'typ' => 'jwt' ];
  /** @var array */
  public $payload = [];
  /** @var string */
  public $signature;

  /**
   * @param string $claim
   * @return mixed|null
   */
  public function getClaim(string $claim)
  {
    if (isset($this->payload[$claim]))
    {
      return $this->payload[$claim];
    }

    return null;
  }
}