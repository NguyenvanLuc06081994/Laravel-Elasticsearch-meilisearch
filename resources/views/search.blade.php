<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Search') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 space-x-4">
                    <form action="/search" method="get" class="space-x-4 =">
                        <div class="flex items-baseline space-x-2">
                            <x-select name="user_id">
                               @foreach($users as $user)
                                   <option value="{{ $user->id }}" @if($user->id == request()->get('user_id')) selected @endif>{{ $user->name }}</option>
                               @endforeach
                            </x-select>
                            <x-text-input id="query" name="query"  type="search"
                                          placeholder="Search for something..." value="{{ request()->get('query') }}">
                            </x-text-input>
                            <x-secondary-button type="submit">Search</x-secondary-button>
                        </div>

                    </form>
                    @if(!$results)
                        <div class="space-y-4 mt-4">
                            No result
                        </div>
                    @else
                        <div class="space-y-4 mt-4">
                            @if($results->count())
                                <em>Find {{ $results->total() }} results</em>
                                @foreach($results as $article)
                                    <div>
                                        <h1 class="text-lg font-bold">{{ $article->title }} # {{ $article->id }}</h1>
                                        <p>{{ $article->teaser }}</p>
                                        <p>{{ $article->user->name }}</p>
                                    </div>
                                @endforeach
                                {{ $results->links() }}
                            @endif
                        </div>
                    @endif
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
