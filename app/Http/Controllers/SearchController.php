<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    /**
     * @param Request $request
     * @return Application|Factory|View|\Illuminate\Foundation\Application
     */
    public function __invoke(Request $request): \Illuminate\Foundation\Application|View|Factory|Application
    {
        $results = null;
        $users = User::query()->get();
        if ($query = $request->get('query')) {
            $results = Article::search($query, function ($meiliSearch, $query, $options) use ($request) {
                if ($userId = $request->get('user_id')) {
                    $options['filter'] = 'user_id=' . $userId;
                }
                return $meiliSearch->search($query, $options);
            })->paginate(5)
                ->withQueryString();
        }
        return view('search', compact('results', 'users'));
    }
}
