<?php

//DEFAULT APP CONFIGURATIONS
//Application name
define('APPNAME','Mtush');
//developer
define('DEVELOPER','Peter Kimani Mwaura');
//path to root
define('ROOT','http://admin.local');
//path to root
define('USER_ROOT', 'http://test.local/');
//path to php file
define('APPPATH',ROOT.'/Res/Php/');



//RESC0URCES
//path to Recources
define('IMAGES',ROOT.'/Res/Images/');
//path to System Images
define('SYS_IMAGES', IMAGES.'Systemimages/');
//path to profile Images
define('PROF_IMAGES',ROOT.'/Res/Images/Profile/');
//path to System Video
define('VIDEO',ROOT.'/Res/Video/');
//path to other
define('PATH_OTHER',ROOT.'/Res/Other/');




//ADMINISTRATOR USER DATEBASE
//databse host
define("ROOT_DB_HOST","localhost");
//database username
define("ROOT_DB_USERNAME","root");
//database password
define("ROOT_DB_PASSWORD","");
//database name
define("ROOT_DB_NAME","mtushImports");





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
define("DB_HOST", "localhost");
//database username
define("DB_USERNAME", "user");
//database password
define("DB_PASSWORD", "");
//database name
define("DB_NAME", "mtushImports");
