<? php
namespace UportWP\Main\DID_JWT\Digest;

// from the javascript:
// import { sha256 as sha256js } from 'js-sha256'
// import { keccak_256 } from 'js-sha3'
// import { Buffer } from 'buffer'

// string hash ( '$sha256' , string $data [, bool $raw_output = FALSE ] )

use kornrunner\keccak;


class uwp_DID_JWT_Digest {
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
