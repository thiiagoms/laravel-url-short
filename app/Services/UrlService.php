<?php

namespace App\Services;

use Illuminate\Database\Eloquent\Collection;
use App\Repositories\UrlRepository;

/**
 * Url service
 *
 * @package App\Services
 * @author  Thiago <thiagom.devsec@gmail.com>
 */
class UrlService
{
    /**
     * Url repository object
     *
     * @var UrlRepository
     */
    private UrlRepository $urlRepo;

    /**
     * @param UrlRepository $repository
     */
    public function __construct(UrlRepository $repository)
    {
        $this->urlRepo = $repository;
    }

    /**
     * Return all urls list
     *
     * @return Collection;
     */
    public function urlList(): Collection
    {
        return $this->urlRepo->getAll();
    }

    /**
     * Create new urlshort
     *
     * Retornar uma nova url short
     *
     * procurar no banco se ja existe, se existir gerar novamente e verificar,
     * se nao existir retornar uma nova
     *
     * @param string $url
     * @return bool
     */
    public function createUrlShort(string $url): bool
    {
        $short = $this->generateRandomUuid();

        $this->urlRepo->createNew(['original' => $url, 'short' => $short]);

        return true;
    }

    /**
     * Generate custom url short
     *
     * @return string
     */
    private function generateRandomUuid(): string
    {
        $specialCharacters = str_split(
            'abcdefghijklmnopqrstuvwxyz' .
            'ABCDEFGHIJKLMNOPQRSTUVWXYZ' .
            '0123456789!@#$%^&*()'
        );

        $rand = '';

        foreach (array_rand($specialCharacters, 5) as $seed) {
            $rand .= $specialCharacters[$seed];
        }

        return $rand;
    }

    /**
     * Search original url by url short
     *
     * @param string $urlshort -short url
     * @return string
     */
    public function redirectTo(string $urlshort): string
    {
        $url = $this->urlRepo->search($urlshort);

        $this->addClick(['short' => $urlshort, 'clicks' => $url->clicks + 1]);

        return $url->original;
    }

    /**
     * Update clicks counter
     *
     * @param array $data
     * @return void
     */
    public function addClick(array $data): void
    {
        $this->urlRepo->update($data);
    }
}
