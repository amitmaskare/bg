<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\SubcategoryController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\WeightController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\CurrencyController;
use App\Http\Controllers\Admin\ListingController;
use App\Http\Controllers\Admin\ProductFieldController;
use App\Http\Controllers\Admin\StockLocationController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\BidController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\CouponController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\RolePermissionController;
use App\Http\Controllers\Admin\EmployeeController;
use App\Http\Controllers\Admin\AdminMessageController;
use App\Http\Controllers\Admin\PackageController;
use App\Http\Controllers\Admin\AdminReviewController;
use App\Http\Controllers\Admin\CmsController;
use App\Http\Controllers\Admin\TemplateController;

// frontend
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\AddressController;
use App\Http\Controllers\UserDashboardController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderInfoController;
use App\Http\Controllers\ShiprocketController;
use App\Http\Controllers\ListingFilterController;
use App\Http\Controllers\WhatsAppController;
use App\Http\Controllers\StripePaymentController;
use App\Http\Controllers\GoogleauthController;


// Route::get('/', function () {
//     return view('welcome');
// });

// frontend Route
Route::get('/', [HomeController::class, 'index'])->name('/');
Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::get('/authlogin', [AuthController::class, 'authlogin'])->name('authlogin');
Route::get('/shopdetail/{id}', [HomeController::class, 'shopdetail'])->name('shopdetail');

Route::post('/place-bid', [HomeController::class, 'store']);
Route::get('/check-quantity/{id}', [HomeController::class, 'checkQuantity']);
Route::get('/userdashboard', [HomeController::class, 'dashboard'])->name('userdashboard');
Route::post('/bid/update-status/{id}', [HomeController::class, 'updateStatus'])->name('bid.updateStatus');
Route::post('/bids/{bid}/status', [HomeController::class, 'updateStatusCounterd']);
Route::post('/save-profileUpdate', [HomeController::class, 'saveprofileData'])->name('saveprofileData');
Route::post('/change-updatePassword', [HomeController::class, 'updatePassword'])->name('updatePassword');
Route::post('/addresses', [AddressController::class, 'store'])->name('addresses.store');
Route::delete('/addresses/{id}', [AddressController::class, 'destroy'])->name('addresses.destroy');
Route::get('/addresses/{id}', [AddressController::class, 'show']);
Route::put('/addresses/{id}', [AddressController::class, 'update']);
Route::get('/userProfile', [HomeController::class, 'userProfile'])->name('userProfile');
Route::get('/userAddress', [HomeController::class, 'userAddress'])->name('userAddress');
Route::get('/myOrderInfo', [UserDashboardController::class, 'myOrderInfo'])->name('myOrderInfo');
Route::get('/myBidInfo', [HomeController::class, 'myBidInfo'])->name('myBidInfo');
Route::post('/saveRegister', [AuthController::class, 'saveRegister'])->name('saveRegister');
Route::post('/loginuser', [AuthController::class, 'loginuser'])->name('auth.loginuser');
Route::get('/userlogout', [AuthController::class, 'logout'])->name('userlogout');
Route::get('/purchaseOrder', [UserDashboardController::class, 'purchaseOrder'])->name('purchaseOrder');
Route::get('/mywishList', [UserDashboardController::class, 'mywishList'])->name('mywishList');
Route::get('/mywalletList', [UserDashboardController::class, 'mywalletList'])->name('mywalletList');
Route::get('/mytransactionList', [UserDashboardController::class, 'mytransactionList'])->name('mytransactionList');
Route::get('order_view/{id}', [UserDashboardController::class, 'order_view'])->name('order_view');
Route::post('/user/bid-expire/{bidId}', [UserDashboardController::class, 'expireBid']);
Route::get('/messageList', [UserDashboardController::class, 'messageList'])->name('messageList');
Route::get('/user/messages/thread/{productId}', [UserDashboardController::class, 'messageThread'])
    ->name('user.messages.thread');
