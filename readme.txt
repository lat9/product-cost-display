-----------------------------------------------------------------

Zen Cart Mod: Product Cost Display
Released under the GPL license found in the root directory of this package.
Original Author: jandm-ent
Updated by: lat9
Version: v2.1.0 (now encapsulated)
Zen Cart Compatibility: Zen Cart v2.1.0 and later

Updated by: jeking
Version: v1.3
Zen Cart Compatibility: Zen Cart 1.5.6

-----------------------------------------------------------------

This Mod allows you to show your product cost (the cost to you from your vendor) on the product page in the admin area. This mod only displays in the admin area and does not display on the catalog. This mod is great for anyone who wishes to track product cost in Zen Cart with out having to keep an external list.

-----------------------------------------------------------------

Installation Instructions

Installing Product Cost Display is very simple, since it's now encapsulated.

1. Upload the contents of the zc_plugins directory (the entire ProductCost sub-directory) to your site's zc_plugins directory.
2. Sign into the admin, navigate to Modules :: Plugins, highlight the row for ProductCost and click the "Install" button. The plugin is now installed in your admin and has added a 'products_cost' field
   to the site's 'products' table.

Once it's installed, you can enter/update the product's cost-to-you when you edit a product.

-----------------------------------------------------------------

Uninstall Instructions

If you decided you want to remove this plugin, it's also simple.

1. Sign into the admin, navigate to Modules :: Plugins, highlight the row for ProductCost and click the "Uninstall" button. The plugin's code is no longer active in your admin.

If you also want to remove the database field, navigate to Tools :: Install SQL Patches, and copy/paste/run the following:

ALTER TABLE `products` DROP `products_cost`

-------------------------------------------------------------------

Change Log:
July 7, 2012: V 1.0 New Mod
September 10, 2015: V 1.1 Updated for Zen Cart 1.5.4
December 5, 2018: V 1.2 Updated for Zen Cart 1.5.5
December 13, 2018: V 1.3 Updated for Zen Cart 1.5.6
June 13, 2026 (lat9): v2.0.0 (encapsulated) for Zen Carts v2.1.0 and later
June 18, 2026 (lat9): v2.1.0
    - Display cost on admin's product listing, too.