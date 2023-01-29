<?php

return [
    'router' => [
        'routes' => [
            'zf2-authentication' => [
                'type'    => 'Literal',
                'options' => [
                    'route'    => '/zf2-authentication',
                    'defaults' => [
                        'controller'    => 'ZF2Authentication\Controller\Index',
                        'action'        => 'index',
                    ],
                ],
                'may_terminate' => true,
                'child_routes'  => [
                    'default' => [
                        'type'      => 'Segment',
                        'options'   => [
                            'route'         => '[/:action]',
                            'constraints'   => [
                                'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                            ],
                        ],
                    ],
                ],
            ],
        ],
    ],
    'authentication_basic' => [
        'adapter' => [
            'config' => [
                'accept_schemes' => 'basic',
                'realm'          => 'authentication',
                'nonce_timeout'  => 3600,
            ],
            'basic'  => __DIR__.'/auth/basic.txt',
        ],
    ],
    'authentication_digest' => [
        'adapter' => [
            'config' => [
                'accept_schemes' => 'digest',
                'realm'          => 'authentication',
                'digest_domains' => '/zf2-authentication/digest',
                'nonce_timeout'  => 3600,
            ],
            'digest' => __DIR__.'/auth/digest.txt',
        ],
    ],
    'service_manager' => [
        'factories' => [
            'ZF2Authentication\BasicAuthenticationAdapter' => 'ZF2Authentication\Factory\BasicAuthenticationAdapterFactory',
            'ZF2Authentication\DigestAuthenticationAdapter' => 'ZF2Authentication\Factory\DigestAuthenticationAdapterFactory',
        ],
    ],

    'controllers' => [
        'invokables' => [
            'ZF2Authentication\Controller\Index' => 'ZF2Authentication\Controller\IndexController',
        ],
    ],

    'view_manager' => [
        'template_path_stack' => [
            __DIR__.'/../view',
        ],
    ],
];
