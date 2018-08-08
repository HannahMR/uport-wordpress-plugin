<? php

use UportWP\Main\MNID;
use PHPUnit\Framework\TestCase;

// require_once dirname( __FILE__ ) . ('/includes/mnid/class-uwp-mnid.php');

class uwpMNIDTestCase extends TestCase {


  public function test_isMNID() {

    $encodedMNID = "2oxQcKpgT7JAG2MEGydPPLZijtaAH4aKbVK";
    $checkMNID = $this -> class_instance -> isMNID($encodedMNID);
    assertTrue( $checkMNID );
  }

}
?>
