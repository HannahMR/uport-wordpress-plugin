<? php
namespace UportWP\Main\DID_JWT\Verifier;


//  from the javascript:
// import { ec as EC } from 'elliptic'
// import { sha256, toEthereumAddress } from './Digest'
// move './Digest' functions into Verifier
// import base64url from 'base64url'
//
// const secp256k1 = new EC('secp256k1')

use Elliptic\EC;
// string base64_encode ( string $data )
use kornrunner\keccak;


class uwp_DID_JWT_Verifier {
  protected static $_instance = null;

public static function instance() {
    if ( is_null( self::$_instance ) ) {
      self::$_instance = new self();
    }
    return self::$_instance;
  }

// from the javascript:
// export function sha256 (payload) {
//   return Buffer.from(sha256js.arrayBuffer(payload))
// }


public function digest_sha256() {
  return payload hash('sha256',)
}
}
