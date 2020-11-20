<?php

declare(strict_types=1);

namespace Adrenth\Thetvdb\Model\Movie;

use Adrenth\Thetvdb\Model\ValueObject;
use Illuminate\Support\Arr;

/**
 * Class Person
 *
 * @category Thetvdb
 * @package  Adrenth\Thetvdb\Model\Movie
 * @author   Alwin Drenth <adrenth@gmail.com>
 * @license  http://opensource.org/licenses/MIT The MIT License (MIT)
 * @link     https://github.com/adrenth/thetvdb2
 */
final class Person extends ValueObject
{
    /** @var string|null */
    private $id;

    /** @var string|null */
    private $imdbId;

    /** @var string|null */
    private $peopleId;

    /** @var string|null */
    private $isFeatured;

    /** @var string|null */
    private $name;

    /** @var string|null */
    private $facebook;

    /** @var string|null */
    private $image;

    /** @var string|null */
    private $instagram;

    /** @var string|null */
    private $twitter;

    /** @var string|null */
    private $role;

    /** @var string|null */
    private $roleImage;

    public function __construct(array $values)
    {
        parent::__construct($values);

        $this->id = $this->stringOrNull('id');
        $this->imdbId = $this->stringOrNull('imdb_id');
        $this->peopleId = $this->stringOrNull('people_id');
        $this->isFeatured = (bool) Arr::get($this->values, 'is_featured', false);
        $this->name = $this->stringOrNull('name');
        $this->facebook = $this->stringOrNull('people_facebook');
        $this->image = $this->stringOrNull('people_image');
        $this->instagram = $this->stringOrNull('people_instagram');
        $this->twitter = $this->stringOrNull('people_twitter');
        $this->role = $this->stringOrNull('role');
        $this->image = $this->stringOrNull('role_image');
    }

    /**
     * @return string|null
     */
    public function getId(): ?string
    {
        return $this->id;
    }

    /**
     * @return string|null
     */
    public function getImdbId(): ?string
    {
        return $this->imdbId;
    }

    /**
     * @return string|null
     */
    public function getPeopleId(): ?string
    {
        return $this->peopleId;
    }

    /**
     * @return string|null
     */
    public function getIsFeatured(): ?string
    {
        return $this->isFeatured;
    }

    /**
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @return string|null
     */
    public function getFacebook(): ?string
    {
        return $this->facebook;
    }

    /**
     * @return string|null
     */
    public function getImage(): ?string
    {
        return $this->image;
    }

    /**
     * @return string|null
     */
    public function getInstagram(): ?string
    {
        return $this->instagram;
    }

    /**
     * @return string|null
     */
    public function getTwitter(): ?string
    {
        return $this->twitter;
    }

    /**
     * @return string|null
     */
    public function getRole(): ?string
    {
        return $this->role;
    }

    /**
     * @return string|null
     */
    public function getRoleImage(): ?string
    {
        return $this->roleImage;
    }
}

