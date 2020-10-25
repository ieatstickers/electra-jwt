<?php

namespace Electra\Jwt\Event\ParseJwt;

use Electra\Core\Event\AbstractResponse;
use Electra\Jwt\Data\Jwt\Jwt;

/**
 * Class ParseJwtResponse
 * @package Electra\Jwt\Event\ParseJwt
 * @method $this static create($data = [])
 */
class ParseJwtResponse extends AbstractResponse
{
  /** @var Jwt */
  public $token;
}
