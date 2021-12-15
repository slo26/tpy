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
    $node->set('title', 'CU-' . trim($entry[0]));
    if ( !empty(trim($entry[1])) ) {
        $node->field_contact_person[] = trim($entry[1]);
    }
    if ( !empty(trim($entry[2])) ) { 
        $node->set('field_phone', trim($entry[2]));    
    }
    if ( !empty(trim($entry[3])) ) {
        $node->set('field_fax', trim($entry[3]));
    } 
    if ( !empty(trim($entry[4])) ) {
        $node->field_mobile[] = trim($entry[4]);
    }
    if ( !empty(trim($entry[5])) ) {
        $node->field_mobile[] = trim($entry[5]);
    }
    if ( !empty(trim($entry[6])) ) {
        if ( strpos(trim($entry[6]), "羅太平") !== FALSE ) {
            $node->set("field_sales", 12);
        } else if ( strpos(trim($entry[6]), "羅明清") !== FALSE ) {
            $node->set("field_sales", 11);
        } else if ( strpos(trim($entry[6]), "賴淑真") !== FALSE ) {
            $node->set("field_sales", 10);
        } else if ( strpos(trim($entry[6]), "LISA") !== FALSE ) {
            $node->set("field_sales", 9);
        }
    }
    if ( !empty(trim($entry[7])) ) {
        $node->set("field_customer_title", trim($entry[7]));
    }
    if ( !empty(trim($entry[8])) ) {
        if ( strpos(trim($entry[8]), "中盤商") !== FALSE ) {
            $node->set("field_industry", "mid_market");
        } else if ( strpos(trim($entry[8]), "系統整合") !== FALSE ) {
            $node->set("field_industry", "system_integration");
        } else if ( strpos(trim($entry[8]), "工程安裝") !== FALSE ) {
            $node->set("field_industry", "engineering_installation");
        } else if ( strpos(trim($entry[8]), "設計事務") !== FALSE ) {
            $node->set("field_industry", "design_affairs");
        } else if ( strpos(trim($entry[8]), "製造商") !== FALSE ) {
            $node->set("field_industry", "manufacturer");
        } else if ( strpos(trim($entry[8]), "水電材料") !== FALSE ) {
            $node->set("field_industry", "hydropower_materials");
        }
    }
    if ( !empty(trim($entry[9])) ) {
        $node->set("field_payment_condition", trim($entry[9]));
    }
    if ( !empty(trim($entry[10])) ) {
        $node->set("field_uniform_number", trim($entry[10]));
    }
    if ( !empty(trim($entry[11])) ) {
        $node->set("field_address", trim($entry[11]));
    }
    if ( !empty(trim($entry[13])) ) {
        $node->set("field_email", strtolower(trim($entry[13])));
    }
    if ( !empty(trim($entry[14])) ) {
        $node->set("field_long_comment", trim($entry[14]));
    }
    $node->set("field_customer_type", "current_customer");
    $node->set("field_delivery", "mail_out");
    $node->set("field_payment", "check");
    $node->save();
}
$switcher->switchBack();

