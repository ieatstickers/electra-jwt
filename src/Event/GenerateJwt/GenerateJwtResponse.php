<?php

namespace Electra\Jwt\Event\GenerateJwt;

use Electra\Core\Event\AbstractResponse;

/**
 * Class GenerateJwtResponse
 * @package Electra\Jwt\Event\GenerateJwt
 * @method static create($data = [])
 */
class GenerateJwtResponse extends AbstractResponse
{
  /** @var string */
  public $jwt;
}