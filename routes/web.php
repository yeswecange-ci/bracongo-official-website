<?php

use Illuminate\Support\Facades\Route;

// ── Controllers Front ──────────────────────────────────────────────────────
use App\Http\Controllers\FrontController;
// ── Controllers Admin ─────────────────────────────────────────────────────
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\ParametresSiteController;
use App\Http\Controllers\Admin\PageWelcomeController;
use App\Http\Controllers\Admin\PageAccueilController;
use App\Http\Controllers\Admin\HeroSlideController;
use App\Http\Controllers\Admin\PageHistoireController;
use App\Http\Controllers\Admin\ValeurController;
use App\Http\Controllers\Admin\PageContactController;
use App\Http\Controllers\Admin\MessageContactController;
use App\Http\Controllers\Admin\PageCarriereController;
use App\Http\Controllers\Admin\OffreEmploiController;
use App\Http\Controllers\Admin\PageProController;
use App\Http\Controllers\Admin\PageBieresController;
use App\Http\Controllers\Admin\PageCategorieBoissonsController;
use App\Http\Controllers\Admin\NavigationItemController;
use App\Http\Controllers\Admin\FooterController;
use App\Http\Controllers\Admin\FooterGalleryController;
use App\Http\Controllers\Admin\ReseauSocialController;
use App\Http\Controllers\Admin\MarqueController;
use App\Http\Controllers\Admin\BoissonController;
use App\Http\Controllers\Admin\ProduitController;
use App\Http\Controllers\Admin\NewsController;
use App\Http\Controllers\Admin\InvitationController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Auth\AcceptInvitationController;
use App\Http\Controllers\Auth\LoginController;

/*
|--------------------------------------------------------------------------
| Routes Front (client)
|--------------------------------------------------------------------------
*/
Route::get('/', [FrontController::class, 'welcome']);
Route::get('/Accueil', [FrontController::class, 'accueil'])->name('Accueil');
Route::get('/histoire', [FrontController::class, 'histoire'])->name('histoire');
Route::get('/Notre-Histoire', [FrontController::class, 'histoire'])->name('Histoire');
Route::get('/Nos-marques', [FrontController::class, 'marques'])->name('marque');
Route::get('/Nos-marques/{categorie}', [FrontController::class, 'marqueCategorie'])->name('marque.categorie');
Route::get('/Nos-marques-bieres', [FrontController::class, 'bieres'])->name('bieres');
Route::get('/Boisson/{slug}', [FrontController::class, 'boisson'])->name('boisson.show');
Route::get('/Nos-marques-bieres-beaufort', [FrontController::class, 'boissonBeaufort'])->name('bieres.beaufort');
Route::get('/Actualites-et-evenements', [FrontController::class, 'actualites'])->name('actualites');
Route::get('/Carriere', [FrontController::class, 'carriere'])->name('carriere');
Route::get('/Contact', [FrontController::class, 'contact'])->name('contact');
Route::post('/Contact', [FrontController::class, 'contactStore'])->name('contact.store');
Route::get('Bracongo-pro', [FrontController::class, 'pro'])->name('pro');

Route::get('/api/recherche', [FrontController::class, 'searchAutocomplete'])->name('recherche.autocomplete');

// Invitation publique (création de compte éditeur)
Route::get('/invitation/{token}', [AcceptInvitationController::class, 'show'])->name('invitation.show');
Route::post('/invitation/{token}', [AcceptInvitationController::class, 'accept'])->name('invitation.accept');

