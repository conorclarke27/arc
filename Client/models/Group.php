<?php require_once('Model.php'); ?>
<?php

class Group
{
    private $group_id;
    private $admin_id;
    private $recipient_ids;

    public function __construct($args)
    {
        if (!is_array($args)) {
            throw new Exception('User constructor requires an array');
        }
        $this->group_id         = $args['group_id'] ?? NULL;
        $this->recipient_ids    = $args['recipient_ids'] ?? NULL;
        $this->admin_id         = $args['admin_id'] ?? NULL;
    }
    public function getGroup_id()
    {
        return $this->group_id;
    }
    public function getRecipient_ids()
    {
        return $this->recipient_ids;
    }
    public function getAdmin_id()
    {
        return $this->admin_id;
    }
    public function setGroup_id($group_id)
    {
        if ($group_id === NULL) {
            $this->group_id = NULL;
            return;
        }
        $this->group_id = $group_id;
    }
    public function setRecipient_ids($recipient_ids)
    {
        if ($recipient_ids === NULL) {
            $this->recipient_ids = NULL;
            return;
        } else if (!is_array($recipient_ids)) {
            $this->recipient_ids = NULL;
            return;
        }
        $this->recipient_ids = $recipient_ids;
    }
    public function setAdmin_id($admin_id)
    {
        if ($admin_id === NULL) {
            $this->admin_id = NULL;
            return;
        }
        $this->admin_id = $admin_id;
    }
    public function addGroup($group, $db)
    {
        $statement = $db->prepare('INSERT into groups (admin_id) VALUES(:admin_id)');
        $statement->execute([
            'admin_id' => $group->getAdmin_id()
        ]);
        $saved = $statement->rowCount() === 1;

        if ($saved) {
            $group->setGroup_id($db->lastInsertId());
        }

        $statement2 = $db->prepare('INSERT into userspergroup (group_id, user_id) VALUES(:group_id, :user_id)');
        $statement2->execute([
            'group_id' => $group->getGroup_id(),
            'user_id' => $group->getRecipient_ids()
        ]);

        $statement3 = $db->prepare('INSERT into userspergroup (group_id, user_id) VALUES(:group_id, :user_id)');
        $statement3->execute([
            'group_id' => $group->getGroup_id(),
            'user_id' => $group->getAdmin_id()
        ]);
    }
    public static function getUsersByGroup_id($group_id, $db)
    {
        $group_id = (int) $group_id;

        $query = $db->prepare('SELECT u.user_id, u.name, p.group_id from userspergroup p inner join users u on p.user_id = u.user_id where p.group_id = :group_id;');
        $query->execute([
            'group_id' => $group_id
        ]);
        $users = $query->fetchAll();
        return $users;
    }

    public static function getGroupsByUser_id($user_id, $db)
    {
        $user_id = (int) $user_id;
        $query = $db->prepare('SELECT p.group_id, p.user_id, g.admin_id from userspergroup p inner join groups g on p.group_id = g.group_id where p.user_id = :user_id;');
        $query->execute([
            'user_id' => $user_id
        ]);
        return $query->fetchAll();
    }

    public function deleteGroupByGroup_id($group, $db)
    {
        $statement = $db->prepare('DELETE FROM groups WHERE group_id = :group_id');
        $statement = $db->execute([
            'group_' => $group->getGroup_id()
        ]);
    }
    public function addUserToGroup($group, $user_id, $db)
    {
        $statement2 = $db->prepare('INSERT into userspergroup (group_id, user_id) VALUES(:group_id, :user_id)');
        $statement2->execute([
            'group_id' => $group->getGroup_id(),
            'user_id' => $user_id
        ]);
        $group->setGroup_id($db->lastInsertId());
    }
}
