<?php 

require_once("partials/header.php");
?>

<div class="container news">
    <div class="home-top">
        <span>News</span>
        <div class="search-by-news">
            <form method="POST" action="index.php">
                <button><i type="submit" class="bi bi-search"></i></button>
                <input type="text" name="search_news" placeholder="Buscar">             
            </form>
        </div>
    </div>


    <div class="news-item">
        <div class="news-item-head">
            <div class="info-from-news">
                <img src="assets/images/user.jpeg" alt="" class="image-user">
                <div>
                    <div class="username">Administrador</div>
                    <div class="info-datetime">13 de Abril de 2022 <span class="info-time">  - 1 min</span></div>
                </div>
            </div>

            <div class="dropdown">
                <p type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="bi bi-three-dots-vertical"></i>
                </p>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                    <li><a class="dropdown-item" href="#"><i class="bi bi-send"></i> Compartilhar</a></li>
                    <li><a class="dropdown-item" href="#"><i class="bi bi-pen"></i> Editar</a></li>
                    <li><a class="dropdown-item" href="#"><i class="bi bi-trash3"></i> Deletar</a></li>
                </ul>
            </div>
        </div>

        <div class="news-item-body">
            <p class="news-item-title">A influência da estratégia humana nos negócios</p>
            <p class="news-item-subject">Crie um subtítulo para o post no blog que resume numa frase curta e atraente o seu post. Assim seus leitores vão querer continuar a ler.</p>

            <div class="news-item-image">
                <img src="assets/images/f69f0ddab5a5bff3e4d39520e1632772.webp" alt="">
            </div>

            <div class="news-item-content">

            </div>

            <div class="news-item-footer">
                <div>
                    <span class="views-info">300 visualizações</span>
                    <span class="comments-info">3 comentários</span>
                </div>
                <div class="likes-info">
                    <span id="num-likes">10</span>
                    <i class="bi bi-heart"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="container-news-mini-preview">
        <div class="mini-preview-top">
            <span>Posts Recentes</span>
            <a href="index.html">Ver todos</a>
        </div>

        <div class="items">
            <div class="news-mini-preview">
                <a href="index.html">
                    <div class="news-mini-preview-image">
                        <img src="assets/images/f69f0ddab5a5bff3e4d39520e1632772.webp" alt="">
                    </div>

                    <div class="news-mini-preview-title">
                        10 regras de ouro para o planejamento estratégico
                    </div>
                    <div class="news-mini-preview-footer">
                        <div>
                            <span class="views-info"><i class="bi bi-eye"></i> 300</span>
                            <span class="comments-info"><i class="bi bi-chat-left-dots"></i> 5</span>
                        </div>
                        <div class="likes-info">
                            <span id="num-likes">10</span>
                            <i class="bi bi-heart"></i>
                        </div>
                    </div>
                    
                </a>
            </div>

            <div class="news-mini-preview">
                <a href="index.html">
                    <div class="news-mini-preview-image">
                        <img src="assets/images/f69f0ddab5a5bff3e4d39520e1632772.webp" alt="">
                    </div>

                    <div class="news-mini-preview-title">
                        10 regras de ouro para o planejamento estratégico
                    </div>
                    <div class="news-mini-preview-footer">
                        <div>
                            <span class="views-info"><i class="bi bi-eye"></i> 300</span>
                            <span class="comments-info"><i class="bi bi-chat-left-dots"></i> 5</span>
                        </div>
                        <div class="likes-info">
                            <span id="num-likes">10</span>
                            <i class="bi bi-heart"></i>
                        </div>
                    </div>
                    
                </a>
            </div>

            <div class="news-mini-preview">
                <a href="index.html">
                    <div class="news-mini-preview-image">
                        <img src="assets/images/f69f0ddab5a5bff3e4d39520e1632772.webp" alt="">
                    </div>

                    <div class="news-mini-preview-title">
                        10 regras de ouro para o planejamento estratégico
                    </div>
                    <div class="news-mini-preview-footer">
                        <div>
                            <span class="views-info"><i class="bi bi-eye"></i> 300</span>
                            <span class="comments-info"><i class="bi bi-chat-left-dots"></i> 5</span>
                        </div>
                        <div class="likes-info">
                            <span id="num-likes">10</span>
                            <i class="bi bi-heart"></i>
                        </div>
                    </div>
                    
                </a>
            </div>

            <div class="news-mini-preview">
                <a href="index.html">
                    <div class="news-mini-preview-image">
                        <img src="assets/images/f69f0ddab5a5bff3e4d39520e1632772.webp" alt="">
                    </div>

                    <div class="news-mini-preview-title">
                        10 regras de ouro para o planejamento estratégico
                    </div>
                    <div class="news-mini-preview-footer">
                        <div>
                            <span class="views-info"><i class="bi bi-eye"></i> 300</span>
                            <span class="comments-info"><i class="bi bi-chat-left-dots"></i> 5</span>
                        </div>
                        <div class="likes-info">
                            <span id="num-likes">10</span>
                            <i class="bi bi-heart"></i>
                        </div>
                    </div>
                    
                </a>
            </div>
        </div>
    </div>
        
</div>
<?php require_once("partials/footer.php");?>