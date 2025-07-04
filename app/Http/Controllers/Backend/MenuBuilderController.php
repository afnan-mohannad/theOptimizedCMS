<?php

namespace App\Http\Controllers\Backend;

use App\Models\Menu;
use App\Models\MenuItem;
use App\Models\Permission;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Redirect;
use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Requests\Menus\StoreMenuItemRequest;
use App\Http\Requests\Menus\UpdateMenuItemRequest;

class MenuBuilderController extends Controller
{
    /**
     * Display the menu Builder
     *
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index($id)
    {
        Gate::authorize('app.menus.index');
        $menu = Menu::getMenuById($id);
        return view('backend.admin.menus.builder',compact('menu'));
    }

    /**
     * Create new menu item
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function itemCreate($id)
    {
        Gate::authorize('app.menus.create');
        $menu = Menu::findOrFail($id);
        $permissions = Permission::getAllPermissions();
        return view('backend.admin.menus.item.form',compact('menu','permissions'));
    }

    /**
     * Store new menu item
     * @param StoreMenuItemRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function itemStore(StoreMenuItemRequest $request, $id)
    {
        $menu = Menu::findOrFail($id);
        MenuItem::create([
            'permission_id'=>$request->permission,
            'menu_id' => $menu->id, 
            'type' => $request->type,
            'title' => [
                'ar'=> $request->title_ar,
                'en'=> $request->title_en
            ],
            'divider_title' => [
                'ar'=> $request->divider_title_ar,
                'en'=> $request->divider_title_en
            ],
            'url' => $request->url,
            'target' => $request->target,
            'icon_class' => $request->icon_class
        ]);
        session()->flash('success', __('admin.success_create', ['item'=>__('admin.menu_item')]));
        return redirect()->route('app.menus.builder',$menu->id);
    }

    /**
     * Edit menu item
     * @param $menuId
     * @param $itemId
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function itemEdit($menuId, $itemId)
    {
        Gate::authorize('app.menus.edit');
        $menu = Menu::findOrFail($menuId);
        $menuItem = $menu->menuItemsWithChilds()->findOrFail($itemId);
        
        $permissions = Permission::getAllPermissions();
        return view('backend.admin.menus.item.form',compact('menu','menuItem','permissions'));
    }

    /**
     * Update menu item
     * @param Request $request
     * @param $menuId
     * @param $itemId
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function itemUpdate(UpdateMenuItemRequest $request, $menuId, $itemId)
    {
        $menu = Menu::findOrFail($menuId);
        $menu->menuItems()->findOrFail($itemId)->update([
            'type' => $request->type,
            'title' => [
                'ar'=>$request->title_ar,
                'en'=>$request->title_en
            ],
            'divider_title' => [
                'ar'=>$request->divider_title_ar,
                'en'=>$request->divider_title_en
            ],
            'url' => $request->url,
            'target' => $request->target,
            'icon_class' => $request->icon_class,
        ]);
        session()->flash('success', __('admin.success_update',['item'=>__('admin.menu_item')]));
        return redirect()->route('app.menus.builder',$menu->id);
    }

    /**
     * Delete a menu item
     * @param $menuId
     * @param $itemId
     * @return \Illuminate\Http\RedirectResponse
     */
    public function itemDestroy($menuId, $itemId)
    {
        Gate::authorize('app.menus.destroy');
        Menu::findOrFail($menuId)
            ->menuItems()
            ->findOrFail($itemId)
            ->delete();
        session()->flash('success', __('admin.success_delete'));
        return redirect()->back();
    }
}
