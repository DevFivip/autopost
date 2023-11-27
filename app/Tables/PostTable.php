<?php

namespace App\Tables;

use Illuminate\Http\Request;
use ProtoneMedia\Splade\AbstractTable;
use ProtoneMedia\Splade\Facades\Toast;
use ProtoneMedia\Splade\SpladeTable;
use Illuminate\Database\Eloquent\Builder;

class PostTable extends AbstractTable
{
    /**
     * Create a new instance.
     *
     * @return void
     */
    public function __construct(public Builder|null $query=null)
    {
        if(!$query){
            $this->query = \App\Models\Post::query();
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
                columns: ['id',]
            )
            ->bulkAction(
                label: trans('tomato-admin::global.crud.delete'),
                each: fn (\App\Models\Post $model) => $model->delete(),
                after: fn () => Toast::danger(__('Post Has Been Deleted'))->autoDismiss(2),
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
                key: 'customer_id',
                label: __('Customer id'),
                sortable: true
            )
            ->column(
                key: 'subreddit_id',
                label: __('Subreddit id'),
                sortable: true
            )
            ->column(
                key: 'telegram_channel_id',
                label: __('Telegram channel id'),
                sortable: true
            )
            ->column(
                key: 'post_type_id',
                label: __('Post type id'),
                sortable: true
            )
            ->column(
                key: 'title',
                label: __('Title'),
                sortable: true
            )
            ->column(
                key: 'description',
                label: __('Description'),
                sortable: true
            )
            ->column(
                key: 'link',
                label: __('Link'),
                sortable: true
            )
            ->column(
                key: 'local_media_file',
                label: __('Local media file'),
                sortable: true
            )
            ->column(key: 'actions',label: trans('tomato-admin::global.crud.actions'))
            ->export()
            ->paginate(10);
    }
}
