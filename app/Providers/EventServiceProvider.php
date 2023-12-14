<?php

namespace App\Providers;

use App\Models\Article;
use App\Models\Character;
use App\Observers\ArticleObserver;
use App\Observers\CharacterObserver;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;
use App\Models\Author;
use App\Models\Category;
use App\Models\Document;
use App\Models\Classe;
use App\Models\Sponsor;
use App\Models\Monument;
use App\Observers\AuthorObserver;
use App\Observers\CategoryObserver;
use App\Observers\DocumentObserver;
use App\Observers\ClasseObserver;
use App\Observers\SponsorObserver;
use App\Observers\MonumentObserver;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The model observers for your application.
     *
     * @var array
     */
    protected $observers = [
        Document::class => [DocumentObserver::class],
        Character::class => [CharacterObserver::class],
        Author::class => [AuthorObserver::class],
        Article::class => [ArticleObserver::class],
        Category::class => [CategoryObserver::class],
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
