<?php

use App\Http\Controllers\FrontEnd\ContactController;
use App\Http\Controllers\FrontEnd\HomePageController;
use App\Http\Controllers\FrontEnd\SaleProcess\LetterController;
use App\Http\Controllers\FrontEnd\SaleProcess\LetterDocumentController;
use App\Http\Controllers\FrontEnd\SaleProcess\PaymentController;
use App\Http\Controllers\FrontEnd\SaleProcess\RecipientController;
use App\Http\Controllers\FrontEnd\SaleProcess\SenderController;
use App\Http\Controllers\FrontEnd\StaticPageController;
use App\Http\Controllers\FrontEnd\TemplatePageController;
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

/**
 * Pages
 */
Route::get(
    '/',
    HomePageController::class
)
    ->name('frontend.homepage');

Route::get(
    '/contact',
    [ContactController::class, 'show'],
)
    ->name('frontend.contact');

/**
 *  Sale Process
 */
Route::get(
    '/lettre/rediger',
    [LetterController::class, 'show'],
)
    ->name('frontend.letter.edit');

Route::get(
    '/lettre/models',
    [TemplatePageController::class, 'index'],
)
    ->name('frontend.letter.templates');

Route::get(
    '/lettre/models/{template}',
    [LetterController::class, 'edit'],
)
    ->name('frontend.template.edit');

Route::get(
    '/lettre/importer',
    [LetterDocumentController::class, 'show'],
)
    ->name('frontend.letter.import');

Route::get(
    '/lettre/destinataire',
    [RecipientController::class, 'show'],
)
    ->name('frontend.letter.recipient');

Route::get(
    '/lettre/expediteur',
    [SenderController::class, 'show'],
)
    ->name('frontend.letter.sender');

Route::get(
    '/lettre/paiement',
    PaymentController::class,
)
    ->name('frontend.letter.payment');

/**
 * Pages
 */
Route::get(
    '/{slug}',
    StaticPageController::class
)
    ->name('frontend.staticpage')
    ->whereIn('slug', ['envoyer', 'faq', 'prix']);
