<?php

namespace App\Tables;

use App\Models\Customer;
use App\Models\Subreddit;
use Illuminate\Http\Request;
use ProtoneMedia\Splade\AbstractTable;
use ProtoneMedia\Splade\Facades\Toast;
use ProtoneMedia\Splade\SpladeTable;
use Illuminate\Database\Eloquent\Builder;

class EventTable extends AbstractTable
{
    /**
     * Create a new instance.
     *
     * @return void
     */
    public function __construct(public Builder|null $query = null)
    {
        if (!$query) {
            $this->query = \App\Models\Event::query();
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
                each: fn (\App\Models\Event $model) => $model->delete(),
                after: fn () => Toast::danger(__('Event Has Been Deleted'))->autoDismiss(2),
                confirm: true
            )
            ->defaultSort('id', 'desc')
            ->column(
                key: 'id',
                label: __('Id'),
                sortable: true,
                hidden: true,
            )
            ->column(
                key: 'user_id',
                label: __('User id'),
                sortable: true,
                hidden: true,
            )
            ->column(
                key: 'customer_id',
                label: __('Customer id'),
                sortable: true,
                hidden: true,
            )
            ->column(
                key: 'subreddit_id',
                label: __('Subreddit id'),
                sortable: true,
                hidden: true,
            )
            ->column(
                key: 'posted_at',
                label: __('Scheduled Date and Time'),
                sortable: true
            )
            ->column(
                key: 'user.name',
                label: __('User'),
                sortable: true,
                hidden: true
            )
            ->column(
                key: 'customer.fullname',
                label: __('Customer'),
                sortable: true
            )
            ->column(
                key: 'subreddit.name',
                label: __('Subreddit'),
                sortable: true
            )
            ->column(
                key: 'status',
                label: __('Status'),
                sortable: true
            )
            ->column(key: 'actions', label: trans('tomato-admin::global.crud.actions'))
            ->export()
            ->selectFilter(
                key: 'customer_id',
                options: Customer::myCustomers()->pluck('fullname', 'id')->toArray(),
                label: 'Customer',
                noFilterOption: true,
                noFilterOptionLabel: 'All Customers'
            )
            ->selectFilter(
                key: 'subreddit_id',
                options: Subreddit::all()->pluck('name', 'id')->toArray(),
                label: 'Subreddits',
                noFilterOption: true,
                noFilterOptionLabel: 'All Subreddits'
            )
            ->selectFilter(
                key: 'status',
                options: ['Failed','Pending','Completed'],
                label: 'Status',
                noFilterOption: true,
                noFilterOptionLabel: 'All Status'
            )
            ->paginate(10);
    }
}
