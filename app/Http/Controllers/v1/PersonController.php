<?php

namespace App\Http\Controllers\v1;

use App\Http\Requests\Person\IndexPersonRequest;
use App\Http\Requests\Person\StorePersonRequest;
use App\Http\Requests\Person\UpdatePersonRequest;
use App\Http\Resources\Person\PersonCollection;
use App\Http\Resources\Person\PersonResource;
use App\Repositories\Person\Exceptions\CreatePersonErrorException;
use App\Repositories\Person\Exceptions\DeletePersonErrorException;
use App\Repositories\Person\Exceptions\PersonNotFoundException;
use App\Repositories\Person\Exceptions\UpdatePersonErrorException;
use App\Repositories\Person\PersonEntity;
use App\Repositories\Person\PersonRepositoryInterface;

class PersonController extends Controller
{

    /**
     * @var PersonRepositoryInterface
     */
    private $personRepository;

    /**
     * CommonController constructor.
     * @param PersonRepositoryInterface $personRepository
     */
    public function __construct(PersonRepositoryInterface $personRepository)
    {
        $this->personRepository = $personRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(IndexPersonRequest $request)
    {
        try {
            $personEntity = new PersonEntity($request->validated());

            $person = $this->personRepository->findAll($personEntity);
            return response()->json(new PersonCollection($person));
        } catch (PersonNotFoundException $e) {
            return response()->json($e->getResponse(), $e->getCode());
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StorePersonRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StorePersonRequest $request)
    {
        try {
            $validated = $request->validated();

            $personEntity = new PersonEntity($validated);
            $person = $this->personRepository->create($personEntity);

            return response()->json(new PersonResource($person));
        } catch (CreatePersonErrorException | CreateUserErrorException $e) {
            return response()->json($e->getResponse(), $e->getCode());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  string $uuid
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(string $uuid)
    {
        try {
            $person = $this->personRepository->findByUuid($uuid);

            return response()->json(new PersonResource($person));
        } catch (PersonNotFoundException $e) {
            return response()->json($e->getResponse(), $e->getCode());
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdatePersonRequest $request
     * @param string $uuid
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdatePersonRequest $request, string $uuid)
    {
        try {
            $validated = $request->validated();
            $validated['uuid'] = $uuid;

            $personEntity = new PersonEntity($validated);
            $person = $this->personRepository->update($personEntity);

            return response()->json(new PersonResource($person));
        } catch (UpdatePersonErrorException $e) {
            return response()->json($e->getResponse(), $e->getCode());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param string $uuid
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete(string $uuid)
    {
        try {
            $person = $this->personRepository->findByUuid($uuid);

            $this->personRepository->delete($uuid);

            $response = [
                'success' => [
                    'message' => __('Person was successfully excluded.'),
                ],
            ];

            return response()->json($response);
        } catch (DeletePersonErrorException | DeleteUserErrorException $e) {
            return response()->json($e->getResponse(), $e->getCode());
        } catch (PersonNotFoundException $e) {
            return response()->json($e->getResponse(), $e->getCode());
        }
    }
}
