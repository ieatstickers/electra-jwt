<?php

namespace Electra\Jwt\Data\Token;

use Electra\Core\Exception\ElectraException;
use Electra\Utility\Objects;

class Token
{
  /** @var array */
  public $header = [ 'alg', 'HS256', 'typ' => 'jwt' ];
  /** @var array */
  public $payload = [];
  /** @var string */
  public $signature;
  /** @var bool */
  public $verified;

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

  /**
   * @param string $claim
   * @return mixed
   * @throws ElectraException
   */
  public function getRequiredClaim(string $claim)
  {
    if (isset($this->payload[$claim]))
    {
      return $this->payload[$claim];
    }

    throw (new ElectraException('Required claim not present in JWT token'))
      ->addMetaData('claim', $claim);
  }

  /**
   * @param array | object $data
   * @return Token
   * @throws \Exception
   */
  public static function create($data = [])
  {
    return Objects::hydrate(new self(), (object)$data);
  }
}