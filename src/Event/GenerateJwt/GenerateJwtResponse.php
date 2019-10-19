<?php

namespace Electra\Jwt\Event\GenerateJwt;

use Electra\Core\Event\AbstractResponse;

class GenerateJwtResponse extends AbstractResponse
{
  /** @var string */
  public $jwt;

  /** @return GenerateJwtResponse */
  public static function create(): GenerateJwtResponse
  {
    return new self();
  }
}