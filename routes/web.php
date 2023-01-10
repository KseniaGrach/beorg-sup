<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\ClientController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\SystemController;
use App\Http\Controllers\ProfileController;
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

Route::middleware(['auth', 'verified'])->get('/', [HomeController::class, 'getStartPage'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::prefix('admin_panel')->middleware('role:super_admin,manager,analyst')->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('homeAdmin');
    Route::middleware('role:super_admin')->group(function () {

        Route::prefix('users')->group(function () {
            Route::get('/', [SystemController::class, 'index'])->name('user.index');
            Route::get('/new', [SystemController::class, 'newUser'])->name('user.add');
            Route::get('/{user}/edit', [SystemController::class, 'getUser'])->name('user.edit');
            Route::post('/', [SystemController::class, 'storeUser'])->name('user.store');
            Route::put('/{user}', [SystemController::class, 'updateUser'])->name('user.update');
            Route::delete('/{user}', [SystemController::class, 'destroyUser'])->name('user.destroy');
        });

        Route::prefix('roles')->group(function () {
            Route::get('/', [SystemController::class, 'getRoles'])->name('role.index');
            Route::get('/new', [SystemController::class, 'newRole'])->name('role.add');
            Route::get('/{role}/edit', [SystemController::class, 'getRole'])->name('role.edit');
            Route::post('/', [SystemController::class, 'storeRole'])->name('role.store');
            Route::put('/{role}', [SystemController::class, 'updateRole'])->name('role.update');
            Route::delete('/{role}', [SystemController::class, 'destroyRole'])->name('role.destroy');
        });

        Route::prefix('departments')->group(function () {
            Route::get('/', [SystemController::class, 'getDepartments'])->name('department.index');
            Route::get('/new', [SystemController::class, 'newDepartment'])->name('department.add');
            Route::get('/{department}/edit', [SystemController::class, 'getDepartment'])->name('department.edit');
            Route::post('/', [SystemController::class, 'storeDepartment'])->name('department.store');
            Route::put('/{department}', [SystemController::class, 'updateDepartment'])->name('department.update');
            Route::delete('/{department}', [SystemController::class, 'destroyDepartment'])->name('department.destroy');
        });

        Route::prefix('types')->group(function () {
            Route::get('/', [SystemController::class, 'getTypes'])->name('type.index');
            Route::get('/new', [SystemController::class, 'newType'])->name('type.add');
            Route::get('/{type}/edit', [SystemController::class, 'getType'])->name('type.edit');
            Route::post('/', [SystemController::class, 'storeType'])->name('type.store');
            Route::put('/{type}', [SystemController::class, 'updateType'])->name('type.update');
            Route::delete('/{type}', [SystemController::class, 'destroyType'])->name('type.destroy');
        });

        Route::prefix('durations')->group(function () {
            Route::get('/', [SystemController::class, 'getDurations'])->name('duration.index');
            Route::get('/new', [SystemController::class, 'newDuration'])->name('duration.add');
            Route::get('/{duration}/edit', [SystemController::class, 'getDuration'])->name('duration.edit');
            Route::post('/', [SystemController::class, 'storeDuration'])->name('duration.store');
            Route::put('/{duration}', [SystemController::class, 'updateDuration'])->name('duration.update');
            Route::delete('/{duration}', [SystemController::class, 'destroyDuration'])->name('duration.destroy');
        });
    });

    Route::prefix('clients')->group(function () {
        Route::get('/', [AdminController::class, 'getClients'])->name('client.index');
        Route::get('/new', [AdminController::class, 'newClient'])->name('client.add');
        Route::get('/{client}/show', [AdminController::class, 'showClient'])->name('client.show');
        Route::get('/{client}/edit', [AdminController::class, 'editClient'])->name('client.edit');
        Route::post('/', [AdminController::class, 'storeClient'])->name('client.store');
        Route::put('/{client}', [AdminController::class, 'updateClient'])->name('client.update');

        Route::middleware('role:super_admin')->group(function () {
            Route::delete('/{client}', [SystemController::class, 'destroyClient'])->name('client.destroy');
        });
    });

    Route::prefix('projects')->group(function () {
        Route::prefix('global')->group(function () {
            Route::get('/', [AdminController::class, 'getGlobalProjects'])->name('project.global.index');
            Route::get('/{project}/show', [AdminController::class, 'getGlobalProject'])->name('project.global.show');

            Route::middleware('role:super_admin')->group(function () {
                Route::delete('/{project}', [SystemController::class, 'destroyProject'])->name('project.global.destroy');
            });
        });

        Route::prefix('self')->group(function () {
            Route::get('/', [AdminController::class, 'getProjects'])->name('project.self.index');
            Route::get('/new', [AdminController::class, 'newProject'])->name('project.self.add');
            Route::get('/{project}/show', [AdminController::class, 'showProject'])->name('project.self.show');
            Route::get('/{project}/edit', [AdminController::class, 'editProject'])->name('project.self.edit');
            Route::post('/', [AdminController::class, 'storeProject'])->name('project.self.store');
            Route::post('/{project}', [AdminController::class, 'addUserToProject'])->name('project.self.add.user');
            Route::post('/{project}/status', [AdminController::class, 'changeProjectStatus'])->name('project.self.change.status');
            Route::put('/{project}', [AdminController::class, 'updateProject'])->name('project.self.update');
        });
    });

    Route::prefix('meetings')->group(function () {
        Route::middleware('role:super_admin,manager')->group(function () {
            Route::get('/new', [AdminController::class, 'newMeeting'])->name('meeting.add');
            Route::get('/{meeting}/edit', [AdminController::class, 'editMeeting'])->name('meeting.edit');
            Route::post('/', [AdminController::class, 'storeMeeting'])->name('meeting.store');
            Route::put('/{meeting}', [AdminController::class, 'updateMeeting'])->name('meeting.update');
            Route::delete('/{meeting}', [SystemController::class, 'destroyMeeting'])->name('meeting.destroy');
        });
        Route::middleware('role:super_admin,analyst')->group(function () {
            Route::post('/{meeting}', [AdminController::class, 'agreementMeeting'])->name('meeting.agreement');
        });
        Route::get('/', [AdminController::class, 'getMeetings'])->name('meeting.index');
        Route::get('/{meeting}/show', [AdminController::class, 'showMeeting'])->name('meeting.show');
    });

    Route::middleware('role:super_admin,analyst')->prefix('instructions')->group(function () {
        Route::get('/', [AdminController::class, 'getInstructions'])->name('instruction.index');
        Route::get('/new', [AdminController::class, 'newInstruction'])->name('instruction.add');
        Route::get('/{instruction}/edit', [AdminController::class, 'editInstruction'])->name('instruction.edit');
        Route::post('/', [AdminController::class, 'storeInstruction'])->name('instruction.store');
        Route::put('/{instruction}', [AdminController::class, 'updateInstruction'])->name('instruction.update');
        Route::get('/{instruction}/show', [AdminController::class, 'showInstruction'])->name('instruction.show');
        Route::middleware('role:super_admin')->group(function () {
            Route::delete('/{instruction}', [SystemController::class, 'destroyInstruction'])->name('instruction.destroy');
        });
    });
});

Route::prefix('client_panel')->middleware('role:client')->group(function () {
    Route::get('/', [ClientController::class, 'index'])->name('homeClient');

    Route::prefix('projects')->group(function () {
        Route::get('/', [ClientController::class, 'getProjects'])->name('client.project.index');
        Route::get('/{project}/show', [ClientController::class, 'showProject'])->name('client.project.show');
    });

    Route::prefix('meetings')->group(function () {
        Route::get('/', [ClientController::class, 'getMeetings'])->name('client.meeting.index');
        Route::get('/{meeting}/show', [ClientController::class, 'showMeeting'])->name('client.meeting.show');
        Route::post('/{meeting}', [ClientController::class, 'agreementMeeting'])->name('client.meeting.agreement');
    });
});


require __DIR__.'/auth.php';
