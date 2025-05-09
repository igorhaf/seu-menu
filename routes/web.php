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
Route::group(['namespace' => 'App\Http\Controllers', 'middleware' => ['web']], function(){
    Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
    Route::post('login', 'Auth\LoginController@login');
    Route::get('register/{plan?}', 'Auth\RegisterController@showRegistrationForm')->name('register');
    Route::post('register', 'Auth\RegisterController@register');
    Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
    Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
    Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
    Route::post('password/reset', 'Auth\ResetPasswordController@reset')->name('password.update');
    Route::get('email/verify', 'Auth\VerificationController@show')->name('verification.notice');
    Route::get('email/verify/{id}', 'Auth\VerificationController@verify')->name('verification.verify');
    Route::get('email/resend', 'Auth\VerificationController@resend')->name('verification.resend');


    Route::get('/auth/redirect/facebook', 'SocialController@redirectFacebook');
    Route::get('/callback/facebook', 'SocialController@callbackFacebook');
    Route::get('/redirect', 'SocialController@redirectGoogle');
    Route::get('/callback', 'SocialController@callbackGoogle');

    Route::prefix('admin')->group(function () {

        //topbar routes

        Route::get('/logout', 'Auth\LoginController@logout')->name('logout');
        Route::get('/profile/user', 'ProfileController@userProfile')->name('user-profile');
        Route::post('/profile/update-tenant/{id}', 'ProfileController@userProfileUpdate')->name('user-profile-update');
        Route::get('/profile/payment', 'ProfileController@paymentProfile')->name('payment-profile');


        //dashboard
        Route::get('/', function () {
            return redirect(route('admin-order-index'));
        });

        Route::get('/dashboard', 'HomeController@index')->name('home');
        Route::post('/dashboard/whatsapp/update', 'HomeController@updateWhatsapp')->name('admin-dashboard-update-whatsapp');
        Route::post('/dashboard/instagram/update', 'HomeController@updateInstagram')->name('admin-dashboard-update-instagram');
        Route::post('/dashboard/googlemaps/update', 'HomeController@updateGooglemaps')->name('admin-dashboard-update-google-maps');
        Route::post('/dashboard/facebook/update', 'HomeController@updateFacebook')->name('admin-dashboard-update-facebook');
        Route::post('/dashboard/facebook/update', 'HomeController@updateFacebook')->name('admin-dashboard-update-facebook');
        Route::post('/dashboard/prevision/update', 'HomeController@updatePrevision')->name('admin-dashboard-update-prevision');
        Route::post('/dashboard/minimalorder/update', 'HomeController@updateMinimalOrder')->name('admin-dashboard-update-minimal-order');
        //menu
        Route::get('/menu', 'MenuController@index')->name('admin-menu');

        //menu categories
        Route::post('/menu/category/store', 'MenuCategoriesController@store')->name('admin-store-menu-category');
        Route::post('/menu/category/update', 'MenuCategoriesController@update')->name('admin-update-menu-category');
        Route::post('/menu/category/reposition', 'MenuCategoriesController@reposition')->name('menu-category-reposition');
        Route::get('/menu/category/change-visibility/{id}', 'MenuCategoriesController@changeVisibility')->name('admin-change-visibility-menu-category');
        Route::get('/menu/category/delete/{id?}', 'MenuCategoriesController@destroy')->name('admin-delete-menu-category');

        //menu itens
        Route::get('/menu/item/manage/{id}', 'MenuItensController@manage')->name('admin-manage-menu-item');
        Route::post('/menu/item/store', 'MenuItensController@store')->name('admin-store-menu-item');
        Route::post('/menu/item/update/{id}', 'MenuItensController@update')->name('admin-update-menu-item');
        Route::post('/menu/item/reposition', 'MenuItensController@reposition')->name('menu-item-reposition');
        Route::get('/menu/item/change-visibility/{id}', 'MenuItensController@changeVisibility')->name('admin-change-visibility-menu-item');
        Route::get('/menu/item/delete/{id}', 'MenuItensController@destroy')->name('admin-delete-menu-item');
        Route::post('/menu/item/change-combo-limit/{id}', 'MenuItensController@changeComboLimit')->name('admin-change-combo-limit-menu-item');



        //menu itens additional
        Route::post('/menu/item/additional/store', 'ItemAdditionalsController@store')->name('admin-item-additional-store');
        Route::post('/menu/item/additional/update', 'ItemAdditionalsController@update')->name('admin-item-additional-update');
        Route::post('/menu/item/additional/reposition', 'ItemAdditionalsController@reposition')->name('admin-item-additional-reposition');
        Route::get('/menu/item/additional/change-visibility/{id}', 'ItemAdditionalsController@changeVisibility')->name('admin-item-additional-change-visibility');
        Route::get('/menu/item/additional/delete/{id?}', 'ItemAdditionalsController@delete')->name('admin-delete-item-additional');


        //menu itens variable
        Route::post('/menu/item/variable/store', 'ItemVariablesController@store')->name('admin-item-variable-store');
        Route::post('/menu/item/variable/update', 'ItemVariablesController@update')->name('admin-update-item-variable');
        Route::post('/menu/item/variable/reposition', 'ItemVariablesController@reposition')->name('admin-item-variable-reposition');
        Route::get('/menu/item/variable/change-visibility/{id}', 'ItemVariablesController@changeVisibility')->name('admin-item-variable-change-visibility');
        Route::get('/menu/item/variable/delete/{id?}', 'ItemVariablesController@delete')->name('admin-delete-item-variable');


        //menu itens combo
        Route::post('/menu/item/combo/store', 'CombosController@store')->name('admin-combo-store');
        Route::post('/menu/item/combo/update', 'CombosController@update')->name('admin-combo-update');
        Route::post('/menu/item/combo/reposition', 'CombosController@reposition')->name('admin-combo-reposition');
        Route::get('/menu/item/combo/change-visibility/{id}', 'CombosController@changeVisibility')->name('admin-combo-change-visibility');
        Route::get('/menu/item/combo/delete/{id?}', 'CombosController@delete')->name('admin-delete-combo');

        // item variable options
        Route::post('/menu/item/variable/option/store', 'VariableOptionsController@store')->name('admin-variable-option-store');
        Route::post('/menu/item/variable/option/update', 'VariableOptionsController@update')->name('admin-update-variable-option');
        Route::post('/menu/item/variable/option/reposition', 'VariableOptionsController@reposition')->name('admin-variable-option-reposition');
        Route::get('/menu/item/variable/option/change-visibility/{id}', 'VariableOptionsController@changeVisibility')->name('admin-variable-option-change-visibility');
        Route::get('/menu/item/variable/option/dorderselete/{id?}', 'VariableOptionsController@delete')->name('admin-delete-item-variable-option');

        //delivery
        Route::get('/delivery', 'DeliveryController@index')->name('admin-delivery-points');
        Route::post('/delivery/change-pickup', 'DeliveryController@updatePickup')->name('admin-change-pickup');
        Route::post('/delivery/change-delivery', 'DeliveryController@updateDelivery')->name('admin-change-delivery');
        Route::post('/delivery/change-free-delivery', 'DeliveryController@changeFreeDelivery')->name('admin-change-free-delivery');
        Route::post('/delivery/free-delivery/update', 'DeliveryController@updateFreeDelivery')->name('admin-update-free-delivery');


        //delivery points
        Route::post('/delivery/cities/store', 'DeliveryCitiesController@store')->name('admin-store-delivery-cities');
        Route::post('/delivery/cities/update', 'DeliveryCitiesController@update')->name('admin-update-delivery-cities');
        Route::post('/delivery/cities/reposition', 'DeliveryCitiesController@reposition')->name('admin-reposition-delivery-cities');
        Route::get('/delivery/cities/change-visibility/{id}', 'DeliveryCitiesController@changeVisibility')->name('admin-delivery-cities-change-visibility');
        Route::get('/delivery/cities/delete/{id?}', 'DeliveryCitiesController@delete')->name('admin-delete-delivery-city');


        //delivery points
        Route::post('/delivery/points/store', 'DeliveryPointsController@store')->name('admin-store-delivery-points');
        Route::post('/delivery/points/update', 'DeliveryPointsController@update')->name('admin-update-delivery-points');
        Route::post('/delivery/points/reposition', 'DeliveryPointsController@reposition')->name('admin-reposition-delivery-points');
        Route::get('/delivery/points/change-visibility/{id}', 'DeliveryPointsController@changeVisibility')->name('admin-delivery-points-change-visibility');
        Route::get('/delivery/points/delete/{id?}', 'DeliveryPointsController@delete')->name('admin-delete-delivery');


        //payments methods
        Route::get('/payment-methods', 'PaymentsController@index')->name('admin-payments');
        Route::post('/payment-methods/store', 'PaymentsController@store')->name('admin-store-payment');
        Route::post('/payment-methods/update', 'PaymentsController@update')->name('admin-update-payment');
        Route::post('/payment-methods/credit-reposition', 'PaymentsController@creditReposition')->name('payment-credit-reposition');
        Route::post('/payment-methods/debit-reposition', 'PaymentsController@debitReposition')->name('payment-debit-reposition');
        Route::post('/payment-methods/voucher-reposition', 'PaymentsController@voucherReposition')->name('payment-voucher-reposition');
        Route::get('/payment-methods/change-visibility/{id}', 'PaymentsController@changeVisibility')->name('admin-change-visibility-payment');
        Route::get('/payment-methods/delete/{id?}', 'PaymentsController@delete')->name('admin-delete-menu-payment');
        Route::post('/payment-methods/change-money-accept', 'PaymentsController@updateAcceptMoney')->name('admin-change-accept-money');

        //schedule
        Route::get('/schedule', 'SchedulesController@index')->name('admin-schedule-index');
        Route::post('/schedule/layout', 'SchedulesController@layout')->name('admin-schedule-layout');
        Route::get('/schedule/change-visibility/{day}', 'SchedulesController@changeVisibility')->name('admin-schedule-change-visibility');
        Route::get('/schedule/change-visibility/item/{id}', 'SchedulesController@changeVisibilitySchedule')->name('admin-schedule-change-item-visibility');
        Route::post('/schedule/store', 'SchedulesController@store')->name('admin-schedule-store');
        Route::post('/schedule/update', 'SchedulesController@update')->name('admin-update-schedule');
        Route::get('/schedule/delete/{id?}', 'SchedulesController@delete')->name('admin-delete-schedule');

        //layout
        Route::get('/layout', 'LayoutController@index')->name('admin-layout-index');
        Route::get('/layout/grapesjs', 'LayoutController@grapesjs')->name('admin-layout-grapesjs');
        Route::post('/layout/cache/logo', 'LayoutController@saveTempLogo')->name('admin-layout-cache-logo');
        Route::post('/layout/update', 'LayoutController@updateLayout')->name('admin-layout-update');
        Route::post('/layout/cache/background', 'LayoutController@saveTempBackground')->name('admin-layout-cache-background');
        Route::post('/layout/cache/header', 'LayoutController@saveTempHeader')->name('admin-layout-cache-header');

        //orders
        Route::get('/orders', 'OrdersController@index')->name('admin-order-index');
        Route::get('/orders/{id?}', 'OrdersController@show')->name('admin-order-show');
        Route::get('/orders/edit/{id}', 'OrdersController@edit')->name('admin-order-edit');
        Route::get('/orders/rejected/{id?}', 'OrdersController@rejected')->name('admin-order-rejected');
        Route::get('/orders/accepted/{id?}', 'OrdersController@accepted')->name('admin-order-accepted');
        Route::get('/orders/sent/{id?}', 'OrdersController@sent')->name('admin-order-sent');
        Route::get('/orders/delivered/{id?}', 'OrdersController@delivered')->name('admin-order-delivered');

        //customers
        Route::get('/customers', 'CustomersController@index')->name('admin-customer-index');
        Route::get('/customers/{id}', 'CustomersController@show')->name('admin-customer-show');
        Route::get('/customers/edit/{id}', 'CustomersController@edit')->name('admin-customer-edit');
        Route::put('/customers/update', 'CustomersController@update')->name('admin-customer-update');




    });
    Route::get('/', 'MenuWebController@index')->name('web-home');
    Route::post('/cart/add', 'MenuWebController@addCart')->name('web-add-cart');
    Route::get('/cart/remove/{id}', 'MenuWebController@removeCart')->name('web-remove-cart');
    Route::get('/cart', 'MenuWebController@cart')->name('web-cart');
    Route::get('/getcep', 'MenuWebController@getCep')->name('web-cep');
    Route::post('/send', 'MenuWebController@send')->name('web-send');
    Route::get('/order/{id}', 'MenuWebController@order')->name('web-order');
    Route::post('/postback/pagseguro', 'MenuWebController@postbackPagseguro')->name('web-postback-pagseguro');



    Route::post('/customer/register', 'MenuWebController@register')->name('web-register');
    Route::post('/customer/login', 'MenuWebController@login')->name('web-login');
    Route::get('/customer/logout', 'MenuWebController@logout')->name('web-logout');
    Route::post('/customer/reset-request', 'MenuWebController@resetRequest')->name('web-reset-request');
    Route::get('/customer/reset-token/{token}', 'MenuWebController@index')->name('web-reset-token');
    Route::post('/customer/reset-password', 'MenuWebController@resetPassword')->name('web-reset-password');
});
