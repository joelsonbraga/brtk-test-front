<?php

namespace App\Repositories\Person;

/**
 * Class PersonEntity
 * @package App\Repositories\Person
 */
class PersonEntity
{

    /**
     * @var
     */
    private $id;
    /**
     * @var
     */
    private $uuid;
    /**
     * @var
     */
    private $cpf;
    /**
     * @var
     */
    private $name;
    /**
     * @var
     */
    private $email;
    /**
     * @var
     */
    private $phone;

    /**
     * PersonEntity constructor.
     * @param array $mixedData
     */
    public function __construct(array $mixedData)
    {
        $this->setId($mixedData['id'] ?? null);
        $this->setUuid($mixedData['uuid'] ?? null);
        $this->setCpf($mixedData['cpf'] ?? null);
        $this->setName($mixedData['name'] ?? null);
        $this->setEmail($mixedData['email'] ?? null);
        $this->setPhone($mixedData['phone'] ?? null);
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'id' => $this->getId(),
            'uuid' => $this->getUuid(),
            'cpf' => $this->getCpf(),
            'name' => $this->getName(),
            'email' => $this->getEmail(),
            'phone' => $this->getPhone(),
        ];
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int|null $id
     */
    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getUuid()
    {
        return $this->uuid;
    }

    /**
     * @param string|null $uuid
     */
    public function setUuid(?string $uuid): void
    {
        $this->uuid = $uuid;
    }

    /**
     * @return mixed
     */
    public function getcpf()
    {
        return $this->cpf;
    }

    /**
     * @param string|null $cpf
     */
    public function setCpf(?string $cpf): void
    {
        $this->cpf = $cpf;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string|null $name
     */
    public function setName(?string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param string|null $email
     */
    public function setEmail(?string $email): void
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * @param string|null $phone
     */
    public function setPhone(?string $phone): void
    {
        $this->phone = $phone;
    }
}
