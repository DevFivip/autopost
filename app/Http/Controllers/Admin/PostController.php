<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Post;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use TomatoPHP\TomatoAdmin\Facade\Tomato;

class PostController extends Controller
{
    public string $model;

    public function __construct()
    {
        $this->model = \App\Models\Post::class;
    }

    /**
     * @param Request $request
     * @return View|JsonResponse
     */
    public function index(Request $request): View|JsonResponse
    {
        return Tomato::index(
            request: $request,
            model: $this->model,
            view: 'admin.posts.index',
            table: \App\Tables\PostTable::class
        );
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function api(Request $request): JsonResponse
    {
        return Tomato::json(
            request: $request,
            model: \App\Models\Post::class,
        );
    }

    /**
     * @return View
     */
    public function create(): View
    {
        return Tomato::create(
            view: 'admin.posts.create',
        );
    }

    /**
     * @param Request $request
     * @return RedirectResponse|JsonResponse
     */
    public function store(Request $request): RedirectResponse|JsonResponse
    {

        $request->validate([
            'user_id' => 'required|exists:users,id',
            'customer_id' => 'required|exists:customers,id',
            'subreddit_id' => 'nullable|exists:subreddits,id',
            'telegram_channel_id' => 'nullable|exists:telegram_channels,id',
            'post_type_id' => 'required|exists:post_types,id',
            'title' => 'required|max:255|string',
            'description' => 'nullable|max:255|string',
            'link' => 'nullable|max:255|string',
            'local_media_file' => 'nullable|max:255|string'
        ]);

        $data = $request->all();

        foreach ($data['submition_schedule'] as $schedule) {

            $post = Post::create([
                'title' => $data['title'],
                'description' => $data['description'] ?? null,
                'link' => $data['link'] ?? null,
                'local_media_file' => $data['local_media_file'] ?? null,
                'user_id' => $data['user_id'],
                'customer_id' => $data['customer_id'],
                'subreddit_id' => $schedule['subreddit_id'] ?? null,
                'telegram_channel_id' => $schedule['telegram_channel_id'] ?? null,
                'post_type_id' => $data['post_type_id'],
                'posted_at' => $schedule['posted_at'],
            ]);

            if (!!$schedule['subreddit_id']) {

                $_fecha = explode(" ", $post->posted_at);
                $fecha = $_fecha[0];


                $event = Event::where('user_id', $post->user_id)
                    ->where('subreddit_id', $post->subreddit_id)
                    ->where('customer_id', $post->customer_id)
                    ->where('posted_at', '>', $fecha . ' 00:00:00')
                    ->where('posted_at', '<', $fecha . ' 23:59:00')
                    ->first();

                if ($event) {
                    $event->post_id = $post->id;
                    $event->save();
                }
            }
        }
        // return response()->json($data);

        return to_route('admin.posts.index');


        // if($response instanceof JsonResponse){
        //     return $response;
        // }

        // return $response->redirect;
    }

    /**
     * @param \App\Models\Post $model
     * @return View|JsonResponse
     */
    public function show(\App\Models\Post $model): View|JsonResponse
    {
        return Tomato::get(
            model: $model,
            view: 'admin.posts.show',
        );
    }

    /**
     * @param \App\Models\Post $model
     * @return View
     */
    public function edit(\App\Models\Post $model): View
    {
        return Tomato::get(
            model: $model,
            view: 'admin.posts.edit',
        );
    }

    /**
     * @param Request $request
     * @param \App\Models\Post $model
     * @return RedirectResponse|JsonResponse
     */
    public function update(Request $request, \App\Models\Post $model): RedirectResponse|JsonResponse
    {
        $response = Tomato::update(
            request: $request,
            model: $model,
            validation: [
                'user_id' => 'sometimes|exists:users,id',
                'customer_id' => 'sometimes|exists:customers,id',
                'subreddit_id' => 'nullable|exists:subreddits,id',
                'telegram_channel_id' => 'nullable|exists:telegram_channels,id',
                'post_type_id' => 'sometimes|exists:post_types,id',
                'title' => 'sometimes|max:255|string',
                'description' => 'sometimes|max:255|string',
                'link' => 'sometimes|max:255|string',
                'local_media_file' => 'sometimes|max:255|string'
            ],
            message: __('Post updated successfully'),
            redirect: 'admin.posts.index',
        );

        if ($response instanceof JsonResponse) {
            return $response;
        }

        return $response->redirect;
    }

    /**
     * @param \App\Models\Post $model
     * @return RedirectResponse|JsonResponse
     */
    public function destroy(\App\Models\Post $model): RedirectResponse|JsonResponse
    {
        
        $event = Event::where('post_id', $model->id)->first();

        if ($event) {
            $event->post_id = null;
            $event->save();
        }



        $response = Tomato::destroy(
            model: $model,
            message: __('Post deleted successfully'),
            redirect: 'admin.posts.index',
        );

        if ($response instanceof JsonResponse) {
            return $response;
        }

        return $response->redirect;
    }
}
