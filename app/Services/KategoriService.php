<?php


namespace App\Services;


use App\Repositories\Kategori\KategoriRepository;

class KategoriService extends BaseService
{
    /**
     * @var KategoriRepository
     */
    private $repository;

    public function __construct(KategoriRepository $repository)
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
        $data['results'] =  $this->repository->select2();

        return $data;
    }

}
