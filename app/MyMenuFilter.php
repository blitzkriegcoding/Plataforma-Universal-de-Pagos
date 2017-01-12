<?php

namespace App;

use JeroenNoten\LaravelAdminLte\Menu\Builder;
use JeroenNoten\LaravelAdminLte\Menu\Filters\FilterInterface;
use Entrust;

class MyMenuFilter implements FilterInterface
{
    public function transform($item, Builder $builder)
    {
        // if (isset($item['permission'] && !Entrust::can($item['permission']))) 
        if (isset($item['permission']) && !Entrust::can($item['permission']))
        {
            return false;
        }

        if (isset($item['header'])) {
            $item = $item['header'];
        }

        return $item;
    }
}