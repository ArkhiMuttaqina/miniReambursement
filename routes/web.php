    <?php

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


Route::get('/', function () {
    // dd(Auth::user());
    if (!Auth::user()) {
        return view('auth.login');
    } else {
        return redirect(route('home'));
    }
});

Auth::routes();

// Route::group(
//     ['middleware' => 'auth'],
//     function () {

        Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

        // USERS
        Route::get('/employee', [App\Http\Controllers\MasterUserController::class, 'index'])->name('employee');
        Route::get('/employee/api', [App\Http\Controllers\MasterUserController::class, 'apiUsers'])->name('employee_api');
        Route::post('/employee/store', [App\Http\Controllers\MasterUserController::class, 'store'])->name('employee_store');
        Route::post('/employee/update', [App\Http\Controllers\MasterUserController::class, 'update'])->name('employee_update');
        Route::post('/employee/destroy', [App\Http\Controllers\MasterUserController::class, 'destroy'])->name('employee_destroy');
        Route::post('/employee/Activate', [App\Http\Controllers\MasterUserController::class, 'Activate'])->name('employee_Activate');
        Route::post('/employee/Deactivate', [App\Http\Controllers\MasterUserController::class, 'Deactivate'])->name('employee_Deactivate');


        // REIMBURSMENT
        Route::get('/reimbursement', [App\Http\Controllers\ReimbursementController::class, 'index'])->name('reimbursement');
        Route::get('/reimbursement/all', [App\Http\Controllers\ReimbursementController::class, 'indexAll'])->name('reimbursement_all');
        Route::get('/reimbursement/create', [App\Http\Controllers\ReimbursementController::class, 'create'])->name('reimbursement_create');
        Route::get('/reimbursement/show/{id}', [App\Http\Controllers\ReimbursementController::class, 'show'])->name('reimbursement_show');
        Route::get('/reimbursement/edit/{id}', [App\Http\Controllers\ReimbursementController::class, 'edit'])->name('reimbursement_edit');
        Route::get('/reimbursement/api', [App\Http\Controllers\ReimbursementController::class, 'api'])->name('reimbursement_api');
        Route::get('/reimbursement/api/all', [App\Http\Controllers\ReimbursementController::class, 'apiAllReimbursement'])->name('reimbursementAll_api');
        Route::post('/reimbursement/store', [App\Http\Controllers\ReimbursementController::class, 'post'])->name('reimbursement_store');
        Route::post('/reimbursement/update', [App\Http\Controllers\ReimbursementController::class, 'update'])->name('reimbursement_update');
        Route::post('/reimbursement/delete', [App\Http\Controllers\ReimbursementController::class, 'destroy'])->name('reimbursement_delete');
        Route::post('/reimbursement/approval', [App\Http\Controllers\ReimbursementController::class, 'approval'])->name('reimbursement_approval');
        Route::post('/reimbursement/approved', [App\Http\Controllers\ReimbursementController::class, 'approved'])->name('reimbursement_approved');
        Route::post('/reimbursement/rejected', [App\Http\Controllers\ReimbursementController::class, 'rejected'])->name('reimbursement_rejected');
        Route::post('/reimbursement/cancelled', [App\Http\Controllers\ReimbursementController::class, 'cancelled'])->name('reimbursement_cancelled');
        Route::post('/reimbursement/downloadFile', [App\Http\Controllers\ReimbursementController::class, 'downloadFile'])->name('reimbursement_downloadFile');

        //PROFILE
        Route::get('/profile', [App\Http\Controllers\ProfileController::class, 'index'])->name('profile_store');
        Route::post('/profile/update', [App\Http\Controllers\ProfileController::class, 'index'])->name('profile_update');
        Route::post('/profile/delete', [App\Http\Controllers\ProfileController::class, 'index'])->name('profile_delete');
//     }
// );
