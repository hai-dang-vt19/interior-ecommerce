<?php

use App\Exports\BillExport;
use App\Exports\HistoryExport;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\interiorController;
use App\Http\Controllers\interiorPostController;
use App\Http\Controllers\statusController;
use App\Http\Controllers\provinceCityController;
use App\Http\Controllers\colorController;
use App\Http\Controllers\userController;
use App\Http\Controllers\historyController;
Use App\Http\Controllers\typeController;
Use App\Http\Controllers\materialSupplierController;
Use App\Http\Controllers\calendarController;
use App\Http\Controllers\calenderController;
use App\Http\Controllers\cartController;
use App\Http\Controllers\checkoutContorller;
use App\Http\Controllers\favoriteController;
use App\Http\Controllers\productController;
use App\Http\Controllers\slideController;
use App\Http\Controllers\warehouseController;

//----------------------------------login------------------------------------------------------------
Route::get('/login', [interiorController::class,'login'])->name('login');
Route::post('/interior-login', [interiorPostController::class,'login_interior'])->name('login_interior');
Route::get('/register-interior', [interiorController::class,'register'])->name('register');
Route::post('/register', [interiorPostController::class, 'register_interior'])->name('register_interior');
Route::get('/logout/interior',[interiorPostController::class, 'logout'])->name('logout');

Route::get('/notsIn', [interiorController::class, 'cod403'])->name('cod403');

//----------------------------------dashboard------------------------------------------------------------
Route::get('/dashboard-interior', [interiorController::class,'index_dashboard'])->middleware(['can:admin','auth'])->name('index_dashboard');
Route::get('/detail/method=', [interiorController::class, 'detail_with_method_dash'])->middleware(['can:admin','auth'])->name('detail_with_method_dash');
Route::get('bill/detail/{id}', [interiorController::class, 'detail_bill'])->name('detail_bill');

Route::get('/new-bill', [interiorController::class, 'create_bill_dashboard'])->middleware('can:admin_manager_staff','auth')->name('create_bill_dashboard');
Route::post('/new-bill-post', [checkoutContorller::class, 'up_to_cart_dashboard'])->middleware('can:admin_manager_staff','auth')->name('up_to_cart_dashboard');
Route::get('/destroy-card-dashboard/{id}', [checkoutContorller::class, 'drestroy_cart_dashboad'])->middleware('can:admin_manager_staff')->name('drestroy_cart_dashboad');

Route::get('/dashboard-product', [interiorController::class, 'product_dashboard'])->middleware(['can:admin_manager','auth'])->name('product_dashboard');
Route::get('/dashboard-product/{id}', [interiorController::class, 'product_dashboard2'])->middleware(['can:admin_manager','auth'])->name('product_dashboard2');
Route::post('/dashboard-add-product', [productController::class, 'add_product'])->middleware(['can:admin_manager','auth'])->name('add_product');
Route::get('/dashboard-list-product', [interiorController::class,'list_product_dashboard'])->middleware(['can:admin_manager_staff','auth'])->name('list_product_dashboard');
Route::get('/dashboard-edit-list-product/{id}', [interiorController::class, 'edit_product'])->middleware(['can:admin_manager','auth'])->name('edit_product');
Route::post('/dashboard-update-list-product/{id}', [productController::class, 'udpate_product'])->middleware(['can:admin_manager','auth'])->name('udpate_product');
Route::get('/dashboard-destroy-product/{id}', [productController::class, 'destroy_product'])->middleware(['can:admin_manager','auth'])->name('destroy_product');


