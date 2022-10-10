<?php
/**
 * Created by PhpStorm.
 * User: Bilal Younas
 * Date: 10/26/2019
 * Time: 6:59 PM
 */

namespace DTApi\Actions;


use DTApi\Repositories\Criteria\GetCustomerJobs;
use DTApi\Repositories\Criteria\GetTranslatorJobs;
use DTApi\Repository\BookingRepository;
use DTApi\Repository\UserRepository;

class CheckParticularJob
{
    private $repository;
    private $userRepository;

    public function __construct(BookingRepository $repository, UserRepository $userRepository)
    {
        $this->repository = $repository;
        $this->userRepository = $userRepository;
    }

    /**
     * @param $user_id
     * @return mixed
     * @throws \CollectiveConscious\RepositoryDesignPattern\Exceptions\RepositoryException
     */
    public function execute($user_id, $job)
    {
        // Login here

        return [];
    }
}