/*
|--------------------------------------------------------------------------
| Routes Admin (prefix: back-office)
|--------------------------------------------------------------------------
*/
Route::prefix('back-office')->name('admin.')->group(function () {
    Route::middleware('guest')->group(function () {
        Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
        Route::post('login', [LoginController::class, 'login']);
    });

    Route::middleware('backoffice.auth')->group(function () {
        // Dashboard
        Route::get('/', DashboardController::class)->name('dashboard');

        Route::post('logout', [LoginController::class, 'logout'])->name('logout');

        Route::get('/invitations', [InvitationController::class, 'index'])->name('invitations.index');
        Route::post('/invitations', [InvitationController::class, 'store'])->name('invitations.store');
        Route::delete('/invitations/{invitation}', [InvitationController::class, 'destroy'])->name('invitations.destroy');

        Route::get('/users', [UserController::class, 'index'])->name('users.index');
        Route::get('/users/{user}', [UserController::class, 'show'])->name('users.show');
        Route::post('/users/{user}/two-factor/reset', [UserController::class, 'resetTwoFactor'])->name('users.two-factor.reset');
        // ── CMS Pages (ancien système) ─────────────────────────────────────
        Route::get('/pages', [PageController::class, 'index'])->name('pages.index');
        Route::get('/pages/create', [PageController::class, 'create'])->name('pages.create');

        // ── Paramètres globaux ─────────────────────────────────────────────
        Route::get('/parametres', [ParametresSiteController::class, 'edit'])->name('parametres.edit');
        Route::put('/parametres', [ParametresSiteController::class, 'update'])->name('parametres.update');

        // ── Contenu des pages (single-row) ─────────────────────────────────
        Route::prefix('pages-contenu')->name('pages.')->group(function () {

        Route::get('/welcome', [PageWelcomeController::class, 'edit'])->name('welcome.edit');
        Route::put('/welcome', [PageWelcomeController::class, 'update'])->name('welcome.update');

        Route::get('/accueil', [PageAccueilController::class, 'edit'])->name('accueil.edit');
        Route::put('/accueil', [PageAccueilController::class, 'update'])->name('accueil.update');

        Route::get('/histoire', [PageHistoireController::class, 'edit'])->name('histoire.edit');
        Route::put('/histoire', [PageHistoireController::class, 'update'])->name('histoire.update');

        Route::get('/contact', [PageContactController::class, 'edit'])->name('contact.edit');
        Route::put('/contact', [PageContactController::class, 'update'])->name('contact.update');

        Route::get('/carriere', [PageCarriereController::class, 'edit'])->name('carriere.edit');
        Route::put('/carriere', [PageCarriereController::class, 'update'])->name('carriere.update');

        Route::get('/pro', [PageProController::class, 'edit'])->name('pro.edit');
        Route::put('/pro', [PageProController::class, 'update'])->name('pro.update');

        Route::get('/bieres', [PageBieresController::class, 'edit'])->name('bieres.edit');
        Route::put('/bieres', [PageBieresController::class, 'update'])->name('bieres.update');

        Route::get('/categorie-boissons/{categorie}', [PageCategorieBoissonsController::class, 'edit'])
            ->name('categorie-boissons.edit')
            ->where('categorie', 'eaux|gazeuses|energisantes');
        Route::put('/categorie-boissons/{categorie}', [PageCategorieBoissonsController::class, 'update'])
            ->name('categorie-boissons.update')
            ->where('categorie', 'eaux|gazeuses|energisantes');
        });

        // ── Hero Slides ────────────────────────────────────────────────────
        Route::resource('hero-slides', HeroSlideController::class)->names('hero-slides');

        // ── Valeurs (page Histoire) ────────────────────────────────────────
        Route::resource('valeurs', ValeurController::class)->names('valeurs');

        // ── Offres d'emploi ────────────────────────────────────────────────
        Route::resource('offres-emploi', OffreEmploiController::class)->names('offres-emploi');

        // ── Messages de contact ────────────────────────────────────────────
        Route::get('/messages', [MessageContactController::class, 'index'])->name('messages.index');
        Route::get('/messages/{messageContact}', [MessageContactController::class, 'show'])->name('messages.show');
        Route::patch('/messages/{messageContact}/read', [MessageContactController::class, 'markAsRead'])->name('messages.read');
        Route::delete('/messages/{messageContact}', [MessageContactController::class, 'destroy'])->name('messages.destroy');

        // ── Navigation ─────────────────────────────────────────────────────
        Route::resource('navigation', NavigationItemController::class)->names('navigation');

        // ── Footer ─────────────────────────────────────────────────────────
        Route::get('/footer', [FooterController::class, 'edit'])->name('footer.edit');
        Route::put('/footer', [FooterController::class, 'update'])->name('footer.update');

        Route::resource('footer-gallery', FooterGalleryController::class)->names('footer-gallery');

        Route::resource('reseaux-sociaux', ReseauSocialController::class)->names('reseaux-sociaux');

        // ── Marques & Boissons ─────────────────────────────────────────────
        Route::resource('marques', MarqueController::class)->names('marques');
        Route::resource('boissons', BoissonController::class)->names('boissons');

        // ── Produits (backend only) ────────────────────────────────────────
        Route::resource('produits', ProduitController::class)->names('produits');

        // ── News ───────────────────────────────────────────────────────────
        Route::resource('news', NewsController::class)->names('news');
    });
});
