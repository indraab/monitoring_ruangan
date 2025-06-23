<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true); // Aktifkan jika ingin pakai auto-routing klasik

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Halaman utama
$routes->get('/', 'Home::index');

// Auth/Login/Logout
$routes->get('login', 'Auth::index');
$routes->post('auth/login', 'Auth::login');
$routes->get('logout', 'Auth::logout');
$routes->get('auth/logout', 'Auth::logout'); // alias

// Dashboard setelah login
$routes->get('dashboard', 'Dashboard::index');

// Monitoring publik (tanpa login)
$routes->get('monitoring', 'Monitoring::index');

// Jadwal penggunaan ruangan
$routes->get('schedule', 'Schedule::index');
$routes->post('schedule', 'Schedule::save'); // simpan baru
$routes->post('schedule/save', 'Schedule::save'); // simpan edit
$routes->post('schedule/delete/(:num)', 'Schedule::delete/$1'); // hapus
$routes->get('schedule/get/(:num)', 'Schedule::get/$1'); // ambil data by id

// Group: Admin (Manajemen User)
$routes->group('admin', ['namespace' => 'App\Controllers\Admin'], function($routes) {
    $routes->get('user', 'User::index'); // list user
    $routes->get('user/edit/(:num)', 'User::edit/$1'); // edit form
    $routes->post('user/save', 'User::save'); // simpan user (tambah/edit)
    $routes->get('user/delete/(:num)', 'User::delete/$1'); // hapus user
});

/*
|--------------------------------------------------------------------------
| Additional Routes
|--------------------------------------------------------------------------
| Tambahkan route lain jika nanti dibutuhkan seperti:
| - Manajemen ruangan
| - Log aktivitas
| - Reset password
| - FullCalendar
| - API route (jika ingin akses JSON)
*/