Route::post('/user/messages/send', [UserDashboardController::class, 'sendMessage'])->name('user.messages.send');


Route::post('/wishListadd', [UserDashboardController::class, 'wishListadd'])->name('wishListadd');

Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
Route::get('/cart/count', [CartController::class, 'getCount'])->name('cart.count');
Route::post('/cart/update-quantity', [CartController::class, 'updateQuantity'])->name('cart.updateQuantity');

Route::post('/deleteCart', [CartController::class, 'deleteCart'])->name('deleteCart');

Route::get('/checkout', [UserDashboardController::class, 'checkout'])->name('checkout');
Route::post('/orders', [OrderInfoController::class, 'orders'])->name('orders');
Route::post('/saveCard',[OrderInfoController::class,'saveCard'])->name('saveCard');
Route::get('/successorder/{orderId}', [OrderInfoController::class, 'success'])->name('successorder');

Route::get('admin/login', [LoginController::class, 'index'])->name('admin/login');
Route::post('actionLogin', [LoginController::class, 'actionLogin'])->name('actionLogin');

// shiprockert api
//Route::get('/check-serviceability', [ShiprocketController::class, 'checkServiceability']);

// ffilter
Route::get('/shop', [ListingFilterController::class, 'index'])->name('shop');
Route::get('/ajaxFilter', [ListingFilterController::class, 'ajaxFilter'])->name('ajaxFilter');
Route::post('/search', [ListingFilterController::class, 'search'])->name('search');


Route::get('order_view_pdf/{id}', [UserDashboardController::class, 'order_view_pdf'])->name('order_view_pdf');
Route::post('/reviews', [UserDashboardController::class, 'store'])->name('reviews.store');

Route::post('/send-message', [HomeController::class, 'send'])->name('messages.send');
Route::post('/addresses/storecheckoute', [AddressController::class, 'storecheckoute'])->name('addresses.storecheckoute');
Route::get('/aboutus', [HomeController::class, 'aboutus'])->name('aboutus');
Route::get('/blogs', [HomeController::class, 'blogs'])->name('blogs');
Route::get('/blog-detail/{id}', [HomeController::class, 'show'])->name('blogs_detail');

Route::get('/contactus', [HomeController::class, 'contactus'])->name('contactus');
Route::post('/contact-submit', [HomeController::class, 'storeContact'])->name('contact.store');
Route::get('/terms_condition', [HomeController::class, 'terms_condition'])->name('terms_condition');
Route::get('/privacy_policy', [HomeController::class, 'privacy_policy'])->name('privacy_policy');

// stripe payment
//Route::get('/payment', [StripePaymentController::class, 'index'])->name('payment');
Route::post('/payment/checkout', [StripePaymentController::class, 'payment'])->name('payment.checkout');
Route::get('/save-card', [StripePaymentController::class, 'setupCard'])->name('save-card');
Route::post('/charge', [StripePaymentController::class, 'chargeSavedCard'])->middleware('auth');
Route::post('/save-payment-method', [StripePaymentController::class, 'savePaymentMethod']);

Route::get('/auth/google-login', [GoogleauthController::class, 'redirectToGoogle']);
Route::get('/auth/google-login/callback', [GoogleauthController::class, 'handleGoogleCallback']);

