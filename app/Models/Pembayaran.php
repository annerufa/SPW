<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Pembayaran extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $table = 'Pembayaran';
    protected $dateFormat = 'Y-m-d';
    protected $primaryKey = 'bayar_id';
    protected $fillable = [
        'cust_id',
        'user_id',
        'tgl_pembayaran',
        'jumlah_bayar',
        'bulan_terbayar',
        'metode_bayar',
        'ket',
    ];
    public $timestamps = false;
    protected $casts = [
        'tgl_pembayaran' => 'date',
        'bulan_terbayar' => 'datetime',
    ];
    // protected $dates = ['tgl_pembayaran','bulan_terbayar'];
    public function customer()
    {
        return $this->belongsTo(Customer::class,'cust_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }
}
