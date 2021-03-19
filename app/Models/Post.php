<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Nicolaslopezj\Searchable\SearchableTrait;

class Post extends Model
{

    use Sluggable;
    use SearchableTrait;

    protected $guarded = [];
    // protected $fillable = [

    //     'title',
    //     'slug',
    //     'description',
    //     'status',
    //     'post_type',
    //     'post',
    //     'comment_able',
    //     'user_id',
    //     'category_id'  ,

    // ];

    protected $searchable = [

        'columns'  => [
            'posts.title'       => 10,
            'posts.description' => 10,
        ],
    ];

    public function sluggable(): array
    {

        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function tags()
    {
        return $this->belongsToMany(Tag::class , 'posts_tags');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function comment()
    {
        return $this->hasMany(Comment::class);
    }
    public function approved_comment()
    {
        return $this->hasMany(Comment::class)->whereStatus(1);
    }

    public function media()
    {
        return $this->hasMany(PostMedia::class);
    }

    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }
    public function scopePost($query)
    {
        return $query->where('post_type', 'post');
    }

    public function status()
    {
        return $this->status == 1 ? 'Active' : 'Inactive';
    }

}
