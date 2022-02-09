<?php
use Drupal\Core\Session\UserSession;
use \Drupal\node\Entity\Node;

$switcher = \Drupal::service('account_switcher');
$switcher->switchTo(new UserSession(['uid' => 1]));

$file = fopen(dirname(__FILE__) . "/customer.csv","r");
while(! feof($file)) {
    $line = trim(fgets($file));
    $entry = explode(",", $line);
    $node = Node::create([
        'type' => "customer",
    ]);
    echo trim($entry[0]) . "\n";
    $node->set('title', 'CU-' . trim($entry[0]));
    if ( !empty(trim($entry[1])) ) {
        $node->set("field_customer_title", trim($entry[1]));
    }
    if ( !empty(trim($entry[2])) ) {
        $node->set("field_industry", trim($entry[2]));
    }
    $node->set("field_customer_type", trim($entry[3]));
    if ( !empty(trim($entry[4])) ) {
        $node->set("field_uniform_number", trim($entry[4]));
    }
    if ( !empty(trim($entry[5])) ) {
        $node->set("field_payment_due", trim($entry[5]));
    }
    if ( !empty(trim($entry[6])) ) {
        $node->set("field_owner", trim($entry[6]));
    }
    if ( !empty(trim($entry[7])) ) {
        $node->set("field_address", trim($entry[7]));
    }
    if ( !empty(trim($entry[8])) ) {
        $node->set("field_uniform_number_address", trim($entry[8]));
    }
    if ( !empty(trim($entry[9])) ) {
        $node->set("field_phone", trim($entry[9]));
    }
    if ( !empty(trim($entry[10])) ) {
        $node->set("field_fax", trim($entry[10]));
    }
    if ( !empty(trim($entry[11])) ) {
        $node->field_contact_person[] = trim($entry[11]);
    }
    if ( !empty(trim($entry[12])) ) {
        $node->field_mobile[] = trim($entry[12]);
    }
    if ( !empty(trim($entry[13])) ) {
        $node->field_mobile[] = trim($entry[13]);
    }
    if ( !empty(trim($entry[14])) ) {
        $node->field_mobile[] = trim($entry[14]);
    }
    if ( !empty(trim($entry[15])) ) {
        $node->set("field_email", trim($entry[15]));
    }
    if ( !empty(trim($entry[16])) ) {
        $node->field_sales = ["target_id" => trim($entry[16])];
    }
    $comment = trim($entry[17]) . trim($entry[18]);
    $node->set("field_long_comment", trim($comment));
    $node->set("field_suggest_to_tax", trim($entry[19]));
    $node->set("field_delivery", "mail_out");
    

    $node->save();
}
$switcher->switchBack();

