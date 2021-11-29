<?php
namespace Drupal\sell_items\Controller;

use Symfony\Component\HttpFoundation\RedirectResponse;
use \Drupal\Core\Routing\TrustedRedirectResponse;

class SellItemsController {

    function hasPacked(\Drupal\taxonomy\Entity\Term $taxonomy_term) { 
        if ( $taxonomy_term->hasField('field_is_packed') ) {
            if ( $taxonomy_term->field_is_packed->value == false ) {
                $taxonomy_term->set('field_is_packed', true);
                $taxonomy_term->save();
                \Drupal::messenger()->addMessage($taxonomy_term->name->value . "以完成包裝.");
            } else {
                \Drupal::messenger()->addMessage($taxonomy_term->name->value . "之前以包裝, 無需在包裝一次.");
            }
        }
        
        $url = \Drupal\Core\Url::fromUri('https://' . get_hostname() .'/admin/sell-items?title=' . get_sell_order_number_by_nid($taxonomy_term->field_order_id->target_id));
        $response = new TrustedRedirectResponse($url->toString());
        return $response;
    }
}

