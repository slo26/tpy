<?php

/**
 * @file
 * Contains \Drupal\custom_toolbar\Controller\CustomToolbarController.
 */
namespace Drupal\custom_toolbar\Controller;

use Drupal\Core\Controller\ControllerBase;

class CustomToolbarController extends ControllerBase {

    public function dropdownSetting() {
        $markup = '<div id="block-seven-content" class="block block-system block-system-main-block">';
        $markup .= '<div class="clearfix">';

        $markup .= '<div class="layout-column layout-column--half">';
        $markup .= '<div class="panel">';
        $markup .= '<h3 class="panel__title">產品相關</h3>';
        $markup .= '<div class="panel__content">';
        $markup .= '<ul class="admin-list">';
        $markup .= '<li>';
        $markup .= '<a href="/admin/structure/types/manage/product/fields/node.product.field_product_category/storage">';
        $markup .= '<span class="label">產品分類</span>';
        $settings = getFieldStorageSettingsAllowedValues('field_product_category', 'product');
        $markup .= '<div class="description">以下是目前的設定:</br>' .  implode(", ", $settings) .'</div>';
        $markup .= '</a></li>';
        $markup .= '<li>';
        $markup .= '<a href="/admin/structure/types/manage/product/fields/node.product.field_color/storage">';
        $markup .= '<span class="label">產品顏色</span>';
        $settings = getFieldStorageSettingsAllowedValues('field_color', 'product');
        $markup .= '<div class="description">以下是目前的設定:</br>' .  implode(", ", $settings) .'</div>';
        $markup .= '</a></li>';
        $markup .= '</ul></div></div>';

        $markup .= '<div class="panel">';
        $markup .= '<h3 class="panel__title">其他</h3>';
        $markup .= '<div class="panel__content">';
        $markup .= '<ul class="admin-list">';
        $markup .= '<li>';
        $markup .= '<a href="/admin/structure/types/manage/vendor/fields/node.vendor.field_country/storage">';
        $markup .= '<span class="label">國別</span>';
        $settings = getFieldStorageSettingsAllowedValues('field_country', 'vendor');
        $markup .= '<div class="description">以下是目前的設定:</br>' .  implode(", ", $settings) .'</div>';
        $markup .= '</a></li>';
        $markup .= '<li>';
        $markup .= '<a href="/admin/structure/types/manage/customer/fields/node.customer.field_customer_type/storage">';
        $markup .= '<span class="label">客戶種類</span>';
        $settings = getFieldStorageSettingsAllowedValues('field_customer_type', 'customer');
        $markup .= '<div class="description">以下是目前的設定:</br>' .  implode(", ", $settings) .'</div>';
        $markup .= '</a></li>';
        $markup .= '</a></li>';
        $markup .= '<li>';
        $markup .= '<a href="/admin/config/common_utils">';
        $markup .= '<span class="label">公司資訊</span>';
        $markup .= '<div class="description">公司基本資料, 名稱, 地址, 電話, 網址, Email, 營業稅</div>';
        $markup .= '</a></li>';
        $markup .= '</ul></div></div>';

        $markup .= '</div>';

        $markup .= '<div class="layout-column layout-column--half">';
        $markup .= '<div class="panel">';
        $markup .= '<h3 class="panel__title">訂單/採購相關</h3>';
        $markup .= '<div class="panel__content">';
        $markup .= '<ul class="admin-list">';
        $markup .= '<li>';
        $markup .= '<a href="/admin/structure/types/manage/purchase_order/fields/node.purchase_order.field_logistics/storage">';
        $markup .= '<span class="label">物流</span>';
        $settings = getFieldStorageSettingsAllowedValues('field_logistics', 'purchase_order');
        $markup .= '<div class="description">以下是目前的設定:</br>' .  implode(", ", $settings) .'</div>';
        $markup .= '</a></li>';
        $markup .= '<li>';
        $markup .= '<a href="/admin/structure/types/manage/purchase_order/fields/node.purchase_order.field_purchase_status/storage">';
        $markup .= '<span class="label">採購狀態</span>';
        $settings = getFieldStorageSettingsAllowedValues('field_purchase_status', 'purchase_order');
        $markup .= '<div class="description">以下是目前的設定:</br>' .  implode(", ", $settings) .'</div>';
        $markup .= '</a></li>';
        $markup .= '<li>';
        $markup .= '<a href="/admin/structure/types/manage/customer/fields/node.customer.field_delivery/storage">';
        $markup .= '<span class="label">出貨方式</span>';
        $settings = getFieldStorageSettingsAllowedValues('field_delivery', 'customer');
        $markup .= '<div class="description">以下是目前的設定:</br>' .  implode(", ", $settings) .'</div>';
        $markup .= '</a></li>';
        $markup .= '<li>';
        $markup .= '<a href="/admin/common_utils/comments-for-print">';
        $markup .= '<span class="label">列印備註</span>';
        $markup .= '<div class="description">備註1, 備註2, 備註3, 備註4, 備註5, 備註6</div>';
        $markup .= '</a></li>';
        $markup .= '</ul></div></div>';

        $markup .= '</div></div>';

        return array(
            '#type' => 'markup',
            '#markup' => $markup,
        );
    }

