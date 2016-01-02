<?php


get('/', [
    'uses'  => 'IndexController@index',
    'as'    => 'guest.index.index',
    'middleware'    => 'guest'
]);

Route::group(['namespace'   => 'Participant'], function() {

    get('/register', [
        'uses'  => 'AuthController@getRegister',
        'as'    => 'participant.auth.getRegister'
    ]);
    post('/register', [
        'uses'  =>  'AuthController@postRegister',
        'as'    =>  'participant.auth.postRegister'
    ]);
    get('/login', [
        'uses'  => 'AuthController@getLogin',
        'as'    => 'participant.auth.getLogin'
    ]);
    post('/login', [
        'uses'  => 'AuthController@postLogin',
        'as'    => 'participant.auth.postLogin'
    ]);

    Route::group(['middleware'  => 'auth.participant'], function() {

        get('/home', [
            'uses'  => 'HomeController@index',
            'as'    => 'participant.home.index'
        ]);

        get('/logout', [
            'uses'  => 'AuthController@getLogout',
            'as'    => 'participant.auth.getLogout'
        ]);
    });

});

Route::group(['namespace'   => 'Admin', 'prefix'    => 'admin'], function() {
    get('/register', [
        'uses'  => 'AuthController@getRegister',
        'as'    => 'admin.auth.getRegister'
    ]);
    post('/register', [
        'uses'  =>  'AuthController@postRegister',
        'as'    =>  'admin.auth.postRegister'
    ]);
    get('/login', [
        'uses'  => 'AuthController@getLogin',
        'as'    => 'admin.auth.getLogin'
    ]);
    post('/login', [
        'uses'  => 'AuthController@postLogin',
        'as'    => 'admin.auth.postLogin'
    ]);

    Route::group(['middleware'  => 'auth.admin'], function() {

        get('/logout', [
            'uses'  => 'AuthController@getLogout',
            'as'    => 'admin.auth.getLogout'
        ]);

        get('/home', [
            'uses'  => 'HomeController@index',
            'as'    => 'admin.home.index'
        ]);

        Route::group(['prefix' => 'exam'], function() {

            get('/', [
                'uses'  => 'ExamController@index',
                'as'    => 'admin.exam.index'
            ]);

            get('/create', [
                'uses'  => 'ExamController@create',
                'as'    => 'admin.exam.create'
            ]);

        });

    });

});

