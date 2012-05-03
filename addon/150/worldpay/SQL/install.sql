##############################################################################
# WorldPay 2.3 Install for 1.5 - 2012-04-04 - webchills
##############################################################################

###################################
# Register for Admin Access Control
###################################

INSERT INTO admin_pages (page_key,language_key,main_page,page_params,menu_key,display_on_menu,sort_order)
VALUES ('configProdWorldPay','BOX_CUSTOMERS_WORLDPAY_PAYMENTS','FILENAME_WORLDPAY_RESPONSE','','customers','Y',100);