<?php 

require_once("vendor/autoload.php");
require_once("config/globals.php");

use Src\Models\Auth;
use Src\Utils\Redirect;

$auth = new Auth($pdo, $base);

$userInfo = $auth->checkAuthentication(false);

if($userInfo){
    Redirect::local("index.php");
}

require_once("partials/header.php");
?>

<div class="container register">
    <form class="form-register">
        <div class="form-register-head">
            <h2>Criar Conta</h2>
        </div>

        <div class="form-register-body">
            <div class="alert alert-danger message hide-message" role="alert">
              teste
            </div>
            <label>
                <i class="bi bi-person-fill"></i>
                <input type="text" name="name" placeholder="Nome completo">
            </label>

            <label>
                <i class="bi bi-envelope-fill"></i>
                <input type="email" name="email" placeholder="Seu Email">
            </label>

            <label>
                <i class="bi bi-incognito"></i>
                <input type="password" name="password" placeholder="Sua Senha">
            </label>

            <label>
                <i class="bi bi-incognito"></i>
                <input type="password" name="confirm_password" placeholder="Confirme a Senha">
            </label>
            
            <button class="btn btn-primary">Criar</button>

            <div class="links">
                <a href="">Esqueceu a senha?</a>
                <a href="login.php">Já tem uma conta?</a>
            </div>
        </div>
    </form>
</div>

<?php require_once("partials/footer.php");?>