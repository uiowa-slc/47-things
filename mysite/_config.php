<?php

global $project;
$project = 'mysite';

global $databaseConfig;
$databaseConfig = array(
	"type" => 'MySQLDatabase',
	"server" => 'localhost',
	"username" => '47things',
	"password" => 'HszUAUB7TBqRt4H4',
	"database" => '47things',
	"path" => '',
);

MySQLDatabase::set_connection_charset('utf8');

// This line set's the current theme. More themes can be
// downloaded from http://www.silverstripe.org/themes/
SSViewer::set_theme('blackcandy');

// Set the site locale
i18n::set_locale('en_US');

// enable nested URLs for this site (e.g. page/sub-page/)
SiteTree::enable_nested_urls();


Director::set_environment_type("dev");
Object::add_extension('Member', 'ThingsMember');
Authenticator::unregister('MemberAuthenticator');
Authenticator::set_default_authenticator('FacebookAuthenticator');



//FacebookConnect::set_api_key('269367499778251'); 
FacebookConnect::set_api_secret('40e878c3aa8a81bb0c92c4c7e990bb76'); 
FacebookConnect::set_app_id('269367499778251'); 
FacebookConnect::set_lang('en_US');

/*RecaptchaField::$public_api_key = '6LciYb8SAAAAAAQbOZzL5o3uqCygC3qmtFIppRkF';
RecaptchaField::$private_api_key = '6LciYb8SAAAAAAiHTl1-SV0qdUg6nIw9qN98Syxv';
SpamProtectorManager::set_spam_protector("RecaptchaProtector");*/