<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminLoginController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\WebsiteController;

// admin route
// Route::get('/', [AdminLoginController::class, 'adminLogin'])->name('/');
Route::get('login', [AdminLoginController::class, 'adminLogin'])->name('login');
Route::get('admin-login', [AdminLoginController::class, 'adminLogin'])->name('admin-login');
Route::post('admin-login-check', [AdminLoginController::class, 'adminLoginCheck'])->name('admin-login-check');
// Admin dashboard route
Route::group(['middleware'=>'auth'],function(){
// ayodhya dham
Route::get('admin-ayodhya-temple-list', [AdminDashboardController::class, 'ayodhyaTempleList'])->name('admin-ayodhya-temple-list');
Route::match(['get', 'post'], 'admin-ayodhya-temple-add', [AdminDashboardController::class, 'ayodhyaTempleAdd'])->name('admin-ayodhya-temple-add');

// hospital list
Route::get('admin/dashboard', [AdminDashboardController::class, 'index'])->name('adminDashboard');
Route::get('admin/hospital-list', [AdminDashboardController::class, 'hospitalList'])->name('adminHospitalList');
Route::get('admin/hospital-add', [AdminDashboardController::class, 'hospitalAdd'])->name('adminHospitalAdd');
Route::post('admin/hospital-save', [AdminDashboardController::class, 'hospitalSave'])->name('adminHospitalSave');
Route::get('admin/hospital-edit/{id}', [AdminDashboardController::class, 'hospitalEdit'])->name('adminHospitalEdit');
Route::post('admin/hospital-update', [AdminDashboardController::class, 'hospitalUpdate'])->name('adminHospitalUpdate');
Route::post('admin/hospital-update-status', [AdminDashboardController::class, 'hospitalUpdateStatus'])->name('adminHospitalUpdateStatus');
// banks
Route::get('admin/bank-add', [AdminDashboardController::class, 'bankAdd'])->name('adminBankAdd');
Route::get('admin/bank-list', [AdminDashboardController::class, 'bankList'])->name('adminBankList');
Route::post('admin/bank-save', [AdminDashboardController::class, 'bankSave'])->name('adminBankSave');
Route::post('admin/bank-update-status', [AdminDashboardController::class, 'bankUpdateStatus'])->name('adminBankUpdateStatus');
Route::get('admin/bank-edit/{id}', [AdminDashboardController::class, 'bankEdit'])->name('adminBankEdit');
Route::post('admin/bank-update', [AdminDashboardController::class, 'bankUpdate'])->name('adminBankUpdate');
// travels
Route::get('admin/travel-list', [AdminDashboardController::class, 'travelList'])->name('adminTravelList');
Route::get('admin/travel-add', [AdminDashboardController::class, 'travelAdd'])->name('adminTravelAdd');
Route::post('admin/travel-save', [AdminDashboardController::class, 'travelSave'])->name('adminTravelSave');
Route::post('admin/travel-update-status', [AdminDashboardController::class, 'travelUpdateStatus'])->name('adminTravelUpdateStatus');
Route::get('admin/travel-edit/{id}', [AdminDashboardController::class, 'travelEdit'])->name('adminTravelEdit');
Route::post('admin/travel-update', [AdminDashboardController::class, 'travelUpdate'])->name('adminTravelUpdate');
Route::get('admin/travel-detail/{id}', [AdminDashboardController::class, 'travelDetail'])->name('adminTravelDetail');
Route::post('admin/travel-detail-update', [AdminDashboardController::class, 'travelDetailUpdate'])->name('adminTravelDetailUpdate');
// hotel
Route::get('admin/hotel-list', [AdminDashboardController::class, 'hotelList'])->name('adminHotelList');
Route::get('admin/hotel-add', [AdminDashboardController::class, 'hotelAdd'])->name('adminHotelAdd');
Route::post('admin/hotel-save', [AdminDashboardController::class, 'hotelSave'])->name('adminHotelSave');
Route::get('admin/hotel-edit/{id}', [AdminDashboardController::class, 'hotelEdit'])->name('adminHotelEdit');
Route::post('admin/hotel-update', [AdminDashboardController::class, 'hotelUpdate'])->name('adminHotelUpdate');
Route::post('admin/hotel-update-status', [AdminDashboardController::class, 'hotelUpdateStatus'])->name('adminHotelUpdateStatus');
// temple category
Route::get('admin/temple-category-list', [AdminDashboardController::class, 'templeCategoryList'])->name('adminTempleCategoryList');
Route::get('admin/temple-category-add', [AdminDashboardController::class, 'templeCategoryAdd'])->name('adminTempleCategoryAdd');
Route::post('admin/temple-category-save', [AdminDashboardController::class, 'templeCategorySave'])->name('adminTempleCategorySave');
Route::get('admin/temple-category-edit/{id}', [AdminDashboardController::class, 'templeCategoryEdit'])->name('adminTempleCategoryEdit');
Route::post('admin/temple-category-update', [AdminDashboardController::class, 'templeCategoryUpdate'])->name('adminTempleCategoryUpdate');
Route::post('admin/temple-category-update-status', [AdminDashboardController::class, 'templeCategoryUpdateStatus'])->name('adminTempleCategoryUpdateStatus');
// sub category temple list
Route::get('admin/sub-category-temples-list/{id}', [AdminDashboardController::class, 'subCategoryTempleList'])->name('adminSubCategoryTempleList');
Route::get('admin/sub-category-temples-add/{id}', [AdminDashboardController::class, 'subCategoryTempleAdd'])->name('adminSubCategoryTempleAdd');
Route::post('admin/sub-category-temples-save', [AdminDashboardController::class, 'subCategoryTempleSave'])->name('adminSubCategoryTempleSave');
Route::get('admin/sub-category-temples-edit/{sub_category_id}', [AdminDashboardController::class, 'subCategoryTempleEdit'])->name('adminSubCategoryTempleEdit');
Route::post('admin/sub-category-temples-update', [AdminDashboardController::class, 'subCategoryTempleUpdate'])->name('adminSubCategoryTempleUpdate');
Route::post('admin/sub-category-temples-update-status', [AdminDashboardController::class, 'subCategoryTempleUpdateStatus'])->name('adminSubCategoryTempleUpdateStatus');
// temples
Route::get('admin/temple-list', [AdminDashboardController::class, 'templeList'])->name('adminTempleList');
Route::get('admin/temple-add', [AdminDashboardController::class, 'templeAdd'])->name('adminTempleAdd');
Route::post('admin/temple-save', [AdminDashboardController::class, 'templeSave'])->name('adminTempleSave');
Route::get('admin/temple-edit/{id}', [AdminDashboardController::class, 'templeEdit'])->name('adminTempleEdit');
Route::post('admin/temple-update', [AdminDashboardController::class, 'templeUpdate'])->name('adminTempleUpdate');
Route::post('admin/temple-update-status', [AdminDashboardController::class, 'templeUpdateStatus'])->name('adminTempleUpdateStatus');

// ayodhya dham
Route::get('admin/ayodhya-dham-add-temple', [AdminDashboardController::class, 'ayodhyaDhamAddTemple'])->name('adminAyodhyaDhamAddTemple');
Route::get('admin/ayodhya-dham-temple-list', [AdminDashboardController::class, 'ayodhyaDhamTempleList'])->name('adminAyodhyaDhamTempleList');
Route::post('admin/ayodhya-dham-save-temple', [AdminDashboardController::class, 'ayodhyaDhamSaveTemple'])->name('adminAyodhyaDhamSaveTemple');
Route::get('admin/ayodhya-dham-temple-edit/{id}', [AdminDashboardController::class, 'ayodhyaDhamTempleEdit'])->name('adminAyodhyaDhamTempleEdit');
Route::post('admin/ayodhya-dham-temple-update', [AdminDashboardController::class, 'ayodhyaDhamTempleUpdate'])->name('adminAyodhyaDhamTempleUpdate');
Route::post('admin/ayodhya-dham-temple-update-status', [AdminDashboardController::class, 'ayodhyaDhamTempleUpdateStatus'])->name('adminAyodhyaDhamTempleUpdateStatus');

Route::get('admin/ayodhya-dham-ghat-add', [AdminDashboardController::class, 'ayodhyaDhamGhatAdd'])->name('adminAyodhyaDhamGhatAdd');
Route::get('admin/ayodhya-dham-ghat-list', [AdminDashboardController::class, 'ayodhyaDhamGhatList'])->name('adminAyodhyaDhamGhatList');
Route::post('admin/ayodhya-dham-ghat-save', [AdminDashboardController::class, 'ayodhyaDhamGhatSave'])->name('adminAyodhyaDhamGhatSave');
Route::get('admin/ayodhya-dham-ghat-edit/{id}', [AdminDashboardController::class, 'ayodhyaDhamGhatEdit'])->name('adminAyodhyaDhamGhatEdit');
Route::post('admin/ayodhya-dham-ghat-update', [AdminDashboardController::class, 'ayodhyaDhamGhatupdate'])->name('adminAyodhyaDhamGhatUpdate');
Route::post('admin/ayodhya-dham-ghat-update-status', [AdminDashboardController::class, 'ayodhyaDhamGhatUpdateStatus'])->name('adminAyodhyaDhamGhatUpdateStatus');

// temle wise arti
Route::get('admin/temple-wise-arti-add', [AdminDashboardController::class, 'templeWiseArtiAdd'])->name('adminTempleWiseArtiAdd');
Route::post('admin/temple-wise-arti-save', [AdminDashboardController::class, 'templeWiseArtiSave'])->name('adminTempleWiseArtiSave');
Route::get('admin/arti-list', [AdminDashboardController::class, 'artiList'])->name('adminArtiList');
Route::get('admin/arti-edit/{id}', [AdminDashboardController::class, 'artiEdit'])->name('adminArtiEdit');
Route::post('admin/arti-update', [AdminDashboardController::class, 'artiUpdate'])->name('adminArtiUpdate');
Route::post('admin/arti-update-status', [AdminDashboardController::class, 'artiUpdateStatus'])->name('adminArtiUpdateStatus');
Route::get('admin/near-me-list', [AdminDashboardController::class, 'nearMeList'])->name('adminNearMeList');
Route::get('admin/add-near-me', [AdminDashboardController::class, 'addNearMe'])->name('adminAddNearMe');
Route::post('admin/save-near-me', [AdminDashboardController::class, 'saveNearMe'])->name('adminSaveNearMe');
Route::post('admin/near-me-update-status', [AdminDashboardController::class, 'nearMeUpdateStatus'])->name('adminNearMeUpdateStatus');



// setting
Route::get('admin/setting', [AdminDashboardController::class, 'setting'])->name('adminSetting');
Route::get('admin/change-password', [AdminDashboardController::class, 'changePassword'])->name('adminChangePassword');
Route::post('admin/update-password', [AdminDashboardController::class, 'updatePassword'])->name('adminUpdatePassword');
Route::post('admin/settingSave', [AdminDashboardController::class, 'settingSave'])->name('adminSettingSave');
Route::get('admin/logout', [AdminDashboardController::class, 'logout'])->name('adminLogout');
});
Route::get('/', [WebsiteController::class, 'home'])->name('/');
Route::get('welcome', [WebsiteController::class, 'welcome'])->name('welcome');
Route::get('emergency', [WebsiteController::class, 'emergency'])->name('emergency');
Route::get('hospital-list', [WebsiteController::class, 'hospitalList'])->name('hospitalList');
Route::get('bank-list', [WebsiteController::class, 'bankList'])->name('bankList');
Route::get('travel-list', [WebsiteController::class, 'travelList'])->name('travelList');
Route::get('travel-detail/{id}', [WebsiteController::class, 'travelDetail'])->name('travelDetail');
Route::get('other-famous-temple', [WebsiteController::class, 'otherFamousTemple'])->name('otherFamousTemple');
Route::get('other-famous-sub-category/{id}', [WebsiteController::class, 'otherFamousSubCategory'])->name('otherFamousSubCategory');
Route::get('other-famous-temple-detail/{id}', [WebsiteController::class, 'otherFamousTempleDetail'])->name('otherFamousTempleDetail');
Route::get('other-famous-sub-category-detail/{id}', [WebsiteController::class, 'otherFamousSubCategoryDetail'])->name('otherFamousSubCategoryDetail');
Route::get('hotel-list', [WebsiteController::class, 'hotelList'])->name('hotelList');
Route::get('ayodhya-dham-place', [WebsiteController::class, 'ayodhyaDhamPlace'])->name('ayodhyaDhamPlace');
Route::get('ayodhya-dham-temples', [WebsiteController::class, 'ayodhyaDhamTemple'])->name('ayodhyaDhamTemple');
Route::get('ayodhya-dham-temple-detail/{id}', [WebsiteController::class, 'ayodhyaDhamTempleDetail'])->name('ayodhyaDhamTempleDetail');
Route::get('ayodhya-dham-ghats', [WebsiteController::class, 'ayodhyaDhamGhat'])->name('ayodhyaDhamGhat');
Route::get('ayodhya-dham-ghat-detail/{id}', [WebsiteController::class, 'ayodhyaDhamGhatDetail'])->name('ayodhyaDhamGhatDetail');
Route::get('temple-qr-location/{id}', [WebsiteController::class, 'templeQrLocation'])->name('templeQrLocation');




