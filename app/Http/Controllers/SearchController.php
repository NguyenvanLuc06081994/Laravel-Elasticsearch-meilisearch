<?php

namespace App\Http\Controllers;

use App\Models\Article;
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
        if ($query = $request->get('query')) {
            $results = Article::search($query)->paginate(5);
        }
        return view('search', compact('results'));
    }
}
