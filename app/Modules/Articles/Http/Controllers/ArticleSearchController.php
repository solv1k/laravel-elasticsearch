<?php

declare(strict_types=1);

namespace App\Modules\Articles\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Articles\Contracts\ArticleRepository;
use App\Modules\Articles\Http\Requests\ArticleSearchRequest;
use Illuminate\Contracts\View\View;

class ArticleSearchController extends Controller
{
    public function index(
        ArticleSearchRequest $request,
        ArticleRepository $articleRepository
    ): View {
        return view('modules.articles.search', [
            'articles' => $articleRepository
                ->search($request->q)
                ->paginate(
                    (int)$request->page ?: 1,
                    (int)$request->perPage ?: 15
                )
        ]);
    }
}
