<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GempaBumi extends Model
{
    use HasFactory;
    protected $guarded = [
        'id',
    ];

    protected $casts = [
        'tanggal' => 'date',
    ];


    // app/Models/GempaBumi.php

    public function getFormattedLintangAttribute()
    {
        $value = floatval(str_replace(',', '.', $this->lintang));
        $arah = $value < 0 ? 'LS' : 'LU';
        return abs($value) . '° ' . $arah;
    }

    public function getFormattedBujurAttribute()
    {
        $value = floatval(str_replace(',', '.', $this->bujur));
        return abs($value) . '° BT';
    }
}
