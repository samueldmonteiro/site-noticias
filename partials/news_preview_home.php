<div class="news-preview-home">
    <div class="news-preview-home-image">
        <img src="<?=$base?>media/news/<?=$newsItemPreviewHome->cover?>" alt="">
    </div>
    <div class="news-preview-home-content">
        <div class="news-preview-home-head">
            <div class="info-from-news">
                <img src="<?=$base?>media/users/<?=$newsItemPreviewHome->user->getImage()?>" alt="" class="image-user me-2">
                <div>
                    <div class="username"><?=$newsItemPreviewHome->user->name?></div>
                    <div class="info-datetime"><?=$newsItemPreviewHome->getFormattedDate()?><span class="info-time ms-2"><?=$newsItemPreviewHome->getTimeItWasCreated()?></span></div>
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

        <div class="news-preview-home-body">
            <a href="<?=$base?>news.php?news_id=<?=$newsItemPreviewHome->id?>" class="news-title"><?=$newsItemPreviewHome->title?></a>

            <p class="news-subject"><?=$newsItemPreviewHome->subject?></p>
        </div>

        <div class="news-preview-home-footer">
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