<?php
/**
 * @file
 * Contains \Drupal\custom_toolbar\Form\purchase\MonthlyDetailPurchaseBillStatementForm.
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
class MonthlyDetailPurchaseBillStatementForm extends ConfigFormBase {
    /**
     * {@inheritdoc}
     */
    public function getFormId() {
        return 'monthly_detail_purchase_bill_statement_form';
    }

    /**
     * {@inheritdoc}
     */
    protected function getEditableConfigNames() {
        return [
            'custom_toolbar.monthly_detail_purchase_bill_statement_form',
        ];
    }

     /**
     * {@inheritdoc}
     */
    public function buildForm(array $form, FormStateInterface $form_state, $vendor_nid = NULL, $begin_date = NULL , $end_date = NULL) {
        $vendor = \Drupal\node\Entity\Node::load($vendor_nid);
        $table_template = '<div id="monthly-detail-purchase-bill-statement-table-top-body">-BODY-</div>';

        $section_one = '<table id="monthly-detail-purchase-bill-s1"><tbody><tr id="monthly-detail-purchase-bill-s1-tpy"><td><strong>' . \Drupal::config('common_utils.settings')->get('company') . "</strong></td></tr>";
        $section_one .= '<tr id="monthly-detail-purchase-bill-s1-addr"><td>' . \Drupal::config('common_utils.settings')->get('company_address') .'</td></tr>';
        $section_one .= '<tr id="monthly-detail-purchase-bill-s1-phone"><td>Tel: ' . \Drupal::config('common_utils.settings')->get('company_phone') . '  Fax: ' . \Drupal::config('common_utils.settings')->get('company_fax') . '</td></tr>';
        $section_one .= '<tr id="monthly-detail-purchase-bill-s1-title"><td><strong><u>應付帳款明細表</u></strong></td></tr></tbody></table>';

        $section_two = '<table id="monthly-detail-purchase-bill-s2"><tbody><tr><td align="left">日期起迄區間: ' . centuryToRepublicEra($begin_date, "-", "-") . " ~ " . centuryToRepublicEra($end_date, "-", "-") . '</td><td width="250px">頁次: 1</td></tr>';
        $section_two .= '<tr id="monthly-detail-purchase-bill-s2-cust"><td>廠商名稱: <a href="/node/' . $vendor_nid .'/edit" target="_blank">' . $vendor->field_vendor_name->value . '</a></td><td>製表日期: ' . centuryToRepublicEra(date("Y/m/d"), "/", "-") . '</td></tr>';
        $section_two .= '<tr id="monthly-detail-purchase-bill-s2-addr"><td>地址: ' . $vendor->field_factory_address->value . '</a></td><td>聯絡人: ' . $vendor->field_contact_person->value . '</td></tr>';
        $section_two .= '<tr id="monthly-detail-purchase-bill-s2-phone"><td>電話: ' . $vendor->field_phone->value . '   傳真: ' . $vendor->field_fax->value  . '</td><td>統一編號: ' . $vendor->field_uniform_number->value . '</td></tr></tbody></table>';

        $section_three = '<table id="monthly-detail-purchase-bill-s3"><tbody><tr><th width="90">帳款日期</th><th width="160">採購單憑證</th><th width="150">物品編號</th><th width="400">物品名稱</th><th width="50">數量</th><th width="30">單位</th><th width="100">稅後單價</th><th width="110">稅後售價</th><th width="50">種類</th></tr>';
        $bill_nids = \Drupal::entityQuery("node")
                                ->condition('type', 'bill_4_purchase')
                                ->condition('field_expected_receive_payment', [$begin_date, $end_date], "BETWEEN")
                                ->condition("field_vendor_entity", $vendor_nid)
                                ->execute();
        $total_amount = 0;
        $total_amount_had_collected = 0;
        $total_amount_need_collect = 0;
        $total_tax_amount = 0;
        foreach($bill_nids as $bill_nid) {
            $bill = \Drupal\node\Entity\Node::load($bill_nid);
            $purchase = \Drupal\node\Entity\Node::load($bill->field_order_id->target_id);
            if ( $purchase->moderation_state->value != "purchase_done" ) {
                $tmp = $purchase->get('field_material')->getValue();
                $purchase_items = [];
                for ($i=0; $i < count($tmp); $i++) {			
                    $purchase_items[] = $tmp[$i]['target_id'];
                }
                for ($i=0; $i < count($purchase_items); $i++) {
                    $term = \Drupal\taxonomy\Entity\Term::load($purchase_items[$i]);
                    $product = \Drupal\node\Entity\Node::load($term->field_product_goods->target_id);
                    $inventory_nids = \Drupal::entityQuery("node")
                                    ->condition('type', 'stock_up')
                                    ->condition('field_product_goods', $purchase_items[$i])
                                    ->execute();
                    $inventory = \Drupal\node\Entity\Node::load($inventory_nids[0]);
                    if ( $i == 0 ) {
                        $section_three .= '<tr id="monthly-detail-purchase-bill-s3-begin"><td>' . centuryToRepublicEra($bill->field_expected_receive_payment->value, "-", "") . '</td><td><a href="/node/' . $purchase->id() .'/edit" target="_blank">' . $purchase->title->value . '</a></td><td>' . $product->title->value . '</td><td>' . $product->field_goods_name->value . '</td><td>' . $term->field_quantity->value .'</td><td>' . $term->field_unit->value . '</td><td>' . number_format($term->field_price->value) . '</td><td>' . number_format($term->field_total_amount->value) . '</td><td><a href="/node/' . $bill->id() . '/edit" target="_blank">' . get_entity_storage_label($bill, 'field_bill_type', $bill->field_bill_type->value) . '</a></td></tr>';
                    } else {
                        $section_three .= '<tr id="monthly-detail-purchase-bill-s3-mid"><td></td><td></td><td>' . $product->title->value . '</td><td>' . $product->field_goods_name->value . '</td><td>' . $term->field_quantity->value .'</td><td>' . $inventory->field_unit->value . '</td><td>' . number_format($term->field_price->value) . '</td><td>' . number_format($term->field_total_amount->value) . '</td><td></td><td></td></tr>';
                    }
                }
                $total_amount = $total_amount + $bill->field_total_amount_with_tax->value;
                $total_amount_had_collected = $total_amount_had_collected + ($bill->field_deposit->value + $bill->field_write_off_amount->value);
            }
        }
        $total_amount_need_collect = $total_amount - $total_amount_had_collected;
        $section_three .= '<tr id="monthly-detail-purchase-bill-s3-end"><td colspan="9">以下空白</td></tr></tbody></table>';

        $section_four = '<table id="monthly-detail-purchase-bill-s4"><tbody><tr><td>金額總計: ' . number_format($total_amount_need_collect) .'</td><td></td><td width="250">已收金額: ' . number_format($total_amount_had_collected) .'</td></tr>';
        $section_four .= '<tr><td >本期應收帳款: ' . number_format($total_amount_need_collect) .'</td><td></td><td>應收帳款總額: ' . number_format($total_amount) . '</td></tr></table></tbody>';
        
        $comment = '<div id="monthly-detail-purchase-bill-statement-comment"><pre>' . \Drupal::config ('common_utils.comment_selection_for_print')->get('comment4') . '</pre></div>';

        $table = $section_one . $section_two . $section_three . $section_four . $comment;

        $form['monthly_bill_statement'] = array('#type' => 'markup', '#markup' => "<div>$table</div>",);

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
    public function submitForm(array &$form, FormStateInterface $form_state) {}
}




