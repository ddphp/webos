<?php
namespace App\Http\Controllers\Admin\Tools;

use Illuminate\Http\Request;
use App\Models\Admin\Lists;
use App\Models\Admin\ListsChild;
use App\Models\Admin\Menu;

trait ProfileTrait
{
    private function profile(Request $request)
    {
        $type = $request->input('t');
        $id = $request->input('i');

        $t = [
            'menu' => null,
            'crumb' => [],
            'curr' => ''
        ];

        switch ($type) {
            case 'menu':
                $menuModel = Menu::find($id);
                $groupModel = $menuModel->group;
                $t['menu'] = $menuModel;
                $t['crumb'][] = ['name' => $groupModel->name, 'act' => ''];
                $t['crumb'][] = ['name' => $menuModel->name, 'act' => 'admin.profile', 'param' => "?t=menu&i={$menuModel->id}"];
                break;
            case 'list':
                $listModel = Lists::find($id);
                $menuModel = $listModel->menu;
                $groupModel = $menuModel->group;
                $t['menu'] = $menuModel;
                $t['crumb'][] = ['name' => $groupModel->name, 'act' => ''];
                $t['crumb'][] = ['name' => $menuModel->name, 'act' => 'admin.profile', 'param' => "?t=menu&i={$menuModel->id}"];
                $t['crumb'][] = ['name' => $listModel->name, 'act' => $listModel->act, 'param' => "?t=list&i={$listModel->id}"];
                $t['curr'] = $listModel->id;
                break;
            case 'item':
                $itemModel = ListsChild::find($id);
                $listModel = $itemModel->list;
                $menuModel = $listModel->menu;
                $groupModel = $menuModel->group;
                $t['menu'] = $menuModel;
                $t['crumb'][] = ['name' => $groupModel->name, 'act' => ''];
                $t['crumb'][] = ['name' => $menuModel->name, 'act' => 'admin.profile', 'param' => "?t=menu&i={$menuModel->id}"];
                $t['crumb'][] = ['name' => $listModel->name, 'act' => ''];
                $t['crumb'][] = ['name' => $itemModel->name, 'act' => $itemModel->act, 'param' => "?t=item&i={$itemModel->id}"];
                $t['curr'] = $listModel->id;
                break;
        }

        return $t;
    }
}