<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Area;
use App\Models\Paket;
use App\Models\Customer;
use Carbon\Carbon;
use Session;
use Dompdf\Dompdf;
use Illuminate\Support\Facades\View;
use Endroid\QrCode\Color\Color;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\ErrorCorrectionLevel;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Label\Label;
use Endroid\QrCode\Logo\Logo;
use Endroid\QrCode\RoundBlockSizeMode;
use Endroid\QrCode\Writer\PngWriter;
use Endroid\QrCode\Writer\ValidationException;


class C_Customer extends Controller
{
    // 
    public function index()
    {
        $customer = Customer::select('*','paket.bandwidth as nama_paket','area.nama_area as nama_area')
        ->join('area','area.area_id','=','customer.kd_area')
        ->join('paket','paket.paket_id','=','customer.paket_wifi')
        ->orderBy('updated_at', 'DESC')->paginate(10);
        return view('pegawai.customer', compact('customer'));
    }
    // show form create
    public function create()
    {
        $tanggal = Carbon::now()->toDateString();  
        $area = Area::all();
        $paket = Paket::all();
        return view('pegawai.addCust',compact('area','paket','tanggal'));
    }

    // save new cust
    public function store(Request $request){
        $kodeCust = $this->setCustCode($request->kode_area);
        
        $customer = Customer::create([
            'nama_cust' => $request->nama,
            'ip'=> $request->ip,
            'alamat'  => $request->alamat,
            'no_telp'=> $request->noTelp,
            'paket_wifi' => $request->paket_wifi,
            'kd_area'=> $request->kode_area,
            'biaya_pemasangan' => $request->biaya,
            'tgl_pemasangan' => $request->tgl_pasang,
            'kode_cust' => $kodeCust,
            'status' => 1,
            'updated_at' => Carbon::now()->timestamp,
            'created_at' => Carbon::now()->timestamp, 

        ]);
        Session::flash('message', 'Data Pegawai Berhasil Ditambahkan !');
        return redirect('/customer');
    }

    //show form edit
    public function edit($id)
    {
        $customer = Customer::select('*','paket.bandwidth as nama_paket','area.nama_area as nama_area')
        ->join('area','area.area_id','=','customer.kd_area')
        ->join('paket','paket.paket_id','=','customer.paket_wifi')->where('cust_id', $id)->first();
        $area = Area::all();
        $tanggal = Carbon::now()->toDateString();  
        $paket = Paket::all();
        return view('pegawai.editCust',compact('customer','area','paket','tanggal'));
    } 

    //update
    public function update(Request $request)
    {   
        $dataLama = Customer::where('cust_id', $request->cust_id)->first();
        if ($dataLama->kd_area == $request->kode_area) {
            $kodeCust = $dataLama->kode_cust;
        } else {
            $kodeCust = $this->setCustCode($request->kode_area);
        }        

        $customer = Customer::find($request->cust_id)->update([
            'nama_cust' => $request->nama,
            'ip'=> $request->ip,
            'alamat'  => $request->alamat,
            'no_telp'=> $request->noTelp,
            'paket_wifi' => $request->paket_wifi,
            'kd_area'=> $request->kode_area,
            'biaya_pemasangan' => $request->biaya,
            'tgl_pemasangan' => $request->tgl_pasang,
            'kode_cust' => $kodeCust,
            'updated_at' => Carbon::now()->timestamp,
        ]);

        Session::flash('message', 'Data Customer Berhasil Di Update !');
        return redirect('/customer');   
    }

    public function show($id){
        $customer = Customer::select('*','paket.bandwidth as nama_paket','area.nama_area as nama_area')->join('area','area.area_id','=','customer.kd_area')->join('paket','paket.paket_id','=','customer.paket_wifi')->where('cust_id', $id)->first();
        return response($customer);
    }
    
    public function hapus($id)
    {
        // echo("sdf");
        Customer::destroy($id);
        Session::flash('message', 'Data Pegawai Berhasil Dihapus !');
        return redirect('/customer');
        // $message = "Data Berhasil Di hapus !";
        // $customer = Customer::select('*','paket.bandwidth as nama_paket')->join('paket','paket.paket_id','=','customer.paket_wifi')->orderBy('updated_at', 'DESC')->get();
        // return view('pegawai.customer', compact('customer','message'));
    }
    public function destroy(Request $request,$id)
    {
        Customer::destroy($id);
        Session::flash('message', 'Data Pegawai Berhasil Dihapus !');
        return redirect('/customer');
    }

    public function setCustCode($kodeArea){
        if ((Customer::where('kd_area', $kodeArea)->count())==0) {
            $noCust = "0001";
        } else {
            $lastCust = Customer::where('kd_area', $kodeArea)->orderBy('updated_at','DESC')->first()->kode_cust;
            $arrayKode = explode("-",$lastCust);
            $kodeterakhir = intval($arrayKode[1]);
            $noCust = sprintf("%'.04d",($kodeterakhir+1));
        }
        $kArea = Area::select('kode_area')->where('area_id',$kodeArea)->value('kode_area');
        $kodeCust = $kArea.'-'.$noCust;
        return $kodeCust;
    }

