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
            'uses'  => 'ParticipantsController@index',
            'as'    => 'admin.participants.list'
        ]);

        get('/exams', [
            'uses'  => 'IndexController@index',
            'as'    => 'admin.exams.index'
        ]);

        Route::group(['prefix' => 'exam', 'namespace' => 'Exam'], function() {

            get('/create', [
                'uses'  => 'CreateController@create',
                'as'    => 'admin.exam.create'
            ]);

            post('/create', [
               'uses'   => 'CreateController@postCreate',
                'as'    => 'admin.exam.postCreate'
            ]);

            get('/{exam}', [
               'uses'   => 'ViewController@view',
                'as'    => 'admin.exam.view'
            ]);

            get('/{exam}/participants', [
               'uses'   => 'ParticipantsController@index',
                'as'    => 'admin.exam.participants'
            ]);

            get('/{exam}/questions', [
                'uses'  =>  'QuestionController@index',
                'as'    =>  'admin.exam.questions'
            ]);

            get('/{exam}/question/create', [
                'uses'  =>  'QuestionController@create',
                'as'    =>  'admin.exam.question.create'
            ]);

            post('/{exam}/question/create', [
                'uses'  =>  'QuestionController@postCreate',
                'as'    =>  'admin.exam.question.postCreate'
            ]);

            get('/{exam}/question/{question}/edit', [
                'uses'  =>  'QuestionController@edit',
                'as'    =>  'admin.exam.question.edit'
            ]);

            post('/{exam}/question/{question}/update', [
                'uses'  =>  'QuestionController@update',
                'as'    =>  'admin.exam.question.update'
            ]);

            get('/{exam}/question/{question}/delete', [
                'uses'  =>  'QuestionController@delete',
                'as'    =>  'admin.exam.question.delete'
            ]);

            get('/{exam}/question/{question}/answer/new', [
                'uses'  =>  'AnswerController@create',
                'as'    =>  'admin.exam.question.answer.create'
            ]);

            post('/{exam}/question/{question}/answer/create', [
                'uses'  =>  'AnswerController@postCreate',
                'as'    =>  'admin.exam.question.answer.postCreate'
            ]);

            get('/{exam}/question/{question}/view', [
                'uses'  => 'QuestionController@view',
                'as'    => 'admin.exam.question.view'
            ]);

            get('/{exam}/settings', [
                'uses'  =>  'SettingController@index',
                'as'    =>  'admin.exam.setting'
            ]);
        });

    });

});

