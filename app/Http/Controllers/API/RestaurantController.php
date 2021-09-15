<?php

namespace App\Http\Controllers\API;


use App\Http\Controllers\Controller;
use App\Http\Resources\RestaurantResource;
use App\Restaurant;
use App\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator as PaginationPaginator;
use Illuminate\Support\Facades\DB;


class RestaurantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $cat = $request->categories;

        $cat_exploded = explode(',', $cat);
        sort($cat_exploded);

        $categories = implode(',', $cat_exploded);

        $sql_quey =
            'SELECT u.*, GROUP_CONCAT(DISTINCT(cu.category_id) SEPARATOR ",") 
            AS category 
            FROM users u 
            LEFT JOIN category_user cu 
            ON u.id = cu.user_id 
            WHERE cu.category_id
            IN (' . $cat . ') GROUP BY u.id';


        $restaurants = DB::select(DB::raw($sql_quey));

        $final = [];

        foreach ($restaurants as $restaurant) {

            if ($categories == $restaurant->category) {

                array_push($final, $restaurant);
            }
        }

        $data = $this->paginate($final);

        return [$data];
    }


    public function paginate($items, $perPage = 10, $page = null, $options = [])
    {
        $page = $page ?: (PaginationPaginator::resolveCurrentPage() ?: 1);
        $items = $items instanceof Collection ? $items : Collection::make($items);
        return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Restaurant  $restaurant
     * @return \Illuminate\Http\Response
     */
    public function show(User $restaurant)
    {
        $restaurant_id = User::with('dishes')->where('id', $restaurant->id)->get();
        return new RestaurantResource($restaurant_id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Restaurant  $restaurant
     * @return \Illuminate\Http\Response
     */
    public function edit(Restaurant $restaurant)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Restaurant  $restaurant
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Restaurant $restaurant)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Restaurant  $restaurant
     * @return \Illuminate\Http\Response
     */
    public function destroy(Restaurant $restaurant)
    {
        //
    }
}
