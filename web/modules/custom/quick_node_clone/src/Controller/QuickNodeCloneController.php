<?php
namespace Drupal\quick_node_clone\Controller;

use Drupal\Core\Controller\ControllerBase;
use \Drupal\Core\Routing\TrustedRedirectResponse;
use \Drupal\node\Entity\Node;


/**
 * An example controller.
 */
class QuickNodeCloneController extends ControllerBase {
    public function cloneNode(\Drupal\node\Entity\Node $node) {
        if ( !empty($node) ) {
            $clone_node = Node::create(['type' => "sales_order",]);
            $clone_node->set('title', generate_sale_id());
            $clone_node->field_customer_entity->target_id = $node->field_customer_entity->target_id;
            $clone_node->set('field_delivery', $node->field_delivery->value);
            $clone_node->set('field_created_date', date('Y-m-d', time()));
            $clone_node->set('field_comments_for_print', $node->field_comments_for_print->value);
            $clone_node->set('field_long_comment', $node->field_long_comment->value);
            $clone_node->set('field_receiver', $node->field_receiver->value);
            $clone_node->set('field_logistics', $node->field_logistics->value);
            $clone_node->set('field_shipping_address', $node->field_shipping_address->value);
            $clone_node->set('moderation_state', "draft");
            $clone_node->uid = \Drupal\user\Entity\User::load(\Drupal::currentUser()->id());
            $clone_node->save();

            $field_sell_products = $node->get('field_sell_products')->getValue();
            for ($i=0; $i < count($field_sell_products); $i++) {
                $sell_items_tids[] = $field_sell_products[$i]['target_id'];
            }
            foreach($sell_items_tids as $sell_items_tid) {
                $orig_item = \Drupal\taxonomy\Entity\Term::load($sell_items_tid);
                $clone_item = \Drupal\taxonomy\Entity\Term::create(['vid' => 'sell_items']);
                $clone_item->set('status', 0);
                $clone_item->set('field_sell_type', 'sell');
                $clone_item->set('name', gen_sell_item_id($clone_node->title->value));
                $clone_item->field_order_id->target_id = $clone_node->id();
                $clone_item->set('field_product_id', $orig_item->field_product_id->target_id);
                $clone_item->set('field_storage', $orig_item->field_storage->target_id);

                $clone_item->set('field_quantity', $orig_item->field_quantity->value);
                $clone_item->set('field_price', $orig_item->field_price->value);
                $clone_item->set('field_discount', $orig_item->field_discount->value);
                
                $clone_item->set('field_gross_profit_margin', $orig_item->field_gross_profit_margin->value);
                $clone_item->set('field_total_amount', $orig_item->field_total_amount->value);
                $clone_item->save();		 
                $clone_node->field_sell_products[] = $clone_item;
            }
            $clone_node->save();

            $config = \Drupal::config ( 'common_utils.settings' );
            $config->get('sales_tax');
            \Drupal::messenger()->addMessage("複製銷售單成功. 此頁是複製銷售單.");
            $response = new TrustedRedirectResponse("https://" . $config->get("hostname") . "/node/" . $clone_node->id() . "/edit");
            $response->send();
            return $response;
        } else {
            throw new NotFoundHttpException();
        }
    }
}