// Route::get('/dashboard-type', [interiorController::class, 'type_dashboard'])->middleware(['can:admin_manager','auth'])->name('type_dashboard');
Route::post('/dashboard-type-product', [typeController::class, 'add_type_product'])->middleware(['can:admin_manager','auth'])->name('add_type_product');
Route::get('/dashboard-list-type', [interiorController::class,'list_type_dashboard'])->middleware(['can:admin_manager','auth'])->name('list_type_dashboard');
Route::get('/dashboard-edit-list-type-product/{id}', [interiorController::class, 'edit_type_product'])->middleware(['can:admin_manager','auth'])->name('edit_type_product');
Route::post('/dashboard-update-list-type-product/{id}', [typeController::class, 'update_type_product'])->middleware(['can:admin_manager','auth'])->name('update_type_product');
Route::get('/dashboard-destroy-type-product/{id}', [typeController::class, 'destroy_type_product'])->middleware(['can:admin_manager','auth'])->name('destroy_type_product');

Route::get('/dashboard-supplier', [interiorController::class, 'supplier_dashboard'])->middleware(['can:admin_manager','auth'])->name('supplier_dashboard');
Route::post('/dashboard-add-supplier', [materialSupplierController::class, 'add_supplier'])->middleware(['can:admin_manager','auth'])->name('add_supplier');
Route::get('/dashboard-edit-supplier/{id}', [interiorController::class, 'edit_supplier'])->middleware(['can:admin_manager','auth'])->name('edit_supplier');
Route::post('/dashboard-update-supplier/{id}', [materialSupplierController::class, 'update_supplier'])->middleware(['can:admin_manager','auth'])->name('update_supplier');
Route::get('/dashboard-destroy-supplier/{id}', [materialSupplierController::class, 'destroy_supplier'])->middleware(['can:admin_manager','auth'])->name('destroy_supplier');

Route::get('/dashboard-material', [interiorController::class, 'material_dashboard'])->middleware(['can:admin_manager','auth'])->name('material_dashboard');
Route::post('/dashboard-add-material', [materialSupplierController::class, 'add_material'])->middleware(['can:admin_manager','auth'])->name('add_material');
Route::get('/dashboard-edit-material/{id}', [interiorController::class, 'edit_material'])->middleware(['can:admin_manager','auth'])->name('edit_material');
Route::post('/dashboard-update-material/{id}', [materialSupplierController::class, 'update_material'])->middleware(['can:admin_manager','auth'])->name('update_material');
Route::get('/dashboard-destroy-material/{id}', [materialSupplierController::class, 'destroy_material'])->middleware(['can:admin_manager','auth'])->name('destroy_material');

Route::get('/dashboard-warehouse', [interiorController::class, 'warehouse_dashboard'])->middleware(['can:admin_manager','auth'])->name('warehouse_dashboard');
Route::get('/dashboard-warehouse/{id}', [interiorController::class, 'warehouse_dashboard2'])->middleware(['can:admin_manager','auth'])->name('warehouse_dashboard2');
Route::post('/dashboard-add-warehouse', [warehouseController::class, 'add_warehouse'])->middleware(['can:admin_manager','auth'])->name('add_warehouse');
Route::get('/dashboard-edit-warehouse/{id}', [interiorController::class, 'edit_warehouse'])->middleware(['can:admin_manager','auth'])->name('edit_warehouse');
Route::post('/dasboard-update-warehouse/{id}', [warehouseController::class, 'update_warehouse'])->middleware(['can:admin_manager','auth'])->name('update_warehouse');
Route::get('/dashboard-destroy-warehouse/{id}', [warehouseController::class, 'destroy_warehouse'])->middleware(['can:admin_manager','auth'])->name('destroy_warehouse');
Route::get('/dashboard-list-warehouse', [interiorController::class,'list_warehouse_dashboard'])->middleware(['can:admin_manager','auth'])->name('list_warehouse_dashboard');

Route::get('/dashboard-user', [interiorController::class, 'user_dashboard'])->middleware(['can:admin_manager','auth'])->name('user_dashboard');
Route::post('/dashboard-add-user', [userController::class, 'add_user'])->middleware(['can:admin_manager','auth'])->name('add_user');
Route::get('/dashboard-list-user', [interiorController::class,'list_user_dashboard'])->middleware(['can:admin_manager_staff','auth'])->name('list_user_dashboard');
Route::get('/dashboard-edit-list-user/{id}', [interiorController::class, 'edit_list_user'])->middleware(['can:admin_manager','auth'])->name('edit_list_user');
Route::post('/dashboard-update-list-user/{id}', [userController::class, 'update_list_user'])->middleware(['can:admin_manager','auth'])->name('update_list_user');

