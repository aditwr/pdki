@extends('dashboard.layouts.app')

@section('title', 'Dashboard')

@section('content')
    <div class="max-w-7xl">
        {{-- Breadcrumbs --}}
        <div class="text-sm breadcrumbs">
            <ul>
                <li>
                    <x-breadcrumb href="{{ route('profil') }}" text="Profil" />
                </li>
                <li>
                    <x-breadcrumb-add text="Edit Profil" />
                </li>
            </ul>
        </div>

        <div class="flex justify-between w-full mt-8">
            <h1 class="text-3xl font-bold">
                Edit Profil
            </h1>
        </div>

        <div class="max-w-3xl">
            <form action="{{ route('profil.update') }}" method="POST" class="w-full" enctype="multipart/form-data">
                @csrf
                <div class="flex gap-x-8">
                    <div class="mb-3">
                        <label class="rounded-full w-52 form-control">
                            <div class="label">
                                <span class="text-base font-semibold label-text">Avatar</span>
                            </div>
                            <input name="avatar" id="avatar" type="file" class="w-52 filepond"
                                data-max-file-size="3MB" />
                            @error('avatar')
                                <div class="label">
                                    <span class="font-semibold label-text-alt text-error">{{ $message }}</span>
                                </div>
                            @enderror
                        </label>
                    </div>
                    <div class="flex flex-col w-full gap-x-4">
                        <div class="w-full mb-3">
                            <label class="w-full form-control">
                                <div class="label">
                                    <span class="text-base font-semibold label-text">Nama
                                        Lengkap</span>
                                </div>
                                <input name="nama_lengkap" type="text" placeholder="Nama Lengkap"
                                    value="{{ $user->name ?? '' }}" class="w-full input input-bordered" />
                                @error('nama_lengkap')
                                    <div class="label">
                                        <span class="font-semibold label-text-alt text-error">{{ $message }}</span>
                                    </div>
                                @enderror
                            </label>
                        </div>
                        <div class="flex w-full mb-3 gap-x-4">
                            <div class="flex-grow">
                                <label class="w-full form-control">
                                    <div class="label">
                                        <span class="text-base font-semibold label-text">No.
                                            Telepon</span>
                                    </div>
                                    <input name="nomor_telepon" type="text" placeholder="No. Telepon"
                                        value="{{ $user->phone ?? '' }}" class="w-full input input-bordered" />
                                    @error('nomor_telepon')
                                        <div class="label">
                                            <span class="font-semibold label-text-alt text-error">{{ $message }}</span>
                                        </div>
                                    @enderror
                                </label>
                            </div>
                            <div class="">
                                <label class="w-full form-control">
                                    <div class="label">
                                        <span class="text-base font-semibold label-text">Tanggal Lahir</span>
                                    </div>
                                    <input name="tanggal_lahir" type="date" placeholder="Nama Usaha"
                                        value="{{ $user->birth_date ?? '' }}" class="w-full input input-bordered" />
                                    @error('tanggal_lahir')
                                        <div class="label">
                                            <span class="font-semibold label-text-alt text-error">{{ $message }}</span>
                                        </div>
                                    @enderror
                                </label>
                            </div>
                        </div>
                        <div class="">
                            <label class="w-fit form-control">
                                <div class="label">
                                    <span name="nama_lengkap" class="text-base font-semibold label-text">Jenis
                                        Kelamin</span>
                                </div>
                                <select name="jenis_kelamin" class="w-full max-w-xs select select-bordered">
                                    <option disabled>Pilih</option>
                                    <option @if ($user->gender == 'l') selected @endif value="l">Laki-Laki
                                    </option>
                                    <option @if ($user->gender == 'p') selected @endif value="p">Perempuan
                                    </option>
                                </select>
                                @error('jenis_kelamin')
                                    <div class="label">
                                        <span class="font-semibold label-text-alt text-error">{{ $message }}</span>
                                    </div>
                                @enderror
                            </label>
                        </div>
                    </div>
                </div>
                <div class="flex max-w-3xl gap-x-4">
                    <div class="w-full mb-3">
                        <label class="w-full form-control">
                            <div class="label">
                                <span class="text-base font-semibold label-text">Pekerjaan / Jabatan</span>
                            </div>
                            <input name="pekerjaan_atau_jabatan" type="text" placeholder="Jenis Pekerjaan / Jabatan"
                                value="{{ $user->job ?? '' }}" class="w-full input input-bordered" />
                            @error('pekerjaan_atau_jataban')
                                <div class="label">
                                    <span class="font-semibold label-text-alt text-error">{{ $message }}</span>
                                </div>
                            @enderror
                        </label>
                    </div>
                    <div class="w-full mb-3">
                        <label class="w-full form-control">
                            <div class="label">
                                <span class="text-base font-semibold label-text">Perusahaan</span>
                            </div>
                            <input name="perusahaan" type="text" placeholder="Perusahaan tempat bekerja"
                                value="{{ $user->company ?? '' }}" class="w-full input input-bordered" />
                            @error('perusahaan')
                                <div class="label">
                                    <span class="font-semibold label-text-alt text-error">{{ $message }}</span>
                                </div>
                            @enderror
                        </label>
                    </div>
                </div>
                <div class="mb-3">
                    <label class="w-full max-w-3xl form-control">
                        <div class="label">
                            <span class="text-base font-semibold label-text">Bio</span>
                        </div>
                        <textarea name="bio" class="textarea textarea-bordered" placeholder="Ceritakan Biografi anda...">{{ $user->bio ?? '' }}</textarea>
                        @error('bio')
                            <div class="label">
                                <span class="font-semibold label-text-alt text-error">{{ $message }}</span>
                            </div>
                        @enderror
                    </label>
                </div>
                <div class="mb-3">
                    <label class="w-full max-w-3xl form-control">
                        <div class="label">
                            <span class="text-base font-semibold label-text">Alamat</span>
                        </div>
                        <textarea name="alamat" class="textarea textarea-bordered" placeholder="Alamat tinggal anda">{{ $user->address ?? '' }}</textarea>
                        @error('alamat')
                            <div class="label">
                                <span class="font-semibold label-text-alt text-error">{{ $message }}</span>
                            </div>
                        @enderror
                    </label>
                </div>
                <div class="">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
@endsection
@push('scripts_body')
    <script>
        // if document ready
        document.addEventListener('DOMContentLoaded', function() {
            const avatarInput = document.getElementById('avatar');
            FilePond.create(avatarInput, {
                storeAsFile: true,
                acceptedFileTypes: ['image/jpg', 'image/jpeg', 'image/png'],
                // imageCropAspectRatio: '16:9',
                // // style
                labelIdle: 'Drag & Drop your avatar or <span class="font-semibold filepond--label-action">Browse</span>',
                stylePanelLayout: 'compact circle',
                allowReorder: true,
                filePosterMaxHeight: 256,

            });
        });
    </script>
@endpush
