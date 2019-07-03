<?php

namespace App\Providers;

use DB;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Session;
use App;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        Session::put('locale', 1);
        $lang=Session::get('locale');
        $category = DB::table('categories')
            ->join('category_languages', 'category_languages.categore_id', '=', 'categories.id')
            ->select('categories.id as ids','category_languages.*')
            ->where('category_languages.language_id',$lang)
            ->get();
        // if(Session::get('cart'))
        // {
        //     dd(11111);
        //     $carcounter=count(Session::get('cart'));
        // }
        // else
        // {
        //     $carcounter=0;
        // }
     //   dd($carcounter);
        $about =App\Seetting::get();
        $village=App\VillageLanguage::where('language_id',$lang)->get();
        View::share('village',$village);
        // View::share('carcounter',$carcounter);
        View::share('about',$about);
        View::share('category',$category);

    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
