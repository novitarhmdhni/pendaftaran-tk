<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Crud') }}

        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="mt-10 mb-3 p-6 bg-gray-50 rounded-lg shadow-md w-full mx-auto mb-5">
                        <div class="mb-4">
                            <input type="text" name="hari" id="hari" wire:model="hari" placeholder="Hari"
                                class="w-full px-4 py-2 text-gray-700 bg-white border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition">
                            @error('hari')
                                <span class="text-xs text-red-800">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-6">
                            <input type="text" name="mapel" id="mapel" wire:model="mapel"
                                placeholder="Mata Pelajaran"
                                class="w-full px-4 py-2 text-gray-700 bg-white border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition">
                            @error('mapel')
                                <span class="text-xs text-red-800">{{ $message }}</span>
                            @enderror
                        </div>

                        @if ($editId)
                            <button wire:click="update"
                                class="w-full py-2 px-4 bg-green-600 hover:bg-green-700 text-white font-semibold rounded-md transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2">
                                Update
                            </button>
                        @else
                            <button wire:click="submit"
                                class="w-full py-2 px-4 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-md transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                                Create
                            </button>
                        @endif
                    </div>

                    <table class="min-w-full border border-gray-300">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="py-2 px-4 border-b text-left text-gray-600">Hari</th>
                                <th class="py-2 px-4 border-b text-left text-gray-600">Mata Pelajaran</th>
                                <th class="py-2 px-4 border-b text-left text-gray-600">Edit</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($semuaJadwal as $jadwal)
                                <tr class="hover:bg-gray-50">
                                    <td class="py-2 px-4 border-b">{{ $jadwal->hari }}</td>
                                    <td class="py-2 px-4 border-b">{{ $jadwal->mata_pelajaran }}</td>
                                    <td class="py-2 px-4 border-b">
                                        <button @click="modalOpen=true"
                                            class="inline-flex items-center justify-center h-10 px-4 py-2 text-sm font-medium transition-colors bg-white border rounded-md hover:bg-neutral-100 active:bg-white focus:bg-white focus:outline-none focus:ring-2 focus:ring-neutral-200/60 focus:ring-offset-2 disabled:opacity-50 disabled:pointer-events-none"
                                            wire:click="edit({{ $jadwal->id }})">Edit</button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="text-center py-2">Tidak Ada Data</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>

</div>
