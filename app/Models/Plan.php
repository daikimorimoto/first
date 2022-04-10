<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    use HasFactory;

    public function getMyPlan(){
        $query_travel = \Request::query('travel');

        //スケジュール絞り込み

            $plans = Plan::select('plans.*')
                ->leftJoin('travel', 'travel.title', '=', 'travel_title')
                ->where('travel_title', '=', $query_travel)
                ->where('plans.user_id', '=', \Auth::id())
                ->whereNull('plans.deleted_at')
                ->orderBy('plans.updated_at', 'DESC')
                ->get();

        return $plans;
}

}
