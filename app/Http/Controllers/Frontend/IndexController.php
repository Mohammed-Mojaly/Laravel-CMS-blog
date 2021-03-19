<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use App\Models\Contact;
use App\Models\Tag;
use App\Models\User;
use App\Notifications\NewCommentForPostOwnerNotify;
use App\Notifications\NewCommentForAdminNotify;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Stevebauman\Purify\Facades\Purify;

class IndexController extends Controller
{
    public function index()
    {
        $posts = Post::with(['media', 'user' , 'tags'])
            ->whereHas('category', function ($query) {
                $query->whereStatus(1);
            })
            ->whereHas('user', function ($query) {
                $query->whereStatus(1);
            })
            ->post()->active()->orderBy('id', 'desc')->paginate(6);

        return view('frontend.index', compact('posts'));
    }

    public function search(Request $request)
    {
        $Keyword = isset($request->Keyword) && $request->Keyword != '' ? $request->Keyword : null;

        $posts = Post::with(['media', 'user','tags'])
            ->whereHas('category', function ($query) {
                $query->whereStatus(1);
            })
            ->whereHas('user', function ($query) {
                $query->whereStatus(1);
            });

        if ($Keyword != null) {
            $posts = $posts->search($Keyword, null, true);
        }

        $posts = $posts->post()->active()->orderBy('id', 'desc')->paginate(5);
        return view('frontend.index', compact('posts'));
    }

    public function post_show($slug)
    {
        $post = Post::with([
            'category', 'media', 'user','tags',
            'approved_comment' => function ($query) {
                $query->orderBy('id', 'desc');
            }
        ]);

        $post = $post->whereHas('category', function ($query) {
            $query->whereStatus(1);
        })
            ->whereHas('user', function ($query) {
                $query->whereStatus(1);
            })
            ->wherePostType('post')->whereStatus(1)->first();

        $post = $post->whereSlug($slug);
        $post = $post->active()->first();

        if ($post) {

            $blade = $post->post_type == 'post' ? 'post' : 'page';

            return view('frontend.' . $blade, compact('post'));
        } else {
            return redirect()->route('frontend.index');
        }
    }


    public function store_comment(Request $request, $slug)
    {
        // dd($request->all(),$slug);

        $validation = Validator::make($request->all(), [

            'name'       => 'required',
            'email'      => 'required|email',
            'url'        => 'nullable|url',
            'comment'    => 'required|min:10',
        ]);
        if ($validation->fails()) {
            return redirect()->back()->withErrors($validation)->withInput();
        }

        $post = Post::whereSlug($slug)->wherePostType('post')->whereStatus(1)->first();

        if ($post) {

            $userid = auth()->check() ? auth()->id() : null;

            $data['name']         = $request->name;
            $data['email']        = $request->email;
            $data['url']          = $request->url;
            $data['ip_address']   = $request->ip();
            $data['comment']      = Purify::clean($request->comment);
            $data['post_id']      = $post->id;
            $data['user_id']      = $userid;

            $comment =  $post->comment()->create($data);

            if ($comment) {

                if (auth()->guest() || auth()->id() != $post->user_id) {
                    $post->user->notify(new NewCommentForPostOwnerNotify($comment));
                }

                User::whereHas('roles', function ($query) {
                    $query->whereIn('name', ['admin', 'editor']);
                })->each(function ($admin, $key) use ($comment) {
                    $admin->notify(new NewCommentForAdminNotify($comment));
                });
            }


            return redirect()->back()->with([
                'message' => 'Comment added successfuly',
                'alert-type' => 'success'
            ]);

            return redirect()->back()->with([
                'message' => 'Erorr',
                'alert-type' => 'danger'
            ]);
        }
    }

    public  function contact()
    {
        return view('frontend.contact');
    }

    public  function do_contact(Request $request)
    {
        $validation = Validator::make($request->all(), [

            'name'       => 'required',
            'email'      => 'required|email',
            'mobile'     => 'nullable|numeric',
            'title'      => 'required|min:5',
            'message'    => 'required|min:10',
        ]);
        if ($validation->fails()) {
            return redirect()->back()->withErrors($validation)->withInput();
        }

        $data['name']        =  $request->name;
        $data['email']       =  $request->email;
        $data['mobile']      =  $request->mobile;
        $data['title']       =  $request->title;
        $data['message']     =  $request->message;

        Contact::create($data);

        return redirect()->back()->with([
            'message' => 'Message sent successfuly',
            'alert-type' => 'success'
        ]);
    }

    public function tag($slug)
    {
        $tag = Tag::whereSlug($slug)->orWhere('id', $slug)->first()->id;

        if ($tag) {
            $posts = Post::with(['media', 'user' , 'tags'])

                ->whereHas('tags' , function($query) use ($slug){
                    $query->where('slug' , $slug);
                })
                ->post()
                ->active()
                ->orderBy('id', 'desc')
                ->paginate(5);

            return view('frontend.index', compact('posts'));
        }

        return redirect()->route('frontend.index');
    }
    public function category($slug)
    {
        $category = Category::whereSlug($slug)->orWhere('id', $slug)->whereStatus(1)->first()->id;

        if ($category) {
            $posts = Post::with(['media', 'user' , 'tags'])

                ->whereCategoryId($category)
                ->post()
                ->active()
                ->orderBy('id', 'desc')
                ->paginate(5);

            return view('frontend.index', compact('posts'));
        }

        return redirect()->route('frontend.index');
    }

    public function archive($date)
    {
        $explode_date = explode('-', $date);

        $month = $explode_date[0];
        $year = $explode_date[1];

        $posts =  Post::with(['media', 'user', 'category','tags'])
            ->withCount('approved_comment')
            ->whereMonth('created_at', $month)
            ->whereYear('created_at', $year)
            ->wherePostType('post')
            ->whereStatus(1)
            ->orderBy('id', 'desc')
            ->paginate(5);

        return view('frontend.index', compact('posts'));
    }

    public function author($username)
    {
        $user = User::whereUsername($username)->whereStatus(1)->first()->id;

        if ($user) {
            $posts = Post::with(['media', 'user','tags'])

                ->whereUserId($user)
                ->post()
                ->active()
                ->orderBy('id', 'desc')
                ->paginate(5);

            return view('frontend.index', compact('posts'));
        }

        return redirect()->route('frontend.index');
    }
}
