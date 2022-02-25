<?php
ini_set('memory_limit', '-1');
use Drupal\Core\Session\UserSession;
use \Drupal\user\Entity\User;
use \Drupal\node\Entity\Node;

$switcher = \Drupal::service('account_switcher');
$switcher->switchTo(new UserSession(['uid' => 1]));

$all_tpy_taxonomy_term = ['prepaid_balance', 'sell_items', 'purchase_items'];
//'storage'
//$all_tpy_content_type = ['billing_write_off', 'billing', 'sales_order', 'product', 'goods', 'customer', 'stock_up', 'vendor', 'purchase_order'];
$all_tpy_content_type = ['product', 'stock_up'];

for($i=0; $i < count($all_tpy_taxonomy_term); $i++) {
    $tids = \Drupal::entityQuery("taxonomy_term")->condition('vid', $all_tpy_taxonomy_term[$i])->execute();
    foreach($tids as $tid) {
        $entity = \Drupal::entityTypeManager()->getStorage("taxonomy_term")->load($tid);
        $entity->delete();
    }
}

for($i=0; $i < count($all_tpy_content_type); $i++) {
    $nids = \Drupal::entityQuery("node")->condition('type', $all_tpy_content_type[$i])->execute();
    foreach($nids as $nid) {
        $entity = \Drupal::entityTypeManager()->getStorage("node")->load($nid);
        $entity->delete();
    }
}
$switcher->switchBack();

