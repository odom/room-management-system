<?php

/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Reservation;

return array(
	'router' => array(
		'routes' => array(
			// Home Register //
			'home' => array(
				'type' => 'Zend\Mvc\Router\Http\Literal',
				'options' => array(
					'route' => '/',
					'defaults' => array(
						'controller' => 'main',
						'action' => 'index',
					),
				),
				'may_terminate' => true,
				'child_routes' => array(
					'default' => array(
						'type' => 'Segment',
						'options' => array(
							'route' => '[:controller[/:action[/:uid]]]',
							'constraints' => array(
								'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
								'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
								'uid' => '[0-9]+',
							),
						),
					),
				),
			),
			'admin' => array(
				'type' => 'Segment',
				'options' => array(
					'route' => '/admin[/]',
					'defaults' => array(
						'controller' => 'main',
						'action' => 'index',
					),
				),
				'may_terminate' => true,
				'child_routes' => array(
					'default' => array(
						'type' => 'Segment',
						'options' => array(
							'route' => '[:controller[/][:action[/][:uid]]]',
							'constraints' => array(
								'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
								'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
								'uid' => '[0-9]+',
							),
							'defaults' => array(
								'action' => 'index',
							),
						),
					),
				),
			),
		),
	),
	'controllers' => array(
		'invokables' => array(
			'main' => 'Reservation\Controller\MainController',
			'type' => 'Reservation\Controller\TypeController',
			'item' => 'Reservation\Controller\ItemController',
			'reservation' => 'Reservation\Controller\ReservationController',
			'calendar' => 'Reservation\Controller\CalendarController',
		),
	),
	'service_manager' => array(
		'factories' => array(
			'translator' => 'Zend\I18n\Translator\TranslatorServiceFactory',
		),
	),
	'translator' => array(
		'locale' => 'en_US',
		'translation_file_patterns' => array(
			array(
				'type' => 'gettext',
				'base_dir' => __DIR__ . '/../language',
				'pattern' => '%s.mo',
			),
		),
	),
	'session' => array(
		'save_path' => realpath(__DIR__ . '/../../../data/session'),
	),
	'view_manager' => array(
		'display_not_found_reason' => true,
		'display_exceptions' => true,
		'doctype' => 'HTML5',
		'not_found_template' => 'error/404',
		'exception_template' => 'error/index',
		'template_map' => array(
			'layout/layout' => __DIR__ . '/../view/layout/layout.phtml',
			'error/404' => __DIR__ . '/../view/error/404.phtml',
			'error/index' => __DIR__ . '/../view/error/index.phtml',
			'zfcuser/login' => __DIR__ . '/../view/zfcuser/login.phtml',
		),
		'template_path_stack' => array(
			'resourcems' => __DIR__ . '/../view',
			'zfcuser' => __DIR__ . '/../view',
		),
	),
	// Doctrine config
	'doctrine' => array(
		'driver' => array(
			__NAMESPACE__ . '_driver' => array(
				'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
				'cache' => 'array',
				'paths' => array(__DIR__ . '/../src/' . __NAMESPACE__ . '/Entity')
			),
			'orm_default' => array(
				'drivers' => array(
					__NAMESPACE__ . '\Entity' => __NAMESPACE__ . '_driver'
				),
			),
		),
	),
);
