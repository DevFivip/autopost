<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CustomerSubreddit;
use App\Models\Event;
use DateTime;
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

            $fecha = new DateTime($event->updated_at);
            // Fecha y hora actuales
            $fechaActual = new DateTime();
            // error_log(json_encode($event));
            // error_log(json_encode($fechaActual));

            // Diferencia en minutos entre las dos fechas
            $intervalo = $fechaActual->diff($fecha);
            $minutosDiferencia = $intervalo->i;
            $isnew = "";
            // Verificar si la diferencia es menor a 5 minutos
            if ($minutosDiferencia < 3) {
                $isnew = "🔥";
            }
            // error_log($minutosDiferencia);

            $i->event_id = $event->id;
            $i->title = $event->subreddit->name . " " . $isnew;
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



    public function monthlyschedules()
    {

        $countries = [
            'be' => 'Belgium',
            'nl' => 'The Netherlands',
        ];
        return view('admin.events.monthlyschedules', compact('countries'));
    }

    public function monthlystore(Request $request)
    {
        $data = $request->all();
        $_fecha = explode(' to ', $data['scheduled_period']);
        $fechaInicioObj = new DateTime($_fecha[0]);
        $fechaFinObj = new DateTime($_fecha[1]);
        $posts_per_day = $data['posts_per_day'];
        $customer_id = $data['customer_id'];



        /// make reddi schedules
        if ($data['platform'] == "1") {
            $getDateSubreddit =  $this->makeShuffleCalendar($fechaInicioObj, $fechaFinObj, $customer_id, $posts_per_day, auth()->user()->id);
            $event = Event::insert($getDateSubreddit);
            return to_route('admin.events.schedules');
            // return response()->json(["data" => [], "message" => "save succeful", 'status' => true], 200);
        }
    }



    function makeShuffleCalendar($fecha_inicio, $fecha_fin, $customer_id, $number = 2, $user_id)
    {

        // Definir las subreddits disponibles
        $cs = CustomerSubreddit::where('customer_id', $customer_id)->get();
        $subredditsAsignados = $cs->pluck("subreddit_id")->toArray();

        // Definir el periodo de tiempo
        $fechaInicio = $fecha_inicio;
        $fechaFin = $fecha_fin;

        $res = [];
        $datetime = new DateTime();
        // Generar lista de subreddits para cada día
        while ($fechaInicio <= $fechaFin) {
            $fechaActual = $fechaInicio->format('Y-m-d');
            $subredditDia = $this->obtenerListaSubreddits($subredditsAsignados, $number);

            // echo "Para el día $fechaActual, come las siguientes subreddits: " . implode(", ", $subredditDia) . "\n";

            foreach ($subredditDia as $subreddit) {
                $arr = ["created_at" => $datetime, "updated_at" => $datetime, "posted_at" => $fechaActual, "subreddit_id" => $subreddit, 'user_id' => $user_id, 'customer_id' => $customer_id, 'status' => 1];
                error_log($subreddit);
                array_push($res, $arr);
            }


            // Avanzar al siguiente día
            $fechaInicio->modify('+1 day');
        }
        return  $res;
    }

    function obtenerListaSubreddits($subredditsAsignados, $numerosubreddits)
    {


        // Obtener una lista aleatoria de subreddits
        $subredditsAleatorias = array_rand($subredditsAsignados, intval($numerosubreddits));

        // Si solo se seleccionó una subreddit, convertir a array para mantener consistencia
        if (!is_array($subredditsAleatorias)) {
            $subredditsAleatorias = array($subredditsAleatorias);
        }

        // Obtener los nombres de las subreddits seleccionadas
        $subredditsSeleccionadas = array();
        foreach ($subredditsAleatorias as $indice) {
            $subredditsSeleccionadas[] = $subredditsAsignados[$indice];
        }

        return $subredditsSeleccionadas;
    }
}
