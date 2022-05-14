<div class="news-mini-preview">
    <a href="index.html">
        <div class="news-mini-preview-image">
            <img src="<?=$base?>media/news/<?=$newsMiniPreview->cover?>" alt="">
        </div>

        <div class="news-mini-preview-title">
            <?=$newsMiniPreview->title?>
        </div>
        <div class="news-mini-preview-footer">
            <div>
                <span class="views-info"><i class="bi bi-eye"></i> 300</span>
                <span class="comments-info"><i class="bi bi-chat-left-dots"></i> 5</span>
            </div>
            <div class="likes-info">
                <span id="num-likes"><?=$newsMiniPreview->countLikes?></span>
                <i class="bi bi-heart"></i>
            </div>
        </div>
        
    </a>
</div>