    public function billStatement() {
        $markup = '<div id="block-seven-content" class="block block-system block-system-main-block">';
        $markup .= '<div class="clearfix">';

        $markup .= '<div class="layout-column layout-column--half">';
        $markup .= '<div class="panel">';
        $markup .= '<h3 class="panel__title">銷售帳單</h3>';
        $markup .= '<div class="panel__content">';
        $markup .= '<ul class="admin-list">';
        $markup .= '<li>';
        $markup .= '<a href="/admin/billing/sale-billing-statement">';
        $markup .= '<span class="label">建立應收對帳單</span>';
        $markup .= '<div class="description">建立應收對帳單</div>';
        $markup .= '</a></li>';
        $markup .= '<li>';
        $markup .= '<a href="/admin/all-write-off-view">';
        $markup .= '<span class="label">已完成應收對帳列表</span>';
        $markup .= '<div class="description">已完成應收對帳列表</div>';
        $markup .= '</a></li>';
        $markup .= '<li>';
        $markup .= '<a href="/admin/all-billing">';
        $markup .= '<span class="label">銷售單帳單</span>';
        $markup .= '<div class="description">銷售單帳單</div>';
        $markup .= '</a></li>';
        $markup .= '</ul></div></div>';    
        
        $markup .= '<div class="panel">';
        $markup .= '<h3 class="panel__title">客戶信用</h3>';
        $markup .= '<div class="panel__content">';
        $markup .= '<ul class="admin-list">';
        $markup .= '<li>';
        $markup .= '<a href="/admin/all-store-credit">';
        $markup .= '<span class="label">客戶信用儲值</span>';
        $markup .= '<div class="description">客戶信用儲值列表</div>';
        $markup .= '</a></li>';
        $markup .= '</ul></div></div>';

        $markup .= '</div>';

        $markup .= '<div class="layout-column layout-column--half">';
        $markup .= '<div class="panel">';
        $markup .= '<h3 class="panel__title">採購帳單</h3>';
        $markup .= '<div class="panel__content">';
        $markup .= '<ul class="admin-list">';
        $markup .= '<li>';
        $markup .= '<a href="/node/add/purchase_order">';
        $markup .= '<span class="label">建立付款對帳單</span>';
        $markup .= '<div class="description">建立付款對帳單</div>';
        $markup .= '</ul></div></div>';
        $markup .= '</div>';

        $markup .= '</div></div>';

        return array(
            '#type' => 'markup',
            '#markup' => $markup,
        );
    }

