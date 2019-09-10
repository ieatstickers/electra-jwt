<?php

namespace Electra\Jwt\Event\ParseJwt;

use Electra\Core\Event\AbstractResponse;

class ParseJwtResponse extends AbstractResponse
{
  /** @var string */
  public $header;
  /** @var string */
  public $payload;
  /** @var string */
  public $signature;
  /** @var bool */
  public $verified;

  /** @return ParseJwtResponse */
  public static function create(): ParseJwtResponse
  {
    return new self();
  }
}