Route::get('/dashboard-profile-user', [interiorController::class, 'edit_profile_user'])->middleware(['can:admin_manager_staff','auth'])->name('edit_profile_user');
Route::get('/dashboard-profile-user-address/{id}', [interiorController::class, 'edit_profile_address_user'])->middleware(['can:admin_manager_staff','auth'])->name('edit_profile_address_user');
Route::post('/dashboard-update-profile-user/{id}', [userController::class, 'update_profile_user'])->middleware(['can:admin_manager_staff','auth'])->name('update_profile_user');
Route::post('/dashboard-update-profile-addess-user/{id}', [userController::class, 'update_profile_adress_user'])->middleware(['can:admin_manager_staff','auth'])->name('update_profile_adress_user');
Route::get('/dashboard-destroy-user/{id}', [userController::class, 'destroy_user'])->middleware(['can:admin_manager','auth'])->name('destroy_user');
//Chức năng xem dữ liệu User
Route::get('/dashboard-user-roles', [interiorController::class, 'user_name_roles_us'])->middleware(['can:admin_manager_staff','auth'])->name('user_name_roles_us');
Route::get('/dashboard-user-interior', [interiorController::class, 'user_interior'])->middleware(['can:admin_manager_staff','auth'])->name('user_interior');
Route::get('/dashboard-user-city', [interiorController::class, 'user_city'])->middleware(['can:admin_manager_staff','auth'])->name('user_city');
Route::get('/dashboard-user-province', [interiorController::class, 'user_province'])->middleware(['can:admin_manager_staff','auth'])->name('user_province');
Route::get('/dashboard-user-hoatdong', [interiorController::class, 'user_hoatdong'])->middleware(['can:admin_manager_staff','auth'])->name('user_hoatdong');
Route::get('/dashboard-user-ngat', [interiorController::class, 'user_ngat'])->middleware(['can:admin_manager_staff','auth'])->name('user_ngat');
//Reset password dashboard
Route::get('/dashboard-user-reset-password/{id}', [userController::class,'reset_pw'])->middleware(['can:admin_manager_staff','auth'])->name('reset_pw');
Route::post('/dashboard-user-reset-password-us', [userController::class, 'reset_pass_with_user'])->middleware(['can:admin_manager_staff','auth'])->name('reset_pass_with_user');
//


// Route::get('/dashboard-favorite', [interiorController::class, 'favorite_dashboard'])->middleware(['can:admin_manager','auth'])->name('favorite_dashboard');
Route::get('/dashboard-list-favorite', [interiorController::class,'list_favorite_dashboard'])->middleware(['can:admin_manager','auth'])->name('list_favorite_dashboard');

// Route::get('/dashboard-cart', [interiorController::class, 'cart_dashboard'])->middleware(['can:admin_manager','auth'])->name('cart_dashboard');
Route::get('/dashboard-list-cart', [interiorController::class,'list_cart_dashboard'])->middleware(['can:admin_manager','auth'])->name('list_cart_dashboard');

Route::get('/dashboard-list-province', [interiorController::class,'list_province_dashboard'])->middleware(['can:admin_manager','auth'])->name('list_province_dashboard');
Route::post('/dashboard-add-province', [provinceCityController::class, 'add_province'])->middleware(['can:admin','auth'])->name('add_province');
Route::get('/dashboard-edit-province/{id}', [interiorController::class, 'edit_province_dashboard'])->middleware(['can:admin','auth'])->name('edit_province_dashboard');
Route::post('/dashboard-update-province/{id}', [provinceCityController::class, 'update_province'])->middleware(['can:admin','auth'])->name('update_province');
Route::get('/dashboard-destroy-province/{id}', [provinceCityController::class, 'destroy_province'])->middleware(['can:admin','auth'])->name('destroy_province');

