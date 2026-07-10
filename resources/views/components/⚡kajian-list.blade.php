<?php

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Url;

new class extends Component {
    use WithPagination;

    #[Url]
    public $search = '';

    #[Url]
    public $category = '';

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingCategory()
    {
        $this->resetPage();
    }

    public function setCategory($slug)
    {
        $this->category = $slug;
        $this->resetPage();
    }

    public function resetSearch()
    {
        $this->search = '';
        $this->resetPage();
    }

    public function resetFilters()
    {
        $this->reset(['search', 'category']);
        $this->resetPage();
    }

    public function with(): array
    {
        $query = \App\Models\KajianDetail::with(['kajian.kajianCategory', 'ustadz', 'location'])
            ->whereHas('kajian', function ($q) {
                $q->whereNull('deleted_at');
            });

        if ($this->category) {
            $query->whereHas('kajian.kajianCategory', function ($q) {
                $q->where('slug', $this->category);
            });
        }

        if ($this->search) {
            $query->where(function ($q) {
                $q->where('sub_title', 'like', '%' . $this->search . '%')
                    ->orWhereHas('kajian', function ($qk) {
                        $qk->where('title', 'like', '%' . $this->search . '%');
                    })
                    ->orWhereHas('ustadz', function ($qu) {
                        $qu->where('name', 'like', '%' . $this->search . '%');
                    });
            });
        }

        $kajianDetails = $query->orderBy('date', 'desc')
            ->orderBy('start_time', 'desc')
            ->paginate(6);

        $categories = \App\Models\KajianCategory::all();

        return [
            'kajianDetails' => $kajianDetails,
            'categories' => $categories,
        ];
    }
};
?>

