<?php
use Drupal\Core\Session\UserSession;
use \Drupal\node\Entity\Node;

$switcher = \Drupal::service('account_switcher');
$switcher->switchTo(new UserSession(['uid' => 1]));

$file = fopen(dirname(__FILE__) . "/vendor.csv","r");
while(! feof($file)) {
    $line = trim(fgets($file));
    $entry = explode(",", $line);
    $node = Node::create([
        'type' => "vendor",
    ]);
    echo trim($entry[0]) . "\n";
    $node->set('title', 'VD-' . trim($entry[0]));
    if ( !empty(trim($entry[1])) ) {
        $node->set("field_vendor_name", trim($entry[1]));
    }
    if ( !empty(trim($entry[2])) ) {
        $node->set("field_uniform_number", trim($entry[2]));
    }
    if ( !empty(trim($entry[3])) ) {
        $node->set("field_phone", trim($entry[3]));
    }
    if ( !empty(trim($entry[4])) ) {
        $node->set("field_fax", trim($entry[4]));
    }
    if ( !empty(trim($entry[5])) ) {
        $node->set("field_address", trim($entry[5]));
    }
    if ( !empty(trim($entry[6])) ) {
        $node->set("field_factory_address", trim($entry[6]));
    }
    if ( !empty(trim($entry[7])) ) {
        $node->field_contact_person[] = trim($entry[7]);
    }
    if ( !empty(trim($entry[8])) ) {
        $node->field_mobile[] = trim($entry[8]);
    }
    if ( !empty(trim($entry[9])) ) {
        $node->set("field_email", trim($entry[9]));
    }
    $comment = trim($entry[10]) . trim($entry[11]);
    $node->set("field_long_comment", trim($comment));
    if ( !empty(trim($entry[12])) ) {
        $node->set("field_payment_due", trim($entry[12]));
    }
    $node->save();
}
$switcher->switchBack();

