<?php

declare(strict_types=1);

namespace App\Contracts;

use App\Models\Url;
use Illuminate\Database\Eloquent\Collection;

/**
 * Url Contract
 *
 * @package App\Contracts
 * @author  Thiago Silva <thiagom.devsec@gmail.com>
 * @version 1.1
 */
interface UrlContract
{
    /**
     * Return all urls in database
     *
     * @return Collection
     */
    public function all(): Collection;

    /**
     * Search for original from using url short
     *
     * @param string $urlShort
     * @return mixed
     */
    public function search(string $urlShort): mixed;

    /**
     * Create new url short
     *
     * @param array $data
     * @return void
     */
    public function createNew(array $data): void;

    /**
     * Update url data
     *
     * @param array $data
     * @return mixed
     */
    public function update(array $data): mixed;
}
