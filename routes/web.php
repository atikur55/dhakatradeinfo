<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SocialGoogleController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\Profile\ProfileController;
use App\Http\Controllers\Admin\SupplierController;
use App\Http\Controllers\Admin\TemplateCategoryController;
use App\Http\Controllers\Admin\TemplateCreateController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\SubCategoryController;
use App\Http\Controllers\Admin\ChildCategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Supplier\SupplierProductController;
use App\Http\Controllers\Admin\CountryController;
use App\Http\Controllers\Admin\EmailController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\StateController;
use App\Http\Controllers\Admin\StationController;
use App\Http\Controllers\Admin\BusinessTypeController;
use App\Http\Controllers\BuynowPageController;
use App\Http\Controllers\CheckOutPageController;
use App\Http\Controllers\SupplierRegisterController;
use App\Http\Controllers\Supplier\SupplierOrderController;
use App\Http\Controllers\Supplier\SupplierTrackingController;
use App\Http\Controllers\CustomLoginController;
use App\Http\Controllers\CustomerRegistrationController;
use App\Http\Controllers\Customer\CustomerOrderController;


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
/*
|--------------------------------------------------------------------------
| Frontend Part 
|--------------------------------------------------------------------------
*/
Route::get('/',[FrontendController::class,'index']);
Route::get('/ch-product-list/{id}',[FrontendController::class,'child_product_list'])->name('ch-products');
Route::get('/product_details/{slug}',[FrontendController::class,'product_details'])->name('product_details');
Route::get('/category/{name}',[FrontendController::class,'category_assets'])->name('category.assets');
Route::post('/buy-now',[BuynowPageController::class,'buyNow'])->name('buy.now');
Route::post('/checkout',[CheckOutPageController::class,'checkout'])->name('checkout');
Route::get('/buyLogin',[BuynowPageController::class,'buyLogin'])->name('buyLogin');
Route::post('/checkoutOrder',[CheckOutPageController::class,'checkoutOrder'])->name('checkoutOrder');
Route::get('/business/asset/{id}',[FrontendController::class,'business_assets'])->name('business_assets');
Route::get('/subcategory_product/{id}',[FrontendController::class,'subcategory_product'])->name('subcategory_product');

// Supplier Register
Route::get('/be-supplier',[SupplierRegisterController::class,'index'])->name('supplier.register');
Route::post('/be-supplier/register',[SupplierRegisterController::class,'post'])->name('supplier.register.post');
Route::get('register-get-state-list/{id}',[SupplierRegisterController::class,'getStateList']);
Route::get('register-get-city-list/{id}',[SupplierRegisterController::class,'getCityList']);

// Custome Login
Route::get('/login',[CustomLoginController::class,'custom_login'])->name('custom.login'); 
Route::post('/login/post',[CustomLoginController::class,'login_post'])->name('login.post'); 
// Custome Register
Route::get('/register',[CustomerRegistrationController::class,'register_form'])->name('register.customer'); 
Route::post('/register/post',[CustomerRegistrationController::class,'register_post'])->name('register.post'); 

// Route::get('/', function () {
//     return view('welcome');
// });

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');
// Google Route
Route::get('authorized/google', [SocialGoogleController::class, 'redirectToGoogle']);
Route::get('authorized/google/callback', [SocialGoogleController::class, 'handleGoogleCallback']);
/*-------------------------------------
Admin , Supplier & Customer Profile Edit 
----------------------------------------*/
Route::get('/profile',[ProfileController::class, 'profile'])->name('profile');
Route::post('/update/customer/informaiton',[ProfileController::class, 'update_customer_info'])->name('update.customer.info');
Route::post('/update/supplier/informaiton',[ProfileController::class, 'update_supplier_info'])->name('update.supplier.info');
/*-------------------------------------
Admin , Supplier & Customer Password Change 
----------------------------------------*/
Route::get('/password/change',[ProfileController::class, 'password_change'])->name('password.change');
Route::post('/password/update',[ProfileController::class, 'password_update'])->name('update.password');
/*-------------------------------------
Supplier Route
----------------------------------------*/
Route::get('/supplier/create',[SupplierController::class,'supplier_create'])->name('admin.supplier.create');
Route::post('/supplier/post',[SupplierController::class,'supplier_post'])->name('admin.supplier.post');
Route::get('/supplier/list',[SupplierController::class,'supplier_list'])->name('admin.supplier.view');
Route::get('/supplier/pending-list',[SupplierController::class,'supplier_pending_list'])->name('admin.supplier.pending');
Route::get('/supplier/status/{id}',[SupplierController::class,'supplier_status'])->name('admin.supplier.status');
Route::get('/supplier/delete/{id}',[SupplierController::class,'supplier_delete'])->name('admin.supplier.delete');
Route::get('/supplier/edit/{id}',[SupplierController::class,'supplier_edit'])->name('admin.supplier.edit');
Route::post('/supplier/update',[SupplierController::class,'supplier_update'])->name('admin.supplier.update');

