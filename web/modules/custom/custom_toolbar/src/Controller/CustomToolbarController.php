<?php

/**
 * @file
 * Contains \Drupal\custom_toolbar\Controller\CustomToolbarController.
 */
namespace Drupal\custom_toolbar\Controller;

use Drupal\Core\Controller\ControllerBase;

class CustomToolbarController extends ControllerBase {

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
        $markup .= '<a href="/admin/all-products">';
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

    public function sell() {
        $markup = '<ul class="admin-list">';
        $markup .= '<li><a href="' . '/node/add/sales_order';
        $markup .= '"><span class="label">新增銷售單';
        $markup .= '</span><div class="description">新增銷售單.';
        $markup .= '</div></a></li>';


        $markup .= '<li><a href="' . '/admin/all-sell-orders';
        $markup .= '"><span class="label">銷售單列表';
        $markup .= '</span><div class="description">所有銷售單列表.';
        $markup .= '</div></a></li>';

        $markup .= '<li><a href="' . '/admin/sell-items';
        $markup .= '"><span class="label">產品銷售列表.';
        $markup .= '</span><div class="description">所有產品銷售列表.';
        $markup .= '</div></a></li>';
        
        $markup .= '</ul>';

        return array(
            '#type' => 'markup',
            '#markup' => $markup,
        );
    }

    public function company() {
        $markup = '<ul class="admin-list">';
        $markup .= '<li><a href="' . '/node/add/customer';
        $markup .= '"><span class="label">新增客戶';
        $markup .= '</span><div class="description">新增客戶.';
        $markup .= '</div></a></li>';


        $markup .= '<li><a href="' . '/admin/all-customers';
        $markup .= '"><span class="label">客戶列表';
        $markup .= '</span><div class="description">所有客戶列表.';
        $markup .= '</div></a></li>';
        
        $markup .= '</ul>';

        return array(
            '#type' => 'markup',
            '#markup' => $markup,
        );
    }

    public function product() {
        $markup = '<ul class="admin-list">';
        $markup .= '<li><a href="' . '/node/add/product';
        $markup .= '"><span class="label">新增產品';
        $markup .= '</span><div class="description">新增產品.';
        $markup .= '</div></a></li>';


        $markup .= '<li><a href="' . '/admin/all-products';
        $markup .= '"><span class="label">產品列表';
        $markup .= '</span><div class="description">所有產品列表.';
        $markup .= '</div></a></li>';
        
        $markup .= '</ul>';

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

    public function storage() {
        $markup = '<ul class="admin-list">';
        $markup .= '<li><a href="' . '/node/add/storage';
        $markup .= '"><span class="label">新增倉庫';
        $markup .= '</span><div class="description">新增倉庫.';
        $markup .= '</div></a></li>';

        $markup .= '<li><a href="' . '/admin/all-storages';
        $markup .= '"><span class="label">倉庫列表';
        $markup .= '</span><div class="description">所有倉庫列表.';
        $markup .= '</div></a></li>';

        $markup .= '<li><a href="' . '/node/add/stock_up';
        $markup .= '"><span class="label">新增商品庫存';
        $markup .= '</span><div class="description">新增商品庫存.';
        $markup .= '</div></a></li>';

        $markup .= '<li><a href="' . '/admin/all-stock-up';
        $markup .= '"><span class="label">商品庫存列表';
        $markup .= '</span><div class="description">所有商品庫存列表.';
        $markup .= '</div></a></li>';
        
        $markup .= '</ul>';

        return array(
            '#type' => 'markup',
            '#markup' => $markup,
        );
    }
}

