<?php

namespace App\State;

use ApiPlatform\Metadata\CollectionOperationInterface;
use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProviderInterface;
use App\Entity\Joke;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class JokeStateProvider implements ProviderInterface
{
    private HttpClientInterface $jokeClient;

    public function __construct(HttpClientInterface $jokeClient)
    {
        $this->jokeClient = $jokeClient;
    }

    public function provide(Operation $operation, array $uriVariables = [], array $context = []): object|iterable|null
    {
        if ($operation instanceof CollectionOperationInterface) {
            $joke = $this->getJoke();
            return [new Joke(), new Joke()];
        }

        $joke = $this->getJoke($uriVariables['id']);

        return (new Joke())->setId($joke['id'])->setJoke($joke['value']);
    }

    private function getJoke(?string $id)
    {
        $request = $this->jokeClient->request('GET', $id ?? 'random');

        return $request->toArray();
    }
}
