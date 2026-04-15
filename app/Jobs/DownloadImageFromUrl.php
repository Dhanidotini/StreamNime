<?php

namespace App\Jobs;

use App\Models\User;
use Filament\Actions\Action;
use Filament\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class DownloadImageFromUrl implements ShouldQueue
{
    use Queueable;

    public function __construct(
        public $model,
        public string $url,
        public string $collection
    ) {}

    public function handle(): void
    {
        $this->model->addMediaFromUrl($this->url)
            ->toMediaCollection($this->collection);

        Notification::make()
            ->success()
            ->title("Success Import Image {$this->collection}")
            ->body("Image for colleciton $this->collection has successfull imported!")
            ->actions([
                Action::make('See')
                    ->button()
                    ->url(fn () => request()->header('Referer'))
            ])
            ->sendToDatabase(User::first());
    }
}
