<?php

namespace Electra\Jwt\Context;

use Electra\Jwt\Data\Jwt\Jwt;

interface ElectraJwtContextInterface
{
  /** @return Jwt | null */
  public function getJwt(): ?Jwt;

  /**
   * @param Jwt $jwt
   *
   * @return $this
   */
  public function setJwt(Jwt $jwt);

  /** @return string */
  public function getJwtSecret(): string;

  /**
   * @param $secret
   * @return $this
   */
  public function setJwtSecret($secret);

}
