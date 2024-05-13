<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\BeneficiaryController;
use App\Http\Controllers\CountyTypeController;
use App\Http\Controllers\DistributionBeneficiary;
use App\Http\Controllers\DistributionBeneficiaryController;
use App\Http\Controllers\DistributionController;
use App\Http\Controllers\DistributionTypeController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SchoolController;
use App\Http\Controllers\SponsorController;
use App\Http\Controllers\VisitController;
use Illuminate\Support\Facades\Route;


//Home Routes
Route::controller(HomeController::class)->group(function(){
    Route::get('/','dashboard')->name('home.dashboard')->middleware('auth');
});

//Roles Routes
Route::controller(RoleController::class)->group(function(){
    Route::get('roles','index')->name('roles.index')->middleware('auth');
    Route::get('roles/create','create')->name('roles.create')->middleware('auth');
    Route::post('roles/create','store')->name('roles.store')->middleware('auth');
    Route::get('roles/edit/{id}','edit')->name('roles.edit')->middleware('auth');
    Route::post('roles/edit/{id}','update')->name('roles.update')->middleware('auth');
    Route::get('roles/delete/{id}','destroy')->name('roles.delete')->middleware('auth');
});

//Account Routes
Route::controller(AccountController::class)->group(function(){
    Route::get('account/users', 'users')->name('account.users');
    Route::get('account/register', 'register')->name('account.register');
    Route::get('account/users/{id}','edit')->name('account.edit');
    Route::post('account/users/{id}','update')->name('account.update');
    Route::get('account/details/{id}','details')->name('account.details');
    Route::post('account/register','store')->name('account.store')->middleware('auth');
    Route::get('account/delete/{id}','destroy')->name('account.destroy')->middleware('auth');
    Route::get('login', 'login')->name('login');
    Route::post('login','authenticate')->name('authenticate');
    Route::get('/logout', 'logout')->name('logout')->middleware('auth');
    Route::get('change_password','changepassword')->name('change.password')->middleware('auth');
    Route::post('change_password','updatePassword')->name('update.password')->middleware('auth');
});

//CountyTypes Routes
Route::controller(CountyTypeController::class)->group(function(){
    Route::get('counties','index')->name('counties.index')->middleware('auth');
    Route::get('counties/create','create')->name('counties.create')->middleware('auth');
    Route::post('counties/create','store')->name('counties.store')->middleware('auth');
    Route::get('counties/edit/{id}','edit')->name('counties.edit')->middleware('auth');
    Route::post('counties/edit/{id}','update')->name('counties.update')->middleware('auth');
    Route::get('counties/destroy/{id}','destroy')->name('counties.destroy')->middleware('auth');
});

//Distribution Type Routes
Route::controller(DistributionTypeController::class)->group(function(){
    Route::get('distributiontypes','index')->name('distributiontypes.index')->middleware('auth');
    Route::get('distributiontypes/create','create')->name('distributiontypes.create')->middleware('auth');
    Route::post('distributiontypes/create','store')->name('distributiontypes.store')->middleware('auth');
    Route::get('distributiontypes/edit/{id}','edit')->name('distributiontypes.edit')->middleware('auth');
    Route::post('distributiontypes/edit/{id}','update')->name('distributiontypes.update')->middleware('auth');
    Route::get('distributiontypes/destroy/{id}','destroy')->name('distributiontypes.destroy')->middleware('auth');
});

//Sponsor Routes
Route::controller(SponsorController::class)->group(function(){
    Route::get('sponsors','index')->name('sponsors.index')->middleware('auth');
    Route::get('sponsors/create','create')->name('sponsors.create')->middleware('auth');
    Route::post('sponsors/create','store')->name('sponsors.store')->middleware('auth');
    Route::get('sponsors/edit/{id}','edit')->name('sponsors.edit')->middleware('auth');
    Route::post('sponsors/edit/{id}','update')->name('sponsors.update')->middleware('auth');
    Route::get('sponsors/destroy/{id}','destroy')->name('sponsors.destroy')->middleware('auth');
});

