<?php

use App\Models\Team;
use App\Mail\TestEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Auth::routes();
Route::get('/',[App\Http\Controllers\welcomeController::class,'index'])->middleware('guest')->name('index');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::controller(App\Http\Controllers\matchesController::class)->group(function(){
    Route::get('/matches','index')->name('matches');
    Route::get("/displayBookMatch/{match_id}","displayBookMatch")->middleware(['auth','isAllowed','fanTeam'])->name("displayBookMatch");
});

Route::controller(App\Http\Controllers\welcomeController::class)->group(function(){

    Route::get('/news','news')->name('news');
    Route::get('/highlights','highlights')->name('highlights');
    Route::get('/contactUs','showContactUs')->name('contactUs');
    Route::get('/sendMail','sendMail')->name('sendMail');

});

Route::middleware('auth')->name('user.')->group(function(){
    Route::controller(App\Http\Controllers\usersControllers\userController::class)->group(function(){
        Route::get('/profile','profile')->name('profile');
        Route::get('/update','update')->name('update');
        Route::put('/edit','edit')->name('edit');
        Route::get('/UpdatePassworfForm','UpdatePassworfForm')->name('UpdatePassworfForm');
        Route::put('/editPassword','editPassword')->name('editPassword');
        Route::get('/getMatchTickets','getMatchTickets')->name('getMatchTickets');
        Route::get('/getBusTickets','getBusTickets')->name('getBusTickets');
        Route::put('/refundTicket/{ticket}','refundTicket')->name('refundTicket');




    });

    Route::controller(App\Http\Controllers\usersControllers\DependentController::class)->group(function(){
        Route::get('/displayDependents','displayDependents')->name('displayDependents');
        Route::put('/deleteDependent/{dependent}', 'deleteDependent')->name('deleteDependent');
        Route::get('/addDependent','showAddDepForm')->name('addDependent');
        Route::post('/storeDependent','store')->name('store');

    });
    Route::controller(App\Http\Controllers\usersControllers\bookTicketController::class)->group(function(){
        Route::post('/bookTicket/{match_id}','bookTicket')->name('bookTicket');
    });
    Route::controller(App\Http\Controllers\paymobController::class)->middleware('isAllowed')->group(function(){

        Route::post('/credit/{match_id}','credit')->name('credit');
        Route::get('/callback','callback')->name('callback');
        Route::post('/createTickets/{match_id}/{tickets}','createTickets')->name('createTickets');


    });


});


















// Route::get('/mail', function(){
//     return view('emails.test');
// })->name('name');

// Route::get('/send-email', function (Request $request) {
//     $sender = $request->input('sender');
//     $content = $request->input('content');
//     Mail::to('karim8862@gmail.com')->send(new TestEmail($sender, $content));
//     return "Email sent successfully!";
// })->name('ok');



// Route::get('/send-email', function () {
//     Mail::to('karim8862@gmail.com')->send(new TestEmail());
//     return "Email sent successfully!";
// });
