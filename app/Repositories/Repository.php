<?php

declare(strict_types=1);

namespace App\Repositories;

/**
 * Abstract Repository
 *
 * @package App\Repositories
 * @author  Thiago Silva <thiagom.devsec@gmail.com>
 * @version 1.0
 */
abstract class Repository
{
    /**
     * Model injection
     *
     * @var object
     */
    protected $model;

    /**
     * Get model from app container
     *
     * @return mixed
     */
    private function handle(): mixed
    {
        return app($this->model);
    }

    /**
     * Add model class
     */
    public function __construct()
    {
        $this->model = $this->handle();
    }
}
