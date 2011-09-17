ALTER TABLE customers ADD COWOA_account tinyint(1) NOT NULL default 0;
ALTER TABLE orders ADD COWOA_order tinyint(1) NOT NULL default 0;
INSERT INTO query_builder ( query_id , query_category , query_name , query_description , query_string ) VALUES ( '', 'email,newsletters', 'Permanent Account Holders Only', 'Send email only to permanent account holders ', 'select customers_email_address, customers_firstname, customers_lastname from TABLE_CUSTOMERS where COWOA_account != 1 order by customers_lastname, customers_firstname, customers_email_address');
