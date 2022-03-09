<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use SebastianBergmann\Environment\Console;
use Illuminate\Http\Request;


class Post extends Model
{
    use HasFactory;

    use Sluggable;

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }


    protected $fillable = ['title', 'description', 'content', 'category_id', 'thumbnail'];

    public function category(){ // Category(post1, post2, ....)
        return $this->belongsTo(Category::class);
    }

    public function tags() { // many to many
        return $this->belongsToMany(Tag::class)->withTimestamps(); //генерируем created at и updated at
    }

    public function comments() {
        return $this->hasMany(Comment::class); // one to many
    }

    public function getImage()
    {
        if (!$this->thumbnail) {
            return asset("no-image.jpg");
        }
        return asset("storage/{$this->thumbnail}");
    }

    public function getPostDate(){
        /*$formatter = new \IntlDateFormatter('ru-RU', \IntlDateFormatter::FULL, \IntlDateFormatter::FULL);
        $formatter->setPattern('d MMM y');
        return $formatter->format(new \DateTime($this->created_at));*/
        return \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $this->created_at)->format('d F, Y');
    }

    public static function uploadImage(Request $request, $image = null) {

        if ($request->hasFile('thumbnail')) {
            if ($image) {
                Storage::delete($image);
            }
            $folder = date('Y-m-d'); //храним файл в папке с текущей датой
            return $request->file('thumbnail')->store("images/{$folder}"); //{$folder}
        }
        return null;
    }

    public function scopeLike($query, $s) {
        return $query->where('title', 'LIKE', "%{$s}%"); // %% - ищем по вхождению букв в строке
    }
}
