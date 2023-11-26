<?php

namespace App\Tables;

use Illuminate\Http\Request;
use ProtoneMedia\Splade\AbstractTable;
use ProtoneMedia\Splade\Facades\Toast;
use ProtoneMedia\Splade\SpladeTable;
use Illuminate\Database\Eloquent\Builder;

class CustomerTable extends AbstractTable
{
    /**
     * Create a new instance.
     *
     * @return void
     */
    public function __construct(public Builder|null $query=null)
    {
        if(!$query){
            $this->query = \App\Models\Customer::query();
        }
    }

    /**
     * Determine if the user is authorized to perform bulk actions and exports.
     *
     * @return bool
     */
    public function authorize(Request $request)
    {
        return true;
    }

    /**
     * The resource or query builder.
     *
     * @return mixed
     */
    public function for()
    {
        return $this->query;
    }

    /**
     * Configure the given SpladeTable.
     *
     * @param \ProtoneMedia\Splade\SpladeTable $table
     * @return void
     */
    public function configure(SpladeTable $table)
    {
        $table
            ->withGlobalSearch(
                label: trans('tomato-admin::global.search'),
                columns: ['id','email','fullName']
            )
            ->bulkAction(
                label: trans('tomato-admin::global.crud.delete'),
                each: fn (\App\Models\Customer $model) => $model->delete(),
                after: fn () => Toast::danger(__('Customer Has Been Deleted'))->autoDismiss(2),
                confirm: true
            )
            ->defaultSort('id', 'desc')
            ->column(
                key: 'id',
                label: __('Id'),
                sortable: true
            )
            ->column(
                key: 'user_id',
                label: __('User id'),
                sortable: true
            )
            ->column(
                key: 'fullname',
                label: __('Fullname'),
                sortable: true,
            )
            ->column(
                key: 'email',
                label: __('Email'),
                sortable: true
            )
            ->column(
                key: 'reddit_username',
                label: __('Reddit username'),
                sortable: true,
                hidden:true,
            )
            ->column(
                key: 'reddit_password',
                label: __('Reddit password'),
                sortable: true,
                hidden:true,
            )
            ->column(
                key: 'reddit_clientId',
                label: __('Reddit clientId'),
                sortable: true,
                hidden:true,
            )
            ->column(
                key: 'reddit_clientSecret',
                label: __('Reddit clientSecret'),
                sortable: true,
                hidden:true,
            )
            ->column(
                key: 'imgur_username',
                label: __('Imgur username'),
                sortable: true,
                hidden:true,
            )
            ->column(
                key: 'imgur_password',
                label: __('Imgur password'),
                sortable: true,
                hidden:true,
            )
            ->column(
                key: 'imgur_clientId',
                label: __('Imgur clientId'),
                sortable: true,
                hidden:true,
            )
            ->column(
                key: 'imgur_clientSecret',
                label: __('Imgur clientSecret'),
                sortable: true,
                hidden:true,
            )
            ->column(
                key: 'telegram_channel',
                label: __('Telegram channel'),
                sortable: true,
                hidden:true,
            )
            ->column(
                key: 'tags',
                label: __('Tags'),
                sortable: true
            )
            ->column(
                key: 'status',
                label: __('Status'),
                sortable: true
            )
            ->column(key: 'actions',label: trans('tomato-admin::global.crud.actions'))
            ->export()
            ->paginate(10);
    }
}
