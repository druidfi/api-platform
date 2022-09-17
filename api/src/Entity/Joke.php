<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use App\State\JokeProvider;

#[ApiResource(
    operations: [
        new Get(),
        new GetCollection()
    ],
    cacheHeaders: [
        'max_age' => 60,
        'shared_max_age' => 120
    ],
    provider: JokeProvider::class
)]
class Joke
{
    #[ApiProperty(identifier: true)]
    private ?string $id;

    #[ApiProperty]
    private ?string $joke;

    public function getId(): ?string
    {
        return $this->id;
    }

    public function setId(string $id): self
    {
        $this->id = $id;
        return $this;
    }

    public function getJoke(): ?string
    {
        return $this->joke;
    }

    public function setJoke(?string $joke): self
    {
        $this->joke = $joke;
        return $this;
    }
}
