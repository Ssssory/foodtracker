<?php

namespace App\Http\Controllers;

use App\Models\Point;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PointController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(Point::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Request $request
     *
     * @return void
     */
    public function store(Request $request)
    {
        $this->validate(
            $request,
            [
                'login' => 'required|min:6',
                'password' => 'required|min:6',
                'name' => 'required|min:6',
                'restaurant_id' => 'required|int',
            ]
        );

        $newPoint = Point::create($request->all());

        return response()->json($newPoint);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $point = Point::findOrFail($id);

        return response()->json($point);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int                      $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate(
            $request,
            [
                'login' => 'nullable|min:6',
                'password' => 'nullable|min:6',
                'name' => 'nullable|min:6',
                'address' => 'nullable|int',
            ]
        );

        $point = Point::findOrFail($id);

        if ($request->address) {
            $point->fill(['address' => $request->address]);
        }

        if ($request->name) {
            $point->fill(['name' => $request->name]);
        }

        return response()->json($point);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return response()->json(self::TIME_LESS_TEXT, Response::HTTP_METHOD_NOT_ALLOWED);
    }
}
