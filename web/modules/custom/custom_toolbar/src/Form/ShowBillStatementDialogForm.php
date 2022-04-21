<?php
namespace Drupal\custom_toolbar\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\field\FieldConfigInterface;
use Drupal\Core\Ajax\AjaxResponse;
use Drupal\Core\Ajax\OpenModalDialogCommand;
use Drupal\Core\Ajax\CloseModalDialogCommand;
use Drupal\Core\Ajax\ReplaceCommand;
use Drupal\Core\Ajax;
use Drupal\Core\Ajax\CssCommand;
use Drupal\Core\Url;
use Drupal\Core\Field\BaseFieldDefinition;

/**
 * Class ModalForm.
 *
 * @package Drupal\custom_toolbar\Form
 */
class ShowBillStatementDialogForm extends FormBase {

    /**
     * {@inheritdoc}
     */
    public function getFormId() {
        return 'show_bill_statement_dialog_form';
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(array $form, FormStateInterface $form_state, $customer_nid = NULL, $begin_date = NULL , $end_date = NULL) {
        $form['#title'] = t('客戶別應收帳款明細表');
        $config = \Drupal::config ( 'common_utils.settings' );
        //$tax_percentage = $config->get('sales_tax');
        $bill_nids = \Drupal::entityQuery("node")
                                ->condition('type', 'billing')
                                ->condition('field_expected_receive_payment', [$begin_date, $end_date], "BETWEEN")
                                ->condition("field_customer_entity", $customer_nid)
                                ->execute();
        $total_deposit = 0;
        $total_amount = 0;
        $total_remain_amount = 0;
        $table_items = "";
        $num = 0;
        foreach($bill_nids as $bill_nid) {
            $bill = \Drupal\node\Entity\Node::load($bill_nid);
            $tax_percentage = $bill->field_tax_rate->value;
            if ( empty($bill->field_actual_received_payment->value) ) {
                $num++;
                $sale = \Drupal\node\Entity\Node::load($bill->field_order_id->target_id);
                $type = "";
                if ( $sale->moderation_state->value == "return" ) {
                    $type = "銷退";
                } else {
                    $type = "銷貨";
                }
                $total_deposit = $total_deposit + $bill->field_deposit->value;
                $total_amount = $total_amount + $bill->field_total_amount_with_tax->value;
                $total_remain_amount = $total_remain_amount + ($bill->field_total_amount_with_tax->value - $bill->field_deposit->value - $bill->field_write_off_amount->value);
                $table_items .= '<tr><td>' . $bill->field_expected_receive_payment->value . 
                                '</td><td>' . $type . 
                                '</td><td><a href="/node/' . $sale->id() . '" target="_blank">' . $sale->title->value . '</a>' . 
                                '</td><td>' . $tax_percentage . "%" . 
                                '</td><td>' . number_format($bill->field_total_amount_with_tax->value - $bill->field_deposit->value - $bill->field_write_off_amount->value) . 
                                '</td><td>' . number_format($bill->field_deposit->value + $bill->field_write_off_amount->value) . 
                                '</td></tr>';
            }
        }
        $customer = \Drupal\node\Entity\Node::load($customer_nid);
        $table_top = '<div id="detail-bill-statement-table-top-body"><table>-BODY-</table></div>';
        $table_customer = "<tbody><tr><td>客戶編號: " . $customer->title->value . "</td><td>名稱: " . $customer->field_customer_title->value . "</td></tr>";
        $table_summary  = "<tr><td>己收加預收: " . number_format($total_deposit) ."</td><td>應收總金額: " . number_format($total_remain_amount) ."</td><td>本期總金額: " . number_format($total_amount) . "</td><td>交易總筆數: $num</td></tr></tbody>";
        $table_top = str_replace('-BODY-', $table_customer . $table_summary, $table_top);

        $table_middle = '<div id="detail-bill-statement-table-body"><table>-BODY-</table></div>';
        $table_head = "<thead><tr><td>帳款日期</td><td>單據</td><td>銷售憑據</td><td>營業稅額</td><td>應收總計</td><td>己收預收金額</td></tr></thead>";
        $table_body_begin = '<tbody>';
        $table_body_end = '</tbody>';
        $table_body = $table_head . $table_body_begin . $table_items . $table_body_end;
        $table_middle = str_replace('-BODY-', $table_body, $table_middle);

        $form['detail_bill_statement'] = array('#type' => 'markup', '#markup' => '<div class="detail-bill-statement">' . $table_top . $table_middle . '</div>',);
    

        $form['#attached']['library'][] = 'core/drupal.dialog.ajax';
        $form['#attached']['library'][] = 'custom_toolbar/custom_toolbar';
        return $form;
    }

    /**
     * {@inheritdoc}
     */
    public function validateForm(array &$form, FormStateInterface $form_state){ }

    /**
     * {@inheritdoc}
     */
    public function submitForm(array &$form, FormStateInterface $form_state){ }

    /**
     * Gets the configuration names that will be editable.
     *
     * @return array
     *   An array of configuration object names that are editable if called in
     *   conjunction with the trait's config() method.
     */
    protected function getEditableConfigNames() {
        return ['config.show_bill_statement_dialog_form'];
    }

    /*private function getViewSellItems($product_nid, $customer_nid) {
        $config = \Drupal::config ('common_utils.settings');
        $host = $config->get('hostname');
        $product = \Drupal\node\Entity\Node::load($product_nid);
        if ( $customer_nid != "none" ) {
            $customer = \Drupal\node\Entity\Node::load($customer_nid);
            $url = "https://$host/admin/api/sell_items?pid=" . $product->title->value . "&customer_title=" . $customer->field_customer_title->value;
        } else {
            $url = "https://$host/admin/api/sell_items?pid=" . $product->title->value;
        }
        
        $ch = curl_init();
        $options = array(
            CURLOPT_SSL_VERIFYHOST => 0,
            CURLOPT_SSL_VERIFYPEER => 0,
        );
        curl_setopt_array($ch, $options);
        $header = array(
            "accept: application/json",
            "Authorization: Basic c2VhbmxvOlNsbzA4MjEh"
        );
        
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        //curl_setopt($ch, CURLOPT_USERPWD, "seanlo:Slo0821!");
        //curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        $output = curl_exec($ch);
        curl_close($ch);
        $render_table = $this->generate_the_view_table($output);
        
        return $render_table;
    }

    private function generate_the_view_table($output) {
        $json = json_decode($output);
        
        if ( sizeof($json) > 0 ) {
            
            
            $table_body = '';
            for($i=0; $i < count($json); $i++) {
                $row = $json[$i];
                $table_body .= '<tr><td>' . $row->{"name"} . '</td><td>' . $row->{"title"} . '</td><td>' . $row->{"title_1"} . '</td><td>' . $row->{"field_customer_title"} . '</td><td>' . $row->{"field_requisition_status"} . '</td><td>' . $row->{"field_quantity"} . '</td><td>' . $row->{"field_price"} . '</td><td>' . $row->{"field_discount"} . '</td><td>' . $row->{"field_total_amount"}. '</td></tr>';
            }
            
            $table_body = $table_head . $table_body_begin . $table_body . $table_body_end;
            $table = str_replace('-BODY-', $table_body, $table);
        }
        return $table;
    }*/
}



