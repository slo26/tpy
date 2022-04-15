<?php
/**
 * @file
 * Contains \Drupal\custom_toolbar\Form\purchase\GenerateMonthlySaleBillingStatement.
 */
namespace Drupal\custom_toolbar\Form\purchase;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Ajax\AjaxResponse;
use Drupal\Core\Ajax\HtmlCommand;
use Drupal\Core\Ajax;

/**
 * Configure custom_toolbar agent form settings.
 */
class GenerateMonthlyPurchaseBillingStatement extends ConfigFormBase {
    /**
     * {@inheritdoc}
     */
    public function getFormId() {
        return 'generate_monthly_purchase_billing_statement';
    }

    /**
     * {@inheritdoc}
     */
    protected function getEditableConfigNames() {
        return [
            'custom_toolbar.purchase_billing_statement',
        ];
    }

     /**
     * {@inheritdoc}
     */
    public function buildForm(array $form, FormStateInterface $form_state) {
        $config = $this->config('custom_toolbar.purchase_billing_statement');

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

        $form['vendor-bill-statement'] = [
			'#type' => 'entity_autocomplete',
			'#target_type' => 'node',
			'#title' => t('廠商編號'),
			'#selection_settings' => array(
				'target_bundles' => array('vendor'),
			),
			'#size' => 23,
			'#prefix' => '<div class="bill-statement-vendor-number">',
			'#suffix' => '</div>',
		];

        $form['generate'] = array(
            '#type' => 'submit',
            '#value' => $this->t('產生應付月結列表'),
            '#ajax' => [
                'callback' => [$this, 'genreateMonthlyPurchaseBillStatementCallback'],
                'disable-refocus' => FALSE,
                'wrapper' => 'edit-output',
                'progress' => [
                    'type' => 'throbber',
                    'message' => $this->t('產生 ...'),
                ],
                'event' => 'click',
            ]   
        );

        $form['exclude'] = [
            '#type'          => 'checkbox',
            '#title'         => t('排除金額己全收取帳單'),
            '#default_value' => false,
        ];

        $form['monthly_bill_statement'] = array('#type' => 'markup', '#markup' => '<div class="monthly-purchase-bill-statement"></div>',);

        return $form;
    }

    public function genreateMonthlyPurchaseBillStatementCallback(array &$form, FormStateInterface $form_state) {
        $begin_date = $form_state->getValue('begin_date');
        $end_date = $form_state->getValue('end_date');
        $vendor_nid = $form_state->getValue('vendor-bill-statement');
        $exclude = $form_state->getValue('exclude');
        $bill_nids = array();
        $query = \Drupal::entityQuery("node");
        $query->condition('type', 'bill_4_purchase');
        $query->condition('field_expected_receive_payment', [$begin_date, $end_date], "BETWEEN");
        if ( !empty($vendor_nid) ) {
            $query->condition("field_vendor_entity", $vendor_nid);
        }
        if ( $exclude == true ) {
            $query->condition("field_remain_unpaid_amount", 0);
        }
        $bill_nids = $query->execute();
        $vendor_entities = array();
        if ( !empty($bill_nids) ) {
            foreach($bill_nids as $bill_nid) {
                $bill = \Drupal\node\Entity\Node::load($bill_nid);
                $vendor_nid = $bill->field_vendor_entity->target_id; 
                if ( !in_array($vendor_nid, $vendor_entities) ) {
                    $vendor_entities[] = $vendor_nid;
                }
            }
            $table_start = '<table id="purchase-bill-statement"><tbody>';
            $table_body = '<tr><th width="140px">廠商編號</th><th width="300px">廠商名稱</th><th width="60px">採購數量</th><th width="200px">採購單</th><th width="200px">帳單</th><th width="150px">應付總計</th><th>Operation</th></tr>';
            $table_end = "</tbody></table>"; 

            for($i = 0; $i < count($vendor_entities); $i++) {
                $table_body = self::process_table_body($table_body, $begin_date, $end_date, $vendor_entities[$i]);
            }
            $table = $table_start . $table_body . $table_end;
        }
        $ajax_response = new AjaxResponse();
        $ajax_response->addCommand(new HtmlCommand('.monthly-purchase-bill-statement', $table));
        return $ajax_response;
    }

    public function process_table_body($table_body, $begin_date, $end_date, $vendor_nid) {
        $bill_nids = \Drupal::entityQuery("node")
                    					->condition('type', 'bill_4_purchase')
                                        ->condition('field_vendor_entity', $vendor_nid)
                                        ->condition('field_expected_receive_payment', [$begin_date, $end_date], "BETWEEN")
                    					->execute();
        $bill_entity = array();
        $purchase_entity = array();
        $amount_should_collect = 0;
        foreach($bill_nids as $bill_nid) {
            $bill = \Drupal\node\Entity\Node::load($bill_nid);
            if ( empty($bill->field_actual_received_payment->value) ) {
                $amount_should_collect = $amount_should_collect + ($bill->field_total_amount_with_tax->value - $bill->field_deposit->value - $bill->field_write_off_amount->value);
                $purchase = \Drupal\node\Entity\Node::load($bill->field_order_id->target_id);
                $bill_entity[] = $bill->title->value;
                $purchase_entity[] = $purchase->title->value;                    
            }
        }
        if ( count($purchase_entity) != 0 ) {
            $vendor = \Drupal\node\Entity\Node::load($vendor_nid);
            $purchase_in_string = implode(",", $purchase_entity);
            $bill_in_string = implode(",", $bill_entity);
            
            $url = "/admin/view/$vendor_nid/show-purchase-bill-statement/$begin_date/$end_date";
            $preview_link = '<a class="use-ajax" data-dialog-options="{&quot;width&quot;:1000}" data-dialog-type="dialog" href=' . $url . '>預覽</a>';
            $url = "/admin/bill/monthly-detail-purchase-bill-statementForm/$vendor_nid/$begin_date/$end_date";
            $print_link = '<a href=' . $url . ' target="_blank">應付帳款明細表</a>';
            $url = "/node/add/purchase-billing-write-off/$begin_date/$end_date/$vendor_nid";
            $strike_a_balance_link = '<a href=' . $url . ' target="_blank">應付沖帳款</a>';
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
                        <li class="edit dropbutton-action">' 
                            . $strike_a_balance_link . 
                        '</li>
                    </ul>
                </div>
            </div>';

            $table_body .= '<tr><td>' . $vendor->title->value . 
                                '</td><td>' . $vendor->field_vendor_name->value . 
                                '</td><td align="right">' . count($purchase_entity) . 
                                '</td><td  align="right">' . $purchase_in_string . 
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


