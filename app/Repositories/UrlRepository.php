<?php

namespace App\Repositories;

use App\Contracts\UrlContract;
use App\Models\Url;
use Illuminate\Database\Eloquent\Collection;

/**
 * URL Repository (make database operations) package
 *
 * @package App\Repositories
 * @author  Thiago Silva <thiagom.devsec@gmail.com>
 * @version 1.1
 */
class UrlRepository extends Repository implements UrlContract
{
    /**
     * Model injection
     *
     * @var object
     */
    protected $model = Url::class;

    /**
     * Return all urls list
     *
     * @return Collection
     */
    public function all(): Collection
    {
        return $this->model->all();
    }

    /**
     * Create new url resource
     *
     * @param array $data - data to store
     * @return int
     */
    public function createNew(array $data): Url
    {
        return $this->model->create($data);
    }

    /**
     * Return all data from url
     *
     * @param string $urlShort
     * @return mixed
     */
    public function search(string $urlShort): mixed
    {
        return $this->model->where('short', $urlShort)
            ->get(['origin', 'clicks'])->first();
    }

    /**
     * Update url resources clicks
     *
     * @param array $data
     * @return mixed
     */
    public function update(array $data): mixed
    {
        return $this->model->where('short', $data['short'])
            ->update(['clicks' => $data['clicks']]);
    }
}
