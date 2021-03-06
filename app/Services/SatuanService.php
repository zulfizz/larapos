<?php


namespace App\Services;


use App\Repositories\Satuan\SatuanRepository;

class SatuanService extends BaseService
{
    /**
     * @var SatuanRepository
     */
    private $repository;

    public function __construct(SatuanRepository $repository)
    {
        parent::__construct($repository);
        $this->repository = $repository;
    }

    public function datatable()
    {
        return $this->repository->query();
    }

    public function select2($request)
    {
        $data['results'] = $this->repository->select2();

        return $data;
    }

}
