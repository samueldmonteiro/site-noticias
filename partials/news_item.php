<script src="https://cdn.ckeditor.com/4.18.0/standard/ckeditor.js"></script>

<textarea name="editor1"></textarea>
<script>
        CKEDITOR.replace( 'editor1' );
</script>

<div class="news-item" data-id="<?=$newsItem->id?>">
    <div class="news-item-head">
        <div class="info-from-news">
            <img src="<?=$base?>media/users/<?=$newsItem->user->image?>" alt="" class="image-user me-2">
            <div>
                <div class="username"><?=$newsItem->user->name?></div>
                <div class="info-datetime"><?=$newsItem->getFormattedDate()?><span class="info-time ms-2"><?=$newsItem->getTimeItWasCreated()?></span></div>
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
        <p class="news-item-title"><?=$newsItem->title?></p>
        <p class="news-item-subject"><?=$newsItem->subject?></p>

        <div class="news-item-image">
            <img src="<?=$base?>media/news/<?=$newsItem->cover?>" alt="">
        </div>

        <div class="news-item-content mt-4 mb-4">
            
        </div>

        <div class="news-item-footer">
            <div>
                <span class="views-info">300 visualizações</span>
                <span class="comments-info">3 comentários</span>
            </div>
            <div class="likes-info">
                <span id="num-likes"><?=$newsItem->countLikes?></span>
                <i class="bi bi-heart"></i>
            </div>
        </div>
    </div>
</div>

<script src="<?=$base?>assets/js/newsBody.js"></script>
