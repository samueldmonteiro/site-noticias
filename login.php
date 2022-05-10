<?php 


require_once("vendor/autoload.php");
require_once("config/globals.php");

use Src\Models\Auth;
use Src\Utils\Redirect;

$auth = new Auth($pdo, $base);

$userInfo = $auth->checkAuthentication(false);

if($userInfo){
    Redirect::local($base, "index.php");
}

require_once("partials/header.php");
?>

<div class="container login">
    <form method="POST" action="<?=$base?>login_action.php" class="form-login">
        <div class="form-login-head">
            <h2>Login</h2>
        </div>

        <div class="form-login-body">


            <label>
                <i class="bi bi-envelope-fill"></i>
                <input type="email" name="email" placeholder="Seu Email">
            </label>

            <label>
                <i class="bi bi-incognito"></i>
                <input type="password" name="password" placeholder="Sua Senha">
            </label>
            
            <button class="btn btn-primary">Login</button>

            <div class="links">
                <a href="">Esqueceu a senha?</a>
                <a href="register.php">Criar Conta</a>
            </div>
        </div>
    </form>
</div>

<?php require_once("partials/footer.php");?> 