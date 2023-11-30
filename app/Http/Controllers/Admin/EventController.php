<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use TomatoPHP\TomatoAdmin\Facade\Tomato;

class EventController extends Controller
{
    public string $model;

    public function __construct()
    {
        $this->model = \App\Models\Event::class;
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
            view: 'admin.events.index',
            table: \App\Tables\EventTable::class,
            query: Event::query()->where($query),
        );
    }

    public function schedules(Request $request): View|JsonResponse
    {
        // $query = ['user_id' => auth()->user()->id];

        return view('admin.events.schedule');
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function api(Request $request): JsonResponse
    {
        $data = $request->all();

        $_fechaStart = explode("T", $data['start']);
        $_fechaEnd = explode("T", $data['end']);


        $events = Event::where('user_id',  $data['user_id'])
            ->with(['post', 'customer', 'subreddit'])
            ->where('posted_at', '>', $_fechaStart[0] . ' 00:00:00')
            ->where('posted_at', '<', $_fechaEnd[0] . ' 00:00:00')->get();

        $e = $events->map(function ($event) {
            
            $i = (object)[];
            $i->event_id = $event->id;
            $i->title = $event->subreddit->name ;
            $i->customer = $event->customer->fullname;
            $i->customer_id = $event->customer->id;
            $i->tags = $event->subreddit->tags;
            $i->status = "🕑";
            if ($event->post == null) {
                $i->status = "🕑";
                $i->color = "blue";
                $i->start = $event->posted_at;
            } else {
                switch ($event->post->status) {
                    case 1:
                        $i->status = "📮";
                        $i->color = "orange";
                        break;
                    case 2:
                        $i->status = "✅";
                        $i->color = "green";
                        break;
                    case 0:
                        $i->status = "👎";
                        $i->color = "red";
                        break;
                    default:
                        $i->color = "🤷‍♂️";
                        $i->color = "black";
                        break;
                }
                $i->post_id = $event->post->id;
                $i->start = $event->post->posted_at;
            }


            return $i;
        });


        return response()->json($e);
    }

    /**
     * @return View
     */
    public function create(): View
    {
        return Tomato::create(
            view: 'admin.events.create',
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
            model: \App\Models\Event::class,
            validation: [
                'user_id' => 'required|exists:users,id',
                'customer_id' => 'required|exists:customers,id',
                'subreddit_id' => 'required|exists:subreddits,id',
                'status' => 'required'
            ],
            message: __('Event updated successfully'),
            redirect: 'admin.events.index',
        );

        if ($response instanceof JsonResponse) {
            return $response;
        }

        return $response->redirect;
    }

    /**
     * @param \App\Models\Event $model
     * @return View|JsonResponse
     */
    public function show(\App\Models\Event $model): View|JsonResponse
    {
        return Tomato::get(
            model: $model,
            view: 'admin.events.show',
        );
    }

    /**
     * @param \App\Models\Event $model
     * @return View
     */
    public function edit(\App\Models\Event $model): View
    {
        return Tomato::get(
            model: $model,
            view: 'admin.events.edit',
        );
    }

    /**
     * @param Request $request
     * @param \App\Models\Event $model
     * @return RedirectResponse|JsonResponse
     */
    public function update(Request $request, \App\Models\Event $model): RedirectResponse|JsonResponse
    {
        $response = Tomato::update(
            request: $request,
            model: $model,
            validation: [
                'user_id' => 'sometimes|exists:users,id',
                'customer_id' => 'sometimes|exists:customers,id',
                'subreddit_id' => 'sometimes|exists:subreddits,id',
                'status' => 'sometimes'
            ],
            message: __('Event updated successfully'),
            redirect: 'admin.events.index',
        );

        if ($response instanceof JsonResponse) {
            return $response;
        }

        return $response->redirect;
    }

    /**
     * @param \App\Models\Event $model
     * @return RedirectResponse|JsonResponse
     */
    public function destroy(\App\Models\Event $model): RedirectResponse|JsonResponse
    {
        $response = Tomato::destroy(
            model: $model,
            message: __('Event deleted successfully'),
            redirect: 'admin.events.index',
        );

        if ($response instanceof JsonResponse) {
            return $response;
        }

        return $response->redirect;
    }
}
