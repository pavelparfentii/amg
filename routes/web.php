<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\OrdersController;
use App\Http\Controllers\CalculyationsController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\VisitorsController;
use App\Http\Controllers\VisitsController;
use App\Http\Controllers\PromoController;
use App\Http\Controllers\ServicesController;
use App\Http\Controllers\FormsController;
use App\Http\Controllers\ReportsController;
use App\Http\Controllers\ItemsController;
use App\Http\Controllers\ContragentsController;

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

Route::group(['middleware' => ['auth']], function() {
    Route::get('/', [SiteController::class, 'index'])->name('site.index');
    Route::get('likar_calendar', [SiteController::class, 'likar_calendar'])->name('site.likar_calendar');

    Route::get('likars/{cabinet}', [SettingsController::class, 'cabinets_likar'])->name('cabinets.likar');

    Route::get('users', [UsersController::class, 'index'])->name('users.index');
    Route::post('users/store', [UsersController::class, 'store'])->name('users.store');
    Route::get('users/{id}/edit', [UsersController::class, 'edit'])->name('users.edit');
    Route::post('users/{id}/update', [UsersController::class, 'update'])->name('users.update');
    Route::post('users/{id}/update_access', [UsersController::class, 'update_access'])->name('users.update_access');
    Route::get('users/role', [RoleController::class, 'index'])->name('users_role.index');
    Route::post('users/role_update_access', [RoleController::class, 'update_access'])->name('users_role.update_access');
    Route::get('users/role_create_access', [RoleController::class, 'create_access'])->name('users_role.create_access');
    Route::post('users/role_store_access', [RoleController::class, 'store_access'])->name('users_role.store_access');
    Route::get('users/{id}/role_edit_access', [RoleController::class, 'edit_access'])->name('users_role.edit_access');
    Route::post('users/{id}/add_specialist', [UsersController::class, 'add_specialist'])->name('users.add_specialist');
    Route::get('users/{id}/del_specialist', [UsersController::class, 'del_specialist'])->name('users.del_specialist');

    Route::get('calculyations', [CalculyationsController::class, 'index'])->name('calculyations.index');
    Route::get('calculyations/create', [CalculyationsController::class, 'create'])->name('calculyations.create');
    Route::post('calculyations/store', [CalculyationsController::class, 'store'])->name('calculyations.store');
    Route::get('calculyations/{id}/edit', [CalculyationsController::class, 'edit'])->name('calculyations.edit');
    Route::post('calculyations/{id}/update', [CalculyationsController::class, 'update'])->name('calculyations.update');
    Route::post('calculyations/{id}/add_item', [CalculyationsController::class, 'add_item'])->name('calculyations.add_item');
    Route::post('calculyations/del_item', [CalculyationsController::class, 'del_item'])->name('calculyations.del_item');
    Route::get('pfSearch', [CalculyationsController::class, 'pfSearch'])->name('pfSearch');
    Route::get('calculyations/{id}/lastPrice', [CalculyationsController::class, 'lastPrice'])->name('calculyations.lastPrice');

    Route::get('visitors', [VisitorsController::class, 'index'])->name('visitors.index');
    Route::get('visitors/{id}/edit')->name('visitors.edit');
    Route::post('visitor/{visitor}/balance_add', [VisitorsController::class, 'balance_add'])->name('visitors.balance_add');

    Route::get('services/{id}/groupsBy', [ServicesController::class, 'groupsBy'])->name('services.groupsBy');
    Route::get('services/groups', [ServicesController::class, 'groups'])->name('services.groups');
    Route::post('services/groups_store', [ServicesController::class, 'groups_store'])->name('services.groups_store');
    Route::get('services/{service}/get-service-price', [ServicesController::class, 'get_service_price'])->name('services.get-service-price');

    Route::get('selfServices/{id}/{calc}/lastPrice', [ServicesController::class, 'lastPrice'])->name('services.lastPrice');

    Route::post('services/store', [ServicesController::class, 'store'])->name('services.store');
    Route::get('services/{group}/group_edit', [ServicesController::class, 'group_edit'])->name('services.group_edit');
    Route::post('services/{group}/group_update', [ServicesController::class, 'group_update'])->name('services.group_update');

    Route::get('services/{service}/edit', [ServicesController::class, 'edit'])->name('services.edit');
    Route::post('services/{service}/update', [ServicesController::class, 'update'])->name('services.update');

    Route::get('serviceSearch', [ServicesController::class, 'serviceSearch'])->name('serviceSearch');


    Route::get('services/import', [ServicesController::class, 'importXlsService'])->name('services.import');
    Route::post('services/import', [ServicesController::class, 'importXlsService'])->name('services.import');

    Route::get('services/{id}/service-info', [ServicesController::class, 'service_info'])->name('service-info');

    Route::get('reports/services_period', [ReportsController::class, 'services_period'])->name('reports.services_period');
    Route::get('reports/pay_period', [ReportsController::class, 'pay_period'])->name('reports.pay_period');
    Route::post('reports/pay_period', [ReportsController::class, 'pay_period'])->name('reports.pay_period');
    Route::get('reports/doctor_period', [ReportsController::class, 'doctor_period'])->name('reports.doctor_period');

    Route::get('items/groups', [ItemsController::class, 'groups'])->name('items.group_index');
    Route::post('items/groups_store', [ItemsController::class, 'group_store'])->name('items.groups_store');
    Route::get('items/{id}/groupsBy', [ItemsController::class, 'groupsBy'])->name('items.groupsBy');
    Route::get('items/{group}/group_edit', [ItemsController::class, 'group_edit'])->name('items.group_edit');
    Route::post('items/{group}/group_update', [ItemsController::class, 'group_update'])->name('items.group_update');
    Route::get('items', [ItemsController::class, 'index'])->name('items.index');
    Route::post('items/store', [ItemsController::class, 'store'])->name('items.store');
    Route::get('items/{id}/edit', [ItemsController::class, 'edit'])->name('items.edit');
    Route::post('items/{id}/update', [ItemsController::class, 'update'])->name('items.update');
    Route::get('items/leftovers', [ItemsController::class, 'leftovers'])->name('items.leftovers');
    Route::get('items/pivot', [ItemsController::class, 'pivot'])->name('items.pivot');
    Route::get('itemSearch', [ItemsController::class, 'itemSearch'])->name('itemSearch');
    Route::get('items/{id}/lastPrice', [ItemsController::class, 'lastPrice'])->name('items.lastPrice');

    Route::get('contragents', [ContragentsController::class, 'index'])->name('contragents.index');
    Route::get('contragents/create', [ContragentsController::class, 'create'])->name('contragents.create');
    Route::post('contragents/store', [ContragentsController::class, 'store'])->name('contragents.store');
    Route::get('contragents/{id}/edit', [ContragentsController::class, 'edit'])->name('contragents.edit');
    Route::post('contragents/{id}/update', [ContragentsController::class, 'update'])->name('contragents.update');
    Route::get('contragents/{id}/destroy', [ContragentsController::class, 'destroy'])->name('contragents.destroy');

    Route::get('contragents_group', [ContragentsController::class, 'group_index'])->name('contragents.group_index');
    Route::get('contragents_group/create', [ContragentsController::class, 'group_create'])->name('contragents.group_create');
    Route::post('contragents_group/store', [ContragentsController::class, 'group_store'])->name('contragents.group_store');
    Route::get('contragents_group/{id}/edit', [ContragentsController::class, 'group_edit'])->name('contragents.group_edit');
    Route::post('contragents_group/{id}/update', [ContragentsController::class, 'group_update'])->name('contragents.group_update');
    Route::get('contragents_group/{id}/destroy', [ContragentsController::class, 'group_destroy'])->name('contragents.group_destroy');

    Route::get('orders', [OrdersController::class, 'index'])->name('items.orders_index');
    Route::post('orders', [OrdersController::class, 'index'])->name('items.orders_index');
    Route::get('orders/income_create', [OrdersController::class, 'income_create'])->name('orders.income_create');
    Route::get('orders/consumption_create', [OrdersController::class, 'consumption_create'])->name('orders.consumption_create');
    Route::post('orders/store', [OrdersController::class, 'store'])->name('orders.store');
    Route::get('orders/{id}/edit', [OrdersController::class, 'edit'])->name('orders.edit');
    Route::post('orders/{id}/update', [OrdersController::class, 'update'])->name('orders.update');
    Route::get('orders/{id}/destroy', [OrdersController::class, 'destroy'])->name('orders.destroy');
    Route::post('orders/{id}/add_item_in', [OrdersController::class, 'add_item_in'])->name('orders.add_item_in');
    Route::post('orders/{id}/add_item_out', [OrdersController::class, 'add_item_out'])->name('orders.add_item_out');
    Route::post('orders/del_item_in', [OrdersController::class, 'del_item_in'])->name('orders.del_item_in');
    Route::post('orders/del_item_out', [OrdersController::class, 'del_item_out'])->name('orders.del_item_out');
    Route::post('orders/item_count', [OrdersController::class, 'item_count'])->name('orders.item_count');

    Route::get('services', [ServicesController::class, 'index'])->name('services.index');

    Route::get('promo', [PromoController::class, 'index'])->name('promo.index');
    Route::post('promo/store', [PromoController::class, 'store'])->name('promo.store');
    Route::get('promo/{id}/services', [PromoController::class, 'services'])->name('promo.services');
    Route::post('promo/{id}/service_add', [PromoController::class, 'service_add'])->name('promo.service_add');

    Route::get('settings/times', [SettingsController::class, 'times'])->name('settings.times');
    Route::get('settings/pags', [SettingsController::class, 'pages'])->name('settings.pages');
    Route::post('settings/pages_store', [SettingsController::class, 'pages_store'])->name('settings.pages_store');
    Route::get('settings/specialists', [SettingsController::class, 'specialists'])->name('settings.specialists');
    Route::post('settings/specialists_store', [SettingsController::class, 'specialists_store'])->name('settings.specialists_store');
    Route::get('settings/cabinets', [SettingsController::class, 'cabinets'])->name('settings.cabinets');
    Route::post('settings/cabinets_store', [SettingsController::class, 'cabinets_store'])->name('settings.cabinets_store');
    Route::get('settings/{id}/cabinet_edit', [SettingsController::class, 'cabinet_edit'])->name('settings.cabinet_edit');
    Route::post('settings/{id}/cabinet_update', [SettingsController::class, 'cabinet_update'])->name('settings.cabinet_update');
    Route::get('settings/cabinets_likar', [SettingsController::class, 'cabinets_likar'])->name('settings.cabinets_likar');
    Route::post('settings/{id}/cabinets_likar_add', [SettingsController::class, 'cabinets_likar_add'])->name('settings.cabinets_likar_add');
    Route::post('settings/cabinets_likar_del', [SettingsController::class, 'cabinets_likar_del'])->name('settings.cabinets_likar_del');

    Route::get('settings/print_forms', [FormsController::class, 'index'])->name('settings.forms');
    Route::post('settings/print_forms_store', [FormsController::class, 'store'])->name('settings.forms_store');

    Route::get('settings/{specialist}/spec_form', [FormsController::class, 'spec_form'])->name('settings.spec_form');

    Route::get('settings/likars', [SettingsController::class, 'likars'])->name('settings.likars');
    Route::post('settings/likars_store', [SettingsController::class, 'from_likars_store'])->name('settings.likars.store');
    Route::get('settings/likars_create', [SettingsController::class, 'from_likars_create'])->name('settings.likars.create');
    Route::get('settings/{id}/likars_edit', [SettingsController::class, 'from_likars_edit'])->name('settings.likars.edit');
    Route::post('settings/{id}/likars_update', [SettingsController::class, 'from_likars_update'])->name('settings.likars.update');

    Route::get('visits/{date}/{cabinet}/{time}/precreate', [VisitsController::class, 'precreate'])->name('visits.precreate');
    Route::get('visits/{visit}/create', [VisitsController::class, 'create'])->name('visits.create');
    Route::post('visits/{visit}/store', [VisitsController::class, 'store'])->name('visits.store');
    Route::post('visits/{visit}/pretiming', [VisitsController::class, 'pretiming'])->name('visits.pretiming');
    Route::get('visits/{visit}/edit', [VisitsController::class, 'edit'])->name('visits.edit');
    Route::get('visits/{visit}/add_services', [VisitsController::class, 'add_services'])->name('visits.add_services');
    Route::post('visits/{visit}/service_add', [VisitsController::class, 'service_add'])->name('visits.service_add');
    Route::post('visits/{visit}/service_delete', [VisitsController::class, 'service_del'])->name('visits.service_delete');
    Route::post('visits/{visit}/to_pay', [VisitsController::class, 'to_pay'])->name('visits.to_pay');
    Route::get('visits/{visit}/show', [VisitsController::class, 'show'])->name('visits.show');
    Route::get('visits/{visit}/to_visited', [VisitsController::class, 'to_visited'])->name('visits.to_visited');
    Route::get('visits/{visit}/to_date', [VisitsController::class, 'to_date'])->name('visits.to_date');
    Route::post('visits/{visit}/to_date_store', [VisitsController::class, 'to_date_store'])->name('visits.to_date_store');
    Route::get('visits/{visit}/destroy', [VisitsController::class, 'destroy'])->name('visits.destroy');
    Route::post('visits/{visit}/update', [VisitsController::class, 'update'])->name('visits.update');
    Route::get('visits/{visit}/reopen', [VisitsController::class, 'reopen'])->name('visits.reopen');
    Route::get('visits/{visit}/reopen_v', [VisitsController::class, 'reopen_v'])->name('visits.reopen_v');
    Route::get('visits/{date}/{cabinet}/list', [VisitsController::class, 'list'])->name('visits.list');

    Route::get('visits/{visit}/priem', [VisitsController::class, 'priem'])->name('visits.priem');
    Route::get('visits/{visit}/form_print', [FormsController::class, 'form_print'])->name('visits.form_print');
    Route::post('visits/info_store', [VisitsController::class, 'info_store'])->name('visits.info_store');

    Route::get('visits/{visit}/history_show', [VisitsController::class, 'history_show'])->name('visits.history_show');

    Route::post('visits/form_select', [FormsController::class, 'form_select'])->name('visits.form_select');

    Route::post('visits/{visit}/pay_delete', [VisitsController::class, 'pay_delete'])->name('visits.pay_delete');

    Route::get('visits/{visit}/print-analize', [VisitsController::class, 'print_analize'])->name('visits.print-analize');
    Route::post('visits/{visit}/upload-analize', [VisitsController::class, 'upload_analize'])->name('visits.upload_analize');

    Route::get('visitors', [VisitorsController::class, 'index'])->name('visitors.index');
    Route::get('visitors/{id}/edit', [VisitorsController::class, 'edit'])->name('visitors.edit');
    Route::post('visitors/{visitor}/update', [VisitorsController::class, 'update'])->name('visitors.update');
    Route::get('visitors/{visit}/new_visit', [VisitorsController::class, 'new_visit'])->name('visitors.new_visit');
    Route::post('visitors/{visit}/new_store', [VisitorsController::class, 'new_store'])->name('visitors.new_store');
    Route::get('visitors/{visitor}/print', [VisitorsController::class, 'print'])->name('visitors.print');
    Route::post('visitors/{visitor}/reprint', [VisitorsController::class, 'reprint'])->name('visitors.reprint');
    Route::post('visitors/{visitor}/promo_add', [VisitorsController::class, 'promo_add'])->name('visitors.promo_add');

    Route::get('select2-service', [ServicesController::class, 'select2service'])->name('select2-service');
    Route::get('select2-analizy', [ServicesController::class, 'select2analizy'])->name('select2-analizy');
    Route::get('select2-groups', [ServicesController::class, 'select2groups'])->name('select2-groups');
    Route::get('select2-ajax', [VisitorsController::class, 'select2ajax'])->name('select2-ajax');
    Route::post('site/date_refresh', [SiteController::class, 'date_refresh'])->name('site.date_refresh');
});
require __DIR__.'/auth.php';
