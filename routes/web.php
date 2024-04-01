<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/',[App\Http\Controllers\User\HomeController::class,'index'])->name('user.home');
Route::get('/terms-and-conditions',[App\Http\Controllers\User\HomeController::class,'terms'])->name('user.terms');
Route::get('/privacy-and-poilcy',[App\Http\Controllers\User\HomeController::class,'privacy'])->name('user.privacy');
Route::get('/about',[App\Http\Controllers\User\HomeController::class,'about'])->name('user.about');
Route::get('/wff',[App\Http\Controllers\User\HomeController::class,'wff'])->name('user.wff');
Route::get('/journey-of-reyo',[App\Http\Controllers\User\HomeController::class,'journey'])->name('user.journey');
Route::get('/why-to-choose-us',[App\Http\Controllers\User\HomeController::class,'whyus'])->name('user.whyus');
Route::get('/contact-us',[App\Http\Controllers\User\HomeController::class,'contact'])->name('user.contactus');
Route::get('/faq',[App\Http\Controllers\User\HomeController::class,'faq'])->name('user.faq');
Route::get('/check',[App\Http\Controllers\User\HomeController::class,'check'])->name('user.check');
Route::get('/login',[App\Http\Controllers\User\HomeController::class,'login'])->name('user.login');
Route::get('/period-calculator',[App\Http\Controllers\User\HomeController::class,'pCalc'])->name('user.period.calculator');

Route::get('/test-mail',[App\Http\Controllers\User\HomeController::class,'mailto'])->name('user.mailto');


Route::get('/period-calculator',[App\Http\Controllers\User\HomeController::class,'pCalc'])->name('user.period.calculator');

Route::get('/shop',[App\Http\Controllers\User\ShopController::class,'index'])->name('user.shop');
Route::get('/shop/category/{linkcode}',[App\Http\Controllers\User\ShopController::class,'categoryShop'])->name('user.category.show');
Route::get('/shop/category/{linkcode}/{sublink}',[App\Http\Controllers\User\ShopController::class,'subCategoryShop'])->name('user.category.show');

Route::get('/festival-offers',[App\Http\Controllers\User\ShopController::class,'OfferProd'])->name('user.festival.offers');

Route::get('/checkout',[App\Http\Controllers\User\orderController::class,'index'])->name('user.checkout');
/*Route::get('/cart',[App\Http\Controllers\User\HomeController::class,'cart'])->name('user.cart');*/

Route::get('/product/{linkcode}',[App\Http\Controllers\User\ShopController::class,'productDetails'])->name('user.shop.show');
Route::get('/get-products',[App\Http\Controllers\User\ShopController::class,'productList'])->name('user.prod.show');
Route::get('/shop-products',[App\Http\Controllers\User\ShopController::class,'shopList'])->name('user.prodshop.show');

Route::get('/blog',[App\Http\Controllers\User\BlogController::class,'index'])->name('user.blog');
Route::get('/blog/{linkcode}',[App\Http\Controllers\User\BlogController::class,'blogDetails'])->name('user.blog.show');
Route::get('/page/{linkcode}',[App\Http\Controllers\User\BlogController::class,'pageView'])->name('user.page.show');

Route::post('/save-subscribe',[App\Http\Controllers\User\HomeController::class,'subscribe'])->name('user.save.subscribe');
Route::post('/save-referalid',[App\Http\Controllers\User\HomeController::class,'setreferalid'])->name('user.save.setreferalid');

Route::post('/save-contactus',[App\Http\Controllers\User\HomeController::class,'contactus'])->name('user.save.contactus');
Route::post('/addtocart',[App\Http\Controllers\User\HomeController::class,'addtocart'])->name('user.addtocart');
Route::get('/wishlist',[App\Http\Controllers\User\HomeController::class,'wishlist'])->name('user.wishlist');
Route::get('/track-order',[App\Http\Controllers\User\orderController::class,'trackOrder'])->name('user.order.track');
Route::get('/get-cart-list',[App\Http\Controllers\User\HomeController::class,'cartList'])->name('user.cart.show');
Route::get('/get-checkcart-list',[App\Http\Controllers\User\HomeController::class,'checkCartList'])->name('user.checkcart.show');
Route::get('/get-addcart-list',[App\Http\Controllers\User\HomeController::class,'addCartList'])->name('user.addcart.show');
Route::get('/get-wise-list',[App\Http\Controllers\User\HomeController::class,'WiseList'])->name('user.wiselist.show');
Route::get('/get-cart-count',[App\Http\Controllers\User\HomeController::class,'getCartCount'])->name('user.cartcount.show');
Route::get('/remove-cart-all',[App\Http\Controllers\User\HomeController::class,'removeallcart'])->name('user.cart.remove');

Route::middleware(['guest:web'])->group(function(){
    // Google login
    Route::get('/google', [App\Http\Controllers\User\LoginController::class, 'redirectToGoogle'])->name('user.login.google');
    Route::get('/google/callback', [App\Http\Controllers\User\LoginController::class, 'handleGoogleCallback']);

    // Facebook login
    Route::get('/facebook', [App\Http\Controllers\User\LoginController::class, 'redirectToFacebook'])->name('user.login.facebook');
    Route::get('/facebook/callback', [App\Http\Controllers\User\LoginController::class, 'handleFacebookCallback']);


    Route::post('/login-user',[App\Http\Controllers\User\LoginController::class,'loginUser'])->name('user.login.check');
    Route::post('/signup-user',[App\Http\Controllers\User\LoginController::class,'signupUser'])->name('user.signup.check');
});

