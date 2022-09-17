<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use App\State\JokeStateProvider;

#[ApiResource(
    operations: [
        new Get(provider: JokeStateProvider::class),
        new GetCollection(provider: JokeStateProvider::class)
    ]
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
