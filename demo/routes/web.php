<?php
use App\Events\TestEvent;
use Illuminate\Http\Request;
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

Route::get('/bridge', function() {
    $pusher = App::make('pusher');

    $pusher->trigger( 'test-channel',
                      'test-event', 
                      array('text' => 'Preparing the Pusher Laracon.eu workshop!'));

    return view('welcome');
});

Route::get('/broadcast', function() {
   
    event(new TestEvent('Broadcasting in Laravel using Pusher!'));

    return view('counter');
});

Route::get('counter', function() {
    return view('counter');
});

Route::get('sender', function() {
    return view('sender');
});

Route::post('sent', function(Request $request) {
    $text = $request->input('mail');
    event( new TestEvent($text));
    return view('sender');
})->name('sender');