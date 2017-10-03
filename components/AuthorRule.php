<?php

namespace app\components;

/**
 * Created by PhpStorm.
 * User: Дима
 * Date: 09.09.2017
 * Time: 17:27
 */
class AuthorRule extends \yii\rbac\Rule
{
    public $name = 'isAuthor';
    /**
     * @param string|integer $user the user ID.
     * @param Item $item the role or permission that this rule is associated width.
     * @param array $params parameters passed to ManagerInterface::checkAccess().
     * @return boolean a value indicating whether the rule permits the role or permission it is associated with.
     */
    public function execute($user, $item, $params)
    {
        return isset($params['post']) ? $params['post']->user_id == $user : false;
    }
}