<?php
// -----
// Admin-level installation script for the "encapsulated" Products Cost Display plugin for Zen Cart, by lat9.
// Copyright (C) 2026, Vinos de Frutas Tropicales.
//
// Last updated: v2.0.0
//
use Zencart\PluginSupport\ScriptedInstaller as ScriptedInstallBase;

class ScriptedInstaller extends ScriptedInstallBase
{
    protected function executeInstall()
    {
        // -----
        // Add the `products_cost` field to the `products` table, if not
        // already present.
        //
        global $sniffer;
        if ($sniffer->field_exists(TABLE_PRODUCTS, 'products_cost') === false) {
            // -----
            // Add an entry to the address_book table that will hold the VAT Number associated with the address
            // and an indication as to whether that value is valid.
            //
            $sql =
                "ALTER TABLE " . TABLE_PRODUCTS . "
                   ADD products_cost decimal(15,4) NOT NULL DEFAULT 0.0000 AFTER products_price";
            $this->executeInstallerSql($sql);
        }
        parent::executeInstall();

        return true;
    }

    // -----
    // Not used, initially, but included for the possibility of future upgrades!
    //
    // Note: This (https://github.com/zencart/zencart/pull/6498) Zen Cart PR must
    // be present in the base code or a PHP Fatal error is generated due to the
    // function signature difference.
    //
    protected function executeUpgrade($oldVersion)
    {
        parent::executeUpgrade($oldVersion);
    }

    protected function executeUninstall()
    {
        parent::executeUninstall();
    }
}