Route::post('/dashboard-add-city', [provinceCityController::class, 'add_city'])->middleware(['can:admin','auth'])->name('add_city');
Route::get('/dashboard-edit-city/{id}', [interiorController::class, 'edit_city_dashboard'])->middleware(['can:admin','auth'])->name('edit_city_dashboard');
Route::post('/dashboard-update-city/{id}', [provinceCityController::class, 'update_city'])->middleware(['can:admin','auth'])->name('update_city');
Route::get('/dashboard-destroy-city/{id}', [provinceCityController::class, 'destroy_city'])->middleware(['can:admin','auth'])->name('destroy_city');

Route::get('/dashboard-comment', [interiorController::class, 'comment_dashboard'])->middleware(['can:admin_manager','auth'])->name('comment_dashboard');

Route::get('/dashboard-roles', [interiorController::class, 'roles_dashboard'])->middleware(['can:admin','auth'])->name('roles_dashboard');
Route::post('/dashboard-add-roles', [statusController::class, 'add_roles'])->middleware(['can:admin','auth'])->name('add_roles');
Route::get('/dashboard-edit-roles/{id}', [interiorController::class, 'edit_roles_dashboard'])->middleware(['can:admin','auth'])->name('edit_roles_dashboard');
Route::post('/dashboard-update-roles/{id}', [statusController::class, 'update_roles'])->middleware(['can:admin','auth'])->name('update_roles');
Route::get('/dashboard-destroy-roles/{id}', [statusController::class, 'destroy_roles'])->middleware(['can:admin','auth'])->name('destroy_roles');

Route::get('/dashboard-status', [interiorController::class, 'status_dashboard'])->middleware(['can:admin','auth'])->name('status_dashboard');
Route::post('/dashboard-add-status', [statusController::class, 'add_status'])->middleware(['can:admin','auth'])->name('add_status');
Route::get('/dashboard-edit-status/{id}', [interiorController::class, 'edit_status_dashboard'])->middleware(['can:admin','auth'])->name('edit_status_dashboard');
Route::post('/dashboard-update-status/{id}', [statusController::class, 'update_status'])->middleware(['can:admin','auth'])->name('update_status');
Route::get('/dashboard-destroy-status/{id}', [statusController::class, 'destroy_status'])->middleware(['can:admin','auth'])->name('destroy_status');

Route::get('/dashboard-type-status', [interiorController::class, 'type_status_dashboard'])->middleware(['can:admin','auth'])->name('type_status_dashboard');
Route::post('/dashboard-add-type-status',[statusController::class,'add_type_status'])->middleware(['can:admin','auth'])->name('add_type_status');
Route::get('/dashboard-edit-type-status/{id}', [interiorController::class, 'edit_type_status_dashboard'])->name('edit_type_status_dashboard');
Route::post('/dashboard-update-type-status/{id}', [statusController::class,'update_type_status'])->middleware(['can:admin','auth'])->name('update_type_status');
Route::get('/dashboard-destroy-type-status/{id}', [statusController::class, 'destroy_type_status'])->middleware(['can:admin','auth'])->name('destroy_type_status');

Route::get('/dashboard-discount', [interiorController::class, 'discount_dashboard'])->middleware(['can:admin_manager','auth'])->name('discount_dashboard');
Route::post('/dashboard-add-discount', [statusController::class, 'add_discount'])->middleware(['can:admin','auth'])->name('add_discount');
Route::get('/dashboard-edit-discount/{id}', [interiorController::class, 'edit_discount_dashboard'])->middleware(['can:admin','auth'])->name('edit_discount_dashboard');
Route::post('/dashboard-update-discount/{id}', [statusController::class, 'update_discount'])->middleware(['can:admin','auth'])->name('update_discount');
Route::get('/dashboard-destroy-discount/{id}', [statusController::class, 'destroy_discount'])->middleware(['can:admin','auth'])->name('destroy_discount');

