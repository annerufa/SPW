<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Customer extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $table = 'Customer';
    protected $primaryKey = 'cust_id';
    protected $fillable = [
        'nama_cust',
        'ip',
        'kode_cust',
        'no_telp',
        'alamat',
        'kd_area',
        'tgl_pemasangan',
        'paket_wifi',
        'biaya_pemasangan',
        'status',
    ];
    public function paket()
    {
        return $this->belongsTo(Paket::class,'paket_wifi');
    }
    public function area()
    {
        return $this->belongsTo(Area::class,'kd_area');
    }
}
