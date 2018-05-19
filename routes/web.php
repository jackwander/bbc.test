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


// Route::get('/settings/banks/{bank_id}/locations/{location_id}', [
//     'as' => 'branches.show', 
//     'uses' => 'BranchesController@branchesLocation'
// ]);

/*
 * For Branches Route 
 */
Route::resource('/settings/branches','BranchesController');
Route::get('settings/branches/locations/{location_id}', 'BranchesController@pickBank');
Route::get('settings/branches/locations/{location_id}/banks/{bank_id}', 'BranchesController@showBranches');
Route::get('branches/add/{location_id}&{bank_id}','BranchesController@create')->name('settings.branches.create');
Route::get('settings/branches/status/{status}/branch/{branch_id}', 'BranchesController@editBranchStatus');



Auth::routes();

Route::get('/dashboard', 'DashboardController@index');
