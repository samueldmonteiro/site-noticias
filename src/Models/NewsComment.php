<?php

namespace Src\Models;

class NewsComment{
    public $id;
    public $id_user;
    public $id_news;
    public $body;
    public $created_at;

    public function getBody(){
        return nl2br(html_entity_decode($this->body));
    }
}