Route::middleware(['auth:web'])->group(function(){
  Route::post('/check-coupon',[App\Http\Controllers\User\orderController::class,'checkCoupon'])->name('user.coupon.check');
  Route::post('/remove-coupon',[App\Http\Controllers\User\orderController::class,'removeCoupon'])->name('user.coupon.remove');
  Route::post('/user-address',[App\Http\Controllers\User\orderController::class,'saveAddress'])->name('user.save.address');
  Route::post('/user-review',[App\Http\Controllers\User\ShopController::class,'saveReview'])->name('user.save.review');
  Route::post('/admin/generate-manifest', [App\Http\Controllers\Admin\OrderController::class, 'generateManifest'])->name('generateManifest');
  Route::post('/admin/print-manifest', [App\Http\Controllers\Admin\OrderController::class, 'printManifest'])->name('printManifest');
  Route::post('/pay-now',[App\Http\Controllers\User\orderController::class,'payNow'])->name('user.pay.store');
  Route::post('/ship-create',[App\Http\Controllers\User\orderController::class,'shipCreate'])->name('user.ship.create');
  Route::post('/check-pay',[App\Http\Controllers\User\orderController::class,'checkPay'])->name('user.pay.check');
  Route::post('/dismiss-pay',[App\Http\Controllers\User\orderController::class,'dismissPay'])->name('user.pay.dismiss');
  Route::get('/profile',[App\Http\Controllers\User\UserController::class,'index'])->name('user.profile');
  Route::get('/profile/orders',[App\Http\Controllers\User\UserController::class,'list'])->name('user.profile.orders');
  Route::get('/get-orders',[App\Http\Controllers\User\UserController::class,'getlist'])->name('user.get.orders');
  Route::post('/update-profile',[App\Http\Controllers\User\UserController::class,'updateProfile'])->name('user.update.profile');
  Route::post('/save-wishlist',[App\Http\Controllers\User\UserController::class,'saveWishlist'])->name('user.wishlist.save');
  Route::post('/change-pass',[App\Http\Controllers\User\UserController::class,'changePass'])->name('user.change.pass');
  Route::post('/change-mobile',[App\Http\Controllers\User\UserController::class,'changeMobile'])->name('user.change.mobile');
  Route::get('/logout',[App\Http\Controllers\User\LoginController::class,'logout'])->name('user.logout');
});


Route::prefix('admin')->name('admin.')->group(function(){

    Route::middleware(['guest:admin'])->group(function(){
          Route::view('/login','Admin.login')->name('login');
          Route::post('/usercheck',[App\Http\Controllers\Admin\adminUserController::class,'usercheck'])->name('usercheck');
    });

    Route::middleware(['auth:admin'])->group(function(){
        Route::post('/logout',[App\Http\Controllers\Admin\adminUserController::class,'logout'])->name('logout');
        Route::get('/home', [App\Http\Controllers\Admin\aHomeController::class, 'index'])->name('home');

        Route::resource('couriers', App\Http\Controllers\Admin\CourierController::class);
        Route::resource('settings', App\Http\Controllers\Admin\SettingController::class, ['except' => ['create','store','show','destroy']]);

        Route::resource('categorys', App\Http\Controllers\Admin\CategoryController::class);
        Route::resource('orders', App\Http\Controllers\Admin\OrderController::class);
        Route::resource('sub-categorys', App\Http\Controllers\Admin\SubCategoryController::class);
        Route::resource('users', App\Http\Controllers\Admin\UserController::class);
        Route::resource('candidates', App\Http\Controllers\Admin\CandidateController::class);
        Route::resource('products', App\Http\Controllers\Admin\ProductController::class);
        Route::resource('banners', App\Http\Controllers\Admin\BannerController::class);
        Route::resource('coupons', App\Http\Controllers\Admin\CouponController::class);
        Route::resource('reviews', App\Http\Controllers\Admin\ReviewController::class);
        Route::resource('testimonials', App\Http\Controllers\Admin\TestimonialController::class);

        Route::get('/low-stock', [App\Http\Controllers\Admin\ProductController::class, 'lowstock'])->name('lowstock');
        
        Route::get('/newsletters', [App\Http\Controllers\Admin\SettingController::class, 'newsletterindex'])->name('newsletters');
        Route::get('/contact-users', [App\Http\Controllers\Admin\SettingController::class, 'contactusindex'])->name('contact.users');

        Route::resource('offers', App\Http\Controllers\Admin\OfferController::class);
        Route::get('/offers-search', [App\Http\Controllers\Admin\OfferController::class, 'searchProd'])->name('offers.search');

        Route::resource('blogs', App\Http\Controllers\Admin\BlogController::class);
        Route::resource('blog-categorys', App\Http\Controllers\Admin\BlogCategoryController::class);
        Route::resource('pages', App\Http\Controllers\Admin\PageController::class);
        Route::resource('faqs', App\Http\Controllers\Admin\FaqController::class);

        Route::get('/ajax-subcat', [App\Http\Controllers\Admin\SubCategoryController::class, 'ajaxSubcat'])->name('ajaxSubcat');
        Route::get('/generate-pdf', [App\Http\Controllers\Admin\OrderController::class, 'generatePDF'])->name('generatePDF');
        
       
    });
    
    

});
