<?php

namespace App\MenuFilters;

use JeroenNoten\LaravelAdminLte\Menu\Filters\FilterInterface;
use JeroenNoten\LaravelAdminLte\Menu\Builder;

class RoleMenuFilter implements FilterInterface
{
    public function transform($item, Builder $builder)
    {
        if (!$this->isVisible($item)) {
            return false;
        }

        if (isset($item['header'])) {
            $item = $item['header'];
        }

        return $item;
    }

    protected function isVisible($item)
    {
        if (isset($item['roles'])) {
            if (!(auth()->user())->hasRole($item['roles'])) {
                return false;
            } else {
                return true;
            }
        }

        return true;
    }
}