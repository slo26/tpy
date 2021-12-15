<?php
use Drupal\Core\Session\UserSession;
use \Drupal\node\Entity\Node;

$switcher = \Drupal::service('account_switcher');
$switcher->switchTo(new UserSession(['uid' => 1]));
$nids = \Drupal::entityQuery("node")
                    					->condition('type', 'customer')
                    					->execute();
foreach ($nids as $nid) {
    $entity = \Drupal::entityTypeManager()->getStorage("node")->load($nid);
    $entity->delete();
}

$switcher->switchBack();
