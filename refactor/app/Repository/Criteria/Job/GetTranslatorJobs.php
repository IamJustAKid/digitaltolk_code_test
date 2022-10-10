<?php
/**
 * Created by PhpStorm.
 * User: Bilal Younas
 * Date: 10/26/2019
 * Time: 6:59 PM
 */

namespace DTApi\Repositories\Criteria;

use CollectiveConscious\RepositoryDesignPattern\Contracts\CriteriaInterface;
use CollectiveConscious\RepositoryDesignPattern\Contracts\RepositoryInterface;


class GetTranslatorJobs implements CriteriaInterface
{
    public $data;

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function apply($model, RepositoryInterface $repository) {
        return $model->where('user_id', '=', $this->data['user_id'])
                     // Add Translator Related Logic Here
                     ->whereIn('status', $this->data['status']);
    }
}