/*-------------------------------------
Template Category Route
----------------------------------------*/
Route::get('/template_category/create',[TemplateCategoryController::class,'template_category_create'])->name('admin.template_category.create');
Route::post('/template_category/post',[TemplateCategoryController::class,'template_category_post'])->name('admin.template_category.post');
Route::get('/template_category/list',[TemplateCategoryController::class,'template_category_list'])->name('admin.template_category.view');
Route::get('/template_category/status/{id}',[TemplateCategoryController::class,'template_category_status'])->name('admin.template_category.status');
Route::get('/template_category/delete/{id}',[TemplateCategoryController::class,'template_category_delete'])->name('admin.template_category.delete');
Route::get('/template_category/edit/{id}',[TemplateCategoryController::class,'template_category_edit'])->name('admin.template_category.edit');
Route::post('/template_category/update',[TemplateCategoryController::class,'template_category_update'])->name('admin.template_category.update');

/*-------------------------------------
Template Route
----------------------------------------*/
Route::get('/template/create',[TemplateCreateController::class,'template_create'])->name('admin.template.create');
Route::post('/template/post',[TemplateCreateController::class,'template_post'])->name('admin.template.post');
Route::get('/template/list',[TemplateCreateController::class,'template_list'])->name('admin.template.view');
Route::get('/template/status/{id}',[TemplateCreateController::class,'template_status'])->name('admin.template.status');
Route::get('/template/delete/{id}',[TemplateCreateController::class,'template_delete'])->name('admin.template.delete');
Route::get('/template/edit/{id}',[TemplateCreateController::class,'template_edit'])->name('admin.template.edit');
Route::post('/template/update',[TemplateCreateController::class,'template_update'])->name('admin.template.update');

/*-------------------------------------
Supplier Upgrade Membership Route
----------------------------------------*/
Route::get('/supplier/upgrade',[SupplierController::class,'supplier_upgrade'])->name('supplier.upgrade');
Route::post('/supplier/upgrade/post',[SupplierController::class,'supplier_upgrade_post'])->name('supplier.upgrade.post');
Route::get('/search-get-state-list/{id}',[SupplierController::class,'getStateList'])->name('supplier.list');
Route::get('/supplier/upgrade/view',[SupplierController::class,'supplier_upgrade_view'])->name('admin.supplier_upgrade.view');
Route::get('/supplier/upgrade/status/{id}',[SupplierController::class,'supplier_upgrade_status'])->name('admin.supplier_upgrade.status');
Route::post('/supplier/upgrade/update',[SupplierController::class,'supplier_upgrade_update'])->name('admin.supplier_upgrade.update');


/*-------------------------------------
Category Route
----------------------------------------*/
Route::get('/admin/businessType',[BusinessTypeController::class,'view'])->name('admin.businessType.view');
Route::post('/admin/businessType/post',[BusinessTypeController::class,'store'])->name('admin.businessType.store');
Route::get('/admin/businessType/status/{id}',[BusinessTypeController::class,'status'])->name('admin.businessType.status');
Route::get('/admin/businessType/delete/{id}',[BusinessTypeController::class,'delete'])->name('admin.businessType.delete');
Route::post('/admin/businessType/update',[BusinessTypeController::class,'update'])->name('admin.businessType.update');


