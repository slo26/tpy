<?php
namespace Drupal\sales_order_content_type\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\node\Entity\Node;
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
 * @package Drupal\sales_order_content_type\Form
 */
class OpenHistorySellItemDialogForm extends FormBase {

    /**
     * {@inheritdoc}
     */
    public function getFormId() {
        return 'open_history_sell_item_dialog_form';
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(array $form, FormStateInterface $form_state, $product_nid = null, $customer_nid = null) {
        $table = "";
        if ( $customer_nid == "none" ) {
            $form['#title'] = t('產品對所有客戶的歷史紀錄');
        } else {
            $form['#title'] = t('產品對此客戶的歷史紀錄');
        }
        
        $form['view'] = array(
			'#type' => 'markup',
			'#markup' => $this->getViewSellItems($product_nid, $customer_nid),
        );

        $form['#attached']['library'][] = 'core/drupal.dialog.ajax';
        $form['#attached']['library'][] = 'sales_order_content_type/sales_order_content_type';

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
        return ['config.open_history_sell_item_dialog_form'];
    }

    private function getViewSellItems($product_nid, $customer_nid) {
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
        $table = '<div id="open-history-sell-item"></div>';
        if ( sizeof($json) > 0 ) {
            $table = '<div id="open-history-sell-item"><table>-BODY-</table></div>';
            $table_head = "<thead><tr><td>產品訂單編號</td><td>銷售編號</td><td>產品型號</td><td>客戶名稱</td><td>狀態</td><td>數量</td><td>單價</td><td>折扣(%)</td><td>總價</td></tr></thead>";
            $table_body_begin = '<tbody>';
            $table_body = '';
            for($i=0; $i < count($json); $i++) {
                $row = $json[$i];
                $table_body .= '<tr><td>' . $row->{"name"} . '</td><td>' . $row->{"title"} . '</td><td>' . $row->{"title_1"} . '</td><td>' . $row->{"field_customer_title"} . '</td><td>' . $row->{"field_requisition_status"} . '</td><td>' . $row->{"field_quantity"} . '</td><td>' . $row->{"field_price"} . '</td><td>' . $row->{"field_discount"} . '</td><td>' . $row->{"field_total_amount"}. '</td></tr>';
            }
            $table_body_end = '</tbody>';
            $table_body = $table_head . $table_body_begin . $table_body . $table_body_end;
            $table = str_replace('-BODY-', $table_body, $table);
        }
        return $table;
    }
}


