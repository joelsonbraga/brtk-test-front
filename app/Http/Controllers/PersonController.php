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
        $response = Http::get('http://127.0.0.1:8001/api/v1/person/all');
        return view('welcome');
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function add ()
    {
        return view('person.add');
    }

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

    public function show ()
    {
        dd('here');
    }

    public function edit ()
    {
        dd('here');
    }

    public function update ()
    {
        dd('here');
    }
    public function delete ()
    {
        dd('here');
    }
}
