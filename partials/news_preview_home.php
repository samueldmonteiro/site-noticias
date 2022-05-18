<div class="news-item-action news-preview-home" data-id="<?=$newsItemPreviewHome->id?>">
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
                    <?php if($auth->isAdmin($userInfo)):?>
                        <li><a class="dropdown-item" href="<?=$base?>news_update.php?news_id=<?=$newsItemPreviewHome->id?>"><i class="bi bi-pen"></i> Editar</a></li>
                        <li><a class="dropdown-item" href="#"><i class="bi bi-trash3"></i> Deletar</a></li>
                    <?php endif?>
                </ul>
            </div>
        </div>

        <div class="news-preview-home-body">
            <a href="<?=$base?>news.php?news_id=<?=$newsItemPreviewHome->id?>" class="news-title"><?=$newsItemPreviewHome->title?></a>

            <p class="news-subject"><?=$newsItemPreviewHome->subject?></p>
        </div>

        <div class="news-preview-home-footer">
            <div>
                <span class="views-info"><?=$newsItemPreviewHome->views?> visualizações</span>
                <span class="comments-info"><?=$newsItemPreviewHome->countComments?> comentários</span>
            </div>
            <div class="likes-info" id="news-like">
                <span id="num-likes"><?=$newsItemPreviewHome->countLikes?></span>
               
                <?php if($newsItemPreviewHome->isLiked):?>
                    <i class="bi bi-heart-fill"></i>
                <?php else:?>
                    <i class="bi bi-heart"></i>
                <?php endif?>
            </div>
        </div>
    </div>
</div>