<?php

namespace App\Tables;

use App\Models\Customer;
use Illuminate\Http\Request;
use ProtoneMedia\Splade\AbstractTable;
use ProtoneMedia\Splade\Facades\Toast;
use ProtoneMedia\Splade\SpladeTable;
use Illuminate\Database\Eloquent\Builder;

class CustomerSubredditTable extends AbstractTable
{
    /**
     * Create a new instance.
     *
     * @return void
     */
    public function __construct(public Builder|null $query = null)
    {
        if (!$query) {
            $this->query = \App\Models\CustomerSubreddit::query();
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
                columns: ["customer.fullname", 'subreddit.name', "subreddit.tags"]
            )
            ->bulkAction(
                label: trans('tomato-admin::global.crud.delete'),
                each: fn (\App\Models\CustomerSubreddit $model) => $model->delete(),
                after: fn () => Toast::danger(__('CustomerSubreddit Has Been Deleted'))->autoDismiss(2),
                confirm: true
            )
            ->defaultSort('id', 'desc')
            ->column(
                key: 'user_id',
                label: __('User id'),
                sortable: true,
                hidden: true
            )
            ->column(
                key: 'customer_id',
                label: __('Customer id'),
                sortable: true,
                hidden: true
            )
            ->column(
                key: 'user.name',
                label: __('User'),
                sortable: true,
                hidden: true
            )
            ->column(
                key: 'customer.fullname',
                label: __('Customer Name'),
                sortable: true
            )
            ->column(
                key: 'subreddit.name',
                label: __('Subreddit'),
                sortable: true
            )
            ->column(
                key: 'subreddit.tags',
                label: __('Subreddit Tags'),
                sortable: true
            )
            ->column(
                key: 'subreddit_id',
                label: __('Subreddit id'),
                sortable: true,
                hidden: true
            )
            ->column(
                key: 'verification_status',
                label: __('Verification Status'),
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
                key: 'verification_status',
                options: [1 => 'Unkown', 2 => 'Banned', 3 => 'Pending', 4 => 'Verified'],
                label: 'Status',
                noFilterOption: true,
                noFilterOptionLabel: 'All Status'
            )
            ->paginate(10);
    }
}
