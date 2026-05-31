<?php
/**
 * ROUTES — the whole URL map of the app. THIS is the file you edit to add a
 * page. Each line says: for this METHOD + PATH, run this controller method.
 *
 * To add a section "site.com/widgets":
 *   1. add the lines you need here (mirror the /examples block below)
 *   2. create app/Controllers/WidgetController.php with those methods
 *   3. create views/widgets/*.php
 * That's it.
 *
 * @var Router $router  (created in public/index.php)
 */

// --- Public pages ----------------------------------------------------------
$router->get('/',          [HomeController::class, 'index']);
$router->get('/health',    [HomeController::class, 'health']);

// --- Auth ------------------------------------------------------------------
$router->get('/login',           [AuthController::class, 'showLogin']);
$router->post('/login',          [AuthController::class, 'login']);
$router->get('/register',        [AuthController::class, 'showRegister']);
$router->post('/register',       [AuthController::class, 'register']);
$router->post('/logout',         [AuthController::class, 'logout']);
$router->get('/forgot',          [AuthController::class, 'showForgot']);
$router->post('/forgot',         [AuthController::class, 'sendReset']);
$router->get('/reset',           [AuthController::class, 'showReset']);
$router->post('/reset',          [AuthController::class, 'reset']);
$router->get('/verify',          [AuthController::class, 'verify']);
$router->post('/verify/resend',  [AuthController::class, 'resendVerification']);

// Google sign-in (these 404 unless google_enabled is true in config.php)
$router->get('/auth/google',          [GoogleAuthController::class, 'redirect']);
$router->get('/auth/google/callback', [GoogleAuthController::class, 'callback']);

// --- Dashboard -------------------------------------------------------------
$router->get('/dashboard',       [DashboardController::class, 'index']);

// --- Account settings ------------------------------------------------------
$router->get('/settings',           [SettingsController::class, 'show']);
$router->post('/settings/profile',  [SettingsController::class, 'updateProfile']);
$router->post('/settings/password', [SettingsController::class, 'updatePassword']);

// --- Admin (admin role only) -----------------------------------------------
$router->get('/admin/users',     [AdminController::class, 'users']);

// --- Files / uploads -------------------------------------------------------
$router->get('/uploads',             [UploadController::class, 'index']);
$router->post('/uploads',            [UploadController::class, 'store']);
$router->get('/uploads/{id}',        [UploadController::class, 'download']);
$router->post('/uploads/{id}/delete', [UploadController::class, 'destroy']);

// --- JSON API (session-authenticated) --------------------------------------
$router->get('/api/examples',    [ApiController::class, 'examples']);

// --- Examples (the copy-me section) ----------------------------------------
// NOTE: declare the literal '/examples/create' BEFORE '/examples/{id}', or the
// {id} pattern would swallow the word "create".
$router->get('/examples',            [ExampleController::class, 'index']);
$router->get('/examples/create',     [ExampleController::class, 'create']);
$router->post('/examples',           [ExampleController::class, 'store']);
$router->get('/examples/{id}',       [ExampleController::class, 'show']);
$router->get('/examples/{id}/edit',  [ExampleController::class, 'edit']);
$router->post('/examples/{id}',      [ExampleController::class, 'update']);
$router->post('/examples/{id}/delete', [ExampleController::class, 'destroy']);
