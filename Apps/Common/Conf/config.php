<?php
return array(
    'DEFAULT_MODULE' =>'Admin',
    'DEFAULT_CONTROLLER' =>'User',
    'URL_HTML_SUFFIX'=>'',
    'URL_MODEL' =>2, //URL模式
    'TMPL_PARSE_STRING'  =>array(
         '__Admin__' => 'Admin',
         '__User__' => 'Admin/User',
         '__Index__' => 'Admin/Index',
         '__BaseInfo__' => 'Admin/BaseInfo'
    ),
	'DB_FIELD_CACHE'=>false,
	'HTML_CACHE_ON'=>false,
	'TMPL_DENY_PHP'=>false,	
 	'DB_TYPE'               => 'mysql',     // 数据库类型
	'DB_HOST'               => 'localhost', // 服务器地址
	'DB_NAME'               => 'files_manage', // 数据库名
	'DB_USER'               => 'root',      // 用户名
	'DB_PWD'                => '',          // 密码
	'DB_PORT'               => '',        	// 端口
	'DB_PREFIX'             => 'fm_',    // 数据库表前缀
	'DB_CHARSET'            => 'utf8',     // 数据库编码默认采用utf8
	"LOAD_EXT_FILE"=>"admin"		
	//'配置项'=>'配置值'
);
?>