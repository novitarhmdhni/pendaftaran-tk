<?php

namespace App\Livewire;

use App\Models\Jadwal;
use GuzzleHttp\Psr7\Query;
use Livewire\Component;
use Livewire\WithPagination;

class ContohCrud extends Component
{
    use WithPagination;
    //variabel yg akan diolah
    public $hari, $mapel, $editId = null;
    // variable yg akan menampilkan semua jadwal di frontend
    // public $semuaJadwal;
    public $cari;
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
        // $this->semuaJadwal = Jadwal::query()->get();
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

        $this->resetForm(); //untuk menginisiasi form ketika disubmit menjadi kosong
    }

    public function resetForm()
    {
        $this->hari = '';
        $this->mapel = '';
        $this->editId = null;
    }

    public function edit($id)
    {
        //mencari jadwal sesuai id yg akan diedit
        $jadwal = Jadwal::find($id);
        // dd($jadwal);
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

    public function delete($id)
    {
        $jadwal = Jadwal::find($id);
        if ($jadwal) {
            $jadwal->delete();  // Menghapus data dari database
            $this->emit('jadwalDisimpan'); // Emit event untuk reload data setelah delete
        }
    }


    public function render()
    {
        // if ($this->cari) {
        //     dd($this->cari);
        // }
        $semuaJadwal = Jadwal::query()->orderBy('id', 'desc')
            // ->when(!empty($this->cari), function ($p) {
            //     $p->where(function ($query) {
            //         $query->where('hari', 'ilike', '%' . $this->cari . '%');
            //     });
            // })
            ->when(!empty($this->cari), function ($p) {
                $p->where('hari', 'ilike', '%' . $this->cari . '%')
                    ->orWhere('mata_pelajaran', 'ilike', '%' . $this->cari . '%');
            })
            ->paginate(5);
        return view('livewire.contoh-crud', compact('semuaJadwal'));
    }
}
