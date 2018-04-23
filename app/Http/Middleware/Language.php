<?php

namespace App\Http\Middleware;

use App;
use Closure;
use Illuminate\Http\Request;

class Language {
	public function handle(Request $request, Closure $next) {
		// Check if the first segment matches a language code
		$locale = $request->segment(1);
		App::setLocale(!array_key_exists($locale, config('translatable.locales'))
			? config('translatable.fallback_locale')
			: $locale);

		return $next($request);
	}
}
