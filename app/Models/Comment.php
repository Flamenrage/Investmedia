<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = ['content', 'user_id', 'post_id'];

    public function getCommentDate(){
        $formatter = new \IntlDateFormatter('ru-RU', \IntlDateFormatter::FULL, \IntlDateFormatter::FULL);
        $formatter->setPattern('d MMM y');
        return $formatter->format(new \DateTime($this->created_at));
    }

    public function user(){ // Post(comment1, comment2, ....)
        return $this->belongsTo(User::class);
    }

    public function post(){ // Post(comment1, comment2, ....)
        return $this->belongsTo(Post::class);
    }
}
