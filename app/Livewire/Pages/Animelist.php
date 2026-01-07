<?php

namespace App\Livewire\Pages;

use App\Models\Anime;
use App\Models\Genre;
use Livewire\Component;
use Livewire\Attributes\Url;
use Livewire\WithPagination;
use App\Enums\Anime\StatusEnum;
use App\Enums\Enums\Anime\TypeEnum;
use Illuminate\Database\Eloquent\Builder;

class Animelist extends Component
{
    use WithPagination;

    #[Url(as: 'q',)]
    public $search;

    #[Url(as: 's', keep: true)]
    public $searchStatus = 'all';

    #[Url(as: 't', keep: true)]
    public $searchType = [];

    #[Url(as: 'g', keep: true)]
    public $searchGenre = [];

    #[Url(as: 'o', keep: true)]
    public $sorterFilter = 'title_asc';

    #[Url(as: 'yf')]
    public $searchYearFrom;

    #[Url(as: 'yt')]
    public $searchYearTo;

    public $filterStatus, $filterType, $filterGenre, $filterYear;

    public function mount()
    {
        $this->filterStatus = StatusEnum::cases();
        $this->filterType = TypeEnum::cases();
        $this->filterGenre = Genre::all();
        $this->filterYear = range(date('Y'), 1900);
    }

    public function clearFilter()
    {
        $this->reset(['searchType', 'searchGenre', 'search', 'searchStatus', 'sorterFilter', 'searchYearFrom', 'searchYearTo']);
        $this->resetPage();
    }

    protected function getFilterData()
    {
        return Anime::query()
            ->when($this->searchStatus, function (Builder $query) {
                if ($this->searchStatus == "all") {
                    $query->whereIn("status", StatusEnum::all());
                } else {
                    $query->where("status", $this->searchStatus);
                }
            })
            ->when(!empty($this->searchType), function (Builder $query) {
                if (\in_array('all', $this->searchType)) {
                    $query->whereIn("type", TypeEnum::all());
                } else {
                    $query->whereIn("type", $this->searchType);
                }
            })
            ->when($this->searchGenre, function (Builder $query) {
                foreach ($this->searchGenre as $genreId) {
                    $query->wherehas('genres', function (Builder $subQuery) use ($genreId) {
                        $subQuery->where('genres.id', $genreId);
                    });
                }
            })
            ->when($this->sorterFilter, function (Builder $query) {
                match ($this->sorterFilter) {
                    'latest' => $query->orderBy('created_at'),
                    'top' => $query->orderBy('rating', 'desc'),
                    'title_desc' => $query->orderBy('title', 'desc'),
                    default => $query->orderBy('title'),
                };
            })
            ->when($this->searchYearFrom, function (Builder $query) {
                $query->whereYear('release_date', '>=', $this->searchYearFrom);
            })
            ->when($this->searchYearTo, function (Builder $query) {
                $query->whereYear('release_date', '<=', $this->searchYearTo);
            })
            ->where(function (Builder $query) {
                $query->where('title', 'like', "%{$this->search}%");
                $query->orWhere('synopsis', 'like', "%{$this->search}%");
            })
            ->with('genres')
            ->paginate(20)
            ->appends([
                'search' => $this->search,
                'status' => $this->filterStatus,
                'type' => $this->filterType,
                'genres' => $this->filterGenre,
                'sort' => $this->sorterFilter,
                'yearFrom' => $this->searchYearFrom,
                'yearTo' => $this->searchYearTo,
            ]);
    }

    public function render()
    {
        $paginateAnime = $this->getFilterData();

        return view('livewire.pages.animelist', ['paginateAnime' => $paginateAnime]);
    }
}