    public function mainPanel() {
        $markup = '<div id="block-seven-content" class="block block-system block-system-main-block">';
        $markup .= '<div class="clearfix">';

        $markup .= '<div class="layout-column layout-column--half">';
        $markup .= '<div class="panel">';
        $markup .= '<h3 class="panel__title">銷貨</h3>';
        $markup .= '<div class="panel__content">';
        $markup .= '<ul class="admin-list">';
        $markup .= '<li>';
        $markup .= '<a href="/node/add/sales_order">';
        $markup .= '<span class="label">新增銷售單</span>';
        $markup .= '<div class="description">新增銷售單</div>';
        $markup .= '</a></li>';
        $markup .= '<li>';
        $markup .= '<a href="/admin/all-sell-orders">';
        $markup .= '<span class="label">銷售單列表</span>';
        $markup .= '<div class="description">銷售單列表</div>';
        $markup .= '</a></li>';
        $markup .= '<li>';
        $markup .= '<a href="/admin/sell-items">';
        $markup .= '<span class="label">產品銷售列表</span>';
        $markup .= '<div class="description">產品銷售列表</div>';
        $markup .= '</a></li>';
        $markup .= '</ul></div></div>';

        $markup .= '<div class="panel">';
        $markup .= '<h3 class="panel__title">產品/零件/物品</h3>';
        $markup .= '<div class="panel__content">';
        $markup .= '<ul class="admin-list">';
        $markup .= '<li>';
        $markup .= '<a href="/node/add/product">';
        $markup .= '<span class="label">新增產品</span>';
        $markup .= '<div class="description">新增產品</div>';
        $markup .= '</a></li>';
        $markup .= '<li>';
        if ( view_gross_profit_margin() ) {
            $markup .= '<a href="/admin/all-products-for-admin">';
        } else {
            $markup .= '<a href="/admin/all-products">';
        }
        $markup .= '<span class="label">產品列表</span>';
        $markup .= '<div class="description">產品列表</div>';
        $markup .= '</a></li>';
        $markup .= '<li>';
        $markup .= '<a href="/node/add/goods">';
        $markup .= '<span class="label">新增零件／物品</span>';
        $markup .= '<div class="description">新增零件／物品</div>';
        $markup .= '</a></li>';
        $markup .= '<li>';
        $markup .= '<a href="/admin/parts-goods">';
        $markup .= '<span class="label">零件/物品列表</span>';
        $markup .= '<div class="description">零件/物品列表</div>';
        $markup .= '</a></li>';
        $markup .= '</ul></div></div>';
       
        $markup .= '<div class="panel">';
        $markup .= '<h3 class="panel__title">網頁/文件/其他</h3>';
        $markup .= '<div class="panel__content">';
        $markup .= '<ul class="admin-list">';
        $markup .= '<li>';
        $markup .= '<a href="/node/add/page">';
        $markup .= '<span class="label">新增網頁</span>';
        $markup .= '<div class="description">新增網頁</div>';
        $markup .= '</a></li>';
        $markup .= '<li>';
        $markup .= '<a href="/admin/all-html-pages">';
        $markup .= '<span class="label">網頁列表</span>';
        $markup .= '<div class="description">網頁列表</div>';
        $markup .= '</a></li>';
        $markup .= '<li>';
        $markup .= '<a href="/node/add/documentation">';
        $markup .= '<span class="label">新增文件</span>';
        $markup .= '<div class="description">新增文件</div>';
        $markup .= '</a></li>';
        $markup .= '<li>';
        $markup .= '<a href="/admin/all-documents">';
        $markup .= '<span class="label">文件列表</span>';
        $markup .= '<div class="description">文件列表</div>';
        $markup .= '</ul></div></div>';

        $markup .= '</div>';

        $markup .= '<div class="layout-column layout-column--half">';

        $markup .= '<div class="panel">';
        $markup .= '<h3 class="panel__title">採購</h3>';
        $markup .= '<div class="panel__content">';
        $markup .= '<ul class="admin-list">';
        $markup .= '<li>';
        $markup .= '<a href="/node/add/purchase_order">';
        $markup .= '<span class="label">新增採購單</span>';
        $markup .= '<div class="description">新增採購</div>';
        $markup .= '</a></li>';
        $markup .= '<li>';
        $markup .= '<a href="/admin/all-purchase-orders">';
        $markup .= '<span class="label">採購列表</span>';
        $markup .= '<div class="description">採購列表</div>';
        $markup .= '</a></li>';
        $markup .= '<li>';
        $markup .= '<a href="/admin/purchase-items">';
        $markup .= '<span class="label">採購項目列表</span>';
        $markup .= '<div class="description">採購項目列表</div>';
        $markup .= '</a></li>';
        $markup .= '</ul></div></div>';


        $markup .= '<div class="panel">';
        $markup .= '<h3 class="panel__title">倉儲</h3>';
        $markup .= '<div class="panel__content">';
        $markup .= '<ul class="admin-list">';
        $markup .= '<li>';
        $markup .= '<a href="/node/add/stock_up">';
        $markup .= '<span class="label">新增商品庫存</span>';
        $markup .= '<div class="description">新增商品庫存</div>';
        $markup .= '</a></li>';
        $markup .= '<li>';
        $markup .= '<a href="/admin/all-stock-up">';
        $markup .= '<span class="label">商品庫存列表</span>';
        $markup .= '<div class="description">商品庫存列表</div>';
        $markup .= '</a></li>';
        $markup .= '<li>';
        $markup .= '<a href="/node/add/ourbound_inbound_warehouse">';
        $markup .= '<span class="label">提貨/入庫/轉貨單</span>';
        $markup .= '<div class="description">領料/領貨, 入庫, 庫存轉倉庫, 退貨入庫</div>';
        $markup .= '</a></li>';
        $markup .= '<li>';
        $markup .= '<a href="/admin/picking-input-return-form">';
        $markup .= '<span class="label">提貨/入庫/轉貨單列表</span>';
        $markup .= '<div class="description">提貨/入庫/轉貨單列表</div>';
        $markup .= '</a></li>';
        $markup .= '<li>';
        $markup .= '<a href="/admin/inventory-transaction-list">';
        $markup .= '<span class="label">倉儲活動交易紀錄</span>';
        $markup .= '<div class="description">倉儲活動交易紀錄</div>';
        $markup .= '</a></li>';
        $markup .= '<li>';
        $markup .= '<a href="/node/add/storage">';
        $markup .= '<span class="label">新增倉庫</span>';
        $markup .= '<div class="description">新增倉庫</div>';
        $markup .= '</a></li>';
        $markup .= '<li>';
        $markup .= '<a href="/admin/all-storages">';
        $markup .= '<span class="label">倉庫列表</span>';
        $markup .= '<div class="description">倉庫列表</div>';
        $markup .= '</a></li>';
        $markup .= '</ul></div></div>';

        $markup .= '<div class="panel">';
        $markup .= '<h3 class="panel__title">客戶/廠商</h3>';
        $markup .= '<div class="panel__content">';
        $markup .= '<ul class="admin-list">';
        $markup .= '<li>';
        $markup .= '<a href="/node/add/customer">';
        $markup .= '<span class="label">新增客戶</span>';
        $markup .= '<div class="description">新增客戶</div>';
        $markup .= '</a></li>';
        $markup .= '<li>';
        $markup .= '<a href="/admin/all-customers">';
        $markup .= '<span class="label">客戶列表</span>';
        $markup .= '<div class="description">客戶列表</div>';
        $markup .= '</a></li>';
        $markup .= '<li>';
        $markup .= '<a href="/node/add/vendor">';
        $markup .= '<span class="label">新增廠商</span>';
        $markup .= '<div class="description">新增廠商</div>';
        $markup .= '</a></li>';
        $markup .= '<li>';
        $markup .= '<a href="/admin/vendor">';
        $markup .= '<span class="label">廠商列表</span>';
        $markup .= '<div class="description">廠商列表</div>';
        $markup .= '</a></li>';
        $markup .= '</ul></div></div>';
        $markup .= '</div>';

        $markup .= '</div></div>';

        return array(
            '#type' => 'markup',
            '#markup' => $markup,
        );
    }

