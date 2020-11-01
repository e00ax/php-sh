<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class PaginationController extends Controller
{
    protected $itemsPerPageDefault;

    /**
     * Constructor
     *
     * @return void
     */
    public function __construct()
    {
        $this->itemsPerPageDefault = config('sh.pagination.itemsPerPageTable');
    }


    /**
     * Get itemsPerPageDefault
     *
     * @return int items per page
     */
    public function getItemsPerPageDefault()
    {
        return $this->itemsPerPageDefault;
    }


    /**
     * Display a listing of the resource.
     *
     * @param \Illuminate\Http\Request $request
     * @return view
     */
    public function index(Request $request)
    {
        $request->ajax()
            ? $paginationView = 'pagination.paginationData'
            : $paginationView = 'pagination.pagination';

        $itemsPerPage = $request->items ?? $this->itemsPerPageDefault;
        $data = DB::table('dht22')->paginate($itemsPerPage);

        //echo $request->view;
        return view($paginationView, ['data' => $data, 'itemsPerPage' => $itemsPerPage]);
    }
}
