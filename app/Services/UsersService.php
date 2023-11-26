<?php

namespace App\Services;

use App\Enums\UserType;
use App\Repositories\UserRepository;

class UsersService {

    public $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function allCustomerUsers()
    {
        return $this->userRepository->findAll(['type' => UserType::CUSTOMER]);
    }

    public function deactivateUser($id)
    {
        $this->userRepository->updateWhere('id', $id, ['is_active' => 0]);
    }

    public function reactivateUser($id)
    {
        $this->userRepository->updateWhere('id', $id, ['is_active' => 1]);
    }

    public function destroy($id)
    {
        $this->userRepository->delete($id);
    }

    public function updateUser($userId, $data)
    {
        $this->userRepository->updateWhere('id', $userId, $data);
    }

    public function findOne($id)
    {
        return $this->userRepository->findOneBy(['id' => $id]);
    }

    public function search($data)
    {
        return $this->userRepository->search($data);
    }
}