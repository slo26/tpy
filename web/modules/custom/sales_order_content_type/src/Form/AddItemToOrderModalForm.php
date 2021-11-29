<?php

namespace Drupal\sales_order_content_type\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Ajax\AjaxResponse;
use Drupal\Core\Ajax\OpenModalDialogCommand;
use Drupal\Core\Ajax\CloseModalDialogCommand;
use Drupal\Core\Ajax\ReplaceCommand;
use Drupal\Core\Ajax;
use Drupal\Core\Ajax\InvokeCommand;

/**
 * Class ModalForm.
 *
 * @package Drupal\sales_order_content_type\Form
 */
class AddItemToOrderModalForm extends FormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'add_item_to_order_modal_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state, $so_id = null) {
    $form['status_messages'] = [
      '#type' => 'status_messages',
      '#weight' => -10,
    ];

    $connection = \Drupal::database();
    $form['order_id'] = array(
        '#title' => $this->t('銷售編號 '),
        '#type' => 'textfield',
        '#size' => 60,
        '#weight' => 1,
        '#disabled' => true,
        '#default_value' => $so_id,
    );

    $nids = \Drupal::entityQuery("node")
                            ->condition('type', 'product')
                            ->condition('status', 1)
                            ->execute();
    $list_product = array();
    foreach($nids as $nid) {
        $product_id = $connection->query("SELECT title FROM {node_field_data} Where
                                                                    nid = :nid", [':nid' => $nid])->fetchAll();
        $product_name = $connection->query("SELECT field_product_name_value FROM {node__field_product_name} Where
                                                                    entity_id = :nid", [':nid' => $nid])->fetchAll();
        $list_product[trim($product_id[0]->title)] = trim($product_name[0]->field_product_name_value);
    }

    $form['list_product'] = array(
        '#type' => 'select',
        '#title' => $this->t('產品'),
        '#options' => ['' => '- Select -'] + $list_product,
        '#ajax' => [
            'callback' => [$this, 'productSelectedCallback'],
            'disable-refocus' => FALSE,
            'event' => 'change',
        ],
        '#weight' => 2,
    );
    /*$form['list_product'] = [
        '#type' => 'entity_autocomplete',
        '#target_type' => 'node',
        '#title' => $this->t('產品'),
        '#selection_settings' => array(
            'target_bundles' => array('product'),
        ),
        '#attributes' => [
            'class' => [
              'use-ajax select-products',
            ],
        ],
        '#ajax' => [
            'callback' => [$this, 'productSelectedCallback'],
            'event' => 'autocompleteclose change',
        ],
        '#weight' => '2',
    ];*/

    $form['color'] = array(
        '#title' => $this->t('產品顏色 '),
        '#type' => 'textfield',
        '#size' => 60,
        '#weight' => 3,
    );

    /*
    $form['send'] = array(
      '#type' => 'submit',
      '#value' => $this->t('Submit modal form'),
      '#attributes' => [
        'class' => [
          'use-ajax',
        ],
      ],
      '#ajax' => [
        'callback' => [$this, 'submitModalFormAjax'],
        'event' => 'click',
      ],
    );*/

    $form['#attached']['library'][] = 'core/drupal.dialog.ajax';

    return $form;
  }
  
  /*public function submitModalFormAjax(array $form, FormStateInterface $form_state) {
    $response = new AjaxResponse();
    // If there are any form errors, re-display the form.
    $response->addCommand(new OpenModalDialogCommand("Success!", 'The modal form has been submitted.', ['width' => 800]));
    return $response;
  }*/

  /**
   * AJAX callback handler that displays any errors or a success message.
   */
  public function productSelectedCallback(array $form, FormStateInterface $form_state) {
    \Drupal::messenger()->addMessage("abc");
    $ajax_response = new AjaxResponse();

    $product_key = $form_state->getValue('list_product');
    $product_label = $form['list_product']['#options'][$product_key];
    $ajax_response->addCommand(new InvokeCommand('#edit-color', 'val', ["$product_key-$product_label"]));
    return $ajax_response;
  }

  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state){ 
    parent::validateForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) { }

  /**
   * Gets the configuration names that will be editable.
   *
   * @return array
   *   An array of configuration object names that are editable if called in
   *   conjunction with the trait's config() method.
   */
  protected function getEditableConfigNames() {
    return ['config.add_item_to_order_modal_form'];
  }

}

