<?php

namespace Electra\Jwt\Event\ParseJwt;

use Electra\Core\Event\AbstractResponse;
use Electra\Jwt\Data\Token\Token;

/**
 * Class ParseJwtResponse
 * @package Electra\Jwt\Event\ParseJwt
 * @method $this static create($data = [])
 */
class ParseJwtResponse extends AbstractResponse
{
  /** @var Token */
  public $token;
}