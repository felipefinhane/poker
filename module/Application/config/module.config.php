<?php

/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */
return array(
  'router' => array(
    'routes' => array(
      'home' => array(
        'type' => 'Zend\Mvc\Router\Http\Literal',
        'options' => array(
          'route' => '/',
          'defaults' => array(
            '__NAMESPACE__' => 'Application\Controller',
            'controller' => 'Index',
            'action' => 'index',
            ),
          ),
        ),
      // The following is a route to simplify getting started creating
      // new controllers and actions without needing to create a new
      // module. Simply drop new controllers in, and you can access them
      // using the path /application/:controller/:action
      'application' => array(
        'type' => 'Literal',
        'options' => array(
          'route' => '/application',
          'defaults' => array(
            '__NAMESPACE__' => 'Application\Controller',
            'controller' => 'Index',
            'action' => 'index',
            ),
          ),
        'may_terminate' => true,
        'child_routes' => array(
          'default' => array(
            'type' => 'Segment',
            'options' => array(
              'route' => '/[:controller[/:action]]',
              'constraints' => array(
                'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                ),
              'defaults' => array(
                ),
              ),
            ),
          ),
        ),
      'partida_campeonato_new' => array(
        // 'type' => 'Zend\Mvc\Router\Http\Literal',
        'type' => 'Segment',
        'options' => array(
          'route' => '/partida/:idCampeonato/new',
          'constraints' => array(
            'idCampeonato' => '[0-9]+',
            ), 
          'defaults' => array(
            '__NAMESPACE__' => 'Application\Controller',
            'controller' => 'Partida',
            'action' => 'new',
            ),
          ),
        ),
      'partida_campeonato_edit' => array(
        // 'type' => 'Zend\Mvc\Router\Http\Literal',
        'type' => 'Segment',
        'options' => array(
          'route' => '/partida/:idCampeonato/edit/:idPartida',
          'constraints' => array(
            'idCampeonato' => '[0-9]+',
            'idPartida' => '[0-9]+',
            ),
          'defaults' => array(
            '__NAMESPACE__' => 'Application\Controller',
            'controller' => 'Partida',
            'action' => 'edit',
            ),
          ),
        ),
      'partida_campeonato_manage' => array(
        // 'type' => 'Zend\Mvc\Router\Http\Literal',
        'type' => 'Segment',
        'options' => array(
          'route' => '/partida/:idCampeonato/manage/:idPartida',
          'constraints' => array(
            'idCampeonato' => '[0-9]+',
            'idPartida' => '[0-9]+',
            ),
          'defaults' => array(
            '__NAMESPACE__' => 'Application\Controller',
            'controller' => 'Partida',
            'action' => 'manage',
            ),
          ),
        ),
      'padrao' => array(
        'type' => 'Segment',
        'options' => array(
          'route' => '/[:controller[/:action[/:id[/:id_aux]]]]',
          'constraints' => array(
            'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
            'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
            'id' => '[0-9]*',
            'id_aux' => '[0-9]*',
            ),
          'defaults' => array(
            '__NAMESPACE__' => 'Application\Controller',
            'controller' => 'Index',
            'action' => 'index',
            ),
          ),
        ),
      'listagem' => array(
        'type' => 'Segment',
        'options' => array(
          'route' => '/[:controller[/:page]]',
          'constraints' => array(
            'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
            'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
            'page' => '[0-9]*',
            ),
          'defaults' => array(
            '__NAMESPACE__' => 'Application\Controller',
            'controller' => 'Index',
            'action' => 'index',
            'page' => 1
            ),
          ),
        ),
      'partida_campeonato' => array(
        // 'type' => 'Zend\Mvc\Router\Http\Literal',
        'type' => 'Segment',
        'options' => array(
          'route' => '/partida/:idCampeonato[/:page]',
          'constraints' => array(
            'idCampeonato' => '[0-9]+',
            'page' => '[0-9]*',
            ), 
          'defaults' => array(
            '__NAMESPACE__' => 'Application\Controller',
            'controller' => 'Partida',
            'action' => 'index',
            'page' => 1,
            ),
          ),
        ),
      'login' => array(
        'type' => 'Literal',
        'options' => array(
          'route' => '/login',
          'defaults' => array(
            '__NAMESPACE__' => 'Application\Controller',
            'controller' => 'Usuario',
            'action' => 'login'
            ),
          ),
        ),
      'logout' => array(
        'type' => 'Literal',
        'options' => array(
          'route' => '/logout',
          'defaults' => array(
            '__NAMESPACE__' => 'Application\Controller',
            'controller' => 'Usuario',
            'action' => 'logout'
            ),
          ),
        ),
      ),
),
'service_manager' => array(
  'abstract_factories' => array(
    'Zend\Cache\Service\StorageCacheAbstractServiceFactory',
    'Zend\Log\LoggerAbstractServiceFactory',
    ),
  'aliases' => array(
    'translator' => 'MvcTranslator',
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
'controllers' => array(
  'invokables' => array(
    'Application\Controller\Index' => 'Application\Controller\IndexController',
    ),
  'factories' => array(
//            'Application\Controller\Index'      => 'Application\Factory\IndexControllerFactory',
    'Application\Controller\Usuario' => 'Application\Factory\UsuarioControllerFactory',
    'Application\Controller\Campeonato' => 'Application\Factory\CampeonatoControllerFactory',
    'Application\Controller\Partida' => 'Application\Factory\PartidaControllerFactory',
    'Application\Controller\Ajax' => 'Application\Factory\AjaxControllerFactory',
    ),
  ),
'view_helpers' => array(
  'invokables' => array(
    'MenuHelper' => 'Application\View\Helper\MenuHelper',
    'FlashHelper' => 'Application\View\Helper\FlashHelper',
    'PaginationHelper' => 'Application\View\Helper\PaginationHelper',
    ),
  ),
'view_manager' => array(
  'display_not_found_reason' => true,
  'display_exceptions' => true,
  'doctype' => 'HTML5',
  'not_found_template' => 'error/404',
  'exception_template' => 'error/index',
  'template_map' => array(
    'layout/layout' => __DIR__ . '/../view/layout/layout.phtml',
    'application/index/index' => __DIR__ . '/../view/application/index/index.phtml',
    'error/404' => __DIR__ . '/../view/error/404.phtml',
    'error/index' => __DIR__ . '/../view/error/index.phtml',
    ),
  'template_path_stack' => array(
    __DIR__ . '/../view',
    ),
  ),
  // Placeholder for console routes
'console' => array(
  'router' => array(
    'routes' => array(
      ),
    ),
  ),
'doctrine' => array(
  'driver' => array(
      // defines an annotation driver with two paths, and names it `my_annotation_driver`
    'my_annotation_driver' => array(
      'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
      'cache' => 'array',
      'paths' => array(
        __DIR__ . "/../src/Application/Entity"
        ),
      ),
      // default metadata driver, aggregates all other drivers into a single one.
      // Override `orm_default` only if you know what you're doing
    'orm_default' => array(
      'drivers' => array(
          // register `my_annotation_driver` for any entity under namespace `My\Namespace`
        'Application\Entity' => 'my_annotation_driver'
        )
      )
    ),
  'authentication' => [
  'orm_default' => [
  'object_manager' => 'Doctrine\ORM\EntityManager',
  'identity_class' => 'Application\Entity\Usuario',
  'identity_property' => 'email',
  'credential_property' => 'senha',
  'credentialCallable' => function($user, $password) {
    return $user->getSenha() == sha1($password);
  }
  ]
  ]
  )
);
