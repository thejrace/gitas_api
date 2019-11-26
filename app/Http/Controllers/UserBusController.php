<?php

namespace App\Http\Controllers;

use App\Bus;
use App\Http\Resources\BusResource;
use App\User;
use Doctrine\DBAL\Query\QueryBuilder;
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
                'userId'   => $user->id,
                'userName' => $user->name,
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
    public function dataTablesDefined(Request $req, User $user)
    {
        $defined = $user->buses
            ->pluck('id')
            ->toArray();

        $query = Bus::query()
            ->whereIn('id', $defined);

        if ($req->filled('sort')) {
            $exp = explode('|', $req->get('sort'));
            if (count($exp) > 1) {
                $query->orderBy($exp[0], $exp[1]);
            }
        }

        if ($req->filled('filter')) {
            $query->where(function($query) use ($req) {
                /* @var QueryBuilder $query */
                $query->orWhere('active_plate', 'LIKE', '%' . $req->get('filter') . '%')
                    ->orWhere('official_plate', 'LIKE', '%' . $req->get('filter') . '%')
                    ->orWhere('code', 'LIKE', '%' . $req->get('filter') . '%');
            });
        }

        return BusResource::collection($query->paginate(20));
    }

    /**
     * Datatables data
     *
     * @param Request $req
     * @param $user
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function dataTablesNotDefined(Request $req, User $user)
    {
        $defined = $user->buses
            ->pluck('id')
            ->toArray();

        $query = Bus::query()
            ->whereNotIn('id', $defined);

        if ($req->filled('sort')) {
            $exp = explode('|', $req->get('sort'));
            if (count($exp) > 1) {
                $query->orderBy($exp[0], $exp[1]);
            }
        }

        if ($req->filled('filter')) {
            $query->where(function($query) use ($req) {
                /* @var QueryBuilder $query */
                $query->orWhere('active_plate', 'LIKE', '%' . $req->get('filter') . '%')
                    ->orWhere('official_plate', 'LIKE', '%' . $req->get('filter') . '%')
                    ->orWhere('code', 'LIKE', '%' . $req->get('filter') . '%');
            });
        }

        return BusResource::collection($query->paginate(20));
    }
}