//School Routes
Route::controller(SchoolController::class)->group(function(){
    Route::get('schools','index')->name('schools.index')->middleware('auth');
    Route::get('schools/create','create')->name('schools.create')->middleware('auth');
    Route::post('schools/create','store')->name('schools.store')->middleware('auth');
    Route::get('schools/edit/{id}','edit')->name('schools.edit')->middleware('auth');
    Route::post('schools/edit/{id}','update')->name('schools.update')->middleware('auth');
    Route::get('schools/destroy/{id}','destroy')->name('schools.destroy')->middleware('auth');
});

//Beneficiary Routes
Route::controller(BeneficiaryController::class)->group(function(){
    Route::get('beneficiaries','index')->name('beneficiaries.index')->middleware('auth');
    Route::get('beneficiaries/create','create')->name('beneficiaries.create')->middleware('auth');
    Route::post('beneficiaries/create','store')->name('beneficiaries.store')->middleware('auth');
    Route::get('beneficiaries/details/{id}','details')->name('beneficiaries.details')->middleware('auth');
    Route::get('beneficiaries/edit/{id}','edit')->name('beneficiaries.edit')->middleware('auth');
    Route::post('beneficiaries/edit/{id}','update')->name('beneficiaries.update')->middleware('auth');
    Route::get('beneficiaries/destroy/{id}','destroy')->name('beneficiaries.destroy')->middleware('auth');
    Route::get('beneficiaries/get-beneficiaries','getBeneficiaries')->name('getBeneficiaries')->middleware('auth');
    Route::get('beneficiaries/get-project-beneficiaries','getProjectBeneficiaries')->name('getProjectBeneficiaries')->middleware('auth');
});

//Visit Routes
Route::controller(VisitController::class)->group(function(){
    Route::get('visits','index')->name('visits.index')->middleware('auth');
    Route::get('visits/create','create')->name('visits.create')->middleware('auth');
    Route::post('visits/create','store')->name('visits.store')->middleware('auth');
    Route::get('visits/details/{id}','details')->name('visits.details')->middleware('auth');
    Route::get('visits/edit/{id}','edit')->name('visits.edit')->middleware('auth');
    Route::post('visits/edit/{id}','update')->name('visits.update')->middleware('auth');
    Route::get('visits/destroy/{id}','destroy')->name('visits.destroy')->middleware('auth');
});

//Distributions Routes
Route::controller(DistributionController::class)->group(function(){
    Route::get('distributions','index')->name('distributions.index')->middleware('auth');
    Route::get('distributions/create','create')->name('distributions.create')->middleware('auth');
    Route::post('distributions/create','store')->name('distributions.store')->middleware('auth');
    Route::get('distributions/details/{id}','details')->name('distributions.details')->middleware('auth');
    Route::get('distributions/edit/{id}','edit')->name('distributions.edit')->middleware('auth');
    Route::post('distributions/edit/{id}','update')->name('distributions.update')->middleware('auth');
    Route::get('distributions/destroy/{id}','destroy')->name('distributions.destroy')->middleware('auth');
});


//Distribution Beneficiaries
Route::controller(DistributionBeneficiaryController::class)->group(function(){
    Route::get('distribution-beneficiaries','index')->name('distribution.beneficiaries')->middleware('auth');
    Route::get('distribution-beneficiaries/pdf','viewPdf')->name('distribution.beneficiaries.pdf')->middleware('auth');
});

//Report Routes
Route::controller(ReportController::class)->group(function(){
    Route::get('reports/students','students')->name('reports.students')->middleware('auth');
    Route::get('reports/distributions','distributions')->name('reports.distributions')->middleware('auth');
    Route::get('reports/visits','visits')->name('reports.visits')->middleware('auth');
    Route::get('reports/sponsors','sponsors')->name('reports.sponsors')->middleware('auth');
});
