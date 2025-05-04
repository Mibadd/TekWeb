<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Auth::login'); // Route default ke halaman login
$routes->get('auth/login', 'Auth::login');
$routes->post('auth/login_post', 'Auth::login_post');
$routes->get('auth/signup', 'Auth::signup');
$routes->post('auth/signup_post', 'Auth::signup_post');
$routes->get('dashboard', 'Home::dashboard');
$routes->get('/auth/logout', 'Auth::logout');
