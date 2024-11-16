<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Customer;
use App\Models\Pembayaran;
use Session;
use Carbon\Carbon;
use Dompdf\Dompdf;
use Illuminate\Support\Facades\View;

class C_Pembayaran extends Controller
{
    // form tambah user
    public function index()
    {

        $bayars = Pembayaran::with('Customer.Paket','Customer.Area','User')->paginate(10);
        // print($bayars);
        //             ->join('customer','customer.cust_id','=','pembayaran.cust')
        //             ->join('users','users.user_id','=','pembayaran.pegawai')
        //             ->orderBy('tgl_pembayaran', 'DESC')->paginate(10);
        return view('pegawai.pembayaran', compact('bayars'));
    }
    // show form create
    public function create()
    {
        $tanggal = Carbon::now()->toDateString();  
        $customer = Customer::all();
        // $paket = Paket::all();
        return view('pegawai.addBayar',compact('customer','tanggal'));
    }

    // tambah pembayaran baru
    public function store(Request $request){
        $cust_id= Customer::where('kode_cust', $request->kd_cust)->value('cust_id');
        $pembayaran = Pembayaran::create([
            'cust_id' => $cust_id,
            'user_id'=> Session::get('idUser'),
            'tgl_pembayaran'  => $request->tgl_bayar,
            'jumlah_bayar'=> $request->nominal,
            'bulan_terbayar' =>$request->bln_bayar,
            'metode_bayar'=> $request->metode,
            'ket' => $request->ket,
        ]);
        Session::flash('message', 'Data Pembayaran Berhasil Ditambahkan !');
        return redirect('/pembayaran');
    }
    //show form edit
    public function edit($id)
    {
        $bayar = Pembayaran::with('Customer.Paket','Customer.Area','User')->where('bayar_id', $id)->first();
        // print($bayar);
        $tanggal = Carbon::now()->toDateString();  
        return view('pegawai.editBayar',compact('bayar','tanggal'));
    }

    // form 
    public function update(Request $request)
    {
        $cust_id= Customer::where('kode_cust', $request->kd_cust)->value('cust_id');
        $bayar = Pembayaran::find($request->bayar_id)->update([
            'cust' => $cust_id,
            'pegawai'=> Session::get('idUser'),
            'tgl_pembayaran'  => $request->tgl_bayar,
            'jumlah_bayar'=> $request->nominal,
            'bulan_terbayar' =>$request->bln_bayar,
            'metode_bayar'=> $request->metode,
            'ket' => $request->ket,
        ]);
        Session::flash('message', 'Data Pembayaran Berhasil Di Update !');
        return redirect('/pembayaran');
    } 
    public function show($id){
        $bayar = Pembayaran::select(
            'pembayaran.*', 
            'customer.nama_cust', 
            'customer.kd_area', 
            'area.nama_area', 
            'users.nama'
            )
            ->join('customer', 'customer.cust_id', '=', 'pembayaran.cust_id')
            ->join('area', 'area.area_id', '=', 'customer.kd_area')
            ->join('users', 'users.user_id', '=', 'pembayaran.user_id')
            ->where('pembayaran.bayar_id', $id)
            ->first();
        // $bayar = Pembayaran::select('*','paket.bandwidth as nama_paket','area.nama_area as nama_area')
        //         ->join('customer','customer.cust_id','=','pembayaran.cust_id')
        //         ->join('paket','paket.paket_id','=','customer.paket_wifi')
        //         ->where('bayar_id', $id)->first();

        // $bayar = Pembayaran::with('Customer','Customer.Paket','Customer.Area','User')->where('bayar_id', $id)->first();
        $response = [
            'nama_cust' => $bayar->nama_cust,
            'tgl_pembayaran' => Carbon::parse($bayar->tgl_pembayaran)->format('d F Y'),
            'jumlah_bayar' => $bayar->jumlah_bayar,
            'bulan_terbayar' => $bayar->bulan_terbayar->format('F Y'),
            'metode_bayar' => $bayar->metode_bayar,
            'nama' => $bayar->nama
        ];
        return response()->json($response, 200);
        // return response($bayar);
    }

    public function destroy(Request $request,$id)
    {
        Pembayaran::destroy($id);
        Session::flash('message', 'Data Pembayaran Berhasil Dihapus !');
        return redirect('/pembayaran');
    }

