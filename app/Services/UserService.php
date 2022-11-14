<?php

namespace App\Services;

use App\Http\Requests\UserRequest;
use App\Repository\UserRepositoryInterface;
use App\Traits\RespondWithHttpStatus;
use Exception;
use Illuminate\Http\JsonResponse;
use Spatie\FlareClient\Http\Exceptions\NotFound;

class UserService
{
    use RespondWithHttpStatus;

    /**
     * @var UserRepositoryInterface
     */
    private UserRepositoryInterface $userRepository;

    /**
     * UserController constructor.
     *
     * @param UserRepositoryInterface $userRepository
     */
    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * Get all users with pagination.
     *
     * @return JsonResponse
     */
    public function all(): JsonResponse
    {
        $users = $this->userRepository->all();

        return $this->success('OK', 200, $users);
    }

    /**
     * Get a user with relations.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function find(int $id): JsonResponse
    {
        try {
            $user = $this->userRepository->find($id);
        } catch (NotFound $notFoundException) {
            return $this->failure($notFoundException->getMessage(), $notFoundException->getCode());
        }

        return $this->success('OK', 200, $user);
    }

    /**
     * Update user information.
     *
     * @param UserRequest $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(UserRequest $request, int $id): JsonResponse
    {
        try {
            $user = $this->userRepository->update($request->post(), $id);
        } catch (NotFound $notFoundException) {
            return $this->failure($notFoundException->getMessage(), $notFoundException->getCode());
        } catch (Exception) {
            return $this->failure('Bad Request', 400);
        }

        return $this->success('OK', 200, $user);
    }
}
