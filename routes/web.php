<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Main\MainControler;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Main\ProfileController;
use App\Http\Controllers\Main\CommentController;
use App\Http\Controllers\Dashboard\IndexTableController;
use App\Http\Controllers\Dashboard\RolesTableController;
use App\Http\Controllers\Dashboard\UsersTableController;
use App\Http\Controllers\Dashboard\SpecialtiesTableController;
use App\Http\Controllers\Dashboard\BranchesTableController;
use App\Http\Controllers\Dashboard\LanguagesTableController;
use App\Http\Controllers\Dashboard\CoursesTableController;
use App\Http\Controllers\Main\CourseRegisterController;
use App\Http\Controllers\Dashboard\JoinBranchWithLanguageController;
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

// Main Routes
Route::controller(MainControler::class)->group(function () {
    Route::get('/', 'index')->name("home");//Index Page
    Route::get('/programming-map', 'proMap')->name("proMap");//programming-map Page
    Route::get('/showDetails/{id}', 'showDetails')->name("showDetails");//Show details Page
    Route::post('/search', 'search')->name("search");//search
    Route::get('/coursesBySpecialty/{id}', 'coursesBySpecialty')->name("coursesBySpecialty");//courses By Specialty
    Route::post('/addRating/{id}', 'addRating')->name("addRating")->middleware("auth");//Add Rating
});



// Login Routes
Route::controller(LoginController::class)->group(function () {
    Route::get('/login', 'index')->name("login")->middleware("guest");//Login Page
    Route::post('/check', 'check')->name("check")->middleware("guest");//Check the Data
    Route::get('/logout', 'logout')->name("logout")->middleware("auth");//to logout
});

// Register Routes
Route::controller(RegisterController::class)->group(function () {
    Route::get('/register', 'index')->name("register")->middleware("guest");//Register Page
    Route::post('/createUser', 'createUser')->name("createUser")->middleware("guest");//Register Page
});

//Profile Routes
Route::controller(ProfileController::class)->group(function () {//
    Route::get('/profile/{id}', 'profile')->name("profile")->middleware("auth");//Profile Page
    Route::put('/updateUser/{id}', 'updateUser')->name("updateUser")->middleware("auth");//Update User
    Route::put('/updateProfileData/{id}', 'updateProfileData')->name("updateProfileData")->middleware("auth");//Update User
});


//Comment Routes
Route::controller(CommentController::class)->group(function () {
    Route::get('/comment/{course_id}', 'index')->name("comment");//Comment Page
    Route::post('/AddComment/{course_id}', 'addComment')->name("AddComment")->middleware("auth");//Comment Page
    Route::post('/DelComment/{id}/{course_id}', 'delComment')->name("DelComment")->middleware("auth");//Comment Page
});


//Home of Dashboard Routes
Route::controller(IndexTableController::class)->group(function () {
    Route::get('/dashboard/{id}', 'index')->name("dashboard.index")->middleware("access");//Home of Dashboard Page
    Route::get('/settings', 'settings')->name("settings")->middleware("access");//Home of Dashboard Page
    Route::put('/settingsUpdate', 'settingsUpdate')->name("settingsUpdate")->middleware("access");//Home of Dashboard Page
});


//Roles Table Routes
Route::controller(RolesTableController::class)->group(function () {
    Route::get('/RolesTable', 'index')->name("dashboard.RolesTable")->middleware("access");//Roles Table Page
});



//Users Table Routes
Route::controller(UsersTableController::class)->group(function () {
    Route::get('/UsersTable', 'index')->name("dashboard.UsersTable")->middleware("access");//Users Table Page
});



//Specialties Table Routes
Route::controller(SpecialtiesTableController::class)->group(function () {
    Route::get('/SpecialtiesTable', 'index')->name("dashboard.SpecialtiesTable")->middleware("access");//Specialties Table Page
});


//Branches Table Routes
Route::controller(BranchesTableController::class)->group(function () {
    Route::get('/BranchesTable', 'index')->name("dashboard.BranchesTable")->middleware("access");//Branches Table Page
});


//Languages Table Routes
Route::controller(LanguagesTableController::class)->group(function () {
    Route::get('/LanguagesTable', 'index')->name("dashboard.LanguagesTable")->middleware("access");//Languages Table Page
});


//Join Language with Branch Table Routes
Route::controller(JoinBranchWithLanguageController::class)->group(function () {
    Route::get('/JoinsTable',"index")->name("dashboard.JoinsTable")->middleware("access");//Join Table Page

});




//Courses Table Routes
Route::controller(CoursesTableController::class)->group(function () {
    Route::get('/CoursesTable', 'index')->name("dashboard.CoursesTable")->middleware("access");//Courses Table Page
});


//Course Register Routes
Route::controller(CourseRegisterController::class)->group(function () {
    Route::post('/courseRegister/{cours_id}', 'register')->name("courseRegister")->middleware("auth");//Register
    Route::post('/unRegister/{cours_id}', 'unRegister')->name("unRegister")->middleware("auth");//unRegister
});