    public function customers_vendors() {
        $markup = '<div id="block-seven-content" class="block block-system block-system-main-block">';
        $markup .= '<ul class="admin-list">';
        $markup .= '<li><a href="/node/add/customer"><span class="label">新增客戶</span>';
        $markup .= '<div class="description">新增客戶</div>';
        $markup .= '</a></li>';
        $markup .= '<li><a href="/admin/all-customers"><span class="label">客戶列表</span>';
        $markup .= '<div class="description">列出所有客戶</div></a></li>';
        $markup .= '<li><a href="/node/add/vendor"><span class="label">新增廠商</span>';
        $markup .= '<div class="description">新增廠商</div></a></li>';
        $markup .= '<li><a href="/admin/vendor"><span class="label">廠商列表</span>';
        $markup .= '<div class="description">列出所有廠商</div></a></li>';
        $markup .= '</ul>';
        $markup .= '</div>';
        return array(
            '#type' => 'markup',
            '#markup' => $markup,
        );
    }

    public function web_teamroom_other() {
        $markup = '<ul class="admin-list">';
        $markup .= '<li><a href="' . '/node/add/page';
        $markup .= '"><span class="label">新增網頁';
        $markup .= '</span><div class="description">新增網頁.';
        $markup .= '</div></a></li>';

        $markup .= '<li><a href="' . '/admin/all-html-pages';
        $markup .= '"><span class="label">網頁列表';
        $markup .= '</span><div class="description">所有網頁列表.';
        $markup .= '</div></a></li>';

        $markup .= '<li><a href="' . '/node/add/documentation';
        $markup .= '"><span class="label">新增文件';
        $markup .= '</span><div class="description">新增文件列.';
        $markup .= '</div></a></li>';

        $markup .= '<li><a href="' . '/admin/all-documents';
        $markup .= '"><span class="label">文件列表';
        $markup .= '</span><div class="description">所有文件列表.';
        $markup .= '</div></a></li>';
        
        $markup .= '</ul>';

        return array(
            '#type' => 'markup',
            '#markup' => $markup,
        );
    }

