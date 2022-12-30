<?php

declare(strict_types=1);

namespace App\Services;

use App\Contracts\UrlContract;
use Illuminate\Database\Eloquent\Collection;
use App\Exceptions\Url\UrlEmptyException;

/**
 * URL Service (business logic) package
 *
 * @package App\Services
 * @author  Thiago Silva <thiagom.devsec@gmail.com>
 * @version 1.1
 */
final class UrlService
{
    /**
     * Init UrlService with UrlContract
     *
     * @param UrlContract $urlContract
     */
    public function __construct(private UrlContract $urlContract)
    {
    }

    /**
     * Return all urls list
     *
     * @return Collection;
     */
    public function urlList(): Collection
    {
        return $this->urlContract->all();
    }

    /**
     * TODO: Check if url is valid
     *
     * @param string $url
     * @return boolean
     */
    private function isValidUrl(string $url)
    {
    }

    /**
     * Check if short already exists in database
     *
     * @param string $short
     * @return string
     */
    private function shortExists(string $short): string
    {
        $result = $this->urlContract->search($short);

        while (!is_null($result)) {
            $newShort = $this->generateRandomUuid();
            $result = $this->urlContract->search($newShort);
        }

        return isset($newShort) ? $newShort : $short;
    }

    /**
     * Create new url short
     *
     * @param string $url
     * @return bool
     */
    public function createUrlShort(string $url)
    {
        if (empty($url)) {
            throw new UrlEmptyException();
        }

        $short = $this->shortExists($this->generateRandomUuid());

        $result = $this->urlContract->createNew(['origin' => $url, 'short' => $short]);

        return is_integer($result) ? true : false;
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
     * @param string $urlshort - url short
     * @return string
     */
    public function addClickCount(string $urlshort): void
    {
        $url = $this->urlContract->search($urlshort);

        $this->updateClick(['short' => $urlshort, 'clicks' => $url->clicks + 1]);
    }

    /**
     * Update clicks counter
     *
     * @param array $data
     * @return void
     */
    public function updateClick(array $data): void
    {
        $this->urlContract->update($data);
    }
}
