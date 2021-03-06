<?php

namespace App\DataTables;

// use App\Models\ProductDatatable;

use App\Models\Category;
use App\Models\Product;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class ProductDatatable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {

        $dataTable = datatables()
            ->eloquent($query);


        // $dataTable->addColumn('total', function (Cart $cart) {
        //     $total = $cart->quantity * $cart->product->amount;
        //     return $total . ' Rs';
        // });

        $dataTable->editColumn('category', function (Product $product) {
            return $product->category->name;
        });

        $dataTable->editColumn('action', function (Product $product) {
            $id  = $product->id;
            // editProduct
            // $base_url = env('APP_URL');
            return '<a href="' . route('editProduct', ['id' => $id]) . '" data-id="{{$product->id}}" class="sidebar-link warning" data-bs-toggle="modal"  ><i class="bi bi-pencil"></i> </a>

            <button type="button" data-id="' . $id . '" class=" deleteProduct sidebar-link btn  "><i class="bi bi-trash"></i></button>';
        });



        $dataTable->rawColumns(['category', 'action']);
        return $dataTable;
    }

    /** Get query source of dataTable.
     * send data
     *
     * @param \App\Models\ProductDatatable $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Product $model)
    {
        // $id = $this->id;
        return $model->newQuery();

        // ->select('products.id as id', 'products.name as productname', 'price', 'categories.name as categoryname')
        // ->leftJoin('categories', 'categories.id', '=', 'products.category_id');
    }

    /**
     * Optional method if you want to use html builder.
     * This is used for bouilding whole table featuers
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->setTableId('product-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->orderBy(1)
            ->parameters([
                'dom' => 'lBrtip',
                'ordering' => false,
                'buttons' => ['csv', 'excel'],
                'pageLength' => 10
                // , 'excel', 'pdf', 'print', 'reset', 'reload'
            ]);
    }

    /**
     * Get columns.
     * Listing of datatable columns from controller
     * for giving extra features to  column,  go up  to   public function dataTable($query)
     *
     * @return array
     */
    protected function getColumns()
    {
        return [

            Column::make('id')->orderable(false),
            Column::make('name')->orderable(false),
            Column::make('category')->orderable(false)->sWidth('200px'),
            Column::make('price')->orderable(false)->sWidth('200px'),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(60)
                ->addClass('text-center'),

        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Product_' . date('YmdHis');
    }
}
