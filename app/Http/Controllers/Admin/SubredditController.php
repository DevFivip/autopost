<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use TomatoPHP\TomatoAdmin\Facade\Tomato;

class SubredditController extends Controller
{
    public string $model;

    public function __construct()
    {
        $this->model = \App\Models\Subreddit::class;
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
            view: 'admin.subreddits.index',
            table: \App\Tables\SubredditTable::class
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
            model: \App\Models\Subreddit::class,
        );
    }

    /**
     * @return View
     */
    public function create(): View
    {
        return Tomato::create(
            view: 'admin.subreddits.create',
        );
    }

    /**
     * @param Request $request
     * @return RedirectResponse|JsonResponse
     */
    public function store(Request $request): RedirectResponse|JsonResponse
    {
        $response = Tomato::store(
            request: $request,
            model: \App\Models\Subreddit::class,
            validation: [
            'name' => 'required|max:255|string',
            'tags' => 'required|max:255|string',
            'verification' => 'required',
            'status' => 'required'
            ],
            message: __('Subreddit updated successfully'),
            redirect: 'admin.subreddits.index',
        );

        if($response instanceof JsonResponse){
            return $response;
        }

        return $response->redirect;
    }

    /**
     * @param \App\Models\Subreddit $model
     * @return View|JsonResponse
     */
    public function show(\App\Models\Subreddit $model): View|JsonResponse
    {
        return Tomato::get(
            model: $model,
            view: 'admin.subreddits.show',
        );
    }

    /**
     * @param \App\Models\Subreddit $model
     * @return View
     */
    public function edit(\App\Models\Subreddit $model): View
    {
        return Tomato::get(
            model: $model,
            view: 'admin.subreddits.edit',
        );
    }

    /**
     * @param Request $request
     * @param \App\Models\Subreddit $model
     * @return RedirectResponse|JsonResponse
     */
    public function update(Request $request, \App\Models\Subreddit $model): RedirectResponse|JsonResponse
    {
        $response = Tomato::update(
            request: $request,
            model: $model,
            validation: [
                            'name' => 'sometimes|max:255|string',
            'tags' => 'sometimes|max:255|string',
            'verification' => 'sometimes',
            'status' => 'sometimes'
            ],
            message: __('Subreddit updated successfully'),
            redirect: 'admin.subreddits.index',
        );

         if($response instanceof JsonResponse){
             return $response;
         }

         return $response->redirect;
    }

    /**
     * @param \App\Models\Subreddit $model
     * @return RedirectResponse|JsonResponse
     */
    public function destroy(\App\Models\Subreddit $model): RedirectResponse|JsonResponse
    {
        $response = Tomato::destroy(
            model: $model,
            message: __('Subreddit deleted successfully'),
            redirect: 'admin.subreddits.index',
        );

        if($response instanceof JsonResponse){
            return $response;
        }

        return $response->redirect;
    }
}
