<?php
//DEFAULT APP CONFIGURATIONS
//Application name
define('APPNAME','Mtush1.0.0');
//developer
define('DEVELOPER','Peter Kimani Mwaura');
//path to root
define('ROOT','http://test.local');
//path to php file
define('APPPATH',ROOT.'/Res/Php');

//RESC0URCES
//path to Recources
define('IMAGES', ROOT.'/res/images/');
//path to System Images
define('SYSTEM_IMAGES', IMAGES.'systemImages/');
// path to System Images
define('ICONS', SYSTEM_IMAGES.'icons/');
//path to profile Images
define('PROD_IMAGES', IMAGES . 'productsImages/');



//ADMINISTRATOR USER DATEBASE
//databse host
define("ROOT_DB_HOST","localhost");
//database username
define("ROOT_DB_USERNAME","root");
//database password
define("ROOT_DB_PASSWORD","");
//database name
define("ROOT_DB_NAME", "mtushimports");


//SECURE USER
/*this user is the nomal user to access the SQLiteDatabase
*Data   -SELECT
        -INSERT
        -UPDATE
        *DELETE
        *FILE

*Structure  -NO STRACTURE PERMISIONS

*Administration -NO ADMINISTRATION PERMISONS

*Resource limits  MAX QUERIES PER HOUR      unlimited
                  MAX UPDATES PER HOUR      unlimited
                  MAX CONNECTIONS PER HOUR  unlimited
                  MAX USER_CONNECTIONS      unlimited
*/
define("DB_HOST","localhost");
//database username
define("DB_USERNAME","user");
//database password
define("DB_PASSWORD","");
//database name
define("DB_NAME", "mtushimports");
