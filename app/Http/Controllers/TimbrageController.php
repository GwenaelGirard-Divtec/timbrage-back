<?php

namespace App\Http\Controllers;


use App\Models\Timbrage;
use Illuminate\Http\Request;

class TimbrageController extends Controller
{
    /**
     * Affiche toutes les taches
     *
     * @response 200
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function showAllTimbrages()
    {
        return Timbrage::orderBy('date', 'ASC')->get();
    }

    /**
     * Affiche toutes les taches
     *
     * @response 200
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function showOneTimbrage($id)
    {
        return Timbrage::findOrFail($id);
    }

    /**
     * Affiche toutes les taches
     *
     * @response 200
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function showDay($date)
    {
        return Timbrage::orderBy('heure', 'ASC')->where('date', $date)->get();
    }

    public function addTimbrage(Request $request)
    {
        $capteursJour = Timbrage::orderBy('heure', 'ASC')->where('date', $request["date"])->get();
        $positionNewTimbrage = count($capteursJour) + 1;
        $indexNewTimbrage = count($capteursJour);

        if ($indexNewTimbrage != 0) {
            $heureRequest = explode(":", $request["heure"]);
            $heureBefore = explode(":",  $capteursJour[$indexNewTimbrage - 1]->heure);

            $timeRequest = mktime((int) $heureRequest[0], (int) $heureRequest[1]);
            $timeBefore = mktime((int) $heureBefore[0], (int) $heureBefore[1]);

            $cooldown = 60 * 5;


            if ($timeRequest <= $timeBefore) {
                return response()->json(['message' => 'Vous ne pouvez pas timbrer pour une heure antérieur au dernier timbrage'], 400);
            }

            if ($timeRequest < $timeBefore + $cooldown) {
                return response()->json(['message' => 'Vous devez attendre 5 min avant de pouvoir timbrer à nouveau'], 400);
            }
        }
        $this->validate($request, Timbrage::validateRules());
        $newTimbrage = $request->all();

        if ($positionNewTimbrage % 2 == 0) {
            $newTimbrage["type"] = "sortie";
        } else {
            $newTimbrage["type"] = "entrée";
        }
        
        return Timbrage::create($newTimbrage);
    }

    public function deleteLastTimbrage($date)
    {
        if(count(Timbrage::where('date', $date)->where('date', $date)->get()) == 0) {
            return response()->json(['message' => 'Aucun timbrage effectué aujourd\'hui'], 400);
        };

        Timbrage::orderBy('heure', 'DESC')->where('date', $date)->take(1)->delete();
        return response()->json(['message' => 'Détimbrage effectué avec succès'], 200);
    }
}
