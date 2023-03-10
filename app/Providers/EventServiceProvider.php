<?php

namespace App\Providers;

use Domains\Catalog\Models\Observers\SkillObserver;
use Domains\Catalog\Models\Skill;
use Domains\Module\Models\Observers\TagObserver;
use Domains\Module\Models\Observers\TagTypeObserver;
use Domains\Module\Models\Tag;
use Domains\Module\Models\TagType;
use Domains\Shared\Models\Observers\UserBioObserver;
use Domains\Shared\Models\Observers\UserObserver;
use Domains\Shared\Models\User;
use Domains\Shared\Models\UserBio;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
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
        User::observe(UserObserver::class);
        UserBio::observe(UserBioObserver::class);
        Skill::observe(SkillObserver::class);
        Tag::observe(TagObserver::class);
        TagType::observe(TagTypeObserver::class);
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     */
    public function shouldDiscoverEvents(): bool
    {
        return false;
    }
}
