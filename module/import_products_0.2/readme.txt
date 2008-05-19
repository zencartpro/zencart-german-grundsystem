imports products + categories from a flat-file into zen-db

# look at attached pdf-file + import_products_example.xls

1) backup !! source + database !!

2) extract zip-file-struc 

3) look at: del_import.sql

4) look at: import_columns.txt == column maping struc
a line like this means:
products_description 	products_description	description_en	2	Hugo was Here
table_name	fieldname	headername	language_id	defaultvalue
!!important: delimeter == tab (in all import files)
DON'T USE PREFIX (ZEN_ ..)

5) look at: admin/import_products/import.*
place in the first row the headernames from 4)
numbers must have the form: 12346.123 (decimal seperator == . (point))

6) place in import_products the file named import.txt

7) goto zen admin / extras / product import == click on import

8) if a category is missed, it will be created; you have to use categories names 

9) import categories
if you wish, you can create an categories.txt-file
SYNTAX: 
MainCat|subCat|SubSubCat|....|SubSubSubnCat
MainCat|subCat|Hello1


#######################

todo:
# automatic creation of categories == 20040917 
# flags for: import/update/delete


rainer AT langheiter DOT com // http://www.filosofisch.com 
20040917




