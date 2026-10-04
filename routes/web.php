<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\DonationController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PhonePeController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('home', [HomeController::class, 'index'])->name('home');
Route::get('/dham', [HomeController::class, 'about'])->name('dham');
Route::get('/about-us', [HomeController::class, 'about'])->name('about-us');
Route::get('/stories', [HomeController::class, 'event'])->name('stories');
Route::get('/donate', [HomeController::class, 'donation'])->name('donate');
Route::get('/events', [HomeController::class, 'event'])->name('events');
Route::get('/volunteer', [HomeController::class, 'volunteer'])->name('volunteer');
Route::get('/Contact', [HomeController::class, 'Contact'])->name('Contact');
Route::get('/book-hotels', [HomeController::class, 'Hotel'])->name('book-hotels');
Route::get('event-details/{id}', [HomeController::class, 'eventDetails'])->name('event.details');
Route::get('privacy-policy', [HomeController::class, 'Privacypolicy'])->name('privacy-policy');

Route::get('term_condition', [HomeController::class, 'TC'])->name('term_condition');
Route::get('refund-policy', [HomeController::class, 'RF'])->name('refund-policy');


Route::post('/send-contact-mail', [HomeController::class, 'sendContactMail'])->name('send.contact.mail');


Route::post('/volunteer-submit', [HomeController::class, 'volunteerSubmit'])->name('volunteer.submit');
// Route::post('/create-order', [HomeController::class, 'createOrder'])->name('create.order');
Route::post('/verify-payment', [HomeController::class, 'verifyPayment'])->name('verify.payment');





Route::post('/create-order', [PhonePeController::class, 'createOrder'])->name('create.order');
Route::match(['get', 'post'], '/payment/callback/{transactionId}', [PhonePeController::class, 'handleCallback'])->name('payment.callback');
// Self-contained result pages
Route::get('/donation/success/{transactionId}', [PhonePeController::class, 'donationSuccess'])->name('donation.success.page');
Route::get('/donation/failed', [PhonePeController::class, 'donationFailed'])->name('donation.failed');


// Booking Routes
Route::get('/booking', [BookingController::class, 'index'])->name('booking');
Route::post('/booking', [BookingController::class, 'store'])->name('booking.store');
Route::get('/booking/success', [BookingController::class, 'success'])->name('booking.success');

// Donation Routes
Route::get('/donation', [DonationController::class, 'index'])->name('donation');
Route::post('/donation', [DonationController::class, 'store'])->name('donation.store');
Route::get('/donation/success', [DonationController::class, 'success'])->name('donation.success');

// Gallery
Route::get('/gallery', [GalleryController::class, 'index'])->name('gallery');

// Contact Routes
Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');


Route::get('login', [AdminController::class, 'Login'])->name('login');
Route::post('AdminLogin', [AdminController::class, 'AdminLogin'])->name('AdminLogin');


Route::prefix('Admin')->middleware('Admin')->group(function () {
    Route::get('Dashboard', [AdminController::class, 'Dashboard'])->name('Dashboard');
    Route::get('logout', [AdminController::class, 'logout'])->name('logout');
    
    Route::get('website-content', [AdminController::class, 'Content'])->name('website-content');
    Route::post('Content/update', [AdminController::class, 'update_content'])->name('admin.updateFrontendContent');

    


    // Banner Routes
      Route::get('banner/list', [AdminController::class, 'Banner_list'])->name('Banner_list');
     Route::get('banner/add', [AdminController::class, 'Banner_add'])->name('Banner_add');
     Route::post('banner/store', [AdminController::class, 'Banner_store'])->name('Banner_store');
    Route::get('/banner/edit/{id}', [AdminController::class, 'Banner_edit'])->name('Banner_edit');
     Route::post('/admin/banner/update/{id}', [AdminController::class, 'banner_update'])->name('Banner_update');
      Route::delete('/admin/banner/delete/{id}', [AdminController::class, 'banner_delete'])->name('admin.banner.delete');
    // Banner Routes

   Route::get('setting/form', [AdminController::class, 'FrontEnd'])->name('FrontEnd');
   Route::post('/admin/update-frontend', [AdminController::class, 'updateFrontend'])->name('admin.updateFrontend');
   
  
  Route::get('gallery', [AdminController::class, 'Gallery'])->name('gallery');
  Route::post('gallery/store', [AdminController::class, 'Gallery_store'])->name('Gallery_store');
  Route::get('gallery/list', [AdminController::class, 'Gallerylist'])->name('Gallerylist');
  Route::post('/admin/toggle-status', [AdminController::class, 'toggleStatus'])->name('admin.toggleStatus');
  Route::post('/admin/delete-gallery', [AdminController::class, 'deleteGallery'])->name('admin.deleteGallery');

  Route::get('admin/objectives', [AdminController::class, 'objectivesList'])->name('objectives.list');
Route::post('admin/objectives-store', [AdminController::class, 'objectivesStore'])->name('objectives.store');
Route::post('/objectives/update', [AdminController::class, 'objectivesUpdate'])->name('objectives.update');
Route::get('admin/objectives-form', [AdminController::class, 'objectivesForm'])->name('objectives.form');
Route::delete('admin/objectives-delete/{id}', [AdminController::class, 'deleteObjective'])->name('objectives.delete');
Route::post('/update-top-banner', [AdminController::class, 'updateTopBanner'])->name('topbanner.update');
  Route::get('Services/add', [AdminController::class, 'Services_add'])->name('Services_add');
  Route::get('topbanner', [AdminController::class, 'Topbanner'])->name('Topbanner');
    Route::get('Services/list', [AdminController::class, 'Services_list'])->name('Services_list');
    Route::post('Services/store', [AdminController::class, 'Services_store'])->name('Services_store');
    Route::post('Services/edit', [AdminController::class, 'Service_edit'])->name('admin.service.edit');
    Route::post('Services/edit', [AdminController::class, 'Service_edit'])->name('admin.service.delete');

  Route::get('hotel/add', [AdminController::class, 'Hotel_add'])->name('Hotel_add');
  Route::post('hotel/store', [AdminController::class, 'Hotel_store'])->name('Hotel_store');
  Route::get('hotel/list', [AdminController::class, 'Hotel_list'])->name('Hotel_list');
  Route::post('hotel/update', [AdminController::class, 'Hotel_update'])->name('Hotel_update');

  Route::get('Sub/subservice/edit/{id}', [AdminController::class, 'SubService_edit'])->name('SubService_edit');
 Route::post('Sub/subservice/update/{id}', [AdminController::class, 'SubService_update'])->name('SubService_update');
Route::get('Sub/list', [AdminController::class, 'Sub_list'])->name('Sub_list');


Route::get('Special/list', [AdminController::class, 'Special_list'])->name('Special_list');
Route::get('Special/add', [AdminController::class, 'SpecialServices'])->name('Special_add');

  Route::post('Special/store', [AdminController::class, 'Special_Services_store'])->name('Special_Services_store');
   Route::post('Special/update', [AdminController::class, 'Special_Services_update'])->name('Special_Services_update');


  Route::get('events/add', [AdminController::class, 'events_add'])->name('events_add');
Route::post('events/store', [AdminController::class, 'Events_store'])->name('Events_store');
Route::get('events/list', [AdminController::class, 'events_list'])->name('events_list');
Route::post('events/update', [AdminController::class, 'Events_update'])->name('Events_update');

Route::get('volentree/list', [AdminController::class, 'volunteersList'])->name('volunteersList');

}); 

