<div class="news-mini-preview">
    <a href="<?=$base?>news.php?news_id=<?=$newsMiniPreview->id?>">
        <div class="news-mini-preview-image">
            <img src="<?=$base?>media/news/<?=$newsMiniPreview->cover?>" alt="">
        </div>

        <div class="news-mini-preview-title">
            <?=$newsMiniPreview->title?>
        </div>
        <div class="news-mini-preview-footer">
            <div>
                <span class="views-info"><i class="bi bi-eye"></i> 100</span>
                <span class="comments-info"><i class="bi bi-chat-left-dots"></i> <?=$newsMiniPreview->countComments?></span>
            </div>
            <div class="likes-info">
                <span id="num-likes"><?=$newsMiniPreview->countLikes?></span>
                <?php if($newsMiniPreview->isLiked):?>
                    <i class="bi bi-heart-fill"></i>
                <?php else:?>
                    <i class="bi bi-heart"></i>
                <?php endif?>
            </div>
        </div>
        
    </a>
</div>