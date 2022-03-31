<?php

namespace Drupal\quick_node_clone\Controller;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Access\AccessResult;
use \Drupal\node\Entity\Node;
use Symfony\Component\Routing\Route;

class QuickNodeCloneAccess {
    public function cloneNode(Route $route, $node) {
        $config = \Drupal::config('quick_node_clone.settings');
        $str_enabled_node = $config->get('enable_node');
        $arr_enabled_node = explode(",",$str_enabled_node);
        $node = Node::load($node);

        if ( in_array($node->bundle(), $arr_enabled_node) ) {
            $result = AccessResult::allowed();
        } else {
            $result = AccessResult::forbidden();
        }
        return $result;
    }
}

