<?php

namespace App\Http\Controllers;

use App\Http\Requests\Person\IndexPersonRequest;
use App\Http\Requests\Person\StorePersonRequest;
use App\Http\Requests\Person\UpdatePersonRequest;
use Illuminate\Http\Client\RequestException;
use Illuminate\Support\Facades\Http;

class PersonController extends Controller
{
    /**
     * @var string
     */
    private $api;

    /**
     * PersonController constructor.
     */
    public function __construct()
    {
        $this->api = 'http://127.0.0.1:8001/';
    }

    public function index ()
    {
        $response = Http::get($this->api . 'api/v1/person/all');
        return view('person.index')
            ->with('persons', $response->json()['data']);
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function add ()
    {
        return view('person.add');
    }

    /**
     * @param StorePersonRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store (StorePersonRequest $request)
    {
        try {
            $validated = $request->validated();
            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
            ])->post($this->api . 'api/v1/person/add', $validated);

            if ($response->failed() === true) {
                throw new RequestException($response);
            }
        } catch (RequestException $e) {
            return redirect()
                ->route('person.add')
                ->with('errors', $e->response->json());
        }

        return redirect()
            ->route('person.index')
            ->with('success', 'Person successfully inserted!');

    }

    /**
     * @param string $uuid
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit (string $uuid)
    {
        $response = Http::get($this->api . 'api/v1/person/show/' . $uuid);
        return view('person.edit')
            ->with('person', $response->json());
    }

    /**
     * @param UpdatePersonRequest $request
     * @param string $uuid
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update (UpdatePersonRequest $request, string $uuid)
    {
        try {
            $validated = $request->validated();

            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
            ])->put($this->api . 'api/v1/person/update/' . $uuid, $validated);

            if ($response->failed() === true) {
                throw new RequestException($response);
            }
        } catch (RequestException $e) {
            return redirect()
                ->route('person.edit', $uuid)
                ->with('errors', $e->response->json());
        }

        return redirect()
            ->route('person.index')
            ->with('success', 'Person successfully updated!');
    }

    /**
     * @param string $uuid
     * @return \Illuminate\Http\RedasdfadsfirectResponse
     */
    public function delete (string $uuid)
    {
        try {
            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
            ])->delete($this->api . 'api/v1/person/delete/' . $uuid);

            if ($response->failed() === true) {
                throw new RequestException($response);
            }
        } catch (RequestException $e) {
            return redirect()
                ->route('person.index', $uuid)
                ->with('errors', $e->response->json());
        }

        return redirect()
            ->route('person.index')
            ->with('success', 'Person successfully deleted!');
    }
}
