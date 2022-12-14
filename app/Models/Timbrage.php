<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Timbrage extends Model
{

    use HasFactory;

    /**
     * La table associée au modèle.
     *
     * @var string
     */
    // protected $table = 'taches';

    /**
     * La clé primaire associée à la table.
     *
     * @var string
     */
    // protected $primaryKey = 'id';

    /**
     * Validation des données
     * @return string[] qui contient les règles des propriétés
     */
    static function validateRules()
    {
        return [
            'date'    => 'required|date_format:Y-m-d',
            'heure'   => 'required|date_format:H:i',
            'type'    => 'string'
        ];
    }

    /**
     * Liste des attributs modifiables
     *
     * @var array
     */
    protected $fillable = [
        'date',
        'heure',
        'type',
    ];

    /**s
     * Liste des attributs cachés
     * Seront exclus dans les réponses
     *
     * @var array
     */
    protected $hidden = [
        'created_at',
        'updated_at'
    ];
}
