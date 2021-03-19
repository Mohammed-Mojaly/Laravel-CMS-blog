<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\Comment;
use App\Models\Permission;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        if (!request()->is('admin/*')) {
            Paginator::defaultView('vendor.pagination.boighor');

            view()->composer('*', function ($view) {

                //////////// Get recent Posts  //////////

                if (!Cache::has('recent_posts')) {

                    $recent_posts = Post::with(['category', 'media', 'user'])
                        ->whereHas('category', function ($query) {
                            $query->whereStatus(1);
                        })
                        ->whereHas('user', function ($query) {
                            $query->whereStatus(1);
                        })
                        ->wherePostType('post')->whereStatus(1)->orderBy('id', 'desc')->limit(5)->get();

                    Cache::remember('recent_posts', 3600, function () use ($recent_posts) {
                        return $recent_posts;
                    });
                }
                $recent_posts = Cache::get('recent_posts');

                //////////// End  get recent Posts  //////////



                //////////// get recent comments  //////////

                if (!Cache::has('recent_comments')) {

                    $recent_comments = Comment::whereStatus(1)->orderBy('id', 'desc')->limit(5)->get();

                    Cache::remember('recent_comments', 3600, function () use ($recent_comments) {
                        return $recent_comments;
                    });
                }
                $recent_comments = Cache::get('recent_comments');

                //////////// End get recent comments  //////////




                //////////// get categories  //////////

                if (!Cache::has('categories')) {

                    $categories = Category::whereStatus(1)->orderBy('id', 'desc')->limit(5)->get();

                    Cache::remember('categories', 3600, function () use ($categories) {
                        return $categories;
                    });
                }
                $categories = Cache::get('categories');

                //////////// End get categoriess  //////////


                //////////// get Tags  //////////

                if (!Cache::has('tags')) {

                    $tags = Tag::withCount('posts')->get();

                    Cache::remember('tags', 3600, function () use ($tags) {
                        return $tags;
                    });
                }
                $tags = Cache::get('tags');

                //////////// End get Tags  //////////



                //////////// get ARCHIVES  //////////

                if (!Cache::has('archives')) {

                    $archives = Post::whereStatus(1)->orderBy('created_at', 'desc')
                        ->select(DB::raw("Year(created_at) as year"), DB::raw('Month(created_at) as month'))
                        ->pluck('year', 'month')->toArray();

                    Cache::remember('archives', 3600, function () use ($archives) {
                        return $archives;
                    });
                }
                $archives = Cache::get('archives');

                //////////// End get ARCHIVES  //////////




                $view->with([
                    'recent_posts' => $recent_posts,
                    'recent_comments' => $recent_comments,
                    'categories' => $categories,
                    'archives' => $archives,
                    'tags' => $tags,
                ]);
            });
        }

        // cache for admin
        if (request()->is('admin/*')) {

            view()->composer('*', function ($view) {

                if (!Cache::has('admin_side_menu')) {
                    Cache::forever('admin_side_menu', Permission::tree());
                }
                $admin_side_menu = Cache::get('admin_side_menu');

                $view->with([
                    'admin_side_menu' => $admin_side_menu,
                ]);

            });
        }
    }
}
