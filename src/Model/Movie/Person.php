<?php

declare(strict_types=1);

namespace Adrenth\Thetvdb\Model\Movie;

use Adrenth\Thetvdb\Model\ValueObject;
use Illuminate\Support\Arr;

final class Person extends ValueObject
{
    private ?string $id;
    private ?string $imdbId;
    private ?string $peopleId;
    private bool $featured;
    private ?string $name;
    private ?string $facebook;
    private ?string $image;
    private ?string $instagram;
    private ?string $twitter;
    private ?string $role;
    private ?string $roleImage;

    public function __construct(array $values)
    {
        parent::__construct($values);

        $this->id = $this->stringOrNull('id');
        $this->imdbId = $this->stringOrNull('imdb_id');
        $this->peopleId = $this->stringOrNull('people_id');
        $this->featured = (bool) Arr::get($this->values, 'is_featured', false);
        $this->name = $this->stringOrNull('name');
        $this->facebook = $this->stringOrNull('people_facebook');
        $this->image = $this->stringOrNull('people_image');
        $this->instagram = $this->stringOrNull('people_instagram');
        $this->twitter = $this->stringOrNull('people_twitter');
        $this->role = $this->stringOrNull('role');
        $this->roleImage = $this->stringOrNull('role_image');
    }

    public function getId(): ?string
    {
        return $this->id;
    }

    public function getImdbId(): ?string
    {
        return $this->imdbId;
    }

    public function getPeopleId(): ?string
    {
        return $this->peopleId;
    }

    public function featured(): bool
    {
        return $this->featured;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function getFacebook(): ?string
    {
        return $this->facebook;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function getInstagram(): ?string
    {
        return $this->instagram;
    }

    public function getTwitter(): ?string
    {
        return $this->twitter;
    }

    public function getRole(): ?string
    {
        return $this->role;
    }

    public function getRoleImage(): ?string
    {
        return $this->roleImage;
    }

    /**
     * @deprecated Will be removed in v7.0.0
     */
    public function getFeatured(): bool
    {
        return $this->featured;
    }
}
