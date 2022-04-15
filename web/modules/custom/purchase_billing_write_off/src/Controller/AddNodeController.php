<?php

namespace Drupal\purchase_billing_write_off\Controller;

class AddNodeController {
    public function addNodeForm($begin_date, $end_date, $vendor_nid) {
        $values = array('type' => "purchase_billing_write_off");
        $node = \Drupal::entityTypeManager()->getStorage('node')->create($values);
        $node->field_begin_date->value = $begin_date;
        $node->field_end_date->value = $end_date;
        $node->field_vendor_entity->target_id = $vendor_nid;
        $form = \Drupal::entityTypeManager()->getFormObject('node', 'default')->setEntity($node);

        return \Drupal::formBuilder()->getForm($form);
    }
}


