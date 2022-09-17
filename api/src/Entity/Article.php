<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Get;
use App\State\ArticleStateProvider;

#[ApiResource]
#[Get(provider: ArticleStateProvider::class)]
class Article
{
    #[ApiProperty(identifier: true)]
    private ?int $nid = null;

    public function __construct()
    {
        $this->nid = rand();
    }

    public function getNid(): ?int
    {
        return $this->nid;
    }

    public function setNid(?int $nid): void
    {
        $this->nid = $nid;
    }
}
