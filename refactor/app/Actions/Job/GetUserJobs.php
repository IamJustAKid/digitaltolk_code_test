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

class GetUserJobs
{
    private $repository;
    private $userRepository;

    private $checkParticularJob;

    public function __construct(BookingRepository $repository, UserRepository $userRepository, CheckParticularJob $checkParticularJob)
    {
        $this->repository = $repository;
        $this->userRepository = $userRepository;

        $this->checkParticularJob = $checkParticularJob;
    }

    /**
     * @param $user_id
     * @return mixed
     * @throws \CollectiveConscious\RepositoryDesignPattern\Exceptions\RepositoryException
     */
    public function execute($user_id)
    {
        $currentUser = $this->userRepository->with(['user.userMeta', 'user.average', 'translatorJobRel.user.average', 'language', 'feedback'])->find($user_id);
        $userType = '';

        $emergencyJobs = array();
        $noramlJobs = array();
        $jobs = array();

        if($currentUser) {
            if($currentUser->is('customer')) {
                // Using Push Criteria I can apply as many filters I want
                $jobs = $this->repository->pushCriteria(new GetCustomerJobs(['user_id' => $user_id]))->orderBy('due', 'asc')->get();
                $userType = 'customer';
            }

            if($currentUser->is('translator')) {
                $jobs = $this->repository->pushCriteria(new GetTranslatorJobs(['user_id' => $user_id, 'status' => ['new']]))->get();
                $userType = 'translator';
            }
        }

        if (count($jobs) > 0) {
            foreach ($jobs as $jobitem) {
                if ($jobitem->immediate == 'yes') {
                    $emergencyJobs[] = $jobitem;
                } else {
                    $noramlJobs[] = $jobitem;
                }
            }

            // Instead of this, Add Accessor Attribute USERCHECK in Job Model to process this. Or Add a Single Action Class to separate the logic from model
            $noramlJobs = collect($noramlJobs)->each(function ($item, $key) use ($user_id) {
                $item['usercheck'] = $this->checkParticularJob->execute($user_id, $item);
            })->sortBy('due')->all();
        }

        return ['emergencyJobs' => $emergencyJobs, 'noramlJobs' => $noramlJobs, 'cuser' => $currentUser, 'usertype' => $userType];
    }
}

