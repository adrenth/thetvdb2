<?php

declare(strict_types=1);

namespace Adrenth\Thetvdb\Model;

use Adrenth\Thetvdb\Model\Movie\Artwork;
use Adrenth\Thetvdb\Model\Movie\Genre;
use Adrenth\Thetvdb\Model\Movie\Person;
use Adrenth\Thetvdb\Model\Movie\ReleaseDate;
use Adrenth\Thetvdb\Model\Movie\RemoteId;
use Adrenth\Thetvdb\Model\Movie\Trailer;
use Adrenth\Thetvdb\Model\Movie\Translation;
use Symfony\Component\VarDumper\VarDumper;

/**
 * @author   Alwin Drenth <adrenth@gmail.com>
 * @license  MIT
 *
 * @see     https://github.com/adrenth/thetvdb2
 */
final class Movie extends ValueObject
{
    /** @var int|null */
    private $id;

    /** @var int|null */
    private $runtime;

    /** @var string|null */
    private $url;

    /** @var Genre[] */
    private $genres;

    /** @var Translation[] */
    private $translations;

    /** @var ReleaseDate[] */
    private $releaseDates;

    /** @var Artwork[] */
    private $artworks;

    /** @var Trailer[] */
    private $trailers;

    /** @var RemoteId[] */
    private $remoteIds;

    /** @var Person[] */
    private $actors;

    /** @var Person[] */
    private $directors;

    /** @var Person[] */
    private $producers;

    /** @var Person[] */
    private $writers;

    public function __construct(array $values)
    {
        parent::__construct($values);

        VarDumper::dump($values);

        $this->id = $this->intOrNull('data.id');
        $this->runtime = $this->intOrNull('data.runtime');
        $this->url = $this->stringOrNull('data.url');
        $this->genres = $this->getCollection('data.genres', Genre::class);
        $this->translations = $this->getCollection('data.translations', Translation::class);
        $this->releaseDates = $this->getCollection('data.release_dates', ReleaseDate::class);
        $this->artworks = $this->getCollection('data.artworks', Artwork::class);
        $this->trailers = $this->getCollection('data.trailers', Trailer::class);
        $this->remoteIds = $this->getCollection('data.remoteids', RemoteId::class);
        $this->actors = $this->getCollection('data.people.actors', Person::class);
        $this->directors = $this->getCollection('data.people.directors', Person::class);
        $this->producers = $this->getCollection('data.people.producers', Person::class);
        $this->writers = $this->getCollection('data.people.writers', Person::class);
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRuntime(): ?int
    {
        return $this->runtime;
    }

    public function getUrl(): ?string
    {
        return $this->url;
    }

    /**     * @return Genre[]|array
     */
    public function getGenres(): array
    {
        return $this->genres;
    }

    /**     * @return Translation[]|array
     */
    public function getTranslations(): array
    {
        return $this->translations;
    }

    /**     * @return ReleaseDate[]|array
     */
    public function getReleaseDates(): array
    {
        return $this->releaseDates;
    }

    /**     * @return Artwork[]|array
     */
    public function getArtworks(): array
    {
        return $this->artworks;
    }

    /**     * @return Trailer[]|array
     */
    public function getTrailers(): array
    {
        return $this->trailers;
    }

    /**     * @return RemoteId[]|array
     */
    public function getRemoteIds(): array
    {
        return $this->remoteIds;
    }

    /**     * @return Person[]|array
     */
    public function getActors(): array
    {
        return $this->actors;
    }

    /**     * @return Person[]|array
     */
    public function getDirectors(): array
    {
        return $this->directors;
    }

    /**     * @return Person[]|array
     */
    public function getProducers(): array
    {
        return $this->producers;
    }

    /**     * @return Person[]|array
     */
    public function getWriters(): array
    {
        return $this->writers;
    }
}
