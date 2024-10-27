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
                        </div>

                        <div class="mb-6">
                            <input type="text" name="mapel" id="mapel" wire:model="mapel"
                                placeholder="Mata Pelajaran"
                                class="w-full px-4 py-2 text-gray-700 bg-white border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition">
                        </div>

                        <button wire:click="submit"
                            class="w-full py-2 px-4 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-md transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                            Submit
                        </button>
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
                                        <div x-data="{ modalOpen: false }" @keydown.escape.window="modalOpen = false"
                                            @open-modal.window="modalOpen = true" class="relative z-50 w-auto h-auto">
                                            <button @click="modalOpen=true "
                                                class="inline-flex items-center justify-center h-10 px-4 py-2 text-sm font-medium transition-colors bg-white border rounded-md hover:bg-neutral-100 active:bg-white focus:bg-white focus:outline-none focus:ring-2 focus:ring-neutral-200/60 focus:ring-offset-2 disabled:opacity-50 disabled:pointer-events-none"
                                                wire:click='edit({{ $jadwal->id }})'>
                                                Edit
                                            </button>

                                            <template x-teleport="body">
                                                <div x-show="modalOpen"
                                                    class="fixed top-0 left-0 z-[99] flex items-center justify-center w-screen h-screen"
                                                    x-cloak @click.outside="modalOpen = false"
                                                    x-transition:enter="ease-out duration-300"
                                                    x-transition:enter-start="opacity-0"
                                                    x-transition:enter-end="opacity-100"
                                                    x-transition:leave="ease-in duration-300"
                                                    x-transition:leave-start="opacity-100"
                                                    x-transition:leave-end="opacity-0">

                                                    <div class="absolute inset-0 w-full h-full bg-black bg-opacity-40">
                                                    </div>

                                                    <div x-trap.inert.noscroll="modalOpen"
                                                        x-transition:enter="ease-out duration-300"
                                                        x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                                                        x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                                                        x-transition:leave="ease-in duration-200"
                                                        x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                                                        x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                                                        class="relative w-full py-6 bg-white px-7 sm:max-w-lg sm:rounded-lg">

                                                        <div class="flex items-center justify-between pb-2">
                                                            <h3 class="text-lg font-semibold">Edit</h3>
                                                            <button @click="modalOpen=false"
                                                                class="absolute top-0 right-0 flex items-center justify-center w-8 h-8 mt-5 mr-5 text-gray-600 rounded-full hover:text-gray-800 hover:bg-gray-50">
                                                                <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg"
                                                                    fill="none" viewBox="0 0 24 24"
                                                                    stroke-width="1.5" stroke="currentColor">
                                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                                        d="M6 18L18 6M6 6l12 12" />
                                                                </svg>
                                                            </button>
                                                        </div>

                                                        <div class="relative w-auto">
                                                            <div class="relative w-auto">
                                                                <input type="text" name="edit_hari"
                                                                    wire:model.lazy="{{ $hari }}"
                                                                    value="{{ $hari }}" placeholder="Hari"
                                                                    class="w-full px-4 py-2 text-gray-700 bg-white border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition mb-3">
                                                                <input type="text" name="edit_mapel"
                                                                    wire:model.lazy="{{ $mapel }}"
                                                                    value="{{ $mapel }}"
                                                                    placeholder="Mata Pelajaran"
                                                                    class="w-full px-4 py-2 text-gray-700 bg-white border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition mb-3">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </template>
                                        </div>
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
