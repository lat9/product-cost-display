<?php
// -----
// Part of the Products Cost Display plugin by Cindy Merkin a.k.a. lat9
// Copyright (c) 2026 Vinos de Frutas Tropicales
//
// Last updated: v2.0.0
//
if (!defined('IS_ADMIN_FLAG') || IS_ADMIN_FLAG !== true) {
    die('Illegal Access');
}

class zcObserverProductsCostDisplay extends base
{
    // -----
    // On construction, this auto-loaded observer attaches to various
    // product-related notifications so that it can manage the `products_cost`
    // element of the `products` table.
    //
    public function __construct()
    {
        // -----
        // Only watching for notifications from a product's edit/update.
        //
        global $current_page;
        if ($current_page !== FILENAME_PRODUCT . '.php') {
            return;
        }

        // -----
        // Add the list of notifications to be handled.
        //
        $this->attach($this, [
            'NOTIFY_ADMIN_PRODUCT_PRICE_EDIT_BELOW',    //- From collect_info.php
            'NOTIFY_MODULES_UPDATE_PRODUCT_END',        //- From update_product.php
            'NOTIFY_MODULES_COPY_TO_CONFIRM_DUPLICATE', //- From copy_product_confirm.php
        ]);
    }

    protected function updateNotifyAdminProductPriceEditBelow(&$class, string $e, $pInfo, array &$additional_fields): void
    {
        $products_cost = $pInfo->products_cost ?? 0.0000;
        $additional_fields[] = [
            'label' => TEXT_PRODUCTS_PRICE_COST,
            'fieldname' => 'products-cost',
            'input' => zen_draw_input_field('products_cost', $products_cost, 'class="form-control" id="products-price-w"'),
        ];
    }

    protected function updateNotifyModulesUpdateProductEnd(&$class, string $e, array $action_pid): void
    {
        global $db;
        $db->Execute(
            "UPDATE " . TABLE_PRODUCTS . "
                SET products_cost = " . (float)($_POST['products_cost'] ?? 0) . "
              WHERE products_id = " . (int)$action_pid['products_id'] . "
              LIMIT 1"
        );
    }

    protected function updateNotifyModulesCopyToConfirmDuplicate(&$class, string $e, array $from_to): void
    {
        global $db;
        $from = $db->Execute(
            "SELECT products_cost
               FROM " . TABLE_PRODUCTS . "
              WHERE products_id = " . (int)$from_to['products_id'] . "
              LIMIT 1"
        );
        if (!$from->EOF) {
            $db->Execute(
                "UPDATE " . TABLE_PRODUCTS . "
                    SET products_cost = " . $from->fields['products_cost'] . "
                  WHERE products_id = " . (int)$from_to['dup_products_id'] . "
                  LIMIT 1"
            );
        }
    }
}
