<?php namespace TypiCMS\Services;

use Route;
use Request;
use DB;
use Config;

class Helpers {
	
	public function __construct()
	{
	}

	/**
	 * I have slug, give me id.
	 *
	 * @param string $module
	 * @param string $slug
	 * @return integer
	 */
	public static function getIdFromSlug($module = null, $slug = null)
	{
		if ( ! $module or ! $slug) return false;

		return DB::table($module)
				->join($module.'_translations', $module.'.id', '=', $module.'_translations.'.str_singular($module).'_id')
				->where('slug', $slug)
				->remember(10)
				->pluck($module.'.id');
	}


	/**
	 * I have id, give me slugs.
	 *
	 * @param string $module
	 * @param int    $id
	 * @return Array
	 */
	public static function getSlugsFromId($module = null, $id = null)
	{
		if ( ! $module or ! $id) return false;

		return DB::table($module)
				->join($module.'_translations', $module.'.id', '=', $module.'_translations.'.str_singular($module).'_id')
				->where($module.'.id', $id)
				->where($module.'_translations.status', 1)
				->remember(10)
				->lists('slug', 'lang');
	}


	/**
	 * I have id, give me slugs.
	 *
	 * @param string $module
	 * @param int    $id
	 * @return Array
	 */
	public static function getAdminUrl()
	{
		$routeArray = explode('.', \Route::currentRouteName());

		$module = isset($routeArray[1]) ? $routeArray[1] : 'pages' ;

		// dd($routeArray);

		if (isset($routeArray[2])) {
			$id = $routeArray[2];
			if ($routeArray[2] == 'slug') {
				$segments = Request::segments();
				$slug = end($segments);
				$id = Helpers::getIdFromSlug($module, $slug);
			}
			$route = route('admin.'.$module.'.edit', $id);
		} else {
			$route = route('admin.'.$module.'.index');
		}

		if (in_array($routeArray[0], Config::get('app.locales'))) {
			$route .= '?locale='.$routeArray[0];
		}
		return $route;
	}

}
