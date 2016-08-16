<?php

return array(
    'router' => array(
        'routes' => array(
            'estoque' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/estoque[/:controller[/:action]]',
                    'constraints' => array(
                        'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                    ),
                    'defaults' => array(
                        '__NAMESPACE__' => 'Estoque\Controller',
                        'controller' => 'Index',
                        'action' => 'index',
                    ),
                ),
            ),
            'estoque_list' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/estoque[/:controller[/:page]]',
                    'constraints' => array(
                        'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'page' => '[0-9]*',
                    ),
                    'defaults' => array(
                        '__NAMESPACE__' => 'Estoque\Controller',
                        'controller' => 'Index',
                        'action' => 'index',
                        'page' => 1
                    ),
                ),
            ),
            'estoque_param' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/estoque[/:controller[/:action[/:id]]]',
                    'constraints' => array(
                        'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id' => '[0-9]*',
                    ),
                    'defaults' => array(
                        '__NAMESPACE__' => 'Estoque\Controller',
                        'controller' => 'Index',
                        'action' => 'index',
                    ),
                ),
            ),
        )
    ),
    'controllers' => array(
        'invokables' => array(
//            'Estoque\Controller\Index' => 'Estoque\Controller\\IndexController',
//            'Estoque\Controller\Usuario' => 'Estoque\Controller\UsuarioController',
        ),
        'factories' => array(
            'Estoque\Controller\Index' => 'Estoque\Controller\Factory\IndexControllerFactory',
            'Estoque\Controller\Usuario' => 'Estoque\Controller\Factory\UsuarioControllerFactory',
        ),
    ),
    'view_manager' => array(
//        'template_map' => array(
//            'layout/layout' => __DIR__ . '/../view/layout/layout-estoque.phtml',
//        ),
        'template_path_stack' => array(
            'estoque' => __DIR__ . "/../view/"
        ),
    ),
    'view_helpers' => array(
        'invokables' => array(
//            'FlashHelper' => 'Estoque\View\Helper\FlashHelper',
//            'PaginationHelper' => 'Estoque\View\Helper\PaginationHelper',
        ),
    ),
    'doctrine' => array(
        'driver' => array(
            // defines an annotation driver with two paths, and names it `my_annotation_driver`
            'my_annotation_driver' => array(
                'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                'cache' => 'array',
                'paths' => array(
                    __DIR__ . "/../src/Estoque/Entity"
                ),
            ),
            // default metadata driver, aggregates all other drivers into a single one.
            // Override `orm_default` only if you know what you're doing
            'orm_default' => array(
                'drivers' => array(
                    // register `my_annotation_driver` for any entity under namespace `My\Namespace`
                    'Estoque\Entity' => 'my_annotation_driver'
                ),
            ),
        ),
        'authentication' => array(
            'orm_default'=> array(
                'object_manager' => 'Doctrine\Orm\EntityManager',
                'identity_class' => 'Estoque\Entity\Usuario',
                'identity_property' => 'email',
                'credential_property' => 'senha',
                'credentialCallable' => function($user,$senha){
                    return $user->getSenha() == sha1($senha);
                }
            ),
        ),
    ),
);