Route::get('/dashboard-history', [interiorController::class, 'history_dashboard'])->middleware(['can:admin','auth'])->name('history_dashboard');
Route::get('/dashboard-destroy-all-history', [historyController::class, 'destroy_all_history'])->middleware(['can:admin','auth'])->name('destroy_all_history');

// Route::get('/dashboard-calendar', [interiorController::class, 'calendar'])->middleware(['can:admin_manager_staff','auth'])->name('calendar');
// Route::post('/dashboard-add-calender', [calendarController::class, 'add_calender'])->middleware(['can:admin_manager_staff','auth'])->name('add_calender');
// Route::get('/dashboard-reset-calender', [calendarController::class, 'reset_calendar'])->middleware(['can:admin_manager_staff','auth'])->name('reset_calendar');
// Route::get('/dashboard-reset-salary', [calendarController::class, 'reset_salary'])->middleware(['can:admin_manager_staff','auth'])->name('reset_salary');

// new-calender

Route::get('/new/calender', [calenderController::class, 'new_calender'])->middleware(['can:admin_manager_staff','auth'])->name('calender');
Route::post('/dashboard/post/calender', [calenderController::class, 'post_calender'])->middleware(['can:admin_manager_staff','auth'])->name('post_calender');
Route::get('/dashboard/reset/calender', [calenderController::class, 'reset_calender'])->middleware(['can:admin_manager_staff','auth'])->name('reset_calender');
Route::get('/dashboard/reset/salary', [calenderController::class, 'reset_salary'])->middleware(['can:admin_manager_staff','auth'])->name('reset_salary');

// new-calender
Route::get('/dashboard-slide', [interiorController::class, 'slide'])->middleware(['can:admin','auth'])->name('slide');
Route::get('/dashboard-slide/{id}', [interiorController::class, 'slide2'])->middleware(['can:admin','auth'])->name('slide2');
Route::post('/dashboard/add/slide', [slideController::class, 'add_slide'])->middleware(['can:admin','auth'])->name('add_slide');
Route::post('/dashboard/add/position/0', [slideController::class, 'add_position_0'])->middleware(['can:admin','auth'])->name('add_position_0');

Route::get('/dashboard-salary', [interiorController::class, 'salary'])->middleware(['can:admin_manager_staff','auth'])->name('salary');

Route::get('/dashboard-bill', [checkoutContorller::class, 'bill_dashboad'])->middleware(['can:admin_manager_staff','auth'])->name('bill_dashboad');
Route::get('/dashboard-vanchuyen-bill', [checkoutContorller::class, 'bill_vanchuyen_dashboad'])->middleware(['can:admin_manager_staff','auth'])->name('bill_vanchuyen_dashboad');
Route::get('/dashboard-hangden-bill', [checkoutContorller::class, 'bill_hangden_dashboad'])->middleware(['can:admin_manager_staff','auth'])->name('bill_hangden_dashboad');
Route::get('/dashboard-thanhcong-bill', [checkoutContorller::class, 'bill_thanhcong_dashboad'])->middleware(['can:admin_manager_staff','auth'])->name('bill_thanhcong_dashboad');
Route::get('/dashboad-up-bill', [checkoutContorller::class, 'up_bill_dashboad'])->middleware(['can:admin_manager_staff','auth'])->name('up_bill_dashboad');
Route::get('/dashboad-up-bill-vc', [checkoutContorller::class, 'up_bill_vanchuyen'])->middleware(['can:admin_manager_staff','auth'])->name('up_bill_vanchuyen');
Route::get('/dashboad-up-bill-store', [checkoutContorller::class, 'up_bill_xacnhan_store'])->middleware(['can:admin_manager_staff','auth'])->name('up_bill_xacnhan_store');

