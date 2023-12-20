<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Kriteria extends Model
{
    protected $table = "kriterias";
    protected $primaryKey = "id";

    protected $keyType = "int";

    public $incrementing = true;

    public $timestamps = true;

    protected $fillable = [
        'nama_kriteria',
        'bobot_kriteria',
        'jenis-kriteria'
    ];

    public function decision_matrix()
    {
        return $this->hasMany(DecisionMatrix::class, 'alternatif_id', 'id');
    }

}
