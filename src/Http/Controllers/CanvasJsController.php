<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class CanvasJsController extends Controller
{
    protected $itemsPerPageDefault;

    /**
     * Constructor
     *
     * @return void
     */
    public function __construct()
    {
        $this->itemsPerPageDefault = config('sh.pagination.itemsPerPageCanvasJs');
    }


    /**
     * Get default value for items per page
     *
     * @return int Items
     */
    public function getItemsPerPageDefault()
    {
        return $this->itemsPerPageDefault;
    }


    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return view
     */
    public function index(Request $request)
    {
        $itemsPerPage = $request->items ?? $this->itemsPerPageDefault;
        $data = DB::table('dht22')->paginate($itemsPerPage);

        //echo $request->view;
        return view('canvasJs.canvasJs', ['data' => $data, 'itemsPerPage' => $itemsPerPage]);
    }
}
