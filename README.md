# microfluid_website
Website of Microfluid Process Equipment

Icons
1. remixicon
2. iconify

#common files information
include <head> tag - head.php
header - header.php
common query - Commpn_query.php (class file)
database connection - databse.php (class file)
js- manual.js
css - style.css
footer - footer.php
images - assets/img (folder)
note changes - changes.txt


# Code information
- In head.php file we include common_query.php class for use all functions.
- In header.php file we create object for this class.
- In common_query class we have all common methods of system. 
- we declare all constant in this class. 
- In database.php we have database connection. 
- manual.js file include in head.php file
- language function in class_common.php
- product request modal load in header_scroll.php file (request_modal)


# for any CLASS declaration
1. create class
2. include class in head.php
3. create object of this class in header.php
4. use object anywhere 

# default column in every table query
ALTER TABLE `web_products`  ADD `sequence` INT NULL DEFAULT NULL  AFTER `p_description`,  ADD `created_on` DATETIME NULL DEFAULT CURRENT_TIMESTAMP  AFTER `sequence`,  ADD `updated_on` DATETIME NULL DEFAULT NULL  AFTER `created_on`,  ADD `created_by` VARCHAR(50) NULL DEFAULT NULL  AFTER `updated_on`,  ADD `updated_by` VARCHAR(50) NULL DEFAULT NULL  AFTER `created_by`,  ADD `is_deleted` TINYINT NULL DEFAULT '0'  AFTER `updated_by`;

# Software crud for website
1. Manage Clients - web_clients
2. Manage language phrase - web_language
3. Manage About us information - web_about_info @@done
4. Manage Product category - web_products_category
5. Manage Products Sub Category - web_products_sub_category
5. Manage Products - web_products



CHANGES PENDING:
responsive changes of banner
field application - Read more in orange with arrow



