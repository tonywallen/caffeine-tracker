<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Drink;
use App\Models\UserDrinkXref;

class DrinkController extends Controller
{

    /**
     * Instantiate a new DrinkController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Get list of available drinks.
     *
     * @return Response
     */
    public function getAllDrinks()
    {
        return response()->json(['drinks' => Drink::all()], 200);
    }

    /**
     * Get single drink.
     *
     * @param int $id
     * @return Response
     */
    public function getDrinkById($id)
    {
        try {
            $drink = Drink::findOrFail($id);
            return response()->json(['drink' => $drink], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Drink not found!'], 404);
        }
    }

    /**
     * Gets all the drinks consumed by the user between the specified dates.
     *
     * @param Request $request
     * @return Response
     */
    public function getDrinksConsumedByUserByDate(Request $request)
    {
        $currentUser = Auth::user();

        $this->validate($request, [
            'user_id' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
        ]);

        $userId = $request->input('user_id');
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        if ($currentUser->id != $request->input('user_id')) {
            return response()->json(['message' => 'Failed to retrieve drinks for user!'], 409);
        }

        $drinksConsumed = UserDrinkXref::where('user_id', [$userId])
            ->whereBetween('created_at', [$startDate, $endDate])->get();

        return response()->json(['drinksConsumed' => $drinksConsumed], 201);
    }

    /**
     * Creates the drink/user relationship.
     *
     * @param Request $request
     * @return Response
     */
    public function setDrinkConsumedByUser(Request $request)
    {
        $currentUser = Auth::user();

        $this->validate($request, [
            'user_id' => 'required',
            'drink_id' => 'required',
        ]);

        $userDrinkXref = new UserDrinkXref();
        $userDrinkXref->user_id = $request->input('user_id');
        $userDrinkXref->drink_id = $request->input('drink_id');

        if (!$userDrinkXref->save() || $currentUser->id != $request->input('user_id')) {
            return response()->json(['message' => 'Drink consumed insertion Failed!'], 409);
        }

        return response()->json(['userDrinkXref' => $userDrinkXref, 'message' => 'Drink added.'], 201);
    }
}
