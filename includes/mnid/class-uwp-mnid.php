<? php

require_once('vendor/autoload.php');


class upw_MNID {

use Elliptic\EC;
use StephenHill\Base58;
use kornrunner\Keccak;

$gmp = new StephenHill\GMPService();
$base58 = new StephenHill\Base58('123456789ABCDEFGHJKLMNPQRSTUVWXYZabcdefghijkmnopqrstuvwxyz', $gmp);


// my MNID is "2oxQcKpgT7JAG2MEGydPPLZijtaAH4aKbVK"
// $payload = [];
// from this javascript:
// function checksum (payload) {
//   return new Buffer(sha3_256(Buffer.concat(payload)), 'hex').slice(0, 4)
// }
//  function here returns a buffer (typearray?) that is a hash of the concatenated  buffer
//  the function says "use the 4 byte slice of the buffer (typearray) after hashing the concatenated payload"
//  so what is the payload?
// const payload = [new Buffer('01', 'hex'), hex.decode(network.slice(2)), new Buffer(address.slice(2), 'hex')]
// the payload is an array with three elements: a Buffer constructed of two members (01, hex), the second element of the nework array which represents the network address(?), where network is defined as the hex encoded first element of "data", here a (possible) MNID (const network = data.slice(1, netLength)) and a third array with members from the second element of the address array, defined as (const address = data.slice(netLength, 20 + netLength)).  const netLength = data.length - 24.  this aligns with the description given in the MNID README
//
// 1 byte version number (currently 1)
// network id or four bytes of genesis block hash (or both)
// actual address data
// Four bytes (32 bits) of SHA3-based error checking code (digest of the version, network and payload)
// Then base58 encoding is applied to the end result.
//
//  how do we concatenate in php?  the "dot" character
//
private function checksum($payload) {

  // $pubencpayload = hex2bin($payload->encode("hex", true));
  // $pubhash  = $netid . hash('ripemd160', hash('sha256', $pubencpayload, true), true);
  // $checksum = substr( hash('sha256', $pubhash, false), 0, 4);
  $checksum = substr( Keccak::hash($payload), 0, 4);

}
// $recovered = "0x" . substr(Sha3::hash(hex2bin($publicKey['x'].$publicKey['y']), 256),24)
// $recovered = "0x" . substr(Keccak::hash(substr(hex2bin($pubKey->encode("hex")), 1), 256), 24);


  //  from this javascript:
  // export function encode ({network, address}) {
  //   const payload = [new Buffer('01', 'hex'), hex.decode(network.slice(2)), new Buffer(address.slice(2), 'hex')]
  //   payload.push(checksum(payload))
  //   return base58.encode(Buffer.concat(payload))
  // }

public function encode($network, $address) {
  $payload = [(version number), $networkid($el2), $address($el2)];

}
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

public function decodeMnid ($encodedMnid) {
  $mnidData   = $base58->decode($encodedMnid);
  $netLength  = strlen($mnidData) - 24;
  $version    =
}
}
