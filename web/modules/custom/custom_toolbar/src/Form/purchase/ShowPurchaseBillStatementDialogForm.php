<?php
namespace Drupal\custom_toolbar\Form\purchase;

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
 * @package Drupal\custom_toolbar\Form\purchase
 */
class ShowPurchaseBillStatementDialogForm extends FormBase {

    /**
     * {@inheritdoc}
     */
    public function getFormId() {
        return 'show_purchase_bill_statement_dialog_form';
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(array $form, FormStateInterface $form_state, $vendor_nid = NULL, $begin_date = NULL , $end_date = NULL) {
        $form['#title'] = t('廠商應付帳款明細表');
        $bill_nids = \Drupal::entityQuery("node")
                                ->condition('type', 'bill_4_purchase')
                                ->condition('field_expected_receive_payment', [$begin_date, $end_date], "BETWEEN")
                                ->condition("field_vendor_entity", $vendor_nid)
                                ->execute();
        $total_deposit = 0;
        $total_amount = 0;
        $total_remain_amount = 0;
        $table_items = "";
        $num = 0;
        foreach($bill_nids as $bill_nid) {
            $bill = \Drupal\node\Entity\Node::load($bill_nid);
            if ( empty($bill->field_actual_received_payment->value) ) {
                $num++;
                $purchase = \Drupal\node\Entity\Node::load($bill->field_order_id->target_id);
                $total_deposit = $total_deposit + $bill->field_deposit->value;
                $total_amount = $total_amount + $bill->field_total_amount_with_tax->value;
                $total_remain_amount = $total_remain_amount + ($bill->field_total_amount_with_tax->value - $bill->field_deposit->value - $bill->field_write_off_amount->value);
                $table_items .= '<tr><td>' . $bill->field_expected_receive_payment->value . 
                                '</td><td><a href="/node/' . $purchase->id() . '/edit" target="_blank">' . $purchase->title->value . '</a>' . 
                                '</td><td>' . number_format($bill->field_total_amount_with_tax->value - $bill->field_deposit->value - $bill->field_write_off_amount->value) . 
                                '</td><td>' . number_format($bill->field_deposit->value + $bill->field_write_off_amount->value) . 
                                '</td></tr>';
            }
        }
        $vendor = \Drupal\node\Entity\Node::load($vendor_nid);
        $table_top = '<div id="detail-bill-statement-table-top-body"><table>-BODY-</table></div>';
        $table_vendor = "<tbody><tr><td>廠商編號: " . $vendor->title->value . "</td><td>名稱: " . $vendor->field_vendor_name->value . "</td></tr>";
        $table_summary  = "<tr><td>己收加預收: " . number_format($total_deposit) ."</td><td>應付總金額: " . number_format($total_remain_amount) ."</td><td>本期總金額: " . number_format($total_amount) . "</td><td>交易總筆數: $num</td></tr></tbody>";
        $table_top = str_replace('-BODY-', $table_vendor . $table_summary, $table_top);

        $table_middle = '<div id="detail-bill-statement-table-body"><table>-BODY-</table></div>';
        $table_head = "<thead><tr><td>帳款日期</td><td>採購憑據</td><td>應收總計</td><td>己付預付金額</td></tr></thead>";
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
        return ['config.show_purchase_bill_statement_dialog_form'];
    }
}




