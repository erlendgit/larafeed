<?php


namespace App;


use Illuminate\Database\Eloquent\Builder;

/**
 * Query Builder for the Feed Model.
 *
 * @package App
 */
class FeedQueryBuilder extends Builder {

    public function filterEnabled()
    {
        $this->query->where('enabled', 1);
        return $this;
    }

}
