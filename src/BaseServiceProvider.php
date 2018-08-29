<?php

namespace Vismut\RelationJoiner;

use Vismut\RelationJoiner\Relations\JoinerFactory;
use Illuminate\Support\ServiceProvider as BaseProvider;

/**
 * @codeCoverageIgnore
 */
class BaseServiceProvider extends BaseProvider
{
    public function boot()
    {
        Builder::setJoinerFactory(new JoinerFactory);
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->registerJoiner();
    }

    /**
     * Register relation joiner factory.
     *
     * @return void
     */
    protected function registerJoiner()
    {
        $this->app->singleton('eloquence.joiner', function () {
            return new JoinerFactory;
        });

        $this->app->alias('eloquence.joiner', 'Vismut\RelationJoiner\Contracts\Relations\JoinerFactory');
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [
            'eloquence.joiner',
        ];
    }
}
