<?php

namespace Electra\Jwt\Event\GenerateJwt;

use Electra\Core\Event\AbstractResponse;

class ElectraGenerateJwtResponse extends AbstractResponse
{
  /** @var string */
  public $jwt;

  /** @return ElectraGenerateJwtResponse */
  public static function create(): ElectraGenerateJwtResponse
  {
    return new self();
  }
}