<?php
/**
 * @file
 * Contains \Drupal\custom_toolbar\Form\GenerateMonthlySaleBillingStatement.
 */
namespace Drupal\custom_toolbar\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Datetime\DrupalDateTime;

/**
 * Configure custom_toolbar agent form settings.
 */
class GenerateMonthlySaleBillingStatement extends ConfigFormBase {
    /**
     * {@inheritdoc}
     */
    public function getFormId() {
        return 'generate_monthly_sale_billing_statement';
    }

    /**
     * {@inheritdoc}
     */
    protected function getEditableConfigNames() {
        return [
            'custom_toolbar.sale_billing_statement',
        ];
    }

     /**
     * {@inheritdoc}
     */
    public function buildForm(array $form, FormStateInterface $form_state) {
        $config = $this->config('custom_toolbar.sale_billing_statement');

        $form['#prefix'] = '<p>產生月份應收對帳單.<br/>';

        $form['begin_date'] = array(
            '#type' => 'date', 
            '#title' => "月結起始日",
            '#required' => true,
        );

        $form['end_date'] = array(
            '#type' => 'date', 
            '#title' => "月結結束日", 
            '#required' => true,
        );

        $form['actions']['submit'] = [
            '#type' => 'submit',
            '#value' => $this->t('產生月結單'),
        ];
        
        //return parent::buildForm($form, $form_state);
        return $form;
    }

    /**
     * {@inheritdoc}
     */
    public function validateForm(array &$form, FormStateInterface $form_state) {
        parent::validateForm($form, $form_state);
    }

    /**
     * {@inheritdoc}
     */
    public function submitForm(array &$form, FormStateInterface $form_state) {
        try {
            $begin_date = $form_state->getValue('begin_date');
            $end_date = $form_state->getValue('end_date');
            $customer_entities = array();

            $bill_nids = \Drupal::entityQuery("node")
                    					->condition('type', 'billing')
                                        ->condition('field_expected_receive_payment', [$begin_date, $end_date], "BETWEEN")
                    					->execute();
            if ( !empty($bill_nids) ) {
                $operations = [];
                foreach($bill_nids as $bill_nid) {
                    $bill = \Drupal\node\Entity\Node::load($bill_nid);
                    $customer_nid = $bill->field_customer_entity->target_id; 
                    if ( !in_array($customer_nid, $customer_entities) ) {
                        $customer_entities[] = $customer_nid;
                    }
                }

                for($i = 0; $i < count($customer_entities); $i++) {
                    $operations[] = ['Drupal\custom_toolbar\Form\GenerateMonthlySaleBillingStatement::batchGet', [$begin_date, $end_date, $customer_entities[$i]]];
                }
                
                $batch = array(
                    'title' => t('產生 ...'),
                    'operations' => $operations,
                    'finished' => 'Drupal\custom_toolbar\Form\GenerateMonthlySaleBillingStatement::batchFinished', 
                );
                batch_set($batch);
            } else {
                \Drupal::messenger()->addMessage ("你所選擇的期間並沒有帳單."); 
            }
        } catch (Exception $ex) {
            \Drupal::messenger()->addMessage ($ex->getMessage(), "error");
        }

        //parent::submitForm($form, $form_state);
    }

    // Implement the operation method.
    public static function batchGet($begin_date, $end_date, $customer_nid, &$context) {
        try {
            $bill_nids = \Drupal::entityQuery("node")
                    					->condition('type', 'billing')
                                        ->condition('field_customer_entity', $customer_nid)
                                        ->condition('field_expected_receive_payment', [$begin_date, $end_date], "BETWEEN")
                    					->execute();
            $item = \Drupal\taxonomy\Entity\Term::create(['vid' => 'sale_bill_statement']);
            $name = date("Y-m") . "-$customer_nid";
            while (true) {
                $index = 1;
                $tids = \Drupal::entityQuery("taxonomy_term")->condition("vid", "sale_bill_statement")
                                                        ->condition('name', $name)
                                                        ->execute();
                if ( count($tids) == 0 ) {
                    break;
                }
                $name = $name . "-$index";
            }

            $item->set('name', $name);
            $item->field_bill_statement_year_month->value = date("Y-m");
            $context['results']['year_month'] = date("Y-m");
            $item->field_customer_entity->target_id = $customer_nid;
            $item->field_begin_date->value = $begin_date;
            $item->field_end_date->value = $end_date;
            $item->field_total_amount_before_tax->value = 0;
            $item->field_total_amount_after_tax->value = 0;
            $deposite = 0;
            foreach($bill_nids as $bill_nid) {
                $bill = \Drupal\node\Entity\Node::load($bill_nid);
                if ( empty($bill->field_actual_received_payment->value) ) {
                    $item->field_sell_entity[] = $bill->field_order_id->target_id;
                    $item->field_total_amount_before_tax->value = $item->field_total_amount_before_tax->value + $bill->field_total_amount_without_tax->value;
                    $item->field_total_amount_after_tax->value = $item->field_total_amount_after_tax->value + $bill->field_total_amount_with_tax->value;
                    $deposite = $deposite + $bill->field_deposit->value;
                    $sell = \Drupal\node\Entity\Node::load($bill->field_order_id->target_id);
                    $sell_items = $sell->get('field_sell_products')->getValue();
                    for($i=0; $i < count($sell_items); $i++) {
                        $item->field_sell_item_entity[] = $sell_items[$i]['target_id'];
                    }
                }
            }
            $item->set('field_remain_amount', $item->field_total_amount_after_tax->value - $deposite);
            if ( $item->field_total_amount_before_tax->value != 0 ) {
                $item->save();
            }
            // Display data while running batch.
            $context['message'] = "產生客戶 $customer_nid 應收月結單.....";
        } catch (Exception $ex) {
            \Drupal::messenger()->addMessage ($ex->getMessage(), "error");
        }
    } 

    // What to do after batch ran. Display success or error message.
    public static function batchFinished($success, $results, $operations) {
        if ($success) {
            $year_month = $results['year_month'];
            $message = "$year_month 應收月結已產生完成.";
        } else {
            $message = "錯誤.";
        }
        \Drupal::messenger()->addMessage($message);
    }
}

