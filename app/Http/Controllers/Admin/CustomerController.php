<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use TomatoPHP\TomatoAdmin\Facade\Tomato;

class CustomerController extends Controller
{
    public string $model;

    public function __construct()
    {
        $this->model = \App\Models\Customer::class;
    }

    /**
     * @param Request $request
     * @return View|JsonResponse
     */
    public function index(Request $request): View|JsonResponse
    {
        $query = ['user_id' => auth()->user()->id];

        return Tomato::index(
            request: $request,
            model: $this->model,
            view: 'admin.customers.index',
            table: \App\Tables\CustomerTable::class,
            query:Customer::query()->where($query),
        );
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function api(Request $request): JsonResponse
    {
        $query = $request->all();
        return Tomato::json(
            request: $request,
            model: \App\Models\Customer::class,
            query:Customer::query()->where($query),
        );
    }

    /**
     * @return View
     */
    public function create(): View
    {
        $auth_id = Auth()->user()->id;
        $model = ['user_id'=>$auth_id];
        return Tomato::create(
            view: 'admin.customers.create'
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
            model: \App\Models\Customer::class,
            validation: [
                            'user_id' => 'required|exists:users,id',
            'fullname' => 'required|max:255|string',
            'email' => 'nullable|max:255|string|email',
            'reddit_username' => 'nullable|max:255|string',
            'reddit_password' => 'nullable|max:255|confirmed|min:6',
            'reddit_clientId' => 'nullable|max:255|string',
            'reddit_clientSecret' => 'nullable|max:255|string',
            'imgur_username' => 'nullable|max:255|string',
            'imgur_password' => 'nullable|max:255|confirmed|min:6',
            'imgur_clientId' => 'nullable|max:255|string',
            'imgur_clientSecret' => 'nullable|max:255|string',
            'telegram_channel' => 'nullable|max:255|min:2',
            'tags' => 'nullable|max:255|string',
            'status' => 'required'
            ],
            message: __('Customer updated successfully'),
            redirect: 'admin.customers.index',
        );

        if($response instanceof JsonResponse){
            return $response;
        }

        return $response->redirect;
    }

    /**
     * @param \App\Models\Customer $model
     * @return View|JsonResponse
     */
    public function show(\App\Models\Customer $model): View|JsonResponse
    {
        return Tomato::get(
            model: $model,
            view: 'admin.customers.show',
        );
    }

    /**
     * @param \App\Models\Customer $model
     * @return View
     */
    public function edit(\App\Models\Customer $model): View
    {
        return Tomato::get(
            model: $model,
            view: 'admin.customers.edit',
        );
    }

    /**
     * @param \App\Models\Customer $model
     * @return View
     */
    public function assingsubreddit(\App\Models\Customer $model): View
    {
        return Tomato::get(
            model: $model,
            view: 'admin.customers.assingsubreddit',
        );
    }

    /**
     * @param Request $request
     * @param \App\Models\Customer $model
     * @return RedirectResponse|JsonResponse
     */
    public function update(Request $request, \App\Models\Customer $model): RedirectResponse|JsonResponse
    {
        $response = Tomato::update(
            request: $request,
            model: $model,
            validation: [
            'user_id' => 'sometimes|exists:users,id',
            'fullname' => 'sometimes|max:255|string',
            'email' => 'nullable|max:255|string|email',
            'reddit_username' => 'nullable|max:255|string',
            'reddit_password' => 'nullable|max:255|confirmed|min:6',
            'reddit_clientId' => 'nullable|max:255|string',
            'reddit_clientSecret' => 'nullable|max:255|string',
            'imgur_username' => 'nullable|max:255|string',
            'imgur_password' => 'nullable|max:255|confirmed|min:6',
            'imgur_clientId' => 'nullable|max:255|string',
            'imgur_clientSecret' => 'nullable|max:255|string',
            'telegram_channel' => 'nullable|max:255|min:2',
            'tags' => 'nullable|max:255|string',
            'status' => 'sometimes'
            ],
            message: __('Customer updated successfully'),
            redirect: 'admin.customers.index',
        );

         if($response instanceof JsonResponse){
             return $response;
         }

         return $response->redirect;
    }

    /**
     * @param \App\Models\Customer $model
     * @return RedirectResponse|JsonResponse
     */
    public function destroy(\App\Models\Customer $model): RedirectResponse|JsonResponse
    {
        $response = Tomato::destroy(
            model: $model,
            message: __('Customer deleted successfully'),
            redirect: 'admin.customers.index',
        );

        if($response instanceof JsonResponse){
            return $response;
        }

        return $response->redirect;
    }
}
