<?php

namespace App\Http\Controllers\API;

use App\Category_Users;
use App\CategoryUser;
use App\CategoryUsers;
use App\Http\Controllers\Controller;
use App\Http\Resources\RestaurantResource;
use App\Restaurant;
use App\User;
use CreateCategoriesTable;
use Facade\Ignition\QueryRecorder\Query;
use Hamcrest\Core\HasToString;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\QueryBuilder\QueryBuilder;
use Symfony\Component\Console\Helper\TableSeparator;

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

        // return  RestaurantResource::collection($final);
        return ['data' => $final];
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
