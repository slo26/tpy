<?php
/**
 * @file
 * Contains \Drupal\sales_order_content_type\Form\SaleSheet.
 */
namespace Drupal\sales_order_content_type\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Configure sales_order_content_type agent form settings.
 */
class SaleSheet extends ConfigFormBase {
    /**
     * {@inheritdoc}
     */
    public function getFormId() {
        return 'sale_sheet';
    }

    /**
     * {@inheritdoc}
     */
    protected function getEditableConfigNames() {
        return [
            'sales_order_content_type.sale_sheet',
        ];
    }

     /**
     * {@inheritdoc}
     */
    public function buildForm(array $form, FormStateInterface $form_state, $node = null) {
        $result = "";
        if ( $node instanceof \Drupal\node\NodeInterface ) {
            $sale = \Drupal\node\Entity\Node::load($node->id());    
        } else {
            $sale = \Drupal\node\Entity\Node::load($node);
        }
        if ( $sale->moderation_state->value == "stocking" || $sale->moderation_state->value == "shipment" || $sale->moderation_state->value == "done" ) {
            $customer_nid = $sale->field_customer_entity->target_id;
            $customer = \Drupal\node\Entity\Node::load($customer_nid);
            /***************table head***************/ 
            {
                $table_start = '<table id="sales-oder-table-header"><tbody>';
                $table_body = '<tr id="sales-oder-table-header-tpy-name"><td colspan="4" align="center"><strong>' . \Drupal::config('common_utils.settings')->get('company') .'</strong></td></tr>';
                $table_body .= '<tr id="sales-oder-table-header-tpy-add"><td colspan="4" align="center">' . \Drupal::config('common_utils.settings')->get('company_address') .'</td></tr>';
                $table_body .= '<tr id="sales-oder-table-header-tpy-phone"><td colspan="4" align="center">Tel: ' . \Drupal::config('common_utils.settings')->get('company_phone') . '  Fax: ' . \Drupal::config('common_utils.settings')->get('company_fax') . '</td></tr>';
                
                $table_body .= '<tr id="sales-oder-table-header-status"><td colspan="4" align="center"><strong><u>銷售單</u></strong></td></tr>';
                $table_body .= '<tr id="sales-oder-table-header-sell-info"><td colspan="3" align="left">銷售日期: ' . $sale->field_shipping_date->value . '</a></td><td align="left" width="200px"></td></tr>'; 
                $table_body .= '<tr id="sales-oder-table-header-sell-info"><td colspan="3" align="left">客戶名稱: <a href="/node/' . $customer_nid .'/edit" target="blank">' . $customer->field_customer_title->value . '</a></td><td align="left" width="200px">報價憑證: ' . $sale->title->value . '</td></tr>'; 
                $table_body .= '<tr id="sales-oder-table-header-sell-info"><td colspan="3" align="left">公司地址: ' . $customer->field_address->value . '</td><td align="left" width="200px">聯絡人: ' . $customer->field_contact_person->value . '</td></tr>'; 
                if ( $sale->field_shipping_address->value != $customer->field_address->value ) {
                    $table_body .= '<tr id="sales-oder-table-header-sell-info"><td colspan="4" align="left">發貨地址: ' . $sale->field_shipping_address->value . '</td></tr>'; 
                }
                $table_body .= '<tr id="sales-oder-table-header-sell-info"><td align="left">電話: ' . $customer->field_phone->value . '</td><td align="left">連絡人電話: ' . $customer->field_mobile->value . '</td><td>傳真: ' . $customer->field_fax->value . '</td><td align="left" width="200px">統一編號: ' . $customer->field_uniform_number->value . '</td></tr>'; 
                $table_end = "</tbody></table>";
                $table_head = $table_start . $table_body . $table_end;
            }
            
            /***************table list***************/
            {
                $table_list = "";
                $total_discount = 0;
                $table_start = '<table id="sales-oder-table-list"><tbody>';
                $table_body = '<tr><th width="50px">欄號</th><th>產品型號</th><th>產品名稱</th><th width="75px">銷售數量</th><th width="50px">單位</th><th width="85px">稅前售價</th><th width="85px">稅前金額</th></tr>';
                $tids = \Drupal::entityQuery("taxonomy_term")->condition("vid", "sell_items")
                            ->condition('field_order_id', $sale->nid->value)
                            ->execute();
                $index = 0;
                foreach($tids as $tid) {
                    $item = \Drupal\taxonomy\Entity\Term::load($tid);
                    if ( $item->field_quantity->value > 0 ) {
                        $product = \Drupal\node\Entity\Node::load($item->field_product_id->target_id);
                        $index++;
                        $table_body .= '<tr><td>' . $index . '</td><td><a href="/taxonomy/term/' .$tid . '/edit" target="blank">' . $product->title->value . '</a></td><td>' . $product->field_product_name->value . 
                                        '</td><td align="right">' . number_format($item->field_quantity->value) . 
                                        '</td><td align="right">' . $product->field_unit->value .
                                        '</td><td  align="right">' . number_format($item->field_price->value) . 
                                        '</td><td  align="right">' . number_format($item->field_total_amount->value) . '</td></tr>';
                        if ( !empty($item->field_comments->value) ) {
                            $table_body .= '<tr><td colspan="7" align="left">加註: ' . $item->field_comments->value . '</td></tr>';
                        }
                        $total_discount = $total_discount + (($item->field_price->value * $item->field_quantity->value) * ($item->field_discount->value/100));
                    }
                }
                $table_body .= '<tr class="sales-oder-table-list-bottom"><td colspan="7" align="center"> (以下空白) </td></tr>'; 
                $table_end = "</tbody></table>"; 
                $table_list = $table_start . $table_body . $table_end;
            }
            
            /***************table footer***************/
            {
                $sales = \Drupal\user\Entity\User::load($customer->field_sales->target_id);
                $table_footer = "";
                $bill = \Drupal\node\Entity\Node::load($sale->field_bill->target_id);
                $table_start = '<table id="sales-oder-table-footer"><tbody>';
                $table_body = '<tr><td align="left" width="110px">稅前合計: </td><td align="right" width="110px">' . number_format($bill->field_total_amount_without_tax->value) . 
                                '</td><td align="left" width="110px">已收金額: </td><td align="right" width="110px">' . number_format($bill->field_deposit->value + $bill->field_write_off_amount->value)  . 
                                '</td><td align="left" width="110px">未收金額: </td><td align="right" width="110px">' . number_format($bill->field_total_amount_without_tax->value - $bill->field_deposit->value - ($bill->field_write_off_amount->value - $bill->field_tax->value)) .
                                '</td></tr>';
                $table_body .= '<tr><td align="left" width="110px">營業稅額:</td><td align="right">' . number_format($bill->field_tax->value) . 
                                '</td><td align="left" width="110px">折扣金額: </td><td align="right">' . number_format($total_discount) .
                                '</td><td align="left" width="110px">物流: </td><td align="right">' . get_entity_storage_label($sale, 'field_logistics', $sale->field_logistics->value) .
                                '</td></tr>';
                $table_body .= '<tr><td align="left" width="110px">應收總金額:</td><td align="right">' . number_format($bill->field_total_amount_with_tax->value) . 
                                '</td><td align="left" width="110px">取用預收: </td><td align="right">0' .
                                '</td><td align="left" width="110px">業務代表: </td><td align="right">' . $sales->field_full_name->value .
                                '</td></tr>'; 
                $table_end = "</tbody></table>";
                $table_footer = $table_start . $table_body . $table_end;
            }

            if ( !empty($sale->field_comments_for_print->value) ) {
                $comment = \Drupal::config ('common_utils.comment_selection_for_print')->get($sale->field_comments_for_print->value);
                $comment = '<div id="sales-oder-table-comment"><pre>' . $comment . '</pre></div>';
            } else {
                $comment = "";
            }
            
            $result = $table_head . $table_list . $table_footer . $comment;
        } else {
            $result = "此頁只有在銷售備貨, 銷售出貨或銷售完成時才會產生.";
        }

        $form['sale_form'] = array('#type' => 'markup', '#markup' => "<div>$result</div>",);
        
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



