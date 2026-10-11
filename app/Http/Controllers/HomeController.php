<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(Request $request): View
    {
        $search = trim((string) $request->query('q', ''));
        $minCastle = (int) $request->query('min_castle', 0);
        $minMight = (int) $request->query('min_might', 0);
        $role = trim((string) $request->query('role', ''));

        $products = Product::query()
            ->active()
            ->where('category', 'Lord Mobile')
            ->when($search !== '', function ($query) use ($search) {
                $query->where(function ($subQuery) use ($search) {
                    $subQuery->where('title', 'like', "%{$search}%")
                        ->orWhere('description', 'like', "%{$search}%")
                        ->orWhere('kingdom', 'like', "%{$search}%")
                        ->orWhere('account_role', 'like', "%{$search}%");
                });
            })
            ->when($minCastle > 0, fn ($query) => $query->where('castle_level', '>=', $minCastle))
            ->when($minMight > 0, fn ($query) => $query->where('might', '>=', $minMight))
            ->when($role !== '', fn ($query) => $query->where('account_role', $role))
            ->latest()
            ->paginate(9)
            ->withQueryString();

        $roles = Product::query()
            ->select('account_role')
            ->active()
            ->where('category', 'Lord Mobile')
            ->whereNotNull('account_role')
            ->where('account_role', '!=', '')
            ->distinct()
            ->orderBy('account_role')
            ->pluck('account_role');

        return view('home', [
            'products' => $products,
            'roles' => $roles,
            'search' => $search,
            'minCastle' => $minCastle,
            'minMight' => $minMight,
            'role' => $role,
        ]);
    }
}
