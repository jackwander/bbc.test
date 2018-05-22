<?php

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

Route::get('/', 'PagesController@index');
Route::resource('/settings/locations','LocationsController');
Route::resource('/settings/banks','BanksController');
Route::resource('/settings/users','UsersController');
Route::resource('/settings/userbranches','UserBranchesController');

Route::get('/findBranches','UserBranchesController@findBranches');
Route::get('/findUserBranches','UserBranchesController@findUserBranches');
Route::post('assign/branch', array('as'=>'assignBranch','uses'=>'UserBranchesController@assignBranch'));
/*
 * For Branches Route 
 */
Route::resource('/branches','BranchesController');

Route::get('branches/locations/{location_id}', 'BranchesController@pickBank');
Route::get('branches/locations/{location_id}/banks/{bank_id}', 'BranchesController@showBranches');
Route::get('branches/add/{location_id}&{bank_id}','BranchesController@create')->name('branches.create');
Route::get('branches/status/{status}/branch/{branch_id}', 'BranchesController@editBranchStatus');

Auth::routes();

Route::get('/dashboard', 'DashboardController@index');
