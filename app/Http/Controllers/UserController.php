<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class UserController extends Controller
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
        $query = User::query();
        if ($req->filled('sort')) {
            $exp = explode('|', $req->get('sort'));
            if (count($exp) > 1) {
                $query->orderBy($exp[0], $exp[1]);
            }
        }
        if ($req->filled('filter')) {
            $query->orWhere('name', 'LIKE', '%' . $req->get('filter') . '%')
                ->orWhere('name', 'LIKE', '%' . $req->get('filter') . '%')
                ->orWhere('citizenship_number', 'LIKE', '%' . $req->get('filter') . '%');
        }

        return UserResource::collection($query->paginate(20));
    }

    /**
     * Show index view
     *
     * @return \View
     */
    public function index()
    {
        return view('users');
    }
}
