<?php

namespace Nhn\EloquentBuilder;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Arr;
use Illuminate\Support\ServiceProvider;

class EloquentBuilderServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot(): void
    {
        // Define the 'whereLike' macro
        Builder::macro('whereLike', function ($attributes, string $searchTerm) {
            return $this->where(function (Builder $query) use ($attributes, $searchTerm) {
                foreach (Arr::wrap($attributes) as $attribute) {
                    $query->when(
                        // Check if the attribute is not an expression and contains a dot (indicating a related model)
                        !($attribute instanceof \Illuminate\Contracts\Database\Query\Expression) &&
                            str_contains((string) $attribute, '.'),
                        function (Builder $query) use ($attribute, $searchTerm) {
                            // Split the attribute into a relation and related attribute
                            [$relation, $relatedAttribute] = explode('.', (string) $attribute);

                            // Perform a 'LIKE' search on the related model's attribute
                            $query->orWhereHas($relation, function (Builder $query) use ($relatedAttribute, $searchTerm) {
                                $query->where($relatedAttribute, 'LIKE', "%{$searchTerm}%");
                            });

                            // if need more deep nesting then commonet above code and 
                            // use below (which is not recommend)
                            // Split the attribute into a relation and related attribute
                            // $attrs = explode('.', (string) $attribute);
                            // $relatedAttribute = array_pop($attrs);
                            // $relation = implode('.', $attrs);

                            // Perform a 'LIKE' search on the related model's attribute
                            // $query->orWhereRelation($relation, $relatedAttribute, 'LIKE', "%{$searchTerm}%");
                        },
                        function (Builder $query) use ($attribute, $searchTerm) {
                            // Perform a 'LIKE' search on the current model's attribute
                            // also attribute can be an expression
                            $query->orWhere($attribute, 'LIKE', "%{$searchTerm}%");
                        }
                    );
                }
            });
        });
    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/boilerplate.php', 'boilerplate');
    }
}
