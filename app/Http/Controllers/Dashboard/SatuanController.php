<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Satuan\SatuanRequest;
use App\Services\SatuanService;
use Illuminate\Http\Response;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Http\Request;

class SatuanController extends Controller
{
    /**
     * @var SatuanService
     */
    private $service;

    public function __construct(SatuanService $service)
    {
        $this->service = $service;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('satuan');
    }

    public function datatable()
    {
        return DataTables::of($this->service->datatable())
            ->addIndexColumn()
            ->addColumn('opsi', function ($data) {
                return '<button class="btn btn-sm btn-warning btn-edit" data-id="'.$data->id.'" data-nama="'.$data->nama.'" data-kode="'.$data->kode.'"><i class="fas fa-edit"></i></button>
                <button class="btn btn-sm btn-danger btn-hapus" data-id="'.$data->id.'"><i class="fas fa-trash"></i></button>';
            })
            ->rawColumns(['opsi'])
            ->make(true);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(SatuanRequest $request)
    {
        try {
            $response = $this->service->create($request->all());
        } catch (\Exception $e) {
            return response()->json([
                'status' => FALSE,
                'message' => $e->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        return response()->json([
            'status' => TRUE,
            'data' => $response
        ], Response::HTTP_OK);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(SatuanRequest $request, $id)
    {
        try {
            $response = $this->service->update($request->all(), $id);
        } catch (\Exception $e) {
            return response()->json([
                'status' => FALSE,
                'message' => $e->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        return response()->json([
            'status' => TRUE,
            'data' => $response
        ], Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        try {
            $response = $this->service->delete($id);
        } catch (\Exception $e) {
            return response()->json([
                'status' => FALSE,
                'message' => $e->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        return response()->json([
            'status' => TRUE,
            'data' => $response
        ], Response::HTTP_OK);
    }

    /**
     * Select2
     */
    public function select2(Request $request)
    {
        $response = $this->service->select2($request);

        return response()->json($response, Response::HTTP_OK);
    }
}