Route::prefix('admin')->middleware(['auth.admin'])->namespace('App\Http\Controllers\Admin')->group(function () {
    Route::get('logout', [LoginController::class, 'logout'])->name('logout');
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::post('updateProfile', [LoginController::class, 'updateProfile'])->name('updateProfile');
    Route::get('profile', [LoginController::class, 'profile'])->name('profile');
    Route::get('changepassword', [LoginController::class, 'changePassword'])->name('changepassword');
    Route::post('updatePassword', [LoginController::class, 'updatePassword'])->name('updatePassword');

    // category
    Route::get('category', [CategoryController::class, 'index'])->name('category');
    Route::post('category_ajax_manage_page', [CategoryController::class, 'ajax_manage_page'])->name('category_ajax_manage_page');
    Route::post('saveCategory', [CategoryController::class, 'saveCategory'])->name('saveCategory');
    Route::post('category_getvalue', [CategoryController::class, 'getValue'])->name('category_getvalue');
    Route::post('category_update', [CategoryController::class, 'category_update'])->name('category_update');
    Route::post('category_update', [CategoryController::class, 'category_update'])->name('category_update');
    Route::get('category_delete/{id}', [CategoryController::class, 'category_delete']);

    Route::get('subcategory', [SubcategoryController::class, 'index'])->name('subcategory');
    Route::post('subcategory_ajax_manage_page', [SubcategoryController::class, 'ajax_manage_page'])->name('subcategory_ajax_manage_page');
    Route::get('subcategory/edit/{id}', [SubcategoryController::class, 'edit'])->name('subcategory.edit');
    Route::put('/subcategory/update/{id}', [SubcategoryController::class, 'update'])->name('subcategory.update');

    Route::get('addsubcategory', [SubcategoryController::class, 'addsubcategory'])->name('addsubcategory');
    Route::post('saveSubcategory', [SubcategoryController::class, 'saveSubcategory'])->name('saveSubcategory');
    Route::post('subcategory_getvalue', [SubcategoryController::class, 'getValue'])->name('subcategory_getvalue');
    Route::post('subcategory_update', [SubcategoryController::class, 'subcategory_update'])->name('subcategory_update');
    Route::get('subcategory_delete/{id}', [SubcategoryController::class, 'subcategory_delete'])->name('subcategory_delete');

    Route::get('role', [RoleController::class, 'index'])->name('role');
    Route::post('saverole', [RoleController::class, 'saverole'])->name('saverole')->middleware('menuper:role-create');
    Route::post('role_getvalue', [RoleController::class, 'getValue'])->name('role_getvalue')->middleware('menuper:role-update');
    Route::get('role_delete/{id}', [RoleController::class, 'role_delete'])->name('role_delete')->middleware('menuper:role-delete');

    // Permission
    Route::get('permission', [PermissionController::class, 'index'])->name('permission');
    Route::post('permission_ajax_manage_page', [PermissionController::class, 'ajax_manage_page'])->name('permission_ajax_manage_page');
    Route::post('savepermission', [PermissionController::class, 'savepermission'])->name('savepermission');
    Route::post('permission_getvalue', [PermissionController::class, 'getValue'])->name('permission_getvalue');
    Route::get('permission_delete/{id}', [PermissionController::class, 'permission_delete'])->name('permission_delete');

    // Role Permission
    Route::get('rolepermission', [RolePermissionController::class, 'index'])->name('rolepermission');
    Route::get('rolepermission/add', [RolePermissionController::class, 'add'])->name('rolepermission.add');
    Route::get('rolepermission/edit/{id}', [RolePermissionController::class, 'edit'])->name('rolepermission.edit');
    Route::post('givepermission', [RolePermissionController::class, 'givepermission'])->name('givepermission');

    Route::get('weight', [WeightController::class, 'index'])->name('weight');
    Route::post('saveWeight', [WeightController::class, 'saveWeight'])->name('saveWeight');

    Route::post('weight_getvalue', [WeightController::class, 'getValue'])->name('weight_getvalue');
    Route::post('weight_update', [WeightController::class, 'weight_update'])->name('weight_update');
    Route::post('weight_update', [WeightController::class, 'weight_update'])->name('weight_update');
    Route::get('weight_delete/{id}', [WeightController::class, 'weight_delete'])->name('weight_delete');

    Route::get('brand', [BrandController::class, 'index'])->name('brand');
    Route::post('saveBrand', [BrandController::class, 'saveBrand'])->name('saveBrand');
    Route::post('saveBrandAjax', [BrandController::class, 'saveBrandAjax'])->name('saveBrandAjax');
    Route::post('saveCategoryAjax', [CategoryController::class, 'saveCategoryAjax'])->name('saveCategoryAjax');
    Route::post('saveMeasureAjax', [WeightController::class, 'saveMeasureAjax'])->name('saveMeasureAjax');
    Route::post('brand_getvalue', [BrandController::class, 'getValue'])->name('brand_getvalue');
    Route::post('updateBrand', [BrandController::class, 'updateBrand'])->name('updateBrand');
    Route::get('deleteBrand/{id}', [BrandController::class, 'deleteBrand'])->name('deleteBrand');
    Route::post('brand_ajax_manage_page', [BrandController::class, 'ajax_manage_page'])->name('brand_ajax_manage_page');

    Route::get('currency', [CurrencyController::class, 'index'])->name('currency');
    Route::post('saveCurrency', [CurrencyController::class, 'saveCurrency'])->name('saveCurrency');
    Route::post('currency_getvalue', [CurrencyController::class, 'getValue'])->name('currency_getvalue');
    Route::post('updateCurrency', [CurrencyController::class, 'updateCurrency'])->name('updateCurrency');
    Route::get('deleteCurrency/{id}', [CurrencyController::class, 'deleteCurrency'])->name('deleteCurrency');

    Route::get('productfield', [ProductFieldController::class, 'index'])->name('productfield');

    Route::get('product', [ProductController::class, 'index'])->name('product');
    Route::get('addproduct', [ProductController::class, 'addproduct'])->name('addproduct');
    Route::post('saveproduct', [ProductController::class, 'saveproduct'])->name('saveproduct');
    Route::post('product_ajax_manage_page', [ProductController::class, 'ajax_manage_page'])->name('product_ajax_manage_page');

    Route::post('getSubcategoryValue', [ProductController::class, 'getSubcategoryValue'])->name('getSubcategoryValue');
    Route::post('getadditionalfield', [ProductController::class, 'getadditionalfield'])->name('getadditionalfield');
    Route::post('getadditionalfieldInListing', [ListingController::class, 'getadditionalfieldInListing'])->name('getadditionalfieldInListing');
    Route::get('/product/edit/{id}', [ProductController::class, 'edit'])->name('product.edit');
    Route::post('/product/update/{id}', [ProductController::class, 'update'])->name('product.update');
    Route::get('/product/delete/{id}', [ProductController::class, 'delete'])->name('product.delete');
    Route::post('/product/deleteImg', [ProductController::class, 'deleteImg'])->name('product.deleteImg');
    Route::get('/viewproduct/{id}', [ProductController::class, 'view'])->name('viewproduct');

    Route::get('listingproduct', [ListingController::class, 'index'])->name('listingproduct');
    Route::get('addlistingproduct', [ListingController::class, 'addlistingproduct'])->name('addlistingproduct');
    Route::post('savelistingproduct', [ListingController::class, 'savelistingproduct'])->name('savelistingproduct');
    Route::post('getProductValue', [ListingController::class, 'getProductValue'])->name('getProductValue');
    Route::post('getProductData', [ListingController::class, 'getProductData'])->name('getProductData');
    Route::POST('getproductInfoforView', [ListingController::class, 'getproductInfoforView'])->name('getproductInfoforView');


    Route::get('/listingproduct/delete/{id}', [ListingController::class, 'delete'])->name('listingproduct.delete');
    Route::get('/listingproduct/edit/{id}', [ListingController::class, 'edit'])->name('listingproduct.edit');
    Route::put('/listingproduct/update/{id}', [ListingController::class, 'update'])->name('listingproduct.update');
    Route::get('/listingproduct/view/{id}', [ListingController::class, 'view'])->name('listingproduct.view');
    Route::post('/listingproduct/updateStatus', [ListingController::class, 'updateStatus'])->name('listingproduct.updateStatus');
    Route::get('/listinglogs', [ListingController::class, 'listinglogs'])->name('listinglogs');
    Route::post('/changeStatus', [ListingController::class, 'changeStatus'])->name('changeStatus');
    Route::post('getproductInfoforView', [ListingController::class, 'getproductInfoforView'])->name('getproductInfoforView');

    Route::get('stockLocations', [StockLocationController::class, 'index'])->name('stockLocations');
    Route::get('addstockLocations', [StockLocationController::class, 'addstockLocations'])->name('addstockLocations');
    Route::post('savestockLocations', [StockLocationController::class, 'savestockLocations'])->name('savestockLocations');
    Route::get('stock-locations/edit/{id}', [StockLocationController::class, 'edit'])->name('stockLocations.edit');
    Route::post('update-stock-location', [StockLocationController::class, 'update'])->name('updatestockLocations');
    Route::get('stock-locations/delete/{id}', [StockLocationController::class, 'delete'])->name('stockLocations.delete');
    Route::post('stocklocation_ajax_manage_page', [StockLocationController::class, 'ajax_manage_page'])->name('stocklocation_ajax_manage_page');

    Route::get('/banners', [BannerController::class, 'index'])->name('banners');
    Route::post('banner_ajax_manage_page', [BannerController::class, 'ajax_manage_page'])->name('banner_ajax_manage_page');
    Route::post('/banners', [BannerController::class, 'store'])->name('banners.store');
    Route::post('banner_getvalue', [BannerController::class, 'getValue'])->name('banner_getvalue');
    Route::post('/updateBanner', [BannerController::class, 'updateBanner'])->name('banners.updateBanner');
    Route::get('deleteBanner/{id}', [BannerController::class, 'deleteBanner']);

    Route::get('/blog', [BlogController::class, 'index'])->name('blog');
    Route::get('/addBlog', [BlogController::class, 'addBlog'])->name('addBlog');
    Route::post('/saveBlogs', [BlogController::class, 'saveBlogs'])->name('saveBlogs');
    Route::get('/blog/edit/{id}', [BlogController::class, 'edit'])->name('blog.edit');
    Route::post('/blog/update/{id}', [BlogController::class, 'update'])->name('blog.update');
    Route::delete('/blog/delete/{id}', [BlogController::class, 'destroy'])->name('blog.delete');
    Route::post('blog_ajax_manage_page', [BlogController::class, 'ajax_manage_page'])->name('blog_ajax_manage_page');
    Route::post('saveStockAjax', [StockLocationController::class, 'saveStockAjax'])->name('saveStockAjax');

    // Bid
    Route::get('/bids', [BidController::class, 'list'])->name('bids');
    Route::get('/bidlist/{id}', [BidController::class, 'bidlist'])->name('bidlist');
    Route::post('/updateStatus', [BidController::class, 'updateStatus'])->name('updateStatus');
    Route::post('/bids/expire/{bidId}', [BidController::class, 'expire'])->name('expire');

    // Order
    Route::get('/order', [OrderController::class, 'index'])->name('order');
    Route::get('/order_detail/{id}', [OrderController::class, 'order_detail'])->name('order_detail');
    Route::get('/transaction', [OrderController::class, 'transaction'])->name('transaction');

    // coupon
    Route::get('/coupon', [CouponController::class, 'index'])->name('coupon');
    Route::post('/saveCoupon', [CouponController::class, 'saveCoupon'])->name('saveCoupon');
    Route::post('/coupon_getvalue', [CouponController::class, 'coupon_getvalue'])->name('coupon_getvalue');
    Route::get('/deleteCoupon/{id}', [CouponController::class, 'deleteCoupon'])->name('deleteCoupon');

    // setting
    Route::get('/setting', [SettingController::class, 'index'])->name('setting');
    Route::post('/site_setting', [SettingController::class, 'site_setting'])->name('site_setting');
    Route::post('/logo_setting', [SettingController::class, 'logo_setting'])->name('logo_setting');

    //Employee
    Route::get('/employee', [EmployeeController::class, 'index'])->name('employee');
    Route::get('/employee/create', [EmployeeController::class, 'create'])->name('employee.create');
    //Route::post('/employee/store',[EmployeeController::class,'store'])->name('employee.store');
    Route::get('/employee/edit/{id}', [EmployeeController::class, 'edit'])->name('employee.edit');
    //   Route::put('/employee/update/{id}', [EmployeeController::class, 'update'])->name('employee.update');

    Route::get('/employee/delete/{id}', [EmployeeController::class, 'destroy'])->name('employee.delete');
    Route::post('/employee/save', [EmployeeController::class, 'save'])->name('employee.store');

    // Update existing employee (with ID)
    Route::post('/employee/save/{id}', [EmployeeController::class, 'save'])->name('employee.update');
    Route::post('/update-role', [EmployeeController::class, 'updateRole'])->name('updateRole');
    Route::get('/employee/empPermission/{id}', [EmployeeController::class, 'empPermission'])->name('employee.empPermission');
    Route::post('empgivepermission', [EmployeeController::class, 'empgivepermission'])->name('empgivepermission');
    Route::get('/admin/messages', [AdminMessageController::class, 'index'])->name('admin.messages');
    Route::get('/admin/thread/{productId}', [AdminMessageController::class, 'thread'])->name('admin.thread');
    Route::put('/messages/status/{id}', [AdminMessageController::class, 'updateStatus'])
        ->name('admin.updateStatus');

    Route::put('/messages/reply/{id}', [AdminMessageController::class, 'reply'])->name('admin.reply');

    // Send message (user/seller)
    Route::post('/messages/send', [AdminMessageController::class, 'send'])->name('admin.messages.send');

    // package
    Route::get('/package', [PackageController::class, 'index'])->name('package');
    Route::get('/package/add', [PackageController::class, 'add'])->name('package.add');
    Route::post('package/save', [PackageController::class, 'save'])->name('package.save');
    Route::get('/package/edit/{id}', [PackageController::class, 'edit'])->name('package.edit');
    Route::get('/package/delete/{id}', [PackageController::class, 'delete'])->name('package.delete');
    Route::get('/admin/reviews', [AdminReviewController::class, 'index'])->name('admin.reviews.index');
    Route::post('review_ajax_manage_page', [AdminReviewController::class, 'ajax_manage_page'])->name('review_ajax_manage_page');

    Route::put('/reviews/status/{id}', [AdminReviewController::class, 'updateStatus'])->name('admin.reviews.status');

    Route::get('admin/cms/manage', [CmsController::class, 'manage'])->name('admin.cms.manage');
    Route::put('admin/cms/update/{id}', [CmsController::class, 'update'])->name('admin.cms.update');
    Route::get('admin/cms/home', [CmsController::class, 'home'])->name('admin.cms.home');
    Route::put('admin/cms/home/update/{id}', [CmsController::class, 'updateHome'])->name('admin.cms.home.update');

    Route::get('/admin/contact_messages_website', [AdminMessageController::class, 'contact_messages_website'])->name('admin.contact_messages_website');
    Route::get('/message_deletes/{id}', [AdminMessageController::class, 'message_deletes'])->name('admin.message_deletes');

    Route::get('/template', [TemplateController::class, 'index'])->name('template');
    Route::get('/template/add', [TemplateController::class, 'add'])->name('template.add');
    Route::post('/saveTemplate', [TemplateController::class, 'saveTemplate'])->name('saveTemplate');

    // email template
    Route::get('/email-template', [TemplateController::class, 'email_template'])->name('email_template');
    Route::post('/email-template-update', [TemplateController::class, 'updateEmailTemplate'])->name('save_email_template');
});
Route::get('whatsapp', [WhatsAppController::class, 'index']);
Route::get('/checkoutForm', [StripePaymentController::class, 'checkoutForm']);
Route::post('/pay-first-time', [StripePaymentController::class, 'payFirstTime']);
Route::post('/pay-with-saved', [StripePaymentController::class, 'payWithSavedCard']);