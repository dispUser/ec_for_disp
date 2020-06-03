-- add name
ALTER TABLE `dat_sales_product`
ADD `name` VARCHAR
(30) NOT NULL AFTER `code`;
-- add profit_rate, shipment_fee
ALTER TABLE `dat_sales_product`
ADD `profit_rate` INT
(11) NOT NULL AFTER `price`,
ADD `shipment_fee` INT
(11) NOT NULL AFTER `profit_rate`;
-- add code_image
ALTER TABLE `dat_sales_product`
ADD `code_image` INT
(11) NOT NULL AFTER `code_product`;