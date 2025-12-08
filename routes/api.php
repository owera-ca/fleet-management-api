<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\ProvinceController;
use App\Http\Controllers\ProgramController;
use App\Http\Controllers\AddressController;
use App\Http\Controllers\EntityController;
use App\Http\Controllers\DocumentTypeController;
use App\Http\Controllers\EmailTemplateController;
use App\Http\Controllers\SmsTemplateController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\LineItemController;
use App\Http\Controllers\MetadataFieldController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\OrgNodeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\EntityRoleDefinitionController;
use App\Http\Controllers\EntityTransitionDefinitionController;
use App\Http\Controllers\EntityTransitionRoleDefinitionController;
use App\Http\Controllers\AssetController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\SmsController;
use App\Http\Controllers\EntityTransitionController;
use App\Http\Controllers\MessagingController;
use App\Http\Controllers\MetadataValueController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DispatchController;
use App\Http\Controllers\DriverController;
use App\Http\Controllers\TruckController;
use App\Http\Controllers\MasterTruckMaintenanceController;
use App\Http\Controllers\TruckMaintenanceController;
use App\Http\Controllers\TruckMaintenanceItemController;
use App\Http\Controllers\TruckTrackingController;
use App\Http\Controllers\ShopJobController;
use App\Http\Controllers\ShopJobInspectionController;
use App\Http\Controllers\ShopJobItemController;
use App\Http\Controllers\CarrierDispatchController;
use App\Http\Controllers\ShipAddressController;
use App\Http\Controllers\ShipmentController;
use App\Http\Controllers\CargoController;
use App\Http\Controllers\ShipmentBidController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderItemController;
use App\Http\Controllers\CarrierController;
use App\Http\Controllers\ShipperController;
use App\Http\Controllers\PayrollController;
use App\Http\Controllers\PayrollItemController;
use App\Http\Controllers\TripController;
use App\Http\Controllers\TripDamageController;
use App\Http\Controllers\TripLogbookController;
use App\Http\Controllers\TripPickupDropController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\ExpenseItemController;
use App\Http\Controllers\AuthController;

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware(['auth:sanctum'])->group(function () {

});

// register api
Route::post('/register', [AuthController::class, 'register']);

// login api
Route::post('/login', [AuthController::class, 'login']);

// logout api
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

// Masters
Route::apiResource('country', CountryController::class);
Route::apiResource('province', ProvinceController::class);
Route::apiResource('program', ProgramController::class);
Route::apiResource('address', AddressController::class);
Route::apiResource('entity', EntityController::class);
Route::apiResource('document-type', DocumentTypeController::class);
Route::apiResource('email-template', EmailTemplateController::class);
Route::apiResource('sms-template', SmsTemplateController::class);
Route::apiResource('event', EventController::class);
Route::apiResource('line-item', LineItemController::class);
Route::apiResource('metadata-field', MetadataFieldController::class);
Route::apiResource('shop', ShopController::class);
Route::apiResource('org-node', OrgNodeController::class);
Route::apiResource('role', RoleController::class);

// Definitions
Route::apiResource('entity-role-definition', EntityRoleDefinitionController::class);
Route::apiResource('entity-transition-definition', EntityTransitionDefinitionController::class);
Route::apiResource('entity-transition-role-definition', EntityTransitionRoleDefinitionController::class)->parameters(['entity-transition-role-definition' => 'id']);

// Common
Route::apiResource('asset', AssetController::class);
Route::apiResource('document', DocumentController::class);
Route::apiResource('email', EmailController::class);
Route::apiResource('sms', SmsController::class);
Route::apiResource('entity-transition', EntityTransitionController::class);
Route::apiResource('messaging', MessagingController::class);
Route::apiResource('metadata-value', MetadataValueController::class);

// Users & Dispatch
Route::apiResource('user-management', UserController::class); // 'user' is reserved
Route::apiResource('dispatch', DispatchController::class);
Route::apiResource('driver', DriverController::class);

// Truck & Maintenance
Route::apiResource('truck', TruckController::class);
Route::apiResource('master-truck-maintenance', MasterTruckMaintenanceController::class);
Route::apiResource('truck-maintenance', TruckMaintenanceController::class);
Route::apiResource('truck-maintenance-item', TruckMaintenanceItemController::class);
Route::apiResource('truck-tracking', TruckTrackingController::class);

// Shop
Route::apiResource('shop-job', ShopJobController::class);
Route::apiResource('shop-job-inspection', ShopJobInspectionController::class);
Route::apiResource('shop-job-item', ShopJobItemController::class);

// Shipper & Trans
Route::apiResource('carrier-dispatch', CarrierDispatchController::class);
Route::apiResource('ship-address', ShipAddressController::class);
Route::apiResource('shipment', ShipmentController::class);
Route::apiResource('cargo', CargoController::class);
Route::apiResource('shipment-bid', ShipmentBidController::class);
Route::apiResource('transaction', TransactionController::class);
Route::apiResource('order', OrderController::class);
Route::apiResource('order-item', OrderItemController::class);
Route::apiResource('carrier', CarrierController::class);
Route::apiResource('shipper', ShipperController::class);

// Payroll
Route::apiResource('payroll', PayrollController::class);
Route::apiResource('payroll-item', PayrollItemController::class);

// Trip & Expense
Route::apiResource('trip', TripController::class);
Route::apiResource('trip-damage', TripDamageController::class);
Route::apiResource('trip-logbook', TripLogbookController::class);
Route::apiResource('trip-pickup-drop', TripPickupDropController::class);
Route::apiResource('expense', ExpenseController::class);
Route::apiResource('expense-item', ExpenseItemController::class);