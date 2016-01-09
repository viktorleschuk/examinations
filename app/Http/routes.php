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

        get('/participants', [
            'uses'  => 'HomeController@participants',
            'as'    => 'admin.participants.list'
        ]);

        get('/exams', [
            'uses'  => 'HomeController@exams',
            'as'    => 'admin.exams.index'
        ]);

        Route::group(['prefix' => 'exam', 'namespace' => 'Exam'], function() {

            get('/create', [
                'uses'  => 'IndexController@create',
                'as'    => 'admin.exam.create'
            ]);

            post('/create', [
               'uses'   => 'IndexController@postCreate',
                'as'    => 'admin.exam.postCreate'
            ]);

            get('/{exam}', [
               'uses'   => 'InfoController@index',
                'as'    => 'admin.exam.info'
            ]);

            get('/{exam}/questions', [
                'uses'  =>  'QuestionController@index',
                'as'    =>  'admin.exam.questions'
            ]);

            get('/{exam}/question/create', [
                'uses'  =>  'QuestionController@createQuestion',
                'as'    =>  'admin.exam.question.create'
            ]);

            post('/{exam}/question/create', [
                'uses'  =>  'QuestionController@postCreateQuestion',
                'as'    =>  'admin.exam.question.postCreate'
            ]);

            get('/{exam}/question/{question}/edit', [
                'uses'  =>  'QuestionController@edit',
                'as'    =>  'admin.exam.question.edit'
            ]);

            post('/{exam}/question/{question}/edit', [
                'uses'  =>  'QuestionController@postEdit',
                'as'    =>  'admin.exam.question.postEdit'
            ]);

            get('/{exam}/question/{question}/delete', [
                'uses'  =>  'QuestionController@delete',
                'as'    =>  'admin.exam.question.delete'
            ]);

            get('/{exam}/settings', [
                'uses'  =>  'SettingController@index',
                'as'    =>  'admin.exam.setting'
            ]);
        });

    });

});

