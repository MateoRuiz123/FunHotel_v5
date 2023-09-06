<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth; // Import Auth class
use App\Http\Controllers\ClienteController; // Import controller class
use App\Http\Controllers\ServicioController; // Import controller class
use App\Http\Controllers\CatalogoController; // Import controller class
use App\Http\Controllers\VentaControlador; // Import controller class
use App\Http\Controllers\CategoriaController; // Import controller class
use App\Http\Controllers\HabitacionController; // Import controller class
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ReservaController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\CheckinController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\PagoController;


Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('/clientes', ClienteController::class);
Route::resource('/servicios', ServicioController::class);
Route::resource('/catalogos', CatalogoController::class);
Route::resource('/ventas', VentaControlador::class);
Route::resource('/categorias', CategoriaController::class);
Route::resource('/habitaciones', HabitacionController::class);
Route::resource('/roles', RoleController::class);
Route::resource('/users', UserController::class);
Route::resource('/reservas', ReservaController::class);
Route::resource('/products', ProductController::class);
Route::resource('/groups', GroupController::class);
Route::resource('/checkins', CheckinController::class);
Route::resource('/checkouts', CheckoutController::class);
Route::resource('/pagos', PagoController::class);

Route::get('/ventas-obtener-informacion-reserva/{id}', [VentaControlador::class, 'obtenerInformacionReserva']);
Route::get('/venta-create', [VentaControlador::class, 'create'])->name('ventas.create');
Route::get('/venta-update/{venta}', [VentaControlador::class, 'edit'])->name('ventas.edit');

// Ruta para añadir usuarios a un grupo
Route::post('/groups/{group}/add-user', [GroupController::class, 'addUser'])->name('groups.addUser');
// Ruta para eliminar usuarios de un grupo
Route::delete('/groups/{group}/users/{user}', [GroupController::class, 'removeUser'])->name('groups.users.remove');

Route::get('users/assign-roles', [UserController::class, 'show'])->name('users.assign-roles');
Route::post('users/save-roles', [UserController::class, 'saveRoles'])->name('users.save-roles');

Route::post('/groups/{group}/assign-roles', [GroupController::class, 'assignRoles'])->name('groups.assignRoles');
Route::post('/groups/{group}/users/{user}/assign-role', [GroupController::class, 'assignUserRole'])->name('groups.assignUserRole');
Route::post('/groups/{group}/assign-group-role', [GroupController::class, 'assignGroupRole'])->name('groups.assignGroupRole');
Route::post('/groups/{group}/revoke-group-role', [GroupController::class, 'revokeGroupRole'])->name('groups.revokeGroupRole');