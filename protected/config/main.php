<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'Lishiz-beta',
    'sourceLanguage'=>'en_us',
    'language'=>'zh_cn',

	// preloading 'log' component
	'preload'=>array('log'),

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
	),

	'modules'=>array(
		// uncomment the following to enable the Gii tool

		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'123456',
			// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters'=>array('127.0.0.1','::1'),
		),

	),

	// application components
	'components'=>array(
		'user'=>array(
			// enable cookie-based authentication
			'allowAutoLogin'=>true,
            'loginUrl'=>'/user/login',
		),
		// uncomment the following to enable URLs in path-format

		'urlManager'=>array(
			'urlFormat'=>'path',
            'showScriptName'=>false,
            'rules'=>array(
				'<controller:\w+>/<id:\d+>'=>'<controller>/view',
				'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
			),
		),

        /*'db'=>array(
            'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/testdrive.db',
        ),*/
        // uncomment the following to use a MySQL database

        'db'=>array(
            'connectionString' => 'mysql:host=localhost;dbname=beta-lishiz',
            'emulatePrepare' => true,
            'username' => 'root',
            'password' => '',
            'charset' => 'utf8',
            'tablePrefix'=>'lsz_',
        ),

		'errorHandler'=>array(
			// use 'site/error' action to display errors
			'errorAction'=>'site/error',
		),
		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning',
				),
				// uncomment the following to show log messages on web pages
				/*
				array(
					'class'=>'CWebLogRoute',
				),
				*/
			),
		),
	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>array(
		// this is used in contact page
		'adminEmail'=>'admin@lishiz.com',
        'obj_type'=>array(
            'user'=>1,
            'post'=>2,
            'image'=>3,
            'book'=>4,
            'video'=>5,
            'topic'=>6,
            'comment'=>7
        ),
        'video_type'=>array(
            '1'=>'电影',
            '2'=>'电视剧',
            '3'=>'公开课',
            '4'=>'脱口秀',
            '5'=>'纪录片'
        ),
        'media_type'=>array(
            'image'=>1,
            'file'=>2,
            'video'=>3,
            'audio'=>4,
            'attachment'=>5
        ),
        'opt_type'=>array(
            'create'=>1,
            'update'=>2,
            'collect'=>3,
            'cancel_collect'=>4,
            'vote'=>5,
            'cancel_vote'=>6,
            'follow'=>7,
            'cancel_follow'=>8,
            'comment'=>9
        ),
        'user_grade'=>array(
            '1'=>'公士',
            '2'=>'上造',
            '3'=>'簪袅',
            '4'=>'不更',
            '5'=>'大夫',
            '6'=>'官大夫',
            '7'=>'公大夫',
            '8'=>'公乘',
            '9'=>'五大夫',
            '10'=>'左庶长',
            '11'=>'右庶长',
            '12'=>'左更',
            '13'=>'中更',
            '14'=>'右更',
            '15'=>'少上造',
            '16'=>'大上造',
            '17'=>'驷车庶长',
            '18'=>'大庶长',
            '19'=>'关内侯',
            '20'=>'彻侯',
            '21'=>'王',
            '22'=>'帝',
        )
	),
);