<main id="kajian-all"
    class="scroll-mt-12 md:scroll-mt-18 lg:scroll-mt-20 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-24 pt-10">

    <!-- Filter & Search Bar Header -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-6 mb-10">
        <div>
            <h2 class="text-2xl font-extrabold text-slate-900 tracking-tight">Eksplorasi Jadwal Kajian</h2>
            <p class="text-sm text-slate-500 mt-1">Temukan Kajian Terdekat sesuai dengan Kebutuhan Anda sebagai menambah
                iman di setiap harinya.</p>
        </div>

        <!-- Search Controls -->
        <form wire:submit.prevent="" class="flex flex-col sm:flex-row gap-3 w-full md:w-auto">
            <div class="relative flex-1 sm:w-64">
                <input type="text" wire:model.live.debounce.300ms="search" placeholder="Cari judul atau ustadz..."
                    class="w-full bg-white border border-slate-200 text-sm rounded-xl pl-10 pr-4 py-3 focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition shadow-sm">
                <svg class="w-5 h-5 text-slate-400 absolute left-3 top-3.5" fill="none" stroke="currentColor"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                </svg>
            </div>
            @if($search)
                <button type="button" wire:click="resetSearch"
                    class="bg-white border border-slate-200 text-slate-700 font-medium text-sm px-5 py-3 rounded-xl flex items-center justify-center gap-2 hover:bg-slate-50 transition shadow-sm">
                    Reset Cari
                </button>
            @endif
        </form>
    </div>

    <!-- Category Pills -->
    <div class="flex items-center gap-2 overflow-x-auto pb-4 mb-8 no-scrollbar">
        <button type="button" wire:click="setCategory('')"
            class="px-5 py-2.5 rounded-full text-xs font-semibold whitespace-nowrap transition {{ !$category ? 'bg-primary text-white shadow-sm' : 'bg-white hover:bg-slate-100 border border-slate-200 text-slate-600' }}">
            Semua Kajian
        </button>
        @foreach($categories as $cat)
            <button type="button" wire:click="setCategory('{{ $cat->slug }}')"
                class="px-5 py-2.5 rounded-full text-xs font-semibold whitespace-nowrap transition {{ $category == $cat->slug ? 'bg-primary text-white shadow-sm' : 'bg-white hover:bg-slate-100 border border-slate-200 text-slate-600' }}">
                {{ $cat->name }}
            </button>
        @endforeach
    </div>

    <!-- GRID LIST KAJIAN -->
    @if($kajianDetails->isEmpty())
        <div class="text-center py-20 bg-white rounded-2xl border border-slate-100 shadow-xs animate-fade-in">
            <div class="w-16 h-16 bg-slate-100 rounded-full flex items-center justify-center mx-auto text-slate-400 mb-4">
                <iconify-icon icon="lucide:calendar-x" class="text-3xl"></iconify-icon>
            </div>
            <h3 class="font-bold text-slate-800 text-lg">Belum Ada Jadwal Kajian</h3>
            <p class="text-slate-500 text-sm mt-1 px-4">Tidak ditemukan jadwal kajian yang cocok dengan pencarian atau
                filter Anda.</p>
            <button type="button" wire:click="resetFilters"
                class="inline-block mt-4 text-xs bg-primary hover:bg-tertiary text-white font-bold px-4 py-2 rounded-lg transition">
                Lihat Semua Kajian
            </button>
        </div>
    @else
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($kajianDetails as $detail)
                @php
                    $categorySlug = $detail->kajian->kajianCategory->slug ?? '';
                    $gradient = match ($categorySlug) {
                        'fiqih', 'fiqih-muamalah' => 'from-primary to-tertiary',
                        'sirah-nabawiyah' => 'from-sun to-cookies',
                        default => 'from-amber-600 to-amber-800'
                    };
                    $badgeTextClass = match ($categorySlug) {
                        'fiqih', 'fiqih-muamalah' => 'text-primary',
                        'sirah-nabawiyah' => 'text-cookies',
                        default => 'text-amber-700'
                    };
                @endphp

                <div
                    class="bg-white rounded-2xl border border-slate-100 overflow-hidden shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 flex flex-col group animate-fade-in">

                    {{-- Card Header Banner --}}
                    <div
                        class="relative aspect-video bg-linear-to-r {{ $gradient }} flex items-center justify-center text-white p-4 overflow-hidden">
                        <span
                            class="absolute top-3 left-3 bg-white/90 backdrop-blur-sm {{ $badgeTextClass }} text-[10px] font-bold px-2.5 py-1 rounded-md shadow-sm uppercase">
                            {{ $detail->kajian->kajianCategory->name ?? 'Kajian' }}
                        </span>
                        @if($detail->location->type === 'Online')
                            <span
                                class="absolute top-3 right-3 bg-red-500 text-white text-[10px] font-bold px-2.5 py-1 rounded-md shadow-sm flex items-center gap-1">
                                <span class="w-1.5 h-1.5 bg-white rounded-full animate-ping"></span> ONLINE
                            </span>
                        @else
                            <span
                                class="absolute top-3 right-3 bg-slate-900/50 backdrop-blur-sm text-white text-[10px] font-bold px-2.5 py-1 rounded-md shadow-sm uppercase">
                                {{ $detail->location->type ?? 'Offline' }}
                            </span>
                        @endif
                        <div class="text-center group-hover:scale-105 transition duration-500">
                            <p class="text-xs text-white/85 font-medium capitalize">Kajian
                                {{ Str::of($detail->kajian->type)->replace('_', ' ') ?? 'Kajian Umum' }}
                            </p>
                            <p class="font-bold text-sm tracking-wide mt-1 px-4 line-clamp-2">
                                {{ $detail->kajian->title ?? '' }}
                            </p>
                        </div>
                    </div>

                    {{-- Card Body --}}
                    <div class="p-6 flex-1 flex flex-col justify-between">
                        <div>
                            <h3
                                class="font-bold text-slate-900 text-base leading-snug hover:text-primary transition duration-200 cursor-pointer line-clamp-2">
                                <a href="{{ route('kajian.show', $detail->id) }}" wire:navigate>
                                    {{ $detail->sub_title }}
                                </a>
                            </h3>
                            <p class="text-slate-600 text-sm font-medium mt-2 flex items-center gap-2">
                                <span
                                    class="w-6 h-6 rounded-full bg-slate-100 flex items-center justify-center text-xs font-bold text-slate-500 uppercase">
                                    {{ substr($detail->ustadz->name ?? 'U', 0, 1) }}
                                </span>
                                {{ $detail->ustadz->name }}
                            </p>
                        </div>

                        <div class="border-t border-slate-100 pt-4 mt-6 space-y-2 text-xs text-slate-500">
                            <div class="flex items-center gap-2">
                                <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <span>
                                    {{ \Carbon\Carbon::parse($detail->date)->isoFormat('dddd, D MMMM YYYY') }} |
                                    @if($detail->time_type === 'fixed')
                                        {{ \Carbon\Carbon::parse($detail->start_time)->format('H:i') }} WIB
                                    @else
                                        {{ $detail->time_phrase }}
                                    @endif
                                </span>
                            </div>
                            <div class="flex items-center gap-2">
                                <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                                    </path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                                <span class="truncate">{{ $detail->location->name }}</span>
                            </div>
                        </div>

                        <div class="mt-6">
                            <a href="{{ route('kajian.show', $detail->id) }}" wire:navigate
                                class="block w-full text-center bg-slate-50 hover:bg-primary/10 text-slate-700 hover:text-primary text-xs font-semibold py-3 rounded-xl border border-slate-200/60 hover:border-primary transition duration-300">
                                Lihat Detail
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif

    <!-- Pagination Loader Dynamic -->
    @if(!$kajianDetails->isEmpty())
        <div class="mt-16 flex justify-center">
            {{ $kajianDetails->links() }}
        </div>
    @endif

</main>