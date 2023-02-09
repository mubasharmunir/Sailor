<?php
use App\Http\Controllers\PageController as ControllersPageController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\FormController;
use App\Http\Controllers\CityController;

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
Route::get('/', function () {
    return view('welcome');
});

 Route::resource('country' , CountryController::class);
 Route::get('country', [CountryController::class, 'index'])->name('country');
 Route::get('country_edit/{id}', [CountryController::class, 'country_edit']);
 Route::post('country_update', [CountryController::class, 'country_update']);
 Route::get('city_edit/{id}', [CityController::class, 'city_edit']);
 Route::post('city_update', [CityController::class, 'city_update']);
 Route::resource('city' , CityController::class);
 Route::get('city', [CityController::class, 'index'])->name('city');
 Route::get('blog', [ControllersPageController::class, 'blog'])->name('blog');
 Route::get('contact', [ContactController::class, 'contact'])->name('contact');
 Route::post('contact', [ContactController::class, 'addData'])->name('contact.send');
 Route::post('send-message',[ContactController::class,'sendEmail'])->name('contact.send');
 Route::get('list', [ContactController::class,'list'])->name('list');
 Route::get('manage_list', [ContactController::class,'manage_list']);
 Route::get('form', [FormController::class,'form'])->name('form');
 Route::post('/form-submit', [FormController::class,'formSubmit'])->name('form.submit');
 Route::get('jquerylist', [FormController::class, 'jquery'])->name('jquery');
 Route::get('manage_jquerylist', [FormController::class,'manage_jquerylist']);
 Route::get('edit-form/{id}', [FormController::class, 'edit']);
 Route::put('update-form/{id}', [FormController::class, 'update'])->name('update-form');
 Route::delete('delete-form/{id}', [FormController::class, 'delete'])->name('delete-form');
 Route::get('get/countries', [CityController::class, 'getAllCountries'])->name('getAllCountries');
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->middleware(['auth'])->name('dashboard');
    require __DIR__.'/auth.php';
