<?php
declare(strict_types=1);

namespace app\Services\Admin;

use app\Services\BaseService;

class PanelAdminService extends BaseService
{
    public function panel(): void
    {
        if (!empty($_SESSION['user']) && $_SESSION['user']['role'] === '0') {
            \header('Location: /articles');
        }
    }

}
