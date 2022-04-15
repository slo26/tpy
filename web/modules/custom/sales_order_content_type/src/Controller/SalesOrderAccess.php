<?php

namespace Drupal\sales_order_content_type\Controller;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Access\AccessResult;
use \Drupal\node\Entity\Node;
use Symfony\Component\Routing\Route;

class SalesOrderAccess {
    public function SalesOrderForm(Route $route, $node) {
        $arr_enabled_node = explode(",","sales_order");
        $node = Node::load($node);

        if ( in_array($node->bundle(), $arr_enabled_node) ) {
            $result = AccessResult::allowed();
        } else {
            $result = AccessResult::forbidden();
        }
        return $result;
    }
}


