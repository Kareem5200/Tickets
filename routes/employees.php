<?php

use App\Models\Team;
use Illuminate\Support\Facades\Auth;
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




Route::prefix('/admin')->name('admin.')->group(function(){

/**********************************************Admin Routes and Guest**************************************************************/
    Route::middleware('guest:employee')->group(function(){
        Route::post('/store',[App\Http\Controllers\employeesControllers\AdminRegisterController::class,'store'])->name('store');
        Route::controller(App\Http\Controllers\employeesControllers\AdminloginController::class)->group(function(){
            Route::get('/login','showLogin')->name('login');
            Route::post('/checkLogin','checkLogin')->name('checkLogin');
        });
    });

/********************************************************************************************************************************/
/**********************************************Admin Routes and Auth**************************************************************/
Route::middleware('auth:employee','isAdmin')->group(function(){

        Route::get('/dashboard',[App\Http\Controllers\employeesControllers\dashboardController::class,'index'])->name('index');

            Route::controller(App\Http\Controllers\employeesControllers\manageEmployeesController::class)->group(function(){
                Route::get('/getEmployees','getEmployees')->name('getEmployees');
                Route::put('/panEmployee/{employee}','panEmployee')->name('panEmployee');
            });

        Route::controller(App\Http\Controllers\employeesControllers\fanStatusController::class)->group(function(){
            Route::get('/displayFan','displayFan')->name('displayFan');
            Route::get('/fanProfile/{user}','fanProfile')->name('fanProfile');
            Route::put('/changeFanStatus/{user}','changeFanStatus')->name('changeFanStatus');
            Route::get('/getTickets/{user_id}','getTickets')->name('getTickets');
        });


        Route::controller(App\Http\Controllers\employeesControllers\manageBusController::class)->group(function(){
            Route::get('/displayBuses','displayBuses')->name('displayBuses');
            Route::get('/addBusForm','addBusForm')->name('addBusForm');
            Route::get('/addMaintenanceForm/{bus}','addMaintenanceForm')->name('addMaintenanceForm');
            Route::get('/displayBusMaintenance/{bus}','displayBusMaintenance')->name('displayBusMaintenance');
            Route::put('/deleteBus/{bus}','deleteBus')->name('deleteBus');
            Route::post('/addBus','addBus')->name('addBus');
            Route::post('/addMaintenance/{bus}','addMaintenance')->name('addMaintenance');
        });

        Route::controller(App\Http\Controllers\employeesControllers\stationController::class)->group(function(){
            Route::get('/displayStations','displayStations')->name('displayStations');
            Route::put('/deleteStation/{station}','deleteStation')->name('deleteStation');
            Route::get('/addStationForm','addStationForm')->name('addStationForm');
            Route::post('/addStation','addStation')->name('addStation');
        });

        Route::controller(App\Http\Controllers\employeesControllers\teamsController::class)->group(function(){
            Route::get('/displayTeams','displayTeams')->name('displayTeams');
            Route::get('/addTeamsForm','addTeamsForm')->name('addTeamsForm');
            Route::post('/addTeam','addTeam')->name('addTeam');
            Route::get('/updateTeam/{team}','updateTeam')->name('updateTeam');
            Route::put('/editTeam/{team}','editTeam')->name('editTeam');


        });
        Route::controller(App\Http\Controllers\employeesControllers\competitionController::class)->group(function(){
            Route::get('/displayComptition','displayComptition')->name('displayComptition');
            Route::get('/addComptitionForm','addComptitionForm')->name('addComptitionForm');
            Route::post('/addComptition','addComptition')->name('addComptition');

        });

        Route::controller(App\Http\Controllers\employeesControllers\stadiumController::class)->group(function(){
            Route::get('/displayStadium','displayStadium')->name('displayStadium');
            Route::get('/addStadiumForm','addStadiumForm')->name('addStadiumForm');
            Route::post('/addStadium','addStadium')->name('addStadium');
            Route::get('/updateStadium/{stadium}','updateStadium')->name('updateStadium');
            Route::put('/editStadium/{stadium}','editStadium')->name('editStadium');


        });
        Route::controller(App\Http\Controllers\employeesControllers\departmentController::class)->group(function(){
            Route::get('/displayDeprtments/{stadium}','displayDeprtments')->name('displayDeprtments');
            Route::get('/updateDeprtmentsForm/{department}','updateDeprtmentsForm')->name('updateDeprtmentsForm');
            Route::put('/editDeprtments/{department}','editDeprtments')->name('editDeprtments');
            Route::get('/addDeprtmentsForm/{stadium}','addDeprtmentsForm')->name('addDeprtmentsForm');
            Route::post('/addDeprtment/{stadium}','addDeprtment')->name('addDeprtment');
        });

        Route::controller(App\Http\Controllers\employeesControllers\tripsController::class)->group(function(){
            Route::get('/displayTrips','displayTrips')->name('displayTrips');
            Route::get('/addTripForm','addTripForm')->name('addTripForm');
            Route::post('/addTrip','addTrip')->name('addTrip');
            // Route::delete('deleteTrip/{driver}/{trip_date}/{travel_time}','deleteTrip')->name('deleteTrip');
            Route::get('/updateTripForm/{driver}/{match}/{time}/{station_id}','updateTripForm')->middleware('preventUpdateTrip')->name('updateTripForm');
            Route::put('/editTrip/{driver}/{match}/{time}','editTrip')->middleware('preventUpdateTrip')->name('editTrip');
            Route::get('/displayEmployeeTrips','displayEmployeeTrips')->name('displayEmployeeTrips');
            Route::get('/getEmployeeTrips','getEmployeeTrips')->name('getEmployeeTrips');



        });

        Route::controller(App\Http\Controllers\employeesControllers\pricesController::class)->group(function(){
            Route::get('/displayprices','displayprices')->name('displayprices');
            Route::get('/addPricesForm','addPricesForm')->name('addPricesForm');
            Route::post('/addPrices','addPrices')->name('addPrices');
            Route::get('/updatePricesForm/{stadium}/{station}','updatePricesForm')->name('updatePricesForm')->middleware('preventUpdateprices');
            Route::put('/editPrices/{stadium_id}/{station_id}','editPrices')->name('editPrices');
        });

        Route::controller(App\Http\Controllers\employeesControllers\restoreDeactiveController::class)->group(function(){
            Route::get('/displayDeactiveEmployee','displayDeactiveEmployee')->name('displayDeactiveEmployee');
            Route::put('/returnDeactiveEmployee/{employee}','returnDeactiveEmployee')->name('returnDeactiveEmployee');
            Route::get('/displayDeactiveBuses','displayDeactiveBuses')->name('displayDeactiveBuses');
            Route::put('/returnDeactiveBus/{bus}','returnDeactiveBus')->name('returnDeactiveBus');
            Route::get('/displayDeactiveStations','displayDeactiveStations')->name('displayDeactiveStations');
            Route::put('/returnDeactiveStation/{station}','returnDeactiveStation')->name('returnDeactiveStation');
        });

        Route::controller(App\Http\Controllers\employeesControllers\regexController::class)->group(function(){
            route::get('displayRegex','displayRegex')->name('displayRegex');
            route::get('addRegexForm','addRegexForm')->name('addRegexForm');
            route::post('addRegex','addRegex')->name('addRegex');


        });


    });
/********************************************************************************************************************************/


});