Route::get('/checkout-user', [interiorController::class, 'checkout_dash_store'])->middleware(['can:admin_manager_staff','auth'])->name('checkout_dash_store');
Route::post('/checkout-atm/db', [checkoutContorller::class, 'vnpay_payment_atm_dashboard'])->name('vnpay_payment_atm_dashboard');
Route::post('/checkout-qr/db', [checkoutContorller::class, 'vnpay_payment_qr_dashboard'])->name('vnpay_payment_qr_dashboard');
Route::get('/return-db', [checkoutContorller::class, 'return_db'])->name('return_db');
Route::get('/destroy-bill-dashboard', [checkoutContorller::class, 'destroy_bill_dashboard'])->middleware(['can:admin_manager_staff','auth'])->name('destroy_bill_dashboard');
Route::post('/update-after-pay',[checkoutContorller::class,'update_after_pay'])->name('update_after_pay');
Route::post('/pay-store', [checkoutContorller::class, 'pay_store'])->middleware(['can:admin_manager_staff','auth'])->name('pay_store');

Route::get('/search-dashboard=',[interiorController::class, 'search_dashboard_up'])->middleware('can:admin_manager_staff','auth')->name('search_dashboard_up');

Route::get('/destroy/donhang/{id}',[checkoutContorller::class, 'destroy_donhang_dashboard'])->middleware('auth')->name('destroy_donhang_dashboard');

// Route::get('test/map',[interiorController::class, 'test_api_map'])->name('test_api_map');
// ---- user
Route::get('/interior-index', [interiorController::class,'index'])->name('index');
Route::get('/interior-product', [interiorController::class,'product'])->name('product');
Route::get('/interior-product/price', [interiorController::class,'product_with_price'])->name('product_with_price');
Route::get('/interior-product-details/{id}', [interiorController::class,'product_detail'])->name('product_detail');
Route::get('/inteiror-product-cat', [interiorController::class, 'get_with_type'])->name('get_with_type');
Route::get('/inteiror-product-supp', [interiorController::class, 'get_with_brand'])->name('get_with_brand');
Route::get('/inteiror-product-col', [interiorController::class, 'get_with_color'])->name('get_with_color');
Route::get('/interior-product-srh', [interiorController::class, 'search_interior_client'])->name('search_interior_client');
Route::get('/interior-product-news', [interiorController::class, 'new_product'])->name('new_product');

Route::get('/interior-contact', [interiorController::class, 'contact'])->name('contact');
Route::post('/interior-sendmail', [interiorPostController::class, 'sendmail'])->name('sendmail');
route::get('/xoa-di', function(){
    return view('interiors.sendmail');
});

Route::get('/interior-cart', [interiorController::class, 'cart'])->middleware(['can:client_inte','auth'])->name('cart');
Route::post('/indeior-add-cart/{id}', [cartController::class,'add_cart'])->middleware(['can:client_inte','auth'])->name('add_cart');
Route::get('/inteiror-destroy/{id}', [cartController::class, 'destroy_cart_product'])->middleware(['can:client_inte','auth'])->name('destroy_cart_product');
Route::get('/interior-review', [interiorController::class, 'review'])->name('review');
Route::post('/interior-add-review', [productController::class, 'create_comment'])->middleware(['can:client_inte','auth'])->name('create_comment');
Route::get('/inteiror-review/{id}', [interiorController::class, 'review_detail'])->name('review_detail');
Route::get('/interior-product-detailsrv/{id}', [interiorController::class,'review_product_detail'])->name('review_product_detail');

// Route::post('/checkout/momo', [checkoutContorller::class, 'momo_payment'])->middleware(['can:client_inte','auth'])->name('momo_payment');
Route::post('/checkout-vnpay', [checkoutContorller::class, 'vnpay_payment'])->middleware(['can:client_inte','auth'])->name('vnpay_payment');
Route::post('/checkout-vnpay-qr', [checkoutContorller::class, 'vnpay_payment_qr'])->middleware(['can:client_inte','auth'])->name('vnpay_payment_qr');

