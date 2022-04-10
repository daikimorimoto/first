<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Travel;
use App\Models\Plan;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        view()->composer('*', function ($view){
            //インスタンス化
            $plan_model = new Plan();
            //プランを取得
            $plans = $plan_model->getMyPlan();

            $travel = Travel::where('user_id', '=', \Auth::id())
            ->whereNull('deleted_at')
            ->orderBy('id', 'DESC')
            ->get();


            $view->with('plans', $plans)->with('travel', $travel);

        });
    }
}
