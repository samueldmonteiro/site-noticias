<?php 

require_once("vendor/autoload.php");
require_once("config/globals.php");

use Src\Models\Auth;
use Src\Utils\Redirect;
use Src\Utils\Message;

$auth = new Auth($pdo, $base);

$userInfo = $auth->checkAuthentication(true);


require_once("partials/header.php");
?>

<div class="container profile">

    <?php if(Message::getMessageInSession()):?>
        <div class="alert text-center <?=Message::getMessageInSession()['style']?>" role="alert">
            <?=Message::getMessageInSession()['msg']?>
        </div>
        <?=Message::destroyMessageInSession()?>
    <?php endif?>

    <section style="background-color: #eee;">
        <div class="container py-5">
            <div class="row">
            <div class="col">
                <nav aria-label="breadcrumb" class="bg-light rounded-3 p-3 mb-4">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="<?=$base?>">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page"><?=$userInfo->name?></li>
                </ol>
                </nav>
            </div>
            </div>

            <div class="row">
            <div class="col-lg-4">
                <div class="card mb-4">
                <div class="card-body text-center">
                    <img id="image-user" src="<?=$base?>media/users/<?=$userInfo->getImage()?>" alt="avatar"
                    class="rounded-circle img-fluid" style="width: 150px;">
                    <h5 class="my-3"><?=$userInfo->name?></h5>
                    
                </div>
                </div>
                
            </div>
            <form  method="POST" action="<?=$base?>profile_edit_action.php" class="col-lg-8" enctype="multipart/form-data">
                <div class="card mb-4">
                <div class="card-body">

                    <div class="row">
                        <div class="row">
                            <p class="mb-2">Imagem do Perfil</p>
                        </div>
                        <div class="mb-2">
                            <input class="form-control" type="file" id="formFile" name="image">
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                    <div class="col-sm-3">
                        <p class="mb-0">Nome Completo</p>
                    </div>
                    <div class="col-sm-9">
                        <input type="text" name="name" value="<?=$userInfo->name?>">
                    </div>
                    </div>
                    <hr>
                    <div class="row">
                    <div class="col-sm-3">
                        <p class="mb-0">Email</p>
                    </div>
                    <div class="col-sm-9">
                    <input type="email" name="email" value="<?=$userInfo->email?>">
                    </div>
                    </div>

                    <hr>
                    <div class="row">
                    <div class="col-sm-3">
                        <p class="mb-0">Nível de Acesso</p>
                    </div>
                    <div class="col-sm-9">
                        <p class="text-muted ms-3"><?=ucfirst($userInfo->level)?></p>
                    </div>
                    </div>
                    <hr>
                    <div class="row">
                        <button type="submit" id="update Dados" class="btn btn-primary">Atualizar Dados</button>
                    </div>
                    
                </div>
                </div>
                
                </form>
            </div>
        </div>
    </section>
</div>

<?php require_once("partials/footer.php");?>