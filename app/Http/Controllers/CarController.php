<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Car;

class CarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getCars()
    {
           return  [
                'cars' => Car::all(),
           ];
    }
    public function getCar($id)
    {
           return  [
                'car' => Car::find($id),
                'cars' => Car::inRandomOrder()->limit(5)->get(),
           ];
    }
    public function addCar(Request $request)
    {
        try{
                $car = new Car();
                $car->model = $request->get('model');
                $car->price = $request->get('price');
                $path = $request->file('photo')->store('public/cars');
                $car->photo = str_replace('public/', '', $path);
                $car->save();
                return ['succes'];
        } catch (\Exception $e) {
                return response()->json(['error' => 'error file upload', 400]);
        }
    }
}
