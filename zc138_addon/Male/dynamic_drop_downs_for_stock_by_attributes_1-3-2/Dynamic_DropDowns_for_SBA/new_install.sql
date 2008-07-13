# Add new column to products_options to indicate if stock should be tracked
# for an option

ALTER TABLE products_options
  ADD products_options_track_stock tinyint(4) default '1' not null
  AFTER products_options_name;

  