    public function import_sell_inventory() {
        $markup = '<div id="block-seven-content" class="block block-system block-system-main-block">';
        $markup .= '<div class="clearfix">';

        $markup .= '<div class="layout-column layout-column--half">';
        $markup .= '<div class="panel">';
        $markup .= '<h3 class="panel__title">銷貨</h3>';
        $markup .= '<div class="panel__content">';
        $markup .= '<ul class="admin-list">';
        $markup .= '<li>';
        $markup .= '<a href="/node/add/sales_order">';
        $markup .= '<span class="label">新增銷售單</span>';
        $markup .= '<div class="description">新增銷售單</div>';
        $markup .= '</a></li>';
        $markup .= '<li>';
        $markup .= '<a href="/admin/all-sell-orders">';
        $markup .= '<span class="label">銷售單列表</span>';
        $markup .= '<div class="description">銷售單列表</div>';
        $markup .= '</a></li>';
        $markup .= '<li>';
        $markup .= '<a href="/admin/sell-items">';
        $markup .= '<span class="label">產品銷售列表</span>';
        $markup .= '<div class="description">產品銷售列表</div>';
        $markup .= '</a></li>';
        $markup .= '</ul></div></div>';

        $markup .= '<div class="panel">';
        $markup .= '<h3 class="panel__title">倉儲</h3>';
        $markup .= '<div class="panel__content">';
        $markup .= '<ul class="admin-list">';
        $markup .= '<li>';
        $markup .= '<a href="/node/add/stock_up">';
        $markup .= '<span class="label">新增商品庫存</span>';
        $markup .= '<div class="description">新增商品庫存</div>';
        $markup .= '</a></li>';
        $markup .= '<li>';
        $markup .= '<a href="/admin/all-stock-up">';
        $markup .= '<span class="label">商品庫存列表</span>';
        $markup .= '<div class="description">商品庫存列表</div>';
        $markup .= '</a></li>';
        $markup .= '<li>';
        $markup .= '<a href="/node/add/ourbound_inbound_warehouse">';
        $markup .= '<span class="label">提貨/入庫/轉貨單</span>';
        $markup .= '<div class="description">領料/領貨, 入庫, 庫存轉倉庫, 退貨入庫</div>';
        $markup .= '</a></li>';
        $markup .= '<li>';
        $markup .= '<a href="/admin/picking-input-return-form">';
        $markup .= '<span class="label">提貨/入庫/轉貨單列表</span>';
        $markup .= '<div class="description">提貨/入庫/轉貨單列表</div>';
        $markup .= '</a></li>';
        $markup .= '<li>';
        $markup .= '<a href="/admin/inventory-transaction-list">';
        $markup .= '<span class="label">倉儲活動交易紀錄</span>';
        $markup .= '<div class="description">倉儲活動交易紀錄</div>';
        $markup .= '</a></li>';
        $markup .= '<li>';
        $markup .= '<a href="/node/add/storage">';
        $markup .= '<span class="label">新增倉庫</span>';
        $markup .= '<div class="description">新增倉庫</div>';
        $markup .= '</a></li>';
        $markup .= '<li>';
        $markup .= '<a href="/admin/all-storages">';
        $markup .= '<span class="label">倉庫列表</span>';
        $markup .= '<div class="description">倉庫列表</div>';
        $markup .= '</a></li>';
        $markup .= '</ul></div></div>';

        $markup .= '</div>';

        $markup .= '<div class="layout-column layout-column--half">';

        $markup .= '<div class="panel">';
        $markup .= '<h3 class="panel__title">採購</h3>';
        $markup .= '<div class="panel__content">';
        $markup .= '<ul class="admin-list">';
        $markup .= '<li>';
        $markup .= '<a href="/node/add/purchase_order">';
        $markup .= '<span class="label">新增採購單</span>';
        $markup .= '<div class="description">新增採購</div>';
        $markup .= '</a></li>';
        $markup .= '<li>';
        $markup .= '<a href="/admin/all-purchase-orders">';
        $markup .= '<span class="label">採購列表</span>';
        $markup .= '<div class="description">採購列表</div>';
        $markup .= '</a></li>';
        $markup .= '<li>';
        $markup .= '<a href="/admin/purchase-items">';
        $markup .= '<span class="label">採購項目列表</span>';
        $markup .= '<div class="description">採購項目列表</div>';
        $markup .= '</a></li>';
        $markup .= '</ul></div></div>';

        $markup .= '</div></div>';

        return array(
            '#type' => 'markup',
            '#markup' => $markup,
        );
    }

