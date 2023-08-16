<?php

namespace App\Console\Commands\Search;

use App\Models\Article;
use Illuminate\Console\Command;
use Meilisearch\Client;
use Meilisearch\Exceptions\ApiException;

class SetupSearchFilters extends Command
{
    protected $signature = 'scout:filters {index}';

    protected $description = 'Register filters against a search index.';

    public function handle(Client $client): int
    {
        $index = $this->argument(
            key: 'index',
        );

        $model = match($index) {
            'articles' => Article::class,
        };

        try {
            $this->info(
                string: "Updating filterable attributes for [$model] on index [$index]",
            );

            $client->index(
                uid: $index,
            )->updateFilterableAttributes(
                filterableAttributes: $model::getSearchFilterAttributes(),
            );
        } catch (ApiException $exception) {
            $this->warn(
                string: $exception->getMessage(),
            );

            return self::FAILURE;
        }

        return 0;
    }
}
