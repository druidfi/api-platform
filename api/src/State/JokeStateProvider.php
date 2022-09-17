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
        if ($operation instanceof CollectionOperationInterface || $uriVariables['id'] === null) {
            return $this->getJokes();
        }

        return $this->getJoke($uriVariables['id']);
    }

    private function getJoke(?string $id): ?Joke
    {
        $request = $this->jokeClient->request('GET', $id ?? 'random');

        try {
            $joke = $request->toArray();

            return (new Joke())->setId($joke['id'])->setJoke($joke['value']);
        }
        catch (\Exception $e) {
            return null;
        }
    }

    private function getJokes(): array
    {
        $request = $this->jokeClient->request('GET', 'search', [
            'query' => [
                'query' => 'action',
            ],
        ]);

        $jokes = [];

        foreach ($request->toArray() as $joke) {
            $jokes[] = (new Joke())->setId($joke['id'])->setJoke($joke['value']);
        }

        return $jokes;
    }
}
