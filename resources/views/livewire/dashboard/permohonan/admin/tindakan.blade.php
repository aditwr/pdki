<div class="p-6 border bg-base-200 w-[32rem] rounded-btn">
    @if ($status_permohonan == 0 || $status_permohonan == 2)
        <div class="">
            <span class="text-xl font-semibold">Tindakan</span>
        </div>
        <div class="w-full mt-2">
            <div role="tablist" class="tabs tabs-lifted">
                <input type="radio" name="my_tabs_2" role="tab" class="text-base font-semibold tab" checked
                    aria-label="Terima" />
                <div role="tabpanel" class="p-6 tab-content bg-base-100 border-base-300 rounded-box">
                    <div class="">
                        <p class="">Setelah menerima pendaftaran merek ini, maka merek akan secara resmi terdaftar
                        </p>
                        <div class="mt-3">
                            @if (!$profil_belum_lengkap)
                                <button @click="$wire.$refresh" wire:click="terima()"
                                    class="btn btn-primary">Terima</button>
                            @else
                                <div class="">
                                    <p class="font-semibold text-error">Data profil akun pembuat permohonan belum
                                        lengkap! Harap revisi permohonan ini dan minta pengguna akun untuk melengkapi
                                        data profilnya</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <input type="radio" name="my_tabs_2" role="tab" class="text-base font-semibold tab"
                    aria-label="Revisi" />
                <div role="tabpanel" class="p-6 tab-content bg-base-100 border-base-300 rounded-box">
                    <div class="">
                        <p class="">Permohonan akan dikembalikan dengan status revisi. Tindakan akan dapat
                            dilakukan
                            setelah permohonan pendaftaran merek direvisi oleh pemohon</p>
                        <div class="mt-2">
                            <label class="w-full mb-3 form-control">
                                <div class="label">
                                    <span class="text-base font-semibold label-text">Pesan Revisi</span>
                                </div>
                                <textarea wire:model='pesan_revisi' class="textarea textarea-bordered" placeholder="Tulis pesan revisi untuk pemohon"></textarea>
                            </label>
                        </div>
                        <div class="mt-3">
                            <button wire:click="revisi()" class="btn btn-primary">Revisi</button>
                        </div>
                    </div>
                </div>

                <input type="radio" name="my_tabs_2" role="tab" class="text-base font-semibold tab"
                    aria-label="Tolak" />
                <div role="tabpanel" class="p-6 tab-content bg-base-100 border-base-300 rounded-box">
                    <div class="">
                        <p class="">Permohonan pendaftaran merek akan ditolak, yang berarti merek tidak akan
                            terdaftar
                            dan pemohon perlu membuat permohonan pendaftaran merek yang baru jika ingin mencoba lagi.
                        </p>
                        <div class="mt-2">
                            <label class="w-full mb-3 form-control">
                                <div class="label">
                                    <span class="text-base font-semibold label-text">Pesan Penolakan</span>
                                </div>
                                <textarea wire:model='pesan_penolakan' class="textarea textarea-bordered"
                                    placeholder="Tulis alasan permohonan ditolak.."></textarea>
                            </label>
                        </div>
                        <div class="mt-3">
                            <button wire:click="tolak()" class="text-white btn btn-error">Tolak</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @elseif($status_permohonan == 1)
        <div class="flex items-center justify-center">
            <div class="">
                <span class="text-lg font-semibold">Menunggu pemohon merevisi permohonan..</span>
                <p class="mt-1 text-sm">Tindakan bisa dilakukan lagi setelah pemohon selesai merevisi permohonan ini</p>
                <x-dashboard.data.longtext label="Pesan Revisi" value="{{ $pendaftaran_merek->catatan_pemeriksa }}"
                    containerClass="w-full" valueClass="bg-base-100 text-neutral/90" />
            </div>
        </div>
    @elseif($status_permohonan == 3)
        <div class="flex items-center justify-center h-32">
            <div class="">
                <span class="text-lg font-semibold">Permohonan telah ditolak</span>
                <x-dashboard.data.longtext label="Alasan Penolakan" value="{{ $pendaftaran_merek->catatan_pemeriksa }}"
                    containerClass="w-full" valueClass="bg-base-100 text-neutral/90" />
            </div>
        </div>
    @elseif($status_permohonan == 4)
        <div class="">
            <div class="">
                <span class="text-lg font-semibold">Permohonan diterima</span>
                <p class="mt-1 text-sm">Merek ini telah terdaftar secara resmi</p>
            </div>
            <div class="mt-3">
                <!-- Open the modal using ID.showModal() method -->
                <button class="text-white btn btn-error" onclick="my_modal_5.showModal()">Cabut Merek</button>
                <dialog id="my_modal_5" class="modal modal-bottom sm:modal-middle">
                    <div class="modal-box">
                        <div class="">
                            <h3 class="text-lg font-bold text-error">Konfirmasi</h3>
                            <p class="py-4 text-sm">Apakah anda yakin ingin mencabut hak dan perlindungan merek ini?
                                Tindakan ini
                                tidak dapat dikembalikan. Setelah dicabut, merek akan terhapus secara permanen dari
                                database
                                merek terdaftar</p>
                            <div class="mt-2">
                                <label class="w-full mb-3 form-control">
                                    <div class="label">
                                        <span class="text-base font-semibold label-text">Alasan Pencabutan</span>
                                    </div>
                                    <textarea wire:model='pesan_pencabutan_merek' class="textarea textarea-bordered"
                                        placeholder="Tulis alasan merek dicabut.."></textarea>
                                </label>
                            </div>
                        </div>
                        <div class="modal-action">
                            <form method="dialog">
                                <button class="absolute btn btn-sm btn-circle btn-ghost right-2 top-2">✕</button>
                                <!-- if there is a button in form, it will close the modal -->
                                <div class="flex justify-end w-full gap-x-4">
                                    <button class="btn">Batal</button>
                                    <button wire:click="cabut()" class="text-white btn btn-error">Cabut</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </dialog>
            </div>
        </div>
    @elseif($status_permohonan == 5)
        <div class="flex items-center justify-start h-32">
            <div class="w-full">
                <span class="text-lg font-semibold">Merek telah dicabut</span>
                <x-dashboard.data.longtext label="Alasan Pencabutan"
                    value="{{ $pendaftaran_merek->catatan_pemeriksa }}" containerClass="w-full"
                    valueClass="bg-base-100 text-neutral/90" />
            </div>
        </div>
    @endif
</div>
@push('scripts_body')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            window.addEventListener('show-message', event => {
                window.Toastify({
                    text: '' + event.detail[0].message,
                    duration: -1,
                    newWindow: true,
                    close: true,
                    gravity: "top", // `top` or `bottom`
                    position: "right", // `left`, `center` or `right`
                    stopOnFocus: true, // Prevents dismissing of toast on hover
                    style: {
                        background: "#059669",
                        // boxShadow: "none",
                        // width: "600px",
                        height: "auto",
                        borderRadius: "8px",
                        display: "flex",
                        justifyItems: "space-between",
                        alignItems: "start",
                        gap: "1rem",
                    },
                    onClick: function() {} // Callback after click
                }).showToast();
            });

        });
    </script>
@endpush
