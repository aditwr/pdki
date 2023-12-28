@extends('dashboard.layouts.app')

@section('title', 'Dashboard')

@section('content')
    <div class="max-w-7xl">
        {{-- Breadcrumbs --}}
        <div class="text-sm breadcrumbs">
            <ul>
                <li>
                    <x-breadcrumb href="{{ route('permohonan') }}" text="Permohonan" />
                </li>
                <li>
                    <x-breadcrumb-add text="Ajukan Pendaftaran Merek" />
                </li>
            </ul>
        </div>

        <div class="flex justify-between w-full mt-8">
            <h1 class="text-3xl font-bold">
                Ajukan Pendaftaran Merek
            </h1>
        </div>

        <div x-data="{
            tab1active: function() {
                this.$refs.tab1.checked = true;
                this.$refs.tab2.checked = false
                this.$refs.tab3.checked = false
            },
            tab2active: function() {
                this.$refs.tab1.checked = false;
                this.$refs.tab2.checked = true
                this.$refs.tab3.checked = false
            },
            tab3active: function() {
                this.$refs.tab1.checked = false;
                this.$refs.tab2.checked = false
                this.$refs.tab3.checked = true
            },
        }">
            {{-- Stepper --}}
            <div class="flex justify-center max-w-5xl mt-8 mb-6">
                <ul class="steps">
                    <li class="step step-primary">Data Merek</li>
                    <li class="step">Data Pemohon</li>
                    <li class="step">Konsultan</li>
                </ul>
            </div>
            {{-- Form --}}
            <form action="{{ route('permohonan.pendaftaran-merek.store') }}" method="POST">
                @csrf
                <div role="tablist" class="max-w-5xl tabs tabs-lifted">
                    <input x-ref="tab1" type="radio" name="my_tabs_2" role="tab" class="tab" checked
                        aria-label="Data Merek" />
                    <div role="tabpanel" class="p-6 tab-content bg-base-100 border-base-300 rounded-box">
                        <div class="">
                            <div class="">
                                <x-dashboard.form.filepond.image-input name="logo_merek" label="Logo Merek"
                                    acceptedFileTypes="['image/png', 'image/jpeg', 'image/jpg']"
                                    containerClass="max-w-sm" />
                            </div>
                            {{-- Nama Merek --}}
                            <div class="">
                                <x-dashboard.form.text-input name="nama_merek" label="Nama Merek" placeholder="Nama Merek"
                                    value="" containerClass="max-w-3xl" />
                            </div>
                            <div class="">
                                <x-dashboard.form.text-input name="translasi" label="Translasi Merek" value=""
                                    placeholder="Translasi" containerClass="max-w-3xl" />
                            </div>
                            <div class="mb-3">
                                <x-dashboard.form.textarea name="jenis_barang_jasa" label="Jenis Barang atau Jasa"
                                    value=""
                                    placeholder="Jenis jasa, atau jenis makanan seperti bahan pokok, pakaian, minuman bersoda, dll"
                                    containerClass="max-w-3xl" />
                            </div>
                            <div class="mb-3">
                                <x-dashboard.form.select name="kelas_barang_jasa" label="Kategori Barang / Jasa"
                                    containerClass="" value="" :items="[
                                        '10' => 'Makanan',
                                        '20' => 'Minuman',
                                        '30' => 'Pakaian',
                                        '40' => 'Obat dan Kesehatan',
                                        '50' => 'Kosmetik',
                                        '60' => 'Alat Tulis',
                                        '70' => 'Alat Elektronik',
                                        '80' => 'Alat Rumah Tangga',
                                        '90' => 'Alat Kendaraan',
                                        '100' => 'Alat Bangunan',
                                        '110' => 'Alat Olahraga',
                                        '120' => 'Alat Musik',
                                        '130' => 'Alat Pertanian',
                                        '140' => 'Alat Perikanan',
                                        '150' => 'Alat Perkebunan',
                                        '160' => 'Alat Perhutanan',
                                        '170' => 'Alat Peternakan',
                                        '180' => 'Campuran',
                                    ]" />
                            </div>
                            <div class="">
                                <x-dashboard.form.file-input name="surat_keterangan_umk"
                                    acceptedFileTypes="['application/pdf']" label="Surat Keterangan UMK (Opsional)"
                                    containerClass="max-w-sm" />
                            </div>
                            <div class="">
                                <button type="button" @click="tab2active()" class="btn btn-primary">
                                    Selanjutnya
                                </button>
                            </div>
                        </div>
                    </div>

                    <input x-ref="tab2" type="radio" name="my_tabs_2" role="tab" class="tab"
                        aria-label="Data Pemohon" />
                    <div role="tabpanel" class="p-6 tab-content bg-base-100 border-base-300 rounded-box">
                        <div class="">
                            <div class="">
                                <x-dashboard.form.text-input name="pemohon" label="Pemohon Pengajuan"
                                    placeholder="Pemohon adalah perusahaan / personal yang mengajukan permohonan"
                                    value="" containerClass="max-w-3xl" />
                            </div>
                            <div class="">
                                <x-dashboard.form.textarea name="alamat_pemohon" label="Alamat Pemohon"
                                    placeholder="alamat perusahaan / personal yang mengajukan permohonan" value=""
                                    containerClass="max-w-3xl" />
                            </div>
                            <div class="flex gap-x-8">
                                <div class="w-72">
                                    <x-dashboard.form.text-input name="no_telepon_pemohon" label="Nomor Telepon Pemohon"
                                        placeholder="Nomor Telepon" value="" containerClass="" />
                                </div>
                                {{-- <div class="">
                                    <x-dashboard.form.text-input @keyup="search_country()" name="kewarganegaraan_pemohon"
                                        label="Kewarganegaraan Pemohon" placeholder="Nama Negara" value=""
                                        containerClass="" />
                                </div> --}}
                                {{-- Input Alpine Component --}}
                                <div x-data="{
                                    search: '',
                                    items: {{ json_encode($countries) }},
                                    get filteredItems() {
                                        if (this.search === '') {
                                            return this.items;
                                        }
                                        return this.items.filter((item) => {
                                            return item.toLowerCase().includes(this.search.toLowerCase());
                                        });
                                    },
                                    showModal: false,
                                    setValue(item) {
                                        this.showModal = false;
                                    },
                                }">
                                    <label class="w-full mb-3 form-control">
                                        <div class="label">
                                            <span class="text-base font-semibold label-text">Kewarganegaraan</span>
                                        </div>
                                        <div class="relative">
                                            <input x-model="search" name="kewarganegaraan_pemohon"
                                                id="kewarganegaraan_pemohon" type="text" @focus="showModal = true"
                                                placeholder="Kewarganegaraan" value=""
                                                class="w-full input input-bordered" />
                                            <div class="absolute z-50" x-show="showModal">
                                                <ul
                                                    class="block z-[1] overflow-y-auto menu p-2 shadow bg-base-100 rounded-box w-64 max-h-44 h-fit">
                                                    <template x-for="(item, index) in filteredItems"
                                                        :key="index">
                                                        <li class="menu-item">
                                                            <button type="button" class="font-semibold"
                                                                @click="search = item; showModal = false"
                                                                x-text="item"></button>
                                                        </li>
                                                    </template>
                                                </ul>
                                            </div>
                                        </div>
                                        @error('kewarganegaraan_pemohon')
                                            <div class="label">
                                                <span class="font-bold label-text-alt text-error">{{ $message }}</span>
                                            </div>
                                        @enderror
                                    </label>
                                </div>
                            </div>
                            <div class="">
                                <x-dashboard.form.file-input name="tanda_tangan_pemohon"
                                    acceptedFileTypes="['application/pdf']" label="Tanda Tangan Pemohon"
                                    containerClass="max-w-sm" />
                            </div>
                            <div class="">
                                <button type="button" @click="tab3active()" class="btn btn-primary">
                                    Selanjutnya
                                </button>
                            </div>
                        </div>
                    </div>

                    <input x-ref="tab3" type="radio" name="my_tabs_2" role="tab" class="tab"
                        aria-label="Konsultan" />
                    <div role="tabpanel" class="p-6 tab-content bg-base-100 border-base-300 rounded-box">
                        <div class="">
                            {{-- nama konsultan --}}
                            <div class="">
                                <x-dashboard.form.text-input name="konsultan" label="Nama Konsultan"
                                    placeholder="Nama Konsultan" value="" containerClass="max-w-3xl" />
                            </div>
                            {{-- alamat konsultan --}}
                            <div class="">
                                <x-dashboard.form.textarea name="alamat_konsultan" label="Alamat Konsultan"
                                    placeholder="Alamat Konsultan" value="" containerClass="max-w-3xl" />
                            </div>
                            {{-- no telepon konsultan --}}
                            <div class="flex gap-x-8">
                                <div class="w-72">
                                    <x-dashboard.form.text-input name="no_telepon_konsultan"
                                        label="Nomor Telepon Konsultan" placeholder="Nomor Telepon" value=""
                                        containerClass="" />
                                </div>
                                {{-- Alpine Input Component --}}
                                <div x-data="{
                                    search: '',
                                    items: {{ json_encode($countries) }},
                                    get filteredItems() {
                                        if (this.search === '') {
                                            return this.items;
                                        }
                                        return this.items.filter((item) => {
                                            return item.toLowerCase().includes(this.search.toLowerCase());
                                        });
                                    },
                                    showModal: false,
                                    setValue(item) {
                                        this.showModal = false;
                                    },
                                }">
                                    <label class="w-full mb-3 form-control">
                                        <div class="label">
                                            <span class="text-base font-semibold label-text">Kewarganegaraan</span>
                                        </div>
                                        <div class="relative">
                                            <input x-model="search" name="kewarganegaraan_konsultan"
                                                id="kewarganegaraan_konsultan" type="text" @focus="showModal = true"
                                                placeholder="Kewarganegaraan" value=""
                                                class="w-full input input-bordered" />
                                            <div class="absolute z-50" x-show="showModal">
                                                <ul
                                                    class="block z-[1] overflow-y-auto menu p-2 shadow bg-base-100 rounded-box w-64 max-h-44 h-fit">
                                                    <template x-for="(item, index) in filteredItems"
                                                        :key="index">
                                                        <li class="menu-item">
                                                            <button type="button" class="font-semibold"
                                                                @click="search = item; showModal = false"
                                                                x-text="item"></button>
                                                        </li>
                                                    </template>
                                                </ul>
                                            </div>
                                        </div>
                                        @error('kewarganegaraan_konsultan')
                                            <div class="label">
                                                <span class="font-bold label-text-alt text-error">{{ $message }}</span>
                                            </div>
                                        @enderror
                                    </label>
                                </div>
                            </div>
                            <div class="">
                                <button type="submit" class="btn btn-primary">
                                    Ajukan Permohonan
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>

    </div>
@endsection
@push('scripts_body')
    <script>
        // alert('test')
    </script>
@endpush
