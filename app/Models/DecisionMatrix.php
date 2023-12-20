<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class DecisionMatrix extends Model
{
    protected $table = "decision_matrices";
    protected $keyType = "int";
    protected $primaryKey = "id";
    public $incrementing = true;

    public $timestamps = true;
    protected $fillable = [
        'kriteria_id',
        'alternatif_id',
        'value'
    ];

    public function alternatif()
    {
        return $this->belongsTo(Alternatif::class, 'alternatif_id', 'id');
    }

    public function kriteria()
    {
        return $this->belongsTo(Kriteria::class, 'kriteria_id', 'id');
    }

}
