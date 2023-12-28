<div class="mt-8 max-w-7xl">
    <div role="tablist" class="tabs tabs-lifted">
        <input type="radio" name="my_tabs_2" role="tab" class="tab" aria-label="Perlu Verifikasi" checked />
        <div role="tabpanel" class="p-6 tab-content bg-base-100 border-base-300 rounded-box">
            {{-- Content 1 --}}
            <div class="">
                <h3 class="mb-4 text-xl font-bold">Perlu Verifikasi</h3>
                @if (count($users_need_verification) > 0)
                    <div x-data="{
                        deleteId: null,
                        deleteMerek: '',
                    }" class="flex flex-col">
                        <div class="overflow-x-auto">
                            <div class="overflow-x-auto">
                                <table class="table">
                                    <!-- head -->
                                    <thead>
                                        <tr>
                                            <th>
                                                No
                                            </th>
                                            <th>Nama</th>
                                            <th>Email</th>
                                            <th>Tanggal Mendaftar</th>
                                            <th>Tindakan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($users_need_verification as $user)
                                            <tr>
                                                <th>
                                                    {{ $loop->iteration }}
                                                </th>
                                                <td>
                                                    <span class="">{{ $user->name }}</span>
                                                </td>
                                                <td>
                                                    <span class="">{{ $user->email }}</span>
                                                </td>
                                                <td>
                                                    <span class="">{{ formatDate($user->created_at) }}</span>
                                                </td>
                                                <th class="flex items-center gap-x-4">
                                                    <button wire:click="jadikanPemohon({{ $user->id }})"
                                                        class="btn hover:btn-neutral">Jadikan Pemohon</button>
                                                    <div class="">
                                                        <!-- Open the modal using ID.showModal() method -->
                                                        <button class="btn btn-ghost"
                                                            @click="my_modal_1.showModal(); deleteMerek = ''; deleteId='';"><svg
                                                                class="w-4 h-4 text-error" aria-hidden="true"
                                                                xmlns="http://www.w3.org/2000/svg" fill="none"
                                                                viewBox="0 0 18 20">
                                                                <path stroke="currentColor" stroke-linecap="round"
                                                                    stroke-linejoin="round" stroke-width="2"
                                                                    d="M1 5h16M7 8v8m4-8v8M7 1h4a1 1 0 0 1 1 1v3H6V2a1 1 0 0 1 1-1ZM3 5h12v13a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V5Z" />
                                                            </svg></button>

                                                    </div>
                                                </th>
                                            </tr>
                                        @endforeach
                                    </tbody>

                                </table>
                            </div>
                            {{-- delete Modal --}}
                            <dialog id="my_modal_1" class="modal">
                                <div class="modal-box">
                                    <h3 class="text-lg font-bold">Konfirmasi Hapus</h3>
                                    <p class="py-4">Apakah anda yakin ingin menghapus dan
                                        membatalkan
                                        permohonan pendaftaran
                                        merek <span x-text="deleteMerek" class="font-semibold"></span>
                                        ini?
                                    </p>
                                    <div class="modal-action">
                                        <form x-bind:action="'/permohonan/pendaftaran-merek/delete/' + deleteId"
                                            method="post">
                                            @csrf
                                            <!-- if there is a button in form, it will close the modal -->
                                            <button type="submit" class="btn btn-error">Hapus</button>
                                            <button @click="my_modal_1.close()" type="button"
                                                class="btn">Batal</button>
                                        </form>
                                    </div>
                                </div>
                            </dialog>
                            <div class="mt-4">
                                {{ $users_need_verification->links() }}
                            </div>
                        </div>
                    </div>
                @else
                    <div class="flex flex-col items-center justify-center w-full h-64">
                        <p class="mt-4 text-xl font-bold text-gray-500">Tidak ada pengguna baru yang perlu diverfikasi
                        </p>
                    </div>
                @endif
            </div>
        </div>

        <input type="radio" name="my_tabs_2" role="tab" class="tab" aria-label="Pengelolaan Pemohon" />
        <div role="tabpanel" class="p-6 tab-content bg-base-100 border-base-300 rounded-box">
            {{-- Content 2 --}}
            <div class="">
                <h3 class="mb-4 text-xl font-bold">Pengelolaan Pemohon</h3>
                @if (count($users_member) > 0)
                    <div x-data="{
                        deleteId: null,
                        deleteMerek: '',
                    }" class="flex flex-col">
                        <div class="overflow-x-auto">
                            <div class="overflow-x-auto">
                                <table class="table">
                                    <!-- head -->
                                    <thead>
                                        <tr>
                                            <th>
                                                No
                                            </th>
                                            <th>Nama</th>
                                            <th>Email</th>
                                            <th>Tanggal Mendaftar</th>
                                            <th>Tindakan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($users_member as $user)
                                            <tr>
                                                <th>
                                                    {{ $loop->iteration }}
                                                </th>
                                                <td>
                                                    <span class="">{{ $user->name }}</span>
                                                </td>
                                                <td>
                                                    <span class="">{{ $user->email }}</span>
                                                </td>
                                                <td>
                                                    <span class="">{{ formatDate($user->created_at) }}</span>
                                                </td>
                                                <th class="flex items-center gap-x-4">
                                                    <button wire:click="cabutMember({{ $user->id }})"
                                                        class="btn hover:btn-neutral">Cabut Member</button>
                                                    <button wire:click="jadikanAdmin({{ $user->id }})"
                                                        class="btn hover:btn-neutral">Jadikan Admin</button>
                                                    <div class="">
                                                        <!-- Open the modal using ID.showModal() method -->
                                                        <button class="btn btn-ghost"
                                                            @click="my_modal_1.showModal(); deleteMerek = ''; deleteId='';"><svg
                                                                class="w-4 h-4 text-error" aria-hidden="true"
                                                                xmlns="http://www.w3.org/2000/svg" fill="none"
                                                                viewBox="0 0 18 20">
                                                                <path stroke="currentColor" stroke-linecap="round"
                                                                    stroke-linejoin="round" stroke-width="2"
                                                                    d="M1 5h16M7 8v8m4-8v8M7 1h4a1 1 0 0 1 1 1v3H6V2a1 1 0 0 1 1-1ZM3 5h12v13a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V5Z" />
                                                            </svg></button>

                                                    </div>
                                                </th>
                                            </tr>
                                        @endforeach
                                    </tbody>

                                </table>
                            </div>
                            {{-- delete Modal --}}
                            <dialog id="my_modal_1" class="modal">
                                <div class="modal-box">
                                    <h3 class="text-lg font-bold">Konfirmasi Hapus</h3>
                                    <p class="py-4">Apakah anda yakin ingin menghapus dan
                                        membatalkan
                                        permohonan pendaftaran
                                        merek <span x-text="deleteMerek" class="font-semibold"></span>
                                        ini?
                                    </p>
                                    <div class="modal-action">
                                        <form x-bind:action="'/permohonan/pendaftaran-merek/delete/' + deleteId"
                                            method="post">
                                            @csrf
                                            <!-- if there is a button in form, it will close the modal -->
                                            <button type="submit" class="btn btn-error">Hapus</button>
                                            <button @click="my_modal_1.close()" type="button"
                                                class="btn">Batal</button>
                                        </form>
                                    </div>
                                </div>
                            </dialog>
                            <div class="mt-4">
                                {{ $users_member->links() }}
                            </div>
                        </div>
                    </div>
                @else
                    <div class="flex flex-col items-center justify-center w-full h-64">
                        <p class="mt-4 text-xl font-bold text-gray-500">Tidak ada pengguna yang berstatus sebagai
                            member
                        </p>
                    </div>
                @endif
            </div>
        </div>

        <input type="radio" name="my_tabs_2" role="tab" class="tab" aria-label="Pengelolaan Admin" />
        <div role="tabpanel" class="p-6 tab-content bg-base-100 border-base-300 rounded-box">
            {{-- Content 3 --}}
            <div class="">
                <h3 class="mb-4 text-xl font-bold">Pengelolaan Admin</h3>
                @if (count($users_admin) > 0)
                    <div x-data="{
                        deleteId: null,
                        deleteMerek: '',
                    }" class="flex flex-col">
                        <div class="overflow-x-auto">
                            <div class="overflow-x-auto">
                                <table class="table">
                                    <!-- head -->
                                    <thead>
                                        <tr>
                                            <th>
                                                No
                                            </th>
                                            <th>Nama</th>
                                            <th>Email</th>
                                            <th>Tanggal Mendaftar</th>
                                            <th>Tindakan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($users_admin as $user)
                                            <tr>
                                                <th>
                                                    {{ $loop->iteration }}
                                                </th>
                                                <td>
                                                    <span class="">{{ $user->name }}</span>
                                                </td>
                                                <td>
                                                    <span class="">{{ $user->email }}</span>
                                                </td>
                                                <td>
                                                    <span class="">{{ formatDate($user->created_at) }}</span>
                                                </td>
                                                <th class="flex items-center gap-x-4">
                                                    <button wire:click="cabutAdmin({{ $user->id }})"
                                                        class="btn hover:btn-neutral">Cabut Admin</button>
                                                    <div class="">
                                                        <!-- Open the modal using ID.showModal() method -->
                                                        <button class="btn btn-ghost"
                                                            @click="my_modal_1.showModal(); deleteMerek = ''; deleteId='';"><svg
                                                                class="w-4 h-4 text-error" aria-hidden="true"
                                                                xmlns="http://www.w3.org/2000/svg" fill="none"
                                                                viewBox="0 0 18 20">
                                                                <path stroke="currentColor" stroke-linecap="round"
                                                                    stroke-linejoin="round" stroke-width="2"
                                                                    d="M1 5h16M7 8v8m4-8v8M7 1h4a1 1 0 0 1 1 1v3H6V2a1 1 0 0 1 1-1ZM3 5h12v13a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V5Z" />
                                                            </svg></button>

                                                    </div>
                                                </th>
                                            </tr>
                                        @endforeach
                                    </tbody>

                                </table>
                            </div>
                            {{-- delete Modal --}}
                            <dialog id="my_modal_1" class="modal">
                                <div class="modal-box">
                                    <h3 class="text-lg font-bold">Konfirmasi Hapus</h3>
                                    <p class="py-4">Apakah anda yakin ingin menghapus dan
                                        membatalkan
                                        permohonan pendaftaran
                                        merek <span x-text="deleteMerek" class="font-semibold"></span>
                                        ini?
                                    </p>
                                    <div class="modal-action">
                                        <form x-bind:action="'/permohonan/pendaftaran-merek/delete/' + deleteId"
                                            method="post">
                                            @csrf
                                            <!-- if there is a button in form, it will close the modal -->
                                            <button type="submit" class="btn btn-error">Hapus</button>
                                            <button @click="my_modal_1.close()" type="button"
                                                class="btn">Batal</button>
                                        </form>
                                    </div>
                                </div>
                            </dialog>
                            <div class="mt-4">
                                {{ $users_admin->links() }}
                            </div>
                        </div>
                    </div>
                @else
                    <div class="flex flex-col items-center justify-center w-full h-64">
                        <p class="mt-4 text-xl font-bold text-gray-500">Tidak ada pengguna yang berstatus sebagai
                            admin
                        </p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@push('scripts_body')
    <script>
        // when the document is ready
        document.addEventListener("DOMContentLoaded", function(event) {
            window.addEventListener('showSuccess', event => {
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil',
                    text: event.detail[0].message,
                })
            });
        });
    </script>
@endpush
