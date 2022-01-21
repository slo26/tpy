<?php
/**
 * @file
 * Contains \Drupal\custom_toolbar\Form\GenerateMonthlySaleBillingStatement.
 */
namespace Drupal\custom_toolbar\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Ajax\AjaxResponse;
use Drupal\Core\Ajax\HtmlCommand;
use Drupal\Core\Ajax;

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

        //$form['#prefix'] = '<p>產生月份應收對帳單.<br/>';

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

        $form['customer-bill-statement'] = [
			'#type' => 'entity_autocomplete',
			'#target_type' => 'node',
			'#title' => t('客戶編號'),
			'#selection_settings' => array(
				'target_bundles' => array('customer'),
			),
			'#size' => 23,
			'#prefix' => '<div class="bill-statement-customer-number">',
			'#suffix' => '</div>',
		];

        $form['generate'] = array(
            '#type' => 'submit',
            '#value' => $this->t('產生應收月結列表'),
            '#ajax' => [
                'callback' => [$this, 'genreateMonthlyBillStatementCallback'],
                'disable-refocus' => FALSE,
                'wrapper' => 'edit-output',
                'progress' => [
                    'type' => 'throbber',
                    'message' => $this->t('產生 ...'),
                ],
                'event' => 'click',
            ]   
        );

        $form['monthly_bill_statement'] = array('#type' => 'markup', '#markup' => '<div class="monthly-bill-statement"></div>',);

        /*$form['actions']['submit'] = [
            '#type' => 'submit',
            '#value' => $this->t('產生月結單'),
        ];*/
        
        //return parent::buildForm($form, $form_state);
        return $form;
    }

    public function genreateMonthlyBillStatementCallback(array &$form, FormStateInterface $form_state) {
        $begin_date = $form_state->getValue('begin_date');
        $end_date = $form_state->getValue('end_date');
        $customer_nid = $form_state->getValue('customer-bill-statement');
        $bill_nids = array();
        if ( !empty($customer_nid) ) {
            $bill_nids = \Drupal::entityQuery("node")
                                    ->condition('type', 'billing')
                                    ->condition('field_expected_receive_payment', [$begin_date, $end_date], "BETWEEN")
                                    ->condition("field_customer_entity", $customer_nid)
                                    ->execute();
        } else {
            $bill_nids = \Drupal::entityQuery("node")
                                    ->condition('type', 'billing')
                                    ->condition('field_expected_receive_payment', [$begin_date, $end_date], "BETWEEN")
                                    ->execute();
        }
        $customer_entities = array();
        if ( !empty($bill_nids) ) {
            foreach($bill_nids as $bill_nid) {
                $bill = \Drupal\node\Entity\Node::load($bill_nid);
                $customer_nid = $bill->field_customer_entity->target_id; 
                if ( !in_array($customer_nid, $customer_entities) ) {
                    $customer_entities[] = $customer_nid;
                }
            }
            $table_start = '<table id="sale-bill-statement"><tbody>';
            $table_body = '<tr><th width="140px">客戶編號</th><th width="300px">客戶名稱</th><th width="60px">銷售數量</th><th width="200px">銷售單</th><th width="200px">帳單</th><th width="150px">應收總計</th><th>Operation</th></tr>';
            $table_end = "</tbody></table>"; 

            for($i = 0; $i < count($customer_entities); $i++) {
                $table_body = self::process_table_body($table_body, $begin_date, $end_date, $customer_entities[$i]);
            }
            $table = $table_start . $table_body . $table_end;
        }
        $ajax_response = new AjaxResponse();
        $ajax_response->addCommand(new HtmlCommand('.monthly-bill-statement', $table));

        return $ajax_response;
    }

    public function process_table_body($table_body, $begin_date, $end_date, $customer_nid) {
        $bill_nids = \Drupal::entityQuery("node")
                    					->condition('type', 'billing')
                                        ->condition('field_customer_entity', $customer_nid)
                                        ->condition('field_expected_receive_payment', [$begin_date, $end_date], "BETWEEN")
                    					->execute();
        $bill_entity = array();
        $sale_entity = array();
        $amount_should_collect = 0;
        foreach($bill_nids as $bill_nid) {
            $bill = \Drupal\node\Entity\Node::load($bill_nid);
            if ( empty($bill->field_actual_received_payment->value) ) {
                $amount_should_collect = $amount_should_collect + ($bill->field_total_amount_with_tax->value - $bill->field_deposit->value - $bill->field_write_off_amount->value);
                $sale = \Drupal\node\Entity\Node::load($bill->field_order_id->target_id);
                $bill_entity[] = $bill->title->value;
                $sale_entity[] = $sale->title->value;                    
            }
        }
        if ( count($sale_entity) != 0 ) {
            $customer = \Drupal\node\Entity\Node::load($customer_nid);
            $sale_in_string = implode(",", $sale_entity);
            $bill_in_string = implode(",", $bill_entity);
            
            $url = "/admin/view/$customer_nid/show-bill-statement/$begin_date/$end_date";
            $preview_link = '<a class="use-ajax" data-dialog-options="{&quot;width&quot;:1000}" data-dialog-type="dialog" href=' . $url . '>預覽</a>';
            $url = "/admin/bill/monthly-detail-bill-statementForm/$customer_nid/$begin_date/$end_date";
            $print_link = '<a href=' . $url . ' target="_blank">應收帳款明細表</a>';
            $dropdown_button = '<div class="dropbutton-wrapper dropbutton-multiple">
                <div class="dropbutton-widget">
                    <ul class="dropbutton">
                        <li class="edit dropbutton-action">'
                            . $preview_link . 
                        '</li>
                        <li class="dropbutton-toggle">
                            <button type="button">
                                <span class="dropbutton-arrow">
                                    <span class="visually-hidden">List additional actions</span>
                                </span>
                            </button>
                        </li>
                        <li class="edit dropbutton-action">' 
                            . $print_link . 
                        '</li>
                    </ul>
                </div>
            </div>';

            $table_body .= '<tr><td>' . $customer->title->value . 
                                '</td><td>' . $customer->field_customer_title->value . 
                                '</td><td align="right">' . count($sale_entity) . 
                                '</td><td  align="right">' . $sale_in_string . 
                                '</td><td  align="right">' . $bill_in_string . 
                                '</td><td  align="right">' . $amount_should_collect . 
                                '</td><td align="right">' . $dropdown_button . '</td></tr>';
        }
        return $table_body;
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
    public function submitForm(array &$form, FormStateInterface $form_state) {}
}

