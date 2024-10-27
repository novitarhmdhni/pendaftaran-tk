<?php

namespace App\Livewire;

use App\Models\Jadwal;
use Livewire\Component;

class ContohCrud extends Component
{
    //variabel yg akan diolah
    public $hari, $mapel, $editId = null;
    // variable yg akan menampilkan semua jadwal di frontend
    public $semuaJadwal;

    protected $listeners = ['jadwalDisimpan' => 'mount'];

    //ini adalah rulesnya
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
        //membuat validate
        $this->validate();
        //buat inisiasi awal ketika button diklik maka otomatis create di table jadwal
        $jadwals = new Jadwal();
        // menyesuaikan isian pada frontend
        $jadwals->hari = $this->hari;
        $jadwals->mata_pelajaran = $this->mapel;
        // menyimpan pada tabel
        $jadwals->save();
        // reload data pada komponen
        $this->emit('jadwalDisimpan');

        $this->resetForm();
    }

    public function resetForm()
    {
        $this->hari = '';
        $this->mapel = '';
        $this->editId = null;
    }

    public function edit($id)
    {
        $jadwal = Jadwal::find($id);
        if ($jadwal) {
            $this->hari = $jadwal->hari;
            $this->mapel = $jadwal->mata_pelajaran;
            $this->editId = $jadwal->id;
        }
    }

    public function update()
    {
        $this->validate();

        if ($this->editId) {
            // Update data jadwal yang sudah ada
            $jadwal = Jadwal::find($this->editId);
            if ($jadwal) {
                $jadwal->hari = $this->hari;
                $jadwal->mata_pelajaran = $this->mapel;
                $jadwal->save();
            }

            // Emit event untuk reload data setelah update
            $this->emit('jadwalDisimpan');
        }

        // Reset form setelah update
        $this->resetForm();
    }

    public function render()
    {
        return view('livewire.contoh-crud');
    }
}
