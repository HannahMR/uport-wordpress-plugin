<? php

require_once dirname( __FILE__ ) .  ('vendor/autoload.php');

namespace UWP\MNID;

class uwp_MNID {

use StephenHill\Base58;
use kornrunner\Keccak;

$gmp = new StephenHill\GMPService();
$base58 = new StephenHill\Base58('123456789ABCDEFGHJKLMNPQRSTUVWXYZabcdefghijkmnopqrstuvwxyz', $gmp);

protected static $_instance = null;

public static function instance() {
    if ( is_null( self::$_instance ) ) {
      self::$_instance = new self();
    }
    return self::$_instance;
  }

public function __construct() {
  public $encodedMnid = NULL;
  public $payload = [];

  this->
}
}
// my MNID is "2oxQcKpgT7JAG2MEGydPPLZijtaAH4aKbVK"

//  from this javascript:
// function checksum (payload) {
//   return new Buffer(sha3_256(Buffer.concat(payload)), 'hex').slice(0, 4)
// }
Class Encode extends uwp_MNID {


private function checksum(&$payload) {

  global $payload;
  $checksum = substr( Keccak::hash($payload), 0, 4);
  return $checksum;

}


  //  from this javascript:
  // export function encode ({network, address}) {
  //   const payload = [new Buffer('01', 'hex'), hex.decode(network.slice(2)), new Buffer(address.slice(2), 'hex')]
  //   payload.push(checksum(payload))
  //   return base58.encode(Buffer.concat(payload))
  // }

public function encode($network, $address) {
  global $encodedMnid, $payload;
  $payload = [bin2hex("01"), base_convert($network, 10, 16), hex2str($address)];
  $encodedMnid = $base58->encode(array_push(Keccak::hash($payload, 256))) . $checksum;
  return $encodedMnid;
}
}

Class Decode extends uwp_MNID {
// export function decode (encoded) {
//   const data = Buffer.from(base58.decode(encoded))
//   const netLength = data.length - 24
//   const version = data.slice(0, 1)
//   const network = data.slice(1, netLength)
//   const address = data.slice(netLength, 20 + netLength)
//   const check = data.slice(netLength + 20)
//   if (check.equals(checksum([version, network, address]))) {
//     return {
//       network: `0x${hex.encode(network)}`,
//       address: `0x${address.toString('hex')}`
//     }
//   } else {
//     throw new Error('Invalid address checksum')
//   }
// }

public function decodeMnid () {
  global $encodedMnid;
  $mnidData   = $base58->decode($encodedMnid);
  $netLength  = strlen($mnidData) - 24;
  $version    = substr($mnidData, 0, 1);
  $network    = substr($mnidData, 1, $netLength);
  $addressLen = $netLength + 20;
  $address    = substr($mnidData, $netLength, $addressLen);
  $check      = substr($mnidData, $addressLen);
  if (check = (Keccak::hash($version . $network . $address, 256))) {
    return $network = "0x" . base_convert($network, 10, 16),
    $address = "0x" . hex2str($address);
  } else {
    echo "Invalid address checksum";
  }
}
}
// export function isMNID (encoded) {
//   try {
//     const data = Buffer.from(base58.decode(encoded))
//     return data.length > 24 && data[0] === 1
//   } catch (e) {
//     return false
//   }
Class IsMNID extends uwp_MNID {
public function isMNID () {
  global $encodedMnid;
  if (Decode::mnidData = $base58->decode($encodedMnid), $version = substr(Decode::mnidData, 0, 1) {
    ((strlen($mnidData) > 24) and ($version = 1)
    return true;
  } else {
    return false;
  }
}
}
