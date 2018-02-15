<?php

namespace App\Models;

use Cartalyst\Sentinel\Permissions\PermissibleTrait;
use Cartalyst\Sentinel\Permissions\PermissibleInterface;
use Cartalyst\Sentinel\Roles\RoleInterface;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;

class Role extends Model  implements RoleInterface, PermissibleInterface
{
    use PermissibleTrait;
    use Sluggable;

    /**
     * {@inheritDoc}
     */
    protected $table = 'roles';

    /**
     * {@inheritDoc}
     */
    protected $fillable = [
        'name',
        'slug',
        'permissions',
    ];

    /**
     * The Eloquent users model name.
     *
     * @var string
     */
    protected static $usersModel = 'App\Models\User';

    /**
     * {@inheritDoc}
     */
    public function delete()
    {
        $isSoftDeleted = array_key_exists('Illuminate\Database\Eloquent\SoftDeletes', class_uses($this));

        if ($this->exists && ! $isSoftDeleted) {
            $this->users()->detach();
        }

        return parent::delete();
    }

    /**
     * The Users relationship.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users()
    {
        return $this->belongsToMany(static::$usersModel, 'role_users', 'role_id', 'user_id')->withTimestamps();
    }

    /**
     * Get mutator for the "permissions" attribute.
     *
     * @param  mixed  $permissions
     * @return array
     */
    public function getPermissionsAttribute($permissions)
    {
        return $permissions ? json_decode($permissions, true) : [];
    }

    /**
     * Set mutator for the "permissions" attribute.
     *
     * @param  mixed  $permissions
     * @return void
     */
    public function setPermissionsAttribute(array $permissions)
    {
        $this->attributes['permissions'] = $permissions ? json_encode($permissions) : '';
    }

    /**
     * {@inheritDoc}
     */
    public function getRoleId()
    {
        return $this->getKey();
    }

    /**
     * {@inheritDoc}
     */
    public function getRoleSlug()
    {
        return $this->slug;
    }

    /**
     * {@inheritDoc}
     */
    public function getUsers()
    {
        return $this->users;
    }

    /**
     * {@inheritDoc}
     */
    public static function getUsersModel()
    {
        return static::$usersModel;
    }

    /**
     * {@inheritDoc}
     */
    public static function setUsersModel($usersModel)
    {
        static::$usersModel = $usersModel;
    }

    /**
     * Dynamically pass missing methods to the permissions.
     *
     * @param  string  $method
     * @param  array  $parameters
     * @return mixed
     */
    public function __call($method, $parameters)
    {
        $methods = ['hasAccess', 'hasAnyAccess'];

        if (in_array($method, $methods)) {
            $permissions = $this->getPermissionsInstance();

            return call_user_func_array([$permissions, $method], $parameters);
        }

        return parent::__call($method, $parameters);
    }

    /**
     * {@inheritDoc}
     */
    protected function createPermissions()
    {
        return new static::$permissionsClass($this->permissions);
    }

    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

}