Route::post('/checkout-vnpay-d-atm', [checkoutContorller::class, 'vnpay_payment_don_atm'])->middleware(['can:client_inte','auth'])->name('vnpay_payment_don_atm');
Route::post('/checkout-vnpay-d-qr', [checkoutContorller::class, 'vnpay_payment_don_qr'])->middleware(['can:client_inte','auth'])->name('vnpay_payment_don_qr');

// Route::post('/checkout-cod', [checkoutContorller::class, 'checkout_cod'])->name('checkout_cod');
Route::get('/checkout-cod', [checkoutContorller::class, 'checkout_cod'])->middleware(['can:client_inte','auth'])->name('checkout_cod');
Route::post('/checkout-cod-post', [checkoutContorller::class, 'checkout_cod_post'])->middleware(['can:client_inte','auth'])->name('checkout_cod_post');

Route::get('/checkout-cod/{id}', [checkoutContorller::class, 'checkout_cod_get_don'])->middleware(['can:client_inte','auth'])->name('checkout_cod_get_don');
Route::post('/checkout-cod-post-don', [checkoutContorller::class, 'checkout_cod_post_don'])->middleware(['can:client_inte','auth'])->name('checkout_cod_post_don');
// Route::post('/checkout-cod/{id}', [checkoutContorller::class, 'checkout_cod_get_don'])->middleware(['can:client_inte','auth'])->name('checkout_cod_get_don');

Route::get('/return-vnpay', [checkoutContorller::class, 'return_vnpay'])->name('return_vnpay');
Route::get('/return-vnpay-don', [checkoutContorller::class, 'return_vnpay_don'])->name('return_vnpay-don');

Route::get('/print-bill/{id}', [interiorController::class, 'print_bill'])->name('print_bill');

Route::get('/add-favorite/{id}', [favoriteController::class, 'create_favorite'])->middleware(['can:client_inte','auth'])->name('create_favorite');
Route::get('/list-favorite', [interiorController::class, 'favorite_user'])->middleware(['can:client_inte','auth'])->name('favorite_user');
Route::get('/destroy-favorite/{id}', [favoriteController::class, 'destroy_favorite_user'])->middleware(['can:client_inte','auth'])->name('destroy_favorite_user');

Route::get('/profile-user', [interiorController::class, 'profile_user'])->middleware(['can:client_inte','auth'])->name('profile_user');
Route::get('/update-profile', [interiorController::class, 'update_profile'])->middleware(['can:client_inte','auth'])->name('update_profile');
Route::get('/update-profile-adr/{id}', [interiorController::class, 'update_profile2'])->middleware(['can:client_inte','auth'])->name('update_profile2');
Route::get('/update-profile-opc/{id}', [interiorController::class, 'update_profile_opCart'])->middleware(['can:client_inte','auth'])->name('update_profile_opCart');
Route::get('/update-profile-city/{id}', [interiorController::class, 'update_profile_get_city'])->middleware(['can:client_inte','auth'])->name('update_profile_get_city');
Route::post('/update-profile-city-po/{id}', [interiorPostController::class, 'update_profile_city_cart'])->middleware(['can:client_inte','auth'])->name('update_profile_city_cart');
Route::post('/update-profile-city-pro/{id}', [interiorPostController::class, 'update_profile_city'])->middleware(['can:client_inte','auth'])->name('update_profile_city');

Route::post('update_password', [interiorPostController::class, 'update_password'])->middleware('auth')->name('update_password');

Route::get('/ship/done', [checkoutContorller::class, 'ship_done'])->middleware(['can:client_inte','auth'])->name('ship_done');
//Export excel
Route::get('bill/export/', [BillExport::class, 'export_excel_bill'])->middleware(['auth'])->name('export_excel_bill');
Route::get('history/export/', [HistoryExport::class, 'export_excel_history'])->middleware(['auth'])->name('export_excel_history');

// ---------------------------
// Route::get('/index2', function(){
//     return view('interiors2.index');
// });