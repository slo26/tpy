<?php
use Drupal\Core\Session\UserSession;
use \Drupal\node\Entity\Node;

$switcher = \Drupal::service('account_switcher');
$switcher->switchTo(new UserSession(['uid' => 1]));

$storages = ["59" => "KA001", "2104" => "KA002", "2548" => "KA003", "4900" => "KA004"];
$file = fopen(dirname(__FILE__) . "/product.csv","r");
while(! feof($file)) {
    $line = trim(fgets($file));
    $entry = explode(",", $line);
    $node = Node::create([
        'type' => "product",
    ]);
    $node->set('field_product_category_inventory', $entry[0]);
    $node->set('title', trim($entry[1]));
    if ( !empty(trim($entry[2])) ) {
        $node->set("field_product_name", trim($entry[2]));
    }
    if ( !empty(trim($entry[3])) ) {
        $node->set("field_specification", trim($entry[3]));
    }
    if ( !empty(trim($entry[4])) ) {
        $node->set("field_directions", trim($entry[4]));
    }
    if ( !empty(trim($entry[5])) ) {
        $node->set("field_size", trim($entry[5]));
    }
    if ( !empty(trim($entry[6])) ) {
        $node->set("field_weight", trim($entry[6]));
    }
    if ( !empty(trim($entry[7])) ) {
        $node->set("field_color", trim($entry[7]));
    }
    if ( !empty(trim($entry[8])) ) {
        $node->set("field_unit", trim($entry[8]));
    }
    if ( !empty(trim($entry[9])) ) {
        $node->set("field_cost_price", trim($entry[9]));
    }
    if ( !empty(trim($entry[10])) ) {
        $node->set("field_retail_price", trim($entry[10]));
    }
    if ( !empty(trim($entry[11])) ) {
        $node->set("field_comment", trim($entry[11]));
    }
    $node->save();
    $nid = $node->id();
    foreach($storages as $storage_nid => $storage_title) {
        $inventory = Node::create([
            'type' => "stock_up",
        ]);
        $inventory->set('title', $storage_title ."+" . $node->title->value);
        $inventory->field_storage_id = ['target_id' => $storage_nid];
        $inventory->set('field_stock', 0);
        $inventory->field_product_goods = ['target_id' => $nid];
        $inventory->save();
    }
}
$switcher->switchBack();

