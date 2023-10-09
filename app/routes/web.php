
<?php
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
});

Route::post('/login', function () {
    return response('welcome');
});


// Rota para redirecionar o usuário para o GitHub para autenticação
Route::get('/auth/github/redirect', function () {
    return Socialite::driver('github')->redirect();
});

// Rota para tratar o retorno do GitHub após a autenticação
Route::get('/auth/github/callback', function () {
    // Obtenha os detalhes do usuário autenticado pelo GitHub
    $githubUser = Socialite::driver('github')->user();

    // atualiz ou cria um novo linha de usuário com base no ID do GitHub
    $user = User::updateOrCreate([
        'github_id' => $githubUser->id,
    ], [
        'name' => $githubUser->name,
        'email' => $githubUser->email,
        'github_token' => $githubUser->token,
        'github_refresh_token' => $githubUser->refreshToken,
    ]);

    //  login automatco com o usuário autenticado
    Auth::login($user);

    // vai para a página de usuário logado
    return redirect('/logged');
});

// Rota para informações do usuário logado
Route::get('/logged', function () {
    // Ivai mostrar informações do usuário autenticado
    echo '<pre>'; print_r(var_dump(auth()->user())); echo '</pre>';
});
