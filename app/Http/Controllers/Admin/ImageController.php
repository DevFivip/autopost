<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Image;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use TomatoPHP\TomatoAdmin\Facade\Tomato;

class ImageController extends Controller
{
    public string $model;

    public function __construct()
    {
        $this->model = \App\Models\Image::class;
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
            view: 'admin.images.index',
            table: \App\Tables\ImageTable::class
        );
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function api2(Request $request): JsonResponse
    {
        $query = $request->all();
        error_log(json_encode($query));
        return Tomato::json(
            request: $request,
            model: \App\Models\Image::class,
            query: Image::query()->where($query)->each(function ($i) {
                return $i->getFirstMedia()->getUrl('thumb');
            }),
        );
    }
    public function api(Request $request): JsonResponse
    {
        $query = $request->all();
        error_log(json_encode($query));
        $imgs = Image::where($query)->get();
        $imgs->each(function ($i) {
            $i->thum = $i->getFirstMedia('medias')->getUrl('preview');
            return $i;
        });
        return response()->json($imgs);
    }

    /**
     * @return View
     */
    public function create(): View
    {
        return Tomato::create(
            view: 'admin.images.create',
        );
    }

    /**
     * @param Request $request
     * @return RedirectResponse|JsonResponse
     */
    public function store(Request $request): RedirectResponse|JsonResponse
    {
        $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'mediafiles.*' => 'required|file|mimes:jpeg,png,gif,webp,mp4,avi,mov,wmv|max:20480',
        ]);

        foreach ($request->file('mediafiles') as $archivo) {
            $mediaFile = new Image();
            $mediaFile->customer_id = $request->input('customer_id');
            $mediaFile->name = $archivo->getClientOriginalName();
            $mediaFile->tags = " ";
            $mediaFile->save();
            $mediaFile->addMedia($archivo)->toMediaCollection('medias');
        }
        return to_route('admin.images.index', ['message' => 'Image updated successfully']);
    }

    /**
     * @param \App\Models\Image $model
     * @return View|JsonResponse
     */
    public function show(\App\Models\Image $model): View|JsonResponse
    {
        return Tomato::get(
            model: $model,
            view: 'admin.images.show',
        );
    }

    /**
     * @param \App\Models\Image $model
     * @return View
     */
    public function edit(\App\Models\Image $model): View
    {
        return Tomato::get(
            model: $model,
            view: 'admin.images.edit',
        );
    }

    /**
     * @param Request $request
     * @param \App\Models\Image $model
     * @return RedirectResponse|JsonResponse
     */
    public function update(Request $request, \App\Models\Image $model): RedirectResponse|JsonResponse
    {
        $response = Tomato::update(
            request: $request,
            model: $model,
            validation: [
                'customer_id' => 'sometimes|exists:customers,id',
                'name' => 'sometimes|max:255|string'
            ],
            message: __('Image updated successfully'),
            redirect: 'admin.images.index',
        );

        if ($response instanceof JsonResponse) {
            return $response;
        }

        return $response->redirect;
    }

    /**
     * @param \App\Models\Image $model
     * @return RedirectResponse|JsonResponse
     */
    public function destroy(\App\Models\Image $model): RedirectResponse|JsonResponse
    {
        $response = Tomato::destroy(
            model: $model,
            message: __('Image deleted successfully'),
            redirect: 'admin.images.index',
        );

        if ($response instanceof JsonResponse) {
            return $response;
        }

        return $response->redirect;
    }


    /**
     * @param \App\Models\Image $model
     * @return View
     */
    public function search()
    {
        return view('admin.images.modal');
        // return response()->json(["msg"=>"hola"]);
    }
}