    public function fundamental_info() {
        $markup = '<div id="block-seven-content" class="block block-system block-system-main-block">';
        $markup .= '<div class="clearfix">';

        $markup .= '<div class="layout-column layout-column--half">';
        $markup .= '<div class="panel">';
        $markup .= '<h3 class="panel__title">產品/零件</h3>';
        $markup .= '<div class="panel__content">';
        $markup .= '<ul class="admin-list">';
        $markup .= '<li><a href="/node/add/product"><span class="label">新增產品</span>';
        $markup .= '<div class="description">新增產品</div>';
        $markup .= '</a></li>';
        if ( view_gross_profit_margin() ) {
            $markup .= '<li><a href="/admin/all-products-for-admin"><span class="label">產品列表</span>';    
        } else {
            $markup .= '<li><a href="/admin/all-products"><span class="label">產品列表</span>';
        }
        $markup .= '<div class="description">列出所有產品</div></a></li>';
        $markup .= '<li><a href="/node/add/goods"><span class="label">新增零件／物品</span>';
        $markup .= '<div class="description">新增零件／物品</div></a></li>';
        $markup .= '<li><a href="/admin/parts-goods"><span class="label">零件/物品列表</span>';
        $markup .= '<div class="description">列出所有零件和物品</div></a></li>';
        $markup .= '</ul></div></div>';    

        $markup .= '</div>';

        $markup .= '<div class="layout-column layout-column--half">';
        $markup .= '<div class="panel">';
        $markup .= '<h3 class="panel__title">客戶/廠商</h3>';
        $markup .= '<div class="panel__content">';
        $markup .= '<ul class="admin-list">';
        $markup .= '<li><a href="/node/add/customer"><span class="label">新增客戶</span>';
        $markup .= '<div class="description">新增客戶</div>';
        $markup .= '</a></li>';
        $markup .= '<li><a href="/admin/all-customers"><span class="label">客戶列表</span>';
        $markup .= '<div class="description">列出所有客戶</div></a></li>';
        $markup .= '<li><a href="/node/add/vendor"><span class="label">新增廠商</span>';
        $markup .= '<div class="description">新增廠商</div></a></li>';
        $markup .= '<li><a href="/admin/vendor"><span class="label">廠商列表</span>';
        $markup .= '<div class="description">列出所有廠商</div></a></li>';
        $markup .= '</ul></div></div>';
        $markup .= '</div>';

        $markup .= '</div></div>';

        return array(
            '#type' => 'markup',
            '#markup' => $markup,
        );
    }

    public function products_goods() {
        $markup = '<div id="block-seven-content" class="block block-system block-system-main-block">';
        $markup .= '<ul class="admin-list">';
        $markup .= '<li><a href="/node/add/product"><span class="label">新增產品</span>';
        $markup .= '<div class="description">新增產品</div>';
        $markup .= '</a></li>';
        if ( view_gross_profit_margin() ) {
            $markup .= '<li><a href="/admin/all-products-for-admin"><span class="label">產品列表</span>';    
        } else {
            $markup .= '<li><a href="/admin/all-products"><span class="label">產品列表</span>';
        }
        $markup .= '<div class="description">列出所有產品</div></a></li>';
        $markup .= '<li><a href="/node/add/goods"><span class="label">新增零件／物品</span>';
        $markup .= '<div class="description">新增零件／物品</div></a></li>';
        $markup .= '<li><a href="/admin/parts-goods"><span class="label">零件/物品列表</span>';
        $markup .= '<div class="description">列出所有零件和物品</div></a></li>';
        $markup .= '</ul>';
        $markup .= '</div>';
        return array(
            '#type' => 'markup',
            '#markup' => $markup,
        );
    }
}



