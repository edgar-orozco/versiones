<?php

Route::get('version',['as'=>'version', 'uses' => 'EdgarOrozco\Versiones\Controllers\VersionesController@getVersion']);
Route::get('actualizaciones',['as'=>'version.actualizaciones', 'uses' => 'EdgarOrozco\Versiones\Controllers\VersionesController@getActualizaciones']);
Route::post('version/cambiar',['as'=>'version.cambiar', 'uses' => 'EdgarOrozco\Versiones\Controllers\VersionesController@cambiarRama']);
Route::post('version/fetch',['as'=>'version.fetch', 'uses' => 'EdgarOrozco\Versiones\Controllers\VersionesController@fetch']);
Route::post('version/pull',['as'=>'version.pull', 'uses' => 'EdgarOrozco\Versiones\Controllers\VersionesController@pull']);
Route::post('version/migrate',['as'=>'version.migrate', 'uses' => 'EdgarOrozco\Versiones\Controllers\VersionesController@migrate']);
Route::post('version/composer-install',['as'=>'version.composer-install', 'uses' => 'EdgarOrozco\Versiones\Controllers\VersionesController@composerInstall']);
Route::post('version/status',['as'=>'version.status', 'uses' => 'EdgarOrozco\Versiones\Controllers\VersionesController@getStatus']);
