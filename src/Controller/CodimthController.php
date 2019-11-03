<?php

namespace Drupal\codimth_controller\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\user\Entity\User;

class CodimthController extends ControllerBase
{
    public function index()
    {
        $userlist = [];
        $ids = \Drupal::entityQuery('user')
            ->condition('status', 1)
            ->condition('roles', 'administrator')
            ->execute();
        $users = User::loadMultiple($ids);
        foreach ($users as $user) {
            $username = $user->get('name')->getString();
            $mail = $user->get('mail')->getString();
            $userlist[] = ['mail' => $mail, 'username' => $username];
        }

        return array(
            '#theme' => 'codimth',
            '#users' => $userlist
        );
    }
}
