<?php

namespace Electra\Jwt\Event\ParseJwt;

use Electra\Core\Event\AbstractResponse;
use Electra\Jwt\Data\Token\Token;

class ParseJwtResponse extends AbstractResponse
{
  /** @var Token */
  public $token;
  /** @var bool */
  public $verified;

  /** @return ParseJwtResponse */
  public static function create(): ParseJwtResponse
  {
    return new self();
  }
}