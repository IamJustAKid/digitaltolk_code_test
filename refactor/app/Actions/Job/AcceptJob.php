<?php
/**
 * Created by PhpStorm.
 * User: Bilal Younas
 * Date: 10/26/2019
 * Time: 6:59 PM
 */

namespace DTApi\Actions\Job;

use DTApi\Repository\BookingRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

use Modules\Base\Actions\ActivityHistory\CreateActivityHistory;


class AcceptJob
{
    private $repository;

    private $createActivityHistory;

    public function __construct(BookingRepository $repository, CreateActivityHistory $createActivityHistory)
    {
        $this->repository = $repository;

        $this->createActivityHistory = $createActivityHistory;
    }

    /**
     * @param array $data
     * @return mixed
     * @throws \CollectiveConscious\RepositoryDesignPattern\Exceptions\RepositoryException
     */
    public function execute(array $data)
    {
        // Accept Job Logic
        // Call EmailJobAccepted

        // Update Job Status
        $item = $this->repository->update([
            '' => '' ?? null,
        ], $data['id']);

        // Add ActivityHistory
        $this->createActivityHistory->execute([
            'related_model' => 'Job',
            'related_id' => $item->id,
            'related_name' => '',
            'type' => 'Created',
            'message' => Auth::user()->name . ' created a Job named: ' . '',
            'icon' => 'fa fa-plus text-info'
        ]);
    }
}

