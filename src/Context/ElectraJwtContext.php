<?php

namespace Electra\Jwt\Context;

use Electra\Jwt\Data\Jwt\Jwt;

trait ElectraJwtContext
{
  /** @var Jwt | null */
  protected $jwt;
  /** @var string */
  protected $jwtSecret;

  /** @return Jwt | null */
  public function getJwt(): ?Jwt
  {
    return $this->jwt;
  }

  /**
   * @param Jwt $jwt
   *
   * @return $this
   */
  public function setJwt(Jwt $jwt)
  {
    $this->jwt = $jwt;

    return $this;
  }

  /** @return string */
  public function getJwtSecret(): string
  {
    return $this->jwtSecret;
  }

  /**
   * @param string $jwtSecret
   *
   * @return $this
   */
  public function setJwtSecret(string $jwtSecret)
  {
    $this->jwtSecret = $jwtSecret;

    return $this;
  }

}
