<?php
/**
 * @file
 * Contains \Drupal\custom_toolbar\Form\MonthlyDetailBillStatementForm.
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
class MonthlyDetailBillStatementForm extends ConfigFormBase {
    /**
     * {@inheritdoc}
     */
    public function getFormId() {
        return 'monthly_detail_bill_statement_form';
    }

    /**
     * {@inheritdoc}
     */
    protected function getEditableConfigNames() {
        return [
            'custom_toolbar.show_detail_monthly_bill_statement',
        ];
    }

     /**
     * {@inheritdoc}
     */
    public function buildForm(array $form, FormStateInterface $form_state, $customer_nid = null, $begin_date = null , $end_date = null) {
        $customer = \Drupal\node\Entity\Node::load($customer_nid);
        $table_template = '<div id="monthly-detail-bill-statement-table-top-body">-BODY-</div>';

        $section_one = '<table id="monthly-detail-bill-s1"><tbody><tr id="monthly-detail-bill-s1-tpy"><td><strong>' . \Drupal::config('common_utils.settings')->get('company') . "</strong></td></tr>";
        $section_one .= '<tr id="monthly-detail-bill-s1-addr"><td>' . \Drupal::config('common_utils.settings')->get('company_address') .'</td></tr>';
        $section_one .= '<tr id="monthly-detail-bill-s1-phone"><td>Tel: ' . \Drupal::config('common_utils.settings')->get('company_phone') . '  Fax: ' . \Drupal::config('common_utils.settings')->get('company_fax') . '</td></tr>';
        $section_one .= '<tr id="monthly-detail-bill-s1-title"><td><strong><u>應收帳款明細表</u></strong></td></tr></tbody></table>';

        $section_two = '<table id="monthly-detail-bill-s2"><tbody><tr><td align="left">日期起迄區間: ' . $begin_date . " ~ " . $end_date . '</td><td width="250px">頁次: 1</td></tr>';
        $section_two .= '<tr id="monthly-detail-bill-s2-cust"><td>客戶名稱: <a href="/node/' . $customer_nid .'/edit" target="_blank">' . $customer->field_customer_title->value . '</a></td><td>製表日期: ' . date("Y/m/d") . '</td></tr>';
        $section_two .= '<tr id="monthly-detail-bill-s2-addr"><td>地址: ' . $customer->field_address->value . '</a></td><td>聯絡人: ' . $customer->field_contact_person->value . '</td></tr>';
        $section_two .= '<tr id="monthly-detail-bill-s2-phone"><td>電話: ' . $customer->field_phone->value . '   傳真: ' . $customer->field_fax->value  . '</td><td>統一編號: ' . $customer->field_uniform_number->value . '</td></tr></tbody></table>';

        $section_three = '<table id="monthly-detail-bill-s3"><tbody><tr><th width="100">帳款日期</th><th width="150">銷售單憑證</th><th width="150">產品編號</th><th width="360">品名規格</th><th width="50">數量</th><th width="30">單位</th><th width="110">稅前售價</th><th width="110">稅前金額</th><th width="50">種類</th></tr>';
        $bill_nids = \Drupal::entityQuery("node")
                                ->condition('type', 'billing')
                                ->condition('field_expected_receive_payment', [$begin_date, $end_date], "BETWEEN")
                                ->condition("field_customer_entity", $customer_nid)
                                ->execute();
        $total_amount = 0;
        $total_amount_had_collected = 0;
        $total_amount_need_collect = 0;
        $total_tax_amount = 0;
        foreach($bill_nids as $bill_nid) {
            $bill = \Drupal\node\Entity\Node::load($bill_nid);
            $negative = 1;
            if ( $bill->field_bill_type->value == "return" ) {
                $negative = -1;
            }
            $sale = \Drupal\node\Entity\Node::load($bill->field_order_id->target_id);
            if ( $sale->moderation_state->value != "done" && $sale->moderation_state->value != "return_completed" ) {
                $tmp = $sale->get('field_sell_products')->getValue();
                $sell_items = [];
                for ($i=0; $i < count($tmp); $i++) {			
                    $sell_items[] = $tmp[$i]['target_id'];
                }
                for ($i=0; $i < count($sell_items); $i++) {
                    $term = \Drupal\taxonomy\Entity\Term::load($sell_items[$i]);
                    $product = \Drupal\node\Entity\Node::load($term->field_product_id->target_id);
                    $inventory_nids = \Drupal::entityQuery("node")
                                    ->condition('type', 'stock_up')
                                    ->condition('field_product_goods', $sell_items[$i])
                                    ->execute();
                    $inventory = \Drupal\node\Entity\Node::load($inventory_nids[0]);
                    if ( $i == 0 ) {
                        $section_three .= '<tr id="monthly-detail-bill-s3-begin"><td>' . $bill->field_expected_receive_payment->value . '</td><td><a href="/node/' . $sale->id() .'/edit" target="_blank">' . $sale->title->value . '</a></td><td>' . $product->title->value . '</td><td>' . $product->field_specification->value . '</td><td>' . $term->field_quantity->value * $negative .'</td><td>' . $inventory->field_unit->value . '</td><td>' . $term->field_price->value . '</td><td>' . $term->field_total_amount->value * $negative . '</td><td><a href="/node/' . $bill->id() . '/edit" target="_blank">' . get_entity_storage_label($bill, 'field_bill_type', $bill->field_bill_type->value) . '</a></td></tr>';
                    } else {
                        $section_three .= '<tr id="monthly-detail-bill-s3-mid"><td></td><td></td><td>' . $product->title->value . '</td><td>' . $product->field_specification->value . '</td><td>' . $term->field_quantity->value * $negative .'</td><td>' . $inventory->field_unit->value . '</td><td>' . $term->field_price->value . '</td><td>' . $term->field_total_amount->value * $negative . '</td><td></td><td></td></tr>';
                    }
                }
                $total_tax_amount = $total_tax_amount + $bill->field_tax->value;
                $total_amount = $total_amount + $bill->field_total_amount_with_tax->value;
                $total_amount_had_collected = $total_amount_had_collected + ($bill->field_deposit->value + $bill->field_write_off_amount->value);
            }
        }
        $total_amount_need_collect = $total_amount - $total_amount_had_collected;
        $section_three .= '<tr id="monthly-detail-bill-s3-end"><td colspan="9">以下空白</td></tr></tbody></table>';

        $section_four = '<table id="monthly-detail-bill-s4"><tbody><tr><td>金額總計: ' . number_format($total_amount_need_collect) .'</td><td>營業稅額: $' . number_format($total_tax_amount) .'</td><td width="250">已收金額: ' . number_format($total_amount_had_collected) .'</td></tr>';
        $section_four .= '<tr><td >本期應收帳款: ' . number_format($total_amount_need_collect) .'</td><td></td><td>應收帳款總額: ' . number_format($total_amount) . '</td></tr></table></tbody>';
        
        $table = $section_one . $section_two . $section_three . $section_four;

        $form['monthly_bill_statement'] = array('#type' => 'markup', '#markup' => "<div>$table</div>",);

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
            $url = "/admin/view/$customer_nid/show-bill-statement/$begin_date/$end_date";
            $print_link = '<a class="use-ajax" data-dialog-options="{&quot;width&quot;:1000}" data-dialog-type="dialog" href=' . $url . '>列印明細表</a>';
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