/*-------------------------------------
Category Route
----------------------------------------*/
Route::get('/admin/category',[CategoryController::class,'view'])->name('admin.category.view');
Route::post('/admin/category/post',[CategoryController::class,'store'])->name('admin.category.store');
Route::get('/admin/category/status/{id}',[CategoryController::class,'status'])->name('admin.category.status');
Route::get('/admin/category/delete/{id}',[CategoryController::class,'delete'])->name('admin.category.delete');
Route::post('/admin/category/update',[CategoryController::class,'update'])->name('admin.category.update');
/*-------------------------------------
Sub Category Route
----------------------------------------*/
Route::get('/admin/subcategory',[SubCategoryController::class,'view'])->name('admin.subcategory.view');
Route::post('/admin/subcategory/post',[SubCategoryController::class,'store'])->name('admin.subcategory.store');
Route::get('/admin/subcategory/status/{id}',[SubCategoryController::class,'status'])->name('admin.subcategory.status');
Route::get('/admin/subcategory/delete/{id}',[SubCategoryController::class,'delete'])->name('admin.subcategory.delete');
Route::post('/admin/subcategory/update',[SubCategoryController::class,'update'])->name('admin.subcategory.update');
/*-------------------------------------
Child Category Route
----------------------------------------*/
Route::get('/admin/childcategory',[ChildCategoryController::class,'view'])->name('admin.childcategory.view');
Route::post('/admin/childcategory/post',[ChildCategoryController::class,'store'])->name('admin.childcategory.store');
Route::get('/admin/childcategory/status/{id}',[ChildCategoryController::class,'status'])->name('admin.childcategory.status');
Route::get('/admin/childcategory/delete/{id}',[ChildCategoryController::class,'delete'])->name('admin.childcategory.delete');
Route::get('/admin/childcategory/edit/{id}',[ChildCategoryController::class,'edit'])->name('admin.childcategory.edit');
Route::post('/admin/childcategory/update',[ChildCategoryController::class,'update'])->name('admin.childcategory.update');
Route::get('/findCityWithStateID/{id}',[ChildCategoryController::class,'findCityWithStateID']);

/*-------------------------------------
Admin Product Route
----------------------------------------*/
Route::get('/admin/product/create',[ProductController::class,'create'])->name('admin.product.create');
Route::post('/admin/product/post',[ProductController::class,'store'])->name('admin.product.post');
Route::get('/admin/product/list',[ProductController::class,'list'])->name('admin.product.view');
Route::get('/admin/product/status/{id}',[ProductController::class,'status'])->name('admin.product.status');
Route::get('/admin/product/delete/{id}',[ProductController::class,'delete'])->name('admin.product.delete');
Route::get('/admin/product/edit/{id}',[ProductController::class,'edit'])->name('admin.product.edit');
Route::post('/admin/product/update',[ProductController::class,'update'])->name('admin.product.update');
Route::get('get-state-list/{id}',[ProductController::class,'getStateList']);
Route::get('get-city-list/{id}',[ProductController::class,'getCityList']);


/*-------------------------------------
Supplier Product Route
----------------------------------------*/
Route::get('/supplier/product/create',[SupplierProductController::class,'create'])->name('supplier.product.create');
Route::post('/supplier/product/post',[SupplierProductController::class,'store'])->name('supplier.product.post');
// AJax Upload Product
Route::post('/supplier/ajax/post',[SupplierProductController::class,'post'])->name('supplier.productajax.post');

Route::get('/supplier/product/list',[SupplierProductController::class,'list'])->name('supplier.product.view');
Route::get('/supplier/product/status/{id}',[SupplierProductController::class,'status'])->name('supplier.product.status');
Route::get('/supplier/product/delete/{id}',[SupplierProductController::class,'delete'])->name('supplier.product.delete');
Route::get('/supplier/product/edit/{id}',[SupplierProductController::class,'edit'])->name('supplier.product.edit');
Route::post('/supplier/product/update',[SupplierProductController::class,'update'])->name('supplier.product.update');
Route::get('/supplier/product/product_image',[SupplierProductController::class,'image'])->name('supplier.product.view_product_image');
Route::get('/supplier/product/product_image_delete/{id}',[SupplierProductController::class,'image_delete'])->name('supplier.product.product_image_delete');
Route::post('/supplier/product/product_image_update',[SupplierProductController::class,'image_update'])->name('supplier.product.product_image_update');
Route::get('sup-get-state-list/{id}',[SupplierProductController::class,'getStateList']);
Route::get('sup-get-city-list/{id}',[SupplierProductController::class,'getCityList']);
Route::get('sup-get-country-list/{id}',[SupplierProductController::class,'getCountryList']);


/*-------------------------------------
Country Management
----------------------------------------*/
Route::get('/country/create',[CountryController::class,'create'])->name('admin.country.create');
Route::post('/country/post',[CountryController::class,'post'])->name('admin.country.post');
Route::get('/country/list',[CountryController::class,'list'])->name('admin.country.view');
Route::get('/country/status/{id}',[CountryController::class,'status'])->name('admin.country.status');
Route::get('/country/delete/{id}',[CountryController::class,'delete'])->name('admin.country.delete');
Route::post('/country/update',[CountryController::class,'update'])->name('admin.country.update');

