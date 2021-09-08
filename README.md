# Magento 2 Custom Shipping Method based on Weight & Size

This module provide a custom shipping method on the site.

## Condition

Shipping charge will be calculated according to product size and weight.
a. If weight is more than 10 KG and size is less than 100 CM, Shipping Charge will be 100 TK
b. If weight is less than 10 KG and Size is more than 100 CM, Shipping Charge will be 90 TK
c. If weight is more than 10 KG and size is more than 100 CM, shipping charge will be 150 TK.
d. If weight is less than 10 KG and Size is less than 100 CM, Shipping Charge will be 60 TK

## Installation

Custome Size should be attribute code "csize" & type should be "Text field"


Copy the content of the repo to the app/code/Zendanwar/ShippingMethod/ folder

Enable module:
......
php bin/magento module:enable Zendanwar_ShippingMethod
........

Disable module: (Optional)
......
php bin/magento module:disable Zendanwar_ShippingMethod --clear-static-content
.....

Update system:
....
php bin/magento setup:upgrade
php bin/magento cache:flush
php bin/magento cache:clean
....




