<?php

namespace App\Livewire;

use App\Models\Jadwal;
use Livewire\Component;

class ContohCrud extends Component
{
    //variabel yg akan diolah
    public $hari, $mapel;
    // variable yg akan menampilkan semua jadwal di frontend
    public $semuaJadwal;

    protected $rules = [
        'hari' => 'required|string|max:255',
        'mapel' => 'required|string|max:255',
    ];
    // function yg akan di render pertama kali ketika diload
    public function mount()
    {
        // mendapatkan semua data dari tabel jadwal pada database
        $this->semuaJadwal = Jadwal::query()->get();
    }

    // ketika button diklik akan memunculkan aksi
    public function submit()
    {
        //buat inisiasi awal ketika button diklik maka otomatis create di table jadwal
        $jadwals = new Jadwal();
        // menyesuaikan isian pada frontend
        $jadwals->hari = $this->hari;
        $jadwals->mata_pelajaran = $this->mapel;
        // menyimpan pada tabel 
        $jadwals->save();
        // reload page
        return redirect(route('contoh.crud'));
    }

    public function edit($id)
    {
        $jadwal = Jadwal::find($id);
        if ($jadwal) {
            $this->hari = $jadwal->hari;
            $this->mapel = $jadwal->mata_pelajaran;
        }
    }

    public function render()
    {
        return view('livewire.contoh-crud');
    }
}
