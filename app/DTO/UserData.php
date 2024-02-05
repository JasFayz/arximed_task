<?php

namespace App\DTO;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserData
{

    public function __construct(
        private readonly string $name,
        private readonly string $email,
        private readonly string $password
    )
    {
    }

    public static function from(array $data): self
    {
        return new self(
            name: $data['name'],
            email: $data['email'],
            password: $data['password'],
        );
    }


    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

}
