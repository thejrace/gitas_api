<?php

namespace App\Http\Controllers;

use App\AppModule;
use App\Http\Resources\AppModuleResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class AppModuleController extends Controller
{
    /**
     * Generate datatables data for the frontend
     *
     * @param Request $req
     *
     * @return AnonymousResourceCollection
     */
    public function dataTables(Request $req)
    {
        $query = AppModule::query();
        if ($req->filled('sort')) {
            $exp = explode('|', $req->get('sort'));
            if (count($exp) > 1) {
                $query->orderBy($exp[0], $exp[1]);
            }
        }
        if ($req->filled('filter')) {
            $query->orWhere('name', 'LIKE', '%' . $req->get('filter') . '%');
        }

        return AppModuleResource::collection($query->paginate(20));
    }

    /**
     * Show index view
     *
     * @return \View
     */
    public function index()
    {
        return view('app_modules');
    }
}
