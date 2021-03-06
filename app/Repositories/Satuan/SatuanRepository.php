<?php

namespace App\Repositories\Satuan;

use App\Models\Satuan;
use App\Repositories\BaseRepository;

class SatuanRepository extends BaseRepository
{
    public function __construct(Satuan $model)
    {
        parent::__construct($model);
        $this->model = $model;
    }

    public function select2()
    {
        return $this->model->select('id', 'nama as text')->get();
    }

}
