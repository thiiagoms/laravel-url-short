<?php

namespace App\Repositories;

use App\Models\Url;
use Illuminate\Database\Eloquent\Collection;

class UrlRepository
{
    /**
     * Url Model
     *
     * @var Url
     */
    private Url $url;

    /**
     * @param Url $urlModel
     */
    public function __construct(Url $urlModel)
    {
        $this->model = $urlModel;
    }

    /**
     * Return all urls list
     *
     * @return Collection
     */
    public function getAll(): Collection
    {
        return $this->model->all();
    }

    /**
     * Create new url resource
     *
     * @param array $data - data to store
     * @return mixed
     */
    public function createNew(array $data): mixed
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
            ->get(['original', 'clicks'])->first();
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