    //cetak kartu Cust + qr Code
    public function createQr($id){
        $user = Customer::where('cust_id', $id)->value('nama_cust');
        //buat qr Code dan simpan gambar
        $writer = new PngWriter();    
        $qrCode = QrCode::create($id)
                ->setEncoding(new Encoding('UTF-8'))
                ->setErrorCorrectionLevel(ErrorCorrectionLevel::Low)
                ->setSize(200)
                ->setMargin(10);
        $result = $writer->write($qrCode, null, null);
        $result->saveToFile(public_path('/assets/img/qr/qr.png'));
        //cetak qr ke pdf
        $html = View::make('pegawai.kartu2',compact('user'))->render();
        $pdf = new Dompdf();
        $pdf->loadHtml($html);
        $pdf->set_option('isHtml5ParserEnabled', true); 
        $pdf->set_option('isRemoteEnabled', true);
        // Render PDF
        $pdf->render();
        //Tampilkan dokumen PDF dalam browser
        return $pdf->stream('kartu wifi bams-'.$user.'.pdf');
    }


    // cetak Rekap Customer
    public function cetakRekapCust(){
        $bulanTahun = Carbon::today()->toDateString();
        $customer = Customer::with('Paket','Area')->where('status',1)->orderBy('updated_at', 'DESC')->get();            
        
        $pdf = new Dompdf();

        // Load view file
        $html = View::make('owner.cetakRekap2',['customer' => $customer])->render();
    
        $pdf->loadHtml($html);
    
        // (Optional) Atur ukuran dan orientasi halaman
        $pdf->setPaper('legal', 'landscape');
    
        // Render PDF
        $pdf->render();
        
        // Tampilkan dokumen PDF dalam browser
        return $pdf->stream('Rekap Customer - '.$bulanTahun.'.pdf');
    }

    // cetak Kartu
    public function cek_kartu(){
        // $bulanTahun = Carbon::createFromFormat('Y-m', '2024-01');
        // echo($bulanTahun->year);
        // $customer = Customer::select('*','paket.bandwidth as nama_paket','area.nama_area as nama_area')
        //     ->join('area','area.area_id','=','customer.kode_area')
        //     ->join('paket','paket.paket_id','=','customer.paket_wifi')
        //     ->whereYear('created_at', $bulanTahun->year)
        //     ->whereMonth('created_at', $bulanTahun->month)
        //     ->get();
        
            // return view('pembayaran.index', ['pembayaran' => $pembayaran]);
        $pdf = new Dompdf();

        // Load view file
        $html = View::make('pegawai.kartuCust')->render();
    
        $pdf->loadHtml($html);
    
        // (Optional) Atur ukuran dan orientasi halaman
        $pdf->setPaper( 'A5', 'landscape');
        $pdf->set_option('isHtml5ParserEnabled', true); 
        $pdf->set_option('isRemoteEnabled', true);
        // Render PDF
        $pdf->render();
        
        // Tampilkan dokumen PDF dalam browser
        return $pdf->stream('kartu.pdf');
    }

    public function cetak_pdf()
    {
        $pegawai = Pegawai::all();
    
        $pdf = PDF::loadview('pegawai_pdf',['pegawai'=>$pegawai]);
        return $pdf->download('laporan-pegawai-pdf');
    }

    public function cetakRekap(){
        $customer =  Customer::all();
        //cetak qr ke pdf
        $html = View::make('pegawai.kartu2',compact('user'))->render();

        $pdf = new Dompdf();
        $pdf->loadHtml($html);
        $pdf->set_option('isHtml5ParserEnabled', true); 
        $pdf->set_option('isRemoteEnabled', true);

        // Render PDF
        $pdf->render();
        
        //Tampilkan dokumen PDF dalam browser
        return $pdf->stream('kartu wifi bams-'.$user.'.pdf');
    }


    public function rekap()
    {
        $bulanTahun = Carbon::createFromFormat('Y-m', '2024-01');
        $bulan = $bulanTahun->month;
        $tahun = 
        $customer = Customer::select('*','paket.bandwidth as nama_paket','area.nama_area as nama_area')
            ->join('area','area.area_id','=','customer.kd_area')
            ->join('paket','paket.paket_id','=','customer.paket_wifi')
            ->whereYear('created_at', $bulanTahun->year)
            ->whereMonth('created_at', $bulanTahun->month)
            ->get();
        // $customer = Customer::select('*','paket.bandwidth as nama_paket')->join('paket','paket.paket_id','=','customer.paket_wifi')->whereMonth('created_at', Carbon::now()->month)->orderBy('created_at', 'DESC')->get();
        return view('owner.cetakRekap', compact('customer'));
    }

    public function findRekap($bulanRekap)
    {
        $bulanTahun = Carbon::createFromFormat('Y-m', $bulanRekap);
        $customer = Customer::with('Paket','Area')
            ->whereYear('created_at', $bulanTahun->year)
            ->whereMonth('created_at', $bulanTahun->month)
            ->get();
        // print($customer);
        $response["data"] = compact('customer');
        return response()->json($response, 200);
        // response($customer);
        // return view('owner.rekapCust', compact('customer'));
    }
    public function showRekap(){
        $customer = Customer::with('Paket','Area')->paginate(10);   
        if(Session::get('userRole')=='owner'){
            return view('owner.rekapCust', compact('customer'));
        }else{
            return view('pegawai.rekapCust', compact('customer'));
        }
    }
}