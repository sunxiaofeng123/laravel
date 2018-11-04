<?php

namespace App\Admin\Controllers;

use App\Models\User;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;

class UserController extends Controller
{
    use HasResourceActions;

    /**
     * Index interface.
     *
     * @param Content $content
     * @return Content
     */
    public function index(Content $content)
    {
        return $content
            ->header('用户列表')
            ->body($this->grid());
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new User);

        $grid->id('Id')->sortable(); //创建列名为ID的列
        $grid->name('用户名');
        $grid->email('邮箱');
        $grid->email_verified('已验证邮箱')->display(function($value){
            return $value ? '是' : '否';
        });
        $grid->created_at('创建时间');
        $grid->updated_at('修改时间');

        $grid->disableCreateButton(); //不显示创建按钮
        $grid->actions(function($actions){
            //不在美一行后面展示查看按钮
            $actions->disableview();
            //不在每一行后面展示删除按钮
            $actions->disableDelete();
            //不在每一行后面展示编辑按钮
            $actions->disableEdit();
        });

        $grid->tools(function($tools){
            $tools->batch(function ($batch){ //禁用批量删除
                $batch->disableDelete();
            });

        });

        return $grid;
    }
}