/*-------------------------------------
State Management
----------------------------------------*/
Route::get('/state/create',[StateController::class,'create'])->name('admin.state.create');
Route::post('/state/post',[StateController::class,'post'])->name('admin.state.post');
Route::get('/state/list',[StateController::class,'list'])->name('admin.state.view');
Route::get('/state/status/{id}',[StateController::class,'status'])->name('admin.state.status');
Route::get('/state/delete/{id}',[StateController::class,'delete'])->name('admin.state.delete');
Route::post('/state/update',[StateController::class,'update'])->name('admin.state.update');

/*-------------------------------------
Police Station Management
----------------------------------------*/
Route::get('/police/create',[StationController::class,'create'])->name('admin.police.create');
Route::get('/state-name/{id}',[StationController::class,'stateName']);
Route::post('/police/post',[StationController::class,'post'])->name('admin.police.post');
Route::get('/police/list',[StationController::class,'list'])->name('admin.police.view');
Route::get('/police/status/{id}',[StationController::class,'status'])->name('admin.police.status');
Route::get('/police/delete/{id}',[StationController::class,'delete'])->name('admin.police.delete');
Route::post('/police/update',[StationController::class,'update'])->name('admin.police.update');

/*-------------------------------------
Email Management
----------------------------------------*/
Route::post('/email_to_supplier',[EmailController::class,'email_to_supplier'])->name('admin.supplier.email');
Route::post('/email_to_all_supplier',[EmailController::class,'email_to_all_supplier'])->name('admin.supplierall.email');
Route::post('/email_to_customer',[EmailController::class,'email_to_customer'])->name('admin.customer.email');
Route::post('/email_to_all_customer',[EmailController::class,'email_to_all_customer'])->name('admin.customerall.email');

/*-------------------------------------
Customer Management
----------------------------------------*/
Route::get('/customer/list',[CustomerController::class,'customer_list'])->name('admin.customer.view');
Route::get('/customer/status/{id}',[CustomerController::class,'customer_status'])->name('admin.customer.status');
Route::get('/customer/delete/{id}',[CustomerController::class,'customer_delete'])->name('admin.customer.delete');

// Remove route cache
Route::get('/clear-route-cache', function() {
    $exitCode = Artisan::call('route:cache');
    return 'All routes cache has just been removed';
});

//Remove config cache
Route::get('/clear-config-cache', function() {
    $exitCode = Artisan::call('config:cache');
    return 'Config cache has just been removed';
}); 

// Remove application cache
Route::get('/clear-app-cache', function() {
    $exitCode = Artisan::call('cache:clear');
    return 'Application cache has just been removed';
});

// Remove view cache
Route::get('/clear-view-cache', function() {
    $exitCode = Artisan::call('view:clear');
    return 'View cache has jut been removed';
});
// Order System
Route::get('/supplier/all_order',[SupplierOrderController::class,'all_order'])->name('supplier.all_order');
Route::get('/supplier/pending_order',[SupplierOrderController::class,'pending_order'])->name('supplier.pending_order');
Route::get('/supplier/processing_order',[SupplierOrderController::class,'processing_order'])->name('supplier.processing_order');
Route::get('/supplier/confirm_order',[SupplierOrderController::class,'confirm_order'])->name('supplier.confirm_order');
Route::get('/supplier/ongoing_order',[SupplierOrderController::class,'ongoing_order'])->name('supplier.ongoing_order');
Route::get('/supplier/delivered_order',[SupplierOrderController::class,'delivered_order'])->name('supplier.delivered_order');
Route::get('/supplier/cancel_order',[SupplierOrderController::class,'cancel_order'])->name('supplier.cancel_order');
Route::get('/supplier/all_order/delete',[SupplierOrderController::class,'order_delete'])->name('supplier.order.delete');
Route::post('/supplier/all_order/status',[SupplierOrderController::class,'order_status'])->name('supplier.order.status');
// Supplier Order Download
Route::get('/download/order/{id}',[SupplierOrderController::class,'download_order'])->name('supplier.download.order');

//Tracking System
Route::post('/supplier/tracking',[SupplierTrackingController::class,'tracking_post'])->name('supplier.track.post');
Route::get('/track',[FrontendController::class,'track'])->name('track');
Route::post('/track/order',[FrontendController::class,'track_order'])->name('track.post');
// Customer Track

Route::get('/customer/track',[CustomerOrderController::class,'customer_track'])->name('customer.track');
Route::post('/customer/post',[CustomerOrderController::class,'customer_track_post'])->name('customer.trackPost');
// Customer Order
Route::get('/my-order',[CustomerOrderController::class,'my_order'])->name('customer.orders');
Route::post('/customer/message/post',[CustomerOrderController::class,'customer_message_post'])->name('customer.message.post');