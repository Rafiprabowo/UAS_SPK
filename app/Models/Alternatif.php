<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Alternatif extends Model
{
    protected $table = "alternatifs";
    protected $primaryKey = "id";
    protected $keyType = "int";

    public $incrementing = true;

    public $timestamps = true;

    protected $fillable = [
        'nama_alternatif'
    ];

    public function decision_matrix()
    {
        return $this->hasMany(DecisionMatrix::class, 'alternatif_id', 'id');
    }

    public function isUsed()
    {
        // Pemeriksaan apakah id_alternatif telah digunakan di tabel decision_matrix
        return DecisionMatrix::where('alternatif_id', $this->id)->exists();
    }
}
