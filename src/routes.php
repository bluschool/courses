<?php

use Illuminate\Routing\Router;
use Orchestra\Support\Facades\Foundation;

/*
|--------------------------------------------------------------------------
| Routing
|--------------------------------------------------------------------------
*/

Foundation::group('bluschool/courses', 'courses', ['namespace' => 'Bluschool\Courses\Http\Controllers'], function (Router $router) {

    $router->post('courses/create', 'CoursesController@store');
    $router->get('courses/create', 'CoursesController@create');
    $router->get('courses/update/{id}', 'CoursesController@update');
    $router->get('courses/delete/{id}', 'CoursesController@delete');
    $router->get('courses/manageall', 'CoursesController@manageall');
    $router->get('courses/common', 'CoursesController@common');
    $router->get('courses/admin', 'CoursesController@index');
    $router->get('/', 'HomeController@index');

});