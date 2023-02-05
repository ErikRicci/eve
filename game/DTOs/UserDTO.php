<?php

namespace Game\DTOs;

class UserDTO extends DTO
{
    public function __construct(
        public string $login,
        public string $password,
    ) {}
}