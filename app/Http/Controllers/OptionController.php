<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OptionController extends Controller
{
    public function getWeatherOptions()
    {
        $weatherOptions = ['Neigeux', 'Ensoleillé', 'Orageux', 'Nuageux', 'Pluie'];
        return response()->json($weatherOptions);
    }
    public function getDaytimeOptions()
    {
        $DaytimeOptions = ['Soirée', 'Après-midi', 'Matinée'];
        return response()->json($DaytimeOptions);
    }
    public function getRegionOptions()
    {
        $RegionOptions = ['Urbain', 'Rural', 'Périurbain'];
        return response()->json($RegionOptions);
    }   
    

}
