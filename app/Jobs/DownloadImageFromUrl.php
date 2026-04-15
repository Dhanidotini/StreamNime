<?php

namespace App\Jobs;

use App\Models\User;
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
            ->title("Import image success")
            ->body("Image for {$this->collection} collection has successfull imported!")
            ->sendToDatabase(User::first());
    }
}
