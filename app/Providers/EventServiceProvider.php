<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;
use App\Models\Document;
use App\Models\Classe;
use App\Models\Sponsor;
use App\Models\Monument;
use App\Observers\DocumentObserver;
use App\Observers\SponsorObserver;
use App\Observers\MonumentObserver;
use App\Observers\ClasseObserver;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The model observers for your application.
     *
     * @var array
     */
    protected $observers = [
        Document::class => [DocumentObserver::class],
        Monument::class => [MonumentObserver::class],
        Sponsor::class => [SponsorObserver::class],
        Classe::class => [ClasseObserver::class],
    ];

    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
    ];

    /**
     * Register any events for your application.
     */
    public function boot(): void
    {
        //
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     */
    public function shouldDiscoverEvents(): bool
    {
        return false;
    }
}