    public function hapus($id)
    {
        User::destroy($id);
        $users = User::where('jabatan', 'pegawai')->get();
        $response["message"] = "Data Berhasil Di hapus !";
        $response["data"] = compact('users');
        return response()->json($response, 200);
    }

    public function showTagihan($id){
        $today = Carbon::now();
        $bayar = Pembayaran::where('cust_id', $id)
                ->whereYear('bulan_terbayar', $today->year)
                ->whereMonth('bulan_terbayar', $today->month)
                ->get();
        if ($bayar->isEmpty()) {
            $cust = Customer::with('Paket','Area')->where('cust_id',$id)->first();
            // print($cust);
            $tanggal = Carbon::now()->toDateString();  
            return view('pegawai.addBayarQr',compact('cust','tanggal'));
        }else{
            return view('pegawai.lunas');
        }
    }
    public function findRekap($bulanRekap)
    {
        $bulanTahun = Carbon::createFromFormat('Y-m', $bulanRekap);
        $bayar = Pembayaran::with('Customer.Paket','Customer.Area','User')
            ->whereYear('bulan_terbayar', $bulanTahun->year)
            ->whereMonth('bulan_terbayar', $bulanTahun->month)
            ->get();
        // print($bayar);
        $response["data"] = compact('bayar');
        return response()->json($response, 200);
        // response($customer);
        // return view('owner.rekapCust', compact('customer'));
    }
    public function showRekap(){
        $tgl = Carbon::now();
        $bayar = Pembayaran::with('Customer.Paket','Customer.Area','User')
                ->whereYear('bulan_terbayar', $tgl->year)
                ->whereMonth('bulan_terbayar', $tgl->month)
                ->get();        
        if(Session::get('userRole')=='owner'){
            return view('owner.rekapBayar', compact('bayar'));
        }else if(Session::get('userRole')=='pegawai'){
            return view('pegawai.rekapBayar', compact('bayar'));
        }
    }
    public function cetakRekapBayar($bulanTahun){
        // Pisahkan tahun dan bulan dari parameter
        [$tahun, $bulan] = explode('-', $bulanTahun);
        // Query untuk memfilter berdasarkan tgl_pembayaran
        $bayar = Pembayaran::select(
            'pembayaran.*', 
            'customer.nama_cust', 
            'customer.kd_area', 
            'area.nama_area', 
            'users.nama'
            )
        ->whereYear('tgl_pembayaran', $tahun)
        ->whereMonth('tgl_pembayaran', $bulan)
        ->join('customer', 'customer.cust_id', '=', 'pembayaran.cust_id')
        ->join('area', 'area.area_id', '=', 'customer.kd_area')
        ->join('users', 'users.user_id', '=', 'pembayaran.user_id')
        ->get();

        // $bulanTahun = Carbon::createFromFormat('Y-m', $bulanRekap);
        // $bayar = Pembayaran::with('Customer.Paket','Customer.Area','User')
        //     ->whereYear('bulan_terbayar', $bulanTahun->year)
        //     ->whereMonth('bulan_terbayar', $bulanTahun->month)
        //     ->get();

        
        $pdf = new Dompdf();

        // Load view file
        $html = View::make('owner.cetakRekap3',['bayar' => $bayar, 'tgl'=>$bulanTahun])->render();
    
        $pdf->loadHtml($html);
    
        // (Optional) Atur ukuran dan orientasi halaman
        $pdf->setPaper('legal', 'landscape');
    
        // Render PDF
        $pdf->render();
        
        // Tampilkan dokumen PDF dalam browser
        return $pdf->stream('Rekap Pembayaran - '.$bulanTahun.'.pdf');
    }

    // cetak Rekap Customer
    public function cetakKwitansi($idBayar){
        $bulanTahun = Carbon::today()->toDateString();
        // $customer = Customer::with('Paket','Area')->where('status',1)->get();            
        $bayar = Pembayaran::with('Customer.Paket','Customer.Area','User')
            ->where('bayar_id', $idBayar)
            ->first();
        $pdf = new Dompdf();

        // Load view file
        $html = View::make('pegawai.kwitansi',['bayar' => $bayar])->render();

        $pdf->loadHtml($html);

        // (Optional) Atur ukuran dan orientasi halaman
        $pdf->setPaper('A5', 'landscape');

        // Render PDF
        $pdf->render();
        
        // Tampilkan dokumen PDF dalam browser
        return $pdf->stream('Kwitansi '.$bayar->customer->nama_cust.' Tagihan - '.$bulanTahun.'.pdf');
    }
}