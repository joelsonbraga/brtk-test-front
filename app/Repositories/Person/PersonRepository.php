<?php
declare(strict_types=1);

namespace App\Repositories\Person;

use App\Models\Person;
use App\Repositories\Person\Exceptions\PersonNotFoundException;
use App\Repositories\Person\Exceptions\CreatePersonErrorException;
use App\Repositories\Person\Exceptions\DeletePersonErrorException;
use App\Repositories\Person\Exceptions\UpdatePersonErrorException;
use Illuminate\Database\QueryException;
use Illuminate\Pagination\LengthAwarePaginator;


/**
 * Class PersonRepository
 * @package App\Repositories\Person
 */
class PersonRepository implements PersonRepositoryInterface
{

    /**
     * @var Person
     */
    private $person;
    /**
     * @var int
     */
    private $perPage = 25;

    /**
     * PersonRepository constructor.
     * @param Person $person
     */
    public function __construct(Person $person)
    {
        $this->person = $person;
    }

    /**
     * @param PersonEntity $personEntity
     * @return Person
     */
    public function create(PersonEntity $personEntity): Person
    {
        try {

            $this->person->cpf   = $personEntity->getCpf();
            $this->person->name  = $personEntity->getName();
            $this->person->email = $personEntity->getEmail();
            $this->person->phone = $personEntity->getPhone();

            $this->person->save();
        } catch (QueryException | \Throwable $e) {
            throw new CreatePersonErrorException($e->getMessage(), 500);
        }

        return $this->person;
    }

    /**
     * @param PersonEntity $personEntity
     * @return Person
     */
    public function update(PersonEntity $personEntity): Person
    {
        try {

            $person = $this->findByUuid($personEntity->getUuid());

            $person->cpf   = $personEntity->getCpf();
            $person->name  = $personEntity->getName();
            $person->email = $personEntity->getEmail();
            $person->phone = $personEntity->getPhone();

            $person->save();
        } catch (QueryException | \Throwable $e) {
            throw new UpdatePersonErrorException($e->getMessage(), 500);
        }

        return $person;
    }

    /**
     * @param string $uuid
     * @return bool
     */
    public function delete(string $uuid): bool
    {
        try {
            return $this->person->where('uuid', $uuid)->first()->delete();
        } catch (QueryException | \Throwable $e) {
            throw new DeletePersonErrorException($e->getMessage(), 500);
        }

    }

    /**
     * @param string $uuid
     * @return Person
     */
    public function findByUuid(string $uuid): Person
    {
        try {
            return $this->person->where('uuid', $uuid)->first();
        } catch (QueryException | \Throwable $e) {
            throw new PersonNotFoundException($e->getMessage());
        }
    }

    /**
     * @param int $id
     * @return Person
     * @throws PersonNotFoundException
     */
    public function findByid(int $id): Person
    {
        try {
            return $this->person->find($id);
        } catch (QueryException | \Throwable $e) {
            throw new PersonNotFoundException($e->getMessage());
        }
    }

    /**
     * @param string $cpf
     * @return Person
     * @throws PersonNotFoundException
     */
    public function findByCpf(string $cpf): Person
    {
        try {
            return $this->person->where('cpf', $cpf)->first();
        } catch (QueryException | \Throwable $e) {
            throw new PersonNotFoundException($e->getMessage());
        }
    }

    /**
     * @param PersonEntity|null $personEntity
     * @param string $sortBy
     * @param string $orientation
     * @return LengthAwarePaginator
     * @throws PersonNotFoundException
     */
    public function findAll(PersonEntity $personEntity = null, string $sortBy = 'name', string $orientation = 'asc'): LengthAwarePaginator
    {
        try {

            $person =  $this->person
                ->where(function($query) use ($personEntity) {

                    if (!is_null($personEntity->getCpf())) {
                        $query->where('cpf', $personEntity->getCpf());
                    }

                    if (!is_null($personEntity->getEmail())) {
                        $query->where('email', $personEntity->getEmail());
                    }

                    if (!is_null($personEntity->getName())) {
                        $query->where('name', 'like', '%' . $personEntity->getName() . '%');
                    }
                })
                ->orderBy($sortBy, $orientation)
                ->paginate($this->perPage);

        } catch (QueryException | \Throwable $e) {
            throw new PersonNotFoundException($e->getMessage());
        }

        return $person;
    }
}
