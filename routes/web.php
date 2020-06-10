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


Route::group(['middleware' => ['install']], function () {

	Auth::routes();
	Route::get('/logout', '\App\Http\Controllers\Auth\LoginController@logout');

	//Frontend Route
	Route::get('/','Theme\ThemeController@index');
	Route::post('/','Theme\ThemeController@index');

	//Language setting
	Route::get('fr/{path?}','Theme\ThemeController@fr');
	Route::get('en/{path?}','Theme\ThemeController@en');

	Route::get('properties/{id?}/{title?}','Theme\ThemeController@property');
	Route::get('buy','Theme\ThemeController@buy');
	Route::get('rent','Theme\ThemeController@rent');

	Route::get('our_region','Theme\ThemeController@our_region');
	Route::get('evaluation','Theme\ThemeController@evaluation');
	Route::get('careers','Theme\ThemeController@careers');
	Route::get('sell_property','Theme\ThemeController@sell_property');

	Route::get('resources','Theme\ThemeController@resources');
	Route::get('resources_sellers','Theme\ThemeController@resources_sellers');
	Route::get('resources_buyers','Theme\ThemeController@resources_buyers');

	Route::get('filter','Theme\ThemeController@filter');
	Route::get('search','Theme\ThemeController@search');
	Route::get('blog/{id?}/{title?}','Theme\ThemeController@blog');
	Route::get('blog_category/{catid}/{category}','Theme\ThemeController@blog_category');
	Route::get('about','Theme\ThemeController@about');
	Route::get('our_agents','Theme\ThemeController@our_agents');
	Route::get('contact','Theme\ThemeController@contact');
	Route::post('send_message','Theme\ThemeController@send_message');
	Route::post('contact_agent/{property_id}','Theme\ThemeController@contact_agent');
	Route::get('terms','Theme\ThemeController@terms');
	Route::get('privacy','Theme\ThemeController@privacy');

	Route::get('api/inscriptions/{api_key}/{agent_id}','Api\ApiController@inscriptions');
	Route::get('api/markers/{geolong}/{geolat}','Api\ApiController@markers');

	Route::group(['middleware' => ['auth']], function () {

		Route::get('/dashboard', 'DashboardController@index');

		//Profile Controller
		Route::get('profile/edit', 'ProfileController@edit');
		Route::post('profile/update', 'ProfileController@update');
		Route::get('profile/change_password', 'ProfileController@change_password');
		Route::post('profile/update_password', 'ProfileController@update_password');


		//Property Controller
		Route::get('property/gallery/{id}','PropertyController@gallery');
		Route::post('property/upload_gallery_images','PropertyController@upload_gallery_images');
		Route::get('property/delete_gallery_image/{id}','PropertyController@delete_gallery_image');
		Route::resource('property','PropertyController');

		//Location Controller
		Route::resource('locations','LocationController');

		//Benefit Controller
		Route::resource('benefits','BenefitController');

		//Property Type Controller
		Route::resource('property_types','PropertyTypeController');

		//Agent Controller
		Route::resource('agents','AgentController');

		//Blog Category
		Route::resource('blog_categories','BlogCategoryController');

        //Blog Controller
		Route::resource('blog_posts','BlogController');

        //FAQ Controller
		Route::resource('faqs','FaqController');


		Route::group(['middleware' => ['admin']], function () {
			//User Controller
			Route::resource('users','UserController');

			//Language Controller
			Route::resource('languages','LanguageController');

			//Utility Controller
			Route::match(['get', 'post'],'administration/general_settings/{store?}', 'UtilityController@settings')->name('general_settings.update');
			Route::match(['get', 'post'],'administration/theme_option/{store?}', 'UtilityController@theme_option')->name('theme_option.update');
			Route::post('administration/upload_logo', 'UtilityController@upload_logo')->name('general_settings.update');
			Route::post('administration/upload_favicon', 'UtilityController@upload_favicon')->name('general_settings.update');
			Route::get('administration/backup_database', 'UtilityController@backup_database')->name('utility.backup_database');
		});
	});

});
