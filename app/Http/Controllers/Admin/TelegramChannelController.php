<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use TomatoPHP\TomatoAdmin\Facade\Tomato;

class TelegramChannelController extends Controller
{
    public string $model;

    public function __construct()
    {
        $this->model = \App\Models\TelegramChannel::class;
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
            view: 'admin.telegram-channels.index',
            table: \App\Tables\TelegramChannelTable::class
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
            model: \App\Models\TelegramChannel::class,
        );
    }

    /**
     * @return View
     */
    public function create(): View
    {
        return Tomato::create(
            view: 'admin.telegram-channels.create',
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
            model: \App\Models\TelegramChannel::class,
            validation: [
            'user_id' => 'required|exists:users,id',
            'customer_id' => 'required|exists:customers,id',
            'name' => 'required|max:255|string',
            'status' => 'required'
            ],
            message: __('TelegramChannel updated successfully'),
            redirect: 'admin.telegram-channels.index',
        );

        if($response instanceof JsonResponse){
            return $response;
        }

        return $response->redirect;
    }

    /**
     * @param \App\Models\TelegramChannel $model
     * @return View|JsonResponse
     */
    public function show(\App\Models\TelegramChannel $model): View|JsonResponse
    {
        return Tomato::get(
            model: $model,
            view: 'admin.telegram-channels.show',
        );
    }

    /**
     * @param \App\Models\TelegramChannel $model
     * @return View
     */
    public function edit(\App\Models\TelegramChannel $model): View
    {
        return Tomato::get(
            model: $model,
            view: 'admin.telegram-channels.edit',
        );
    }

    /**
     * @param Request $request
     * @param \App\Models\TelegramChannel $model
     * @return RedirectResponse|JsonResponse
     */
    public function update(Request $request, \App\Models\TelegramChannel $model): RedirectResponse|JsonResponse
    {
        $response = Tomato::update(
            request: $request,
            model: $model,
            validation: [
            'user_id' => 'required|exists:users,id',
            'customer_id' => 'sometimes|exists:customers,id',
            'name' => 'sometimes|max:255|string',
            'status' => 'sometimes'
            ],
            message: __('TelegramChannel updated successfully'),
            redirect: 'admin.telegram-channels.index',
        );

         if($response instanceof JsonResponse){
             return $response;
         }

         return $response->redirect;
    }

    /**
     * @param \App\Models\TelegramChannel $model
     * @return RedirectResponse|JsonResponse
     */
    public function destroy(\App\Models\TelegramChannel $model): RedirectResponse|JsonResponse
    {
        $response = Tomato::destroy(
            model: $model,
            message: __('TelegramChannel deleted successfully'),
            redirect: 'admin.telegram-channels.index',
        );

        if($response instanceof JsonResponse){
            return $response;
        }

        return $response->redirect;
    }
}
