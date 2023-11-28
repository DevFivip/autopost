<?php

namespace App\Tables;

use App\Models\Customer;
use Illuminate\Http\Request;
use ProtoneMedia\Splade\AbstractTable;
use ProtoneMedia\Splade\Facades\Toast;
use ProtoneMedia\Splade\SpladeTable;
use Illuminate\Database\Eloquent\Builder;

class ImageTable extends AbstractTable
{
    /**
     * Create a new instance.
     *
     * @return void
     */
    public function __construct(public Builder|null $query=null)
    {
        if(!$query){
            $this->query = \App\Models\Image::query();
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
                columns: ['id','name',]
            )
            ->bulkAction(
                label: trans('tomato-admin::global.crud.delete'),
                each: fn (\App\Models\Image $model) => $model->delete(),
                after: fn () => Toast::danger(__('Image Has Been Deleted'))->autoDismiss(2),
                confirm: true
            )
            ->defaultSort('id', 'desc')
            ->column(
                key: 'id',
                label: __('Id'),
                sortable: true,
                hidden:true
            )
            ->column(
                key: 'name',
                label: __('Preview'),
                sortable: true
            )
            ->column(
                key: 'customer_id',
                label: __('Customer_id'),
                sortable: true,
                hidden:true
            )
            ->column(
                key: 'customer.fullname',
                label: __('Customer'),
                sortable: true,
            )
            ->column(
                key: 'tags',
                label: __('Tags'),
                sortable: true
            )
            ->column(key: 'actions',label: trans('tomato-admin::global.crud.actions'))
            ->export()
            ->selectFilter(
                key: 'customer_id',
                options: Customer::myCustomers()->pluck('fullname', 'id')->toArray(),
                label: 'Customer',
                noFilterOption: true,
                noFilterOptionLabel: 'All Customers'
            )
            ->paginate(10);
    }
}
