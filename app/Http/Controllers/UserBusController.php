<?php

namespace App\Http\Controllers;

use App\Bus;
use App\Http\Resources\BusResource;
use App\User;
use Illuminate\Http\Request;

class UserBusController extends Controller
{
    /**
     * Return main view.
     *
     * @param User $user
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(User $user)
    {
        return view('user_buses')
            ->with([
                'userId' => $user->id,
            ]);
    }

    /**
     * Datatables data
     *
     * @param Request $req
     * @param $user
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function dataTables(Request $req, $user)
    {
        $query = Bus::query();
        if ($req->filled('sort')) {
            $exp = explode('|', $req->get('sort'));
            if (count($exp) > 1) {
                $query->orderBy($exp[0], $exp[1]);
            }
        }
        if ($req->filled('filter')) {
            $query->orWhere('active_plate', 'LIKE', '%' . $req->get('filter') . '%')
                ->orWhere('official_plate', 'LIKE', '%' . $req->get('filter') . '%');
        }

        return BusResource::collection($query->paginate(20));
    }
}
