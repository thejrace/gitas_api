<?php

namespace App\Http\Controllers;

use App\FtsVersion;
use App\Http\Resources\FtsVersionResource;
use Illuminate\Http\Request;

class FtsVersionController extends Controller
{
    /**
     * Generate datatables data for the frontend
     *
     * @param Request $req
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function dataTables(Request $req)
    {
        $query = FtsVersion::query();
        if ($req->filled('sort')) {
            $exp = explode('|', $req->get('sort'));
            if (count($exp) > 1) {
                $query->orderBy($exp[0], $exp[1]);
            }
        }
        return FtsVersionResource::collection($query->paginate(20));
    }

    /**
     * Show index view
     *
     * @return \View
     */
    public function index()
    {
        return view('fts_versions');
    }
}
