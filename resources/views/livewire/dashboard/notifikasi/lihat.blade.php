<div x-data="{
    baca: function(id) {
        let notifikasi = document.getElementById('notifikasi-' + id);
        notifikasi.classList.remove('bg-neutral', 'text-neutral-content');
        notifikasi.classList.add('bg-base-200');
    }
}" class="flex-grow max-w-4xl p-6 mt-8 border rounded-btn">
    @if (count($notifikasis) > 0)
        @foreach ($notifikasis as $notifikasi)
            <div @click="baca({{ $notifikasi->id }})" wire:click="baca({{ $notifikasi->id }})"
                id="notifikasi-{{ $notifikasi->id }}"
                class="mb-3 border collapse collapse-arrow border-base-300 @if ($notifikasi->dibaca) bg-base-200 @else bg-neutral text-neutral-content @endif rounded-btn">
                <input type="checkbox" />
                <div class="font-medium collapse-title">
                    <div class="flex items-center justify-between gap-x-8">
                        <div class="text-base">
                            {{ $notifikasi->judul_notifikasi }}
                        </div>
                        <div class="flex items-center gap-x-2">
                            <svg class="w-4 h-4 text-neutral-300" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                fill="none" viewBox="0 0 20 20">
                                <path stroke="currentColor" stroke-linejoin="round" stroke-width="2"
                                    d="M10 6v4l3.276 3.276M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                            </svg>
                            <span class="text-xs">{{ $notifikasi->created_at->diffForHumans() }}</span>
                        </div>
                    </div>
                </div>
                <div class="collapse-content">
                    <p>{{ $notifikasi->isi_notifikasi }}</p>
                    <div class="mt-3">
                        <a href="{{ $notifikasi->link_notifikasi }}" class="btn btn-neutral">Lihat</a>
                    </div>
                </div>
            </div>
        @endforeach
        <div class="flex justify-center w-full mt-8">
            {{ $notifikasis->links() }}
        </div>
    @else
        <div class="flex flex-col items-center justify-center w-full h-64">
            <img src="{{ asset('assets/images/empty-box.png') }}" alt="" class="w-auto h-32">
            <p class="mt-4 text-xl font-bold text-gray-500">Tidak ada notifikasi saat ini</p>
        </div>
    @endif
</div>
@push('scripts_body')
    <script></script>
@endpush
