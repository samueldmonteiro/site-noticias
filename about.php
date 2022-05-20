<?php

use Src\Models\Auth;

require_once("vendor/autoload.php");
require_once("config/globals.php");

$auth = new Auth($pdo, $base);

$userInfo = $auth->checkAuthentication(false);

require_once("partials/header.php");
?>

<div class="container about">
    <div class="about-info">
        <h2>Sobre o Autor</h2>
        <p>Sou um parágrafo. Clique aqui para adicionar o seu próprio texto e editar-me. Sou um ótimo espaço para você contar sua história para que seus usuários saibam um pouco mais sobre você.
        </p>

        <p>
            Sou um parágrafo. Clique aqui para editar-me e adicionar o seu próprio texto. É fácil! Basta clicar em "Editar Texto" ou clicar duas vezes sobre mim e você poderá adicionar o seu próprio conteúdo e trocar fontes. Sinta-se à vontade para arrastar-me e soltar em qualquer lugar em sua página. Sou um ótimo lugar para você contar sua história e permitir que seus clientes saibam um pouco mais sobre você.
        </p>
            
                
        <p>    
            Este é um ótimo espaço para escrever um texto longo sobre a sua empresa e seus serviços. Você pode usar esse espaço para entrar em detalhes sobre a sua empresa. Fale sobre a sua equipe e sobre os serviços prestados por você. Conte aos seus visitantes sobre como teve a idéia de iniciar o seu negócio e o que o torna diferente de seus competidores. Faça com que sua empresa se destaque e mostre quem você é. Dica: Adicione a sua própria imagem clicando duas vezes sobre a imagem e clicando em Trocar Imagem.
        </p>
    </div>

    <div class="stacks">
        <h2>Tecnoloagias</h2>
        <ul>
            <li>HTML5</li>
            <li>CSS3</li>
            <li>JavaScript</li>
            <li>PHP</li>
        </ul>
    </div>
</div>

<?php require_once("partials/footer.php");?>