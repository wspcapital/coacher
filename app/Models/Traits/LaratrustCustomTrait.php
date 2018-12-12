<?php
/**
 * Created by PhpStorm.
 * User: silivanov
 * Date: 01.11.16
 * Time: 16:19
 */

namespace App\Models\Traits;

use App\Models\Role,
    Illuminate\Database\Eloquent\Collection;

/**
 * Trait LaratrustCustomTrait
 * @package App\Models\Traits
 */
trait LaratrustCustomTrait
{
    /**
     * Update multiple roles to a user
     *
     * @param array $roles
     * @return $this
     */
    public function updateRoles($roles)
    {
        $this->deleteRoles();
        $this->saveRoles($roles);

        return $this;
    }

    /**
     * Delete multiple roles to a user
     *
     * @return $this
     */
    public function deleteRoles()
    {
        foreach ($this->roles as $role) {
            $this->detachRole($role->id);
        }

        return $this;
    }

    /**
     * Attach multiple roles to a user
     *
     * @param array $roles
     * @return $this
     */
    public function saveRoles($roles)
    {
        $default[] = 4;
        $rolesArr = $roles ?? $default;
        foreach ($rolesArr as $one) {
            $this->attachRole($one);
        }

        return $this;
    }

    /**
     * It returns the user to the role of the user
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getUserList()
    {
        return $this->getUsersRole('user');
    }

    /**
     * It returns the user to the role of the trainer
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getTrainersList()
    {
        return $this->getUsersRole('trainer');
    }

    /**
     * @return array
     */
    public function getTrainerListArray()
    {
        return $this->getUsersRoleArray('trainer');
    }

    /**
     * It returns the user to the role of the manager
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getManagerList()
    {
        return $this->getUsersRole('manager');
    }

    /**
     * @return array
     */
    public function getManagerListArray()
    {
        return $this->getUsersRoleArray('manager');
    }

    /**
     * It returns the user to the role of the admin
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAdminList()
    {
        return $this->getUsersRole('admin');
    }

    /**
     * @return array
     */
    public function getAdminListArray()
    {
        return $this->getUsersRoleArray('admin');
    }
    /**
     * @return Collection
     */
    public function getAssistantList()
    {
        $collection = $this->getTrainersList();
        return $collection->merge($this->getAdminList())->merge($this->getManagerList());
    }

    /**
     * @return array
     */
    public function getAssistantListArray()
    {
        $assistants = [];
        $this->getAssistantList()->map(function ($item) use (&$assistants) {
            $assistants[$item->id] = $item->full_name;
        });
        return $assistants;
    }

    /**
     * Returns a list of users for the role
     *
     * @param string $roleName
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getUsersRole(string $roleName)
    {
        return Role::where('name', $roleName)->first()->users()->checkBlock()->get();
    }

    /**
     * @param string $roleName
     * @return array
     */
    public function getUsersRoleArray(string $roleName)
    {
        $roles = [];
        Role::where('name', $roleName)->first()->users()->checkBlock()->get()->map(function ($item) use (&$roles) {
            $roles[$item->id] = $item->full_name;
        });
        return $roles;
    }
}
