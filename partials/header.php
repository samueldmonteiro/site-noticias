<?php

use Src\Dao\NewsCategoryDaoMysql;

$newsCategoryDao = new NewsCategoryDaoMysql($pdo);

$categoriesList = $newsCategoryDao->getAll();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Site de Notícias</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/responsive.css">
</head>
<body>
    
    <header>
        <div class="header-top">
            <div class="container">
                <a href="" class="title">
                    <img src="assets/images/logo.webp" alt=""><span>Site de</span> <span>Notícias</span>
                </a>
                <p>Notícia e Entretenimento</p>
            </div>
        </div>

        <div class="header-bottom">
            <div class="container">
                <nav>
                    <ul  class="container">
                        <li><a href="index.php">Início</a></li>
                        <li><a href="about.php">Sobre</a></li>
                        <li><div class="dropdown">
                            <a class="" href="" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                            Categorias
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                <?php foreach ($categoriesList as $category): ?>
                                    <li><a class="dropdown-item" href="<?=$base?>?category=<?=$category->id?>">
                                        <?=$category->name?>
                                    </a></li> 
                                <?php endforeach ?>
                            
                            </ul>
                        </div></li>
                        
                        <?php if($userInfo):?>
                            <li><a href="<?=$base?>logout.php">Logout</a></li>
                        <?php endif?>
                    </ul>
                    
                </nav>
                
                <?php if($userInfo):?>
                    <div class="header-user-menu">
                        <div class="user">
                            <img src="<?=$base?>media/users/<?=$userInfo->getImage()?>" alt="" class="image-user">
                            <a href="<?=$base?>profile.php"><?=$userInfo->name?></a>
                        </div>
                    </div>
                <?php else:?>
                   <a id="link-login" href="<?=$base?>login.php">Login</a>
                <?php endif?>
            </div>

            <nav class="container navbar navbar-expand-lg navbar-dark">
                <div class="container-fluid">
                    <a class="navbar-brand" href="#"></a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="<?=$base?>">Início</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="<?=$base?>about.php">Sobre</a>
                        </li>
                        <?php if($userInfo):?>
                            <li class="nav-item">
                                <a class="nav-link active" href="<?=$base?>logout.php">logout</a>
                            </li>
                        <?php endif?>
                        </ul>
                    </div>
                </div>
            </nav>
        </div>
    </header>

