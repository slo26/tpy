<?php
namespace Drupal\sell_items\Controller;

use Symfony\Component\HttpFoundation\RedirectResponse;
use \Drupal\Core\Routing\TrustedRedirectResponse;

class SellItemsController {

    function hasPacked(\Drupal\taxonomy\Entity\Term $taxonomy_term) { 
        if ( $taxonomy_term->hasField('field_requisition_status') ) {
            if ( empty($taxonomy_term->field_requisition_status->value) ) {
                $taxonomy_term->set('field_requisition_status', "packed");
                $taxonomy_term->save();
                \Drupal::messenger()->addMessage($taxonomy_term->name->value . "以完成包裝.");
            } else if ( $taxonomy_term->field_requisition_status->value == "packed" ) {
                \Drupal::messenger()->addMessage($taxonomy_term->name->value . "之前以包裝出貨, 無需在包裝出貨一次.");
            } else if ( $taxonomy_term->field_requisition_status->value == "transferred" ) {
                \Drupal::messenger()->addMessage($taxonomy_term->name->value . "以轉寄倉， 無法在包裝出貨.");
            }
        }
        
        $url = \Drupal\Core\Url::fromUri('https://' . get_hostname() .'/admin/sell-items?title=' . get_sell_order_number_by_nid($taxonomy_term->field_order_id->target_id));
        $response = new TrustedRedirectResponse($url->toString());
        return $response;
    }
}


