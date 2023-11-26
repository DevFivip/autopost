<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use TomatoPHP\TomatoAdmin\Facade\Tomato;

class CustomerSubredditController extends Controller
{
    public string $model;

    public function __construct()
    {
        $this->model = \App\Models\CustomerSubreddit::class;
    }

    /**
     * @param Request $request
     * @return View|JsonResponse
     */
    public function index(Request $request): View|JsonResponse
    {
        // return response()->json($this->model);
        return Tomato::index(
            request: $request,
            model: $this->model,
            view: 'admin.customer-subreddits.index',
            table: \App\Tables\CustomerSubredditTable::class
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
            model: \App\Models\CustomerSubreddit::class,
        );
    }

    /**
     * @return View
     */
    public function create(): View
    {
        return Tomato::create(
            view: 'admin.customer-subreddits.create',
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
            model: \App\Models\CustomerSubreddit::class,
            validation: [
                'customer_id' => 'required|exists:customers,id',
            'subreddit_id' => 'required|exists:subreddits,id'
            ],
            message: __('CustomerSubreddit updated successfully'),
            redirect: 'admin.customer-subreddits.index',
        );

        if($response instanceof JsonResponse){
            return $response;
        }

        return $response->redirect;
    }

    /**
     * @param \App\Models\CustomerSubreddit $model
     * @return View|JsonResponse
     */
    public function show(\App\Models\CustomerSubreddit $model): View|JsonResponse
    {
        return Tomato::get(
            model: $model,
            view: 'admin.customer-subreddits.show',
        );
    }

    /**
     * @param \App\Models\CustomerSubreddit $model
     * @return View
     */
    public function edit(\App\Models\CustomerSubreddit $model): View
    {
        return Tomato::get(
            model: $model,
            view: 'admin.customer-subreddits.edit',
        );
    }

    /**
     * @param Request $request
     * @param \App\Models\CustomerSubreddit $model
     * @return RedirectResponse|JsonResponse
     */
    public function update(Request $request, \App\Models\CustomerSubreddit $model): RedirectResponse|JsonResponse
    {
        $response = Tomato::update(
            request: $request,
            model: $model,
            validation: [
                'customer_id' => 'sometimes|exists:customers,id',
            'subreddit_id' => 'sometimes|exists:subreddits,id'
            ],
            message: __('CustomerSubreddit updated successfully'),
            redirect: 'admin.customer-subreddits.index',
        );

         if($response instanceof JsonResponse){
             return $response;
         }

         return $response->redirect;
    }

    /**
     * @param \App\Models\CustomerSubreddit $model
     * @return RedirectResponse|JsonResponse
     */
    public function destroy(\App\Models\CustomerSubreddit $model): RedirectResponse|JsonResponse
    {
        $response = Tomato::destroy(
            model: $model,
            message: __('CustomerSubreddit deleted successfully'),
            redirect: 'admin.customer-subreddits.index',
        );

        if($response instanceof JsonResponse){
            return $response;
        }

        return $response->redirect;
    }
}
