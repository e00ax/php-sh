<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
/**
 * @home
 */
Route::get('/', function () {
    return view('home');
})->name('home');


/**
 * @door
 */
Route::get('/door', 'DoorController@index')->name('door.get');
Route::post('/door', 'DoorController@setDoorState')->name('door.post');
Route::get('/bell', 'DoorController@getBellState')->name('bell.get');
Route::post('/bell', 'DoorController@setBellState')->name('bell.post');
Route::post('/nuki', 'NukiController@setLockAction')->name('nuki.post');


/**
 * @hue
 */
// Lights
Route::post('/hue/quickSet', 'HueLightsController@quickSet')->name('hueQuickSet.post');
Route::get('/hue/lights', 'HueLightsController@lights')->name('hueLights.get');
Route::post('/hue/lights/setState', 'HueLightsController@setLightState')->name('hueLightsSetState.post');
Route::post('/hue/lights/rename', 'HueLightsController@renameLights')->name('hueLightsRename.post');
Route::get('/hue/lights/search', 'HueLightsController@search')->name('hueLightsSearch.get');
Route::post('/hue/lights/search', 'HueLightsController@searchLights')->name('hueLightsSearch.post');
Route::get('/hue/lights/delete', 'HueLightsController@delete')->name('hueLightsDelete.get');
Route::post('/hue/lights/delete', 'HueLightsController@deleteLights')->name('hueLightsDelete.post');
// Groups
Route::post('/hue/groups/quickSet', 'HueGroupsController@quickSet')->name('hueGroupsQuickSet.post');
Route::get('/hue/groups', 'HueGroupsController@groups')->name('hueGroups.get');
Route::post('/hue/groups/setState', 'HueGroupsController@setGroupState')->name('hueGroupsSetState.post');
Route::post('/hue/groups/scenes', 'HueGroupsController@setScenes')->name('hueGroupsScenes.post');
//Route::post('/hue/groups/effects', 'HueEffectsController@setEffects')->name('hueGroupsEffects.post');
Route::post('/hue/groups/modify', 'HueGroupsController@modifyGroups')->name('hueGroupsModify.post');
Route::get('/hue/groups/create', 'HueGroupsController@create')->name('hueGroupsCreate.get');
Route::post('/hue/groups/create', 'HueGroupsController@createGroups')->name('hueGroupsCreate.post');
Route::get('/hue/groups/delete', 'HueGroupsController@delete')->name('hueGroupsDelete.get');
Route::post('/hue/groups/delete', 'HueGroupsController@deleteGroups')->name('hueGroupsDelete.post');
// Sensors
Route::get('/hue/sensors', 'HueSensorsController@sensors')->name('hueSensors.get');
Route::get('/hue/sensors/search', 'HueSensorsController@search')->name('hueSensorsSearch.get');
Route::post('/hue/sensors/search', 'HueSensorsController@searchSensors')->name('hueSensorsSearch.post');
Route::get('/hue/sensors/delete', 'HueSensorsController@delete')->name('hueSensorsDelete.get');
Route::post('/hue/sensors/delete', 'HueSensorsController@deleteSensors')->name('hueSensorsDelete.post');
Route::get('/hue/sensors/rename', 'HueSensorsController@rename')->name('hueSensorsRename.get');
Route::post('/hue/sensors/rename', 'HueSensorsController@renameSensors')->name('hueSensorsRename.post');
// Rules
Route::get('/hue/rules', 'HueRulesController@rules')->name('hueRules.get');
Route::get('/hue/rules/create', 'HueRulesController@create')->name('hueRulesCreate.get');
Route::post('/hue/rules/create', 'HueRulesController@createRules')->name('hueRulesCreate.post');
Route::post('/hue/rules/select', 'HueRulesController@selectRules')->name('hueRulesSelect.post');
Route::get('/hue/rules/delete', 'HueRulesController@delete')->name('hueRulesDelete.get');
Route::post('/hue/rules/delete', 'HueRulesController@deleteRules')->name('hueRulesDelete.post');
Route::post('/hue/lights/update', 'HueRulesController@updateRules')->name('hueRulesUpdate.post');
    

/**
 * @heater
 */
Route::post('/heater/quickSet', 'HeaterController@quickSet')->name('heaterQuickSet.post');
Route::get('/heater/mode', 'HeaterController@mode')->name('heaterMode.get');
Route::post('/heater/mode', 'HeaterController@setMode')->name('heaterMode.post');
Route::get('/heater/cycles', 'HeaterController@cycles')->name('heaterCycles.get');
Route::post('/heater/cycles', 'HeaterController@setCycles')->name('heaterCycles.post');


/**
 * @ws2801
 */
Route::post('/ws2801', 'Ws2801Controller@setWs2801')->name('ws2801.post');


/**
 * @pagination
 */
Route::get('/pagination', 'PaginationController@index')->name('pagination.get');


/**
 * @canvasJs
 */
Route::get('/canvasJs', 'CanvasJsController@index')->name('canvasJs.get');
