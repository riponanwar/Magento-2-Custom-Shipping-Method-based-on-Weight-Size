# Magento 2 Custom Shipping Method based on Weight & Size
<p>This module provide a custom shipping method on the site.</p>
<p>## Condition</p>
<p>Shipping charge will be calculated according to product size and weight.</p>
<ul>
<li>If weight is more than 10 KG and size is less than 100 CM, Shipping Charge will be 100 TK</li>
<li> If weight is less than 10 KG and Size is more than 100 CM, Shipping Charge will be 90 TK</li>
<li>If weight is more than 10 KG and size is more than 100 CM, shipping charge will be 150 TK.</li>
<li>If weight is less than 10 KG and Size is less than 100 CM, Shipping Charge will be 60 TK</li>
</ul>
<p>&nbsp;</p>
<p>## Installation</p>
<p>Custome Size should be attribute code "csize" &amp; type should be "Text field"</p>
<p><br />Copy the content of the repo to the app/code/Zendanwar/ShippingMethod/ folder</p>
<p>Enable module:<br />......<br />php bin/magento module:enable Zendanwar_ShippingMethod<br />........</p>
<p>Disable module: (Optional)<br />......<br />php bin/magento module:disable Zendanwar_ShippingMethod --clear-static-content<br />.....</p>
<p>Update system:<br />....<br />php bin/magento setup:upgrade<br />php bin/magento cache:flush<br />php bin/magento cache:clean<br />....</p>
<p>&nbsp;